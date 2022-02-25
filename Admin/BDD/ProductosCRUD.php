<?php

include 'Conexion.php';
$ruta = "../../img/Productos/";

if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Guardar") {
    $id = $_POST['txtId'];
    $nombre = $_POST['txtNombre'];
    $marca = $_POST['txtMarca'];
    $detalle = $_POST['txtDetalle'];
    $precio = $_POST['txtPrecio'];
    $stock = $_POST['txtStock'];
    $fotoActual = $_POST['txtFotoActual'];
    $nombreArchivo = $_FILES['txtFoto']['name'];
    if ($nombreArchivo == null && !empty($fotoActual)) {
        $nombreArchivo = $fotoActual;
    } else if (empty($id) || ((!empty($id)) && ($fotoActual == "") && ($nombreArchivo == null))) {
        $nombreArchivo = $_FILES['txtFoto']['name'];
        $ruta = $ruta . basename($_FILES['txtFoto']['name']);
        if (!(move_uploaded_file($_FILES['txtFoto']['tmp_name'], $ruta))) {
            echo 'Error al subir el archivo';
            return false;
        }
    }
    if (empty($id)) {

        $sql = "INSERT INTO tb_productos (nombre, marca, detalle, precio, stock, foto) VALUES ('$nombre', '$marca', '$detalle', '$precio', '$stock', '$nombreArchivo')";
        $mensaje = "Producto creado";
    } else {
        $sql = "UPDATE tb_productos SET nombre = '$nombre', marca = '$marca', detalle = '$detalle', precio = '$precio', stock = '$stock', foto = '$nombreArchivo' WHERE id = $id";
        $mensaje = "Producto actualizado";
    }

    if ($conn->query($sql)) {
        echo '<script>
        alert("' . $mensaje . '");
        window.location.href = "../ProductosView.php";
        </script>';
    } else {
        echo 'Error al guardar los datos' . $conn->error;
    }

    $conn->close();
} else if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Eliminar") {
    $id = $_POST['id'];
    $sql = "UPDATE tb_productos SET idEstado = 0 WHERE id = $id";

    if ($conn->query($sql)) {
        echo '<script>
        alert("Producto eliminado");
        window.location.href = "../ProductosView.php";
        </script>';
    } else {
        echo 'Error al eliminar: ' . $conn->error;
    }
    $conn->close();
} else if (isset($_POST['Enviar']) && $_POST['Enviar'] === "Activar") {
    $id = $_POST['id'];
    $sql = "UPDATE tb_productos SET idEstado = 1 WHERE id = $id";

    if ($conn->query($sql)) {
        echo '<script>
        alert("Producto activado");
        window.location.href = "../ProductosView.php";
        </script>';
    } else {
        echo 'Error al eliminar: ' . $conn->error;
    }
    $conn->close();
}

