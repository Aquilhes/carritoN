<?php

include 'Conexion.php';

if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Guardar") {
    $id = $_POST['txtId'];
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $email = $_POST['txtCorreo'];
    $username = $_POST['txtUsuario'];
    $passwd = md5($_POST['txtPasswd']);

    if (empty($id)) {

        $sql = "INSERT INTO tb_usuarios (nombre, apellido, email, username, passwd) VALUES ('$nombre', '$apellido', '$email', '$username', '$passwd')";
        $mensaje = "Usuario creado";
    } else {
        $sql = "UPDATE tb_productos SET nombre = '$nombre', apellido = '$apellido', email = '$email', username = '$username', passwd = '$passwd' WHERE id = $id";
        $mensaje = "Usuario actualizado";
    }

    if ($conn->query($sql)) {
        echo '<script>
        alert("' . $mensaje . '");
        window.location.href = "../UsuariosView.php";
        </script>';
    } else {
        echo 'Error al guardar los datos' . $conn->error;
    }

    $conn->close();
} else if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Eliminar") {
    $id = $_POST['id'];
    $sql = "UPDATE tb_usuarios SET idEstado = 0 WHERE id = $id";

    if ($conn->query($sql)) {
        echo '<script>
        alert("Usuario eliminado");
        window.location.href = "../UsuariosView.php";
        </script>';
    } else {
        echo 'Error al eliminar: ' . $conn->error;
    }
    $conn->close();
} else if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Activar") {
    $id = $_POST['id'];
    $sql = "UPDATE tb_usuarios SET idEstado = 1 WHERE id = $id";

    if ($conn->query($sql)) {
        echo '<script>
        alert("Usuario activado");
        window.location.href = "../UsuariosView.php";
        </script>';
    } else {
        echo 'Error al eliminar: ' . $conn->error;
    }
    $conn->close();
}