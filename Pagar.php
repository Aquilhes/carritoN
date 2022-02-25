<?php
include 'plantillas/Header.php';
include 'Admin/BDD/Conexion.php';
session_start();
$flag = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['txtUsername'];
    $passwd = $_POST['txtPasswd'];

    $sql = "SELECT * FROM tb_clientes WHERE username = '$username' AND passwd = '$passwd';";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $subTotal = $_SESSION["VALORES"]["SUBTOTAL"];
        $valorIva = $_SESSION['VALORES']['VALORIVA'];
        $total = $_SESSION['VALORES']['TOTAL'];
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $sql = "INSERT INTO tb_facturas VALUES (null, CURDATE(), $subTotal, $valorIva, $total, $id)";
        if ($conn->query($sql)) {
            $idFactura = $conn->insert_id;
        } else {
            $flag = false;
        }

        foreach ($_SESSION['Carrito'] as $compra) {
            $idProducto = $compra['id'];
            $precio = $compra['precio'];
            $cantidad = $compra['cantidad'];
            $importe = $compra['importe'];
            $sql = "INSERT INTO tb_detalle VALUES (null, $cantidad, $importe, $precio, $idProducto, $idFactura)";
            if ($conn->query($sql)) {
                $flag = true;
            }
        }
        if ($flag) {
            session_destroy();
            echo '<script>
                alert("Compra registrada");
                window.location.href = "index.php";
                </script>';
        } else {
            echo '<script>
                alert("Error al generar la compra");
                window.location.href = "index.php";
                </script>';
        }
    } else {
        echo '<script>
        alert("Datos incorrectos vuelva a intentar");
        window.location.href = "index.php";
        </script>';
    }
}

?>


<h1 class="display-4 text-danger text-center">CONTACT SOLUTIONS</h1>
<div class="d-flex flex-column justify-content-center align-items-center">
    <div class="card mb-4 p-4 bg-dark bg-gradient text-white col-md-4">
        <div class="card-header text-center">
            <h3>Bienvenido, ingrese sus datos para continuar </h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="input-group form-group mt-3">
                    <input type="text" class="form-control text-center p-3" placeholder="Usuario" name="txtUsername" id="txtUsername">
                </div>
                <div class="input-group form-group mt-3">
                    <input type="password" class="form-control text-center p-3" placeholder="Contraseña" name="txtPasswd" id="txtPasswd">
                </div>
                <div class="text-center">
                    <input type="submit" value="Acceder" class="btn btn-primary mt-3 w-100 p-2 bi-enter" name="login-btn">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'plantillas/Footer.php'; ?>