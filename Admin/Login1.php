<?php
include 'plantillas/Header.php';
include 'BDD/Conexion.php';

$_SESSION['PERMISO'] = false;
$_SESSION['NOMBRES'] = "";
$_SESSION['APELLIDOS'] = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $username = $_POST['txtUsername'];
    $passwd = $_POST['txtPasswd'];
    $sql = "SELECT * FROM tb_usuarios WHERE username = '$username' AND passwd = '$passwd'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['PERMISO'] = true;
        $_SESSION['NOMBRES'] = $row['nombre'];
        $_SESSION['APELLIDOS'] = $row['apellido'];
        echo '<script>
        window.location.href = "ProductosView.php";
        </script>';
    } else {
        echo '<script>alert("Credenciales incorrectos, intente otra vez")</script>';
    }
}
?>

<main>
    <section class="row mt-4">
        <div class="col- 4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title-danger text-center">Login</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <label for="" class="form-label">Ingrese su usuario:</label>
                        <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Usuario">
                        <label for="" class="form-label">Ingrese su contraseña:</label>
                        <input type="password" name="txtPasswd" id="txtPasswd" class="form-control" placeholder="Contraseña"><br>
                        <button type="submit" class="btn btn-primary" value="Ingresar">
                            <span><i class="bi-enter" style="font-size: 1rem;"> Login</i></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="row mt-4"></section>
</main>

<?php include 'plantillas/Footer.php'; ?>