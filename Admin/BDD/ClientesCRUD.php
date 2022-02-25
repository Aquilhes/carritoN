<?php

include 'Conexion.php';

if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Guardar") {
    $id = $_POST['txtId'];
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $cedula = $_POST['txtCedula'];
    $email = $_POST['txtCorreo'];
    $fechaNacimiento = $_POST['txtFechaNac'];
    $username = $_POST['txtUsername'];
    $passwd = $_POST['txtPasswd'];

    if (empty($id)) {

        $sql = "INSERT INTO tb_productos (nombre, apellido, cedula, email, fechaNacimiento, username, passwd) VALUES ('$nombre', '$apellido', '$cedula', '$email', '$fechaNacimiento', '$username', '$passwd')";
        $mensaje = "Cliente creado";
    } else {
        $sql = "UPDATE tb_productos SET nombre = '$nombre', apellido = '$apellido', cedula = '$cedula', email = '$email', fechaNacimiento = '$fechaNacimiento' WHERE id = $id";
        $mensaje = "Cliente actualizado";
    }

    if ($conn->query($sql)) {
        echo '<script>
        alert("' . $mensaje . '");
        window.location.href = "../ClientesView.php";
        </script>';
    } else {
        echo 'Error al guardar los datos' . $conn->error;
    }

    $conn->close();
} else if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Eliminar") {
    $id = $_POST['id'];
    $sql = "UPDATE tb_clientes SET idEstado = 0 WHERE id = $id";

    if ($conn->query($sql)) {
        echo '<script>
        alert("Cliente eliminado");
        window.location.href = "../ClientesView.php";
        </script>';
    } else {
        echo 'Error al eliminar: ' . $conn->error;
    }
    $conn->close();
}else if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Activar") {
    $id = $_POST['id'];
    $sql = "UPDATE tb_clientes SET idEstado = 1 WHERE id = $id";

    if ($conn->query($sql)) {
        echo '<script>
        alert("Cliente activado");
        window.location.href = "../ClientesView.php";
        </script>';
    } else {
        echo 'Error al eliminar: ' . $conn->error;
    }
    $conn->close();
}
