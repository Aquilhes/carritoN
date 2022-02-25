<?php
include 'plantillas/Header.php';
include 'BDD/Conexion.php';

/*
if (!$_SESSION['PERMISO']) {
    header("Location: Login.php");
}
*/

$id = "";
$nombre = "";
$apellido = "";
$email = "";
$username = "";
$passwd = "";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST) && $_POST['Enviar'] === "Actualizar") {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_usuarios WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $email = $row['email'];
    $username = $row['username'];
    $passwd = $row['passwd'];
}
?>
<h1 class="display-4 text-danger text-center">CONTACT SOLUTIONS</h1>
<main>
    <section class="row mt-4">
        <div class="col- 4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Usuarios</h4>
                </div>
                <div class="card-body">
                    <form class="row" action="BDD/UsuariosCRUD.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="txtId" id="txtId" value="<?php echo $id; ?>">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Nombre:</label>
                            <input type="text" name="txtNombre" id="txtNombre" class="form-control" placeholder="Nombre del usuario" value="<?php echo $nombre; ?>" onkeyup="mayusculas(this)" onkeypress="return soloLetras(event)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Apellido:</label>
                            <input type="text" name="txtApellido" id="txtApellido" class="form-control" placeholder="Apellido del usuario" value="<?php echo $apellido ?>" onkeyup="mayusculas(this)" onkeypress="return soloLetras(event)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Email:</label>
                            <input type="text" name="txtCorreo" id="txtCorreo" class="form-control" placeholder="Ingrese un correo" value="<?php echo $email ?>" onkeyup="minusculas(this)" onchange="return validarCorreo(txtCorreo.value);">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Usuario:</label>
                            <input type="text" name="txtUsuario" id="txtUsuario" class="form-control" placeholder="Ingrese su nombre de usuario" value="<?php echo $username ?>" onkeyup="minusculas(this)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Contraseña:</label>
                            <input type="password" name="txtPasswd" id="txtPasswd" class="form-control" placeholder="Ingrese una contraseña" value="<?php echo $passwd ?>"><br>
                        </div>
                        <button type="submit" class="btn btn-primary" name="Enviar" value="Guardar">
                            <span><i class="bi bi-save" style="font-size: 1.5rem;"> Guardar</i></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="row mt-4"></section>
</main>

<?php include 'plantillas/Footer.php'; ?>