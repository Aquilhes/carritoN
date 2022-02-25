<?php
include 'plantillas/HeaderLogin.php';
include 'BDD/Conexion.php';
session_start();

$_SESSION['PERMISO'] = false;
$_SESSION['NOMBRES'] = "";
$_SESSION['APELLIDOS'] = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $username = $_POST['txtUsername'];
    $passwd = md5($_POST['txtPasswd']);
    $sql = "SELECT * FROM tb_usuarios WHERE username = '$username' AND passwd = '$passwd'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['PERMISO'] = true;
        $_SESSION['NOMBRES'] = $row['nombre'];
        $_SESSION['APELLIDOS'] = $row['apellido'];
        $_SESSION['CORREO'] = $row['email'];
        $_SESSION['USERNAME'] = $row['username'];
        echo '<script>
        window.location.href = "ProductosView.php";
        </script>';
    } else {
        echo '<script>alert("Credenciales incorrectos, intente otra vez")</script>';
    }
}
?>
<br>
<div class="d-flex flex-column justify-content-center align-items-center">

    <div class="card mb-4 p-4 bg-dark bg-gradient text-white col-md-4">
        <div class="card-header text-center">
            <h3>Iniciar sesión </h3>
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