<?php
include 'Admin/BDD/Conexion.php';
session_start();
$flag = true;
$subTotal = 0;
$iva = 0.12;
$aPagar = 0;
$valorIva = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST) && $_POST['Operation'] == "Add") {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_productos WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!isset($_SESSION['Carrito'])) {
        $productoArray = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'precio' => $row['precio'],
            'cantidad' => 1,
            'importe' => $row['precio']
        );
        $_SESSION['Carrito'][$row['id']] = $productoArray;
    } else {
        foreach ($_SESSION['Carrito'] as $element) {
            if ($element['id'] == $id) {
                $_SESSION['Carrito'][$id]['cantidad']++;
                $_SESSION['Carrito'][$id]['importe'] = $_SESSION['Carrito'][$id]['precio'] * $_SESSION['Carrito'][$id]['cantidad'];
                $flag = false;
            }
        }

        if ($flag) {
            $productoArray = array(
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'precio' => $row['precio'],
                'cantidad' => 1,
                'importe' => $row['precio']
            );
            $_SESSION['Carrito'][$row['id']] = $productoArray;
        }
    }
    header("Location: Carrito.php");
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST) && $_POST['Operation'] == "Delete") {
    $id = $_POST['id'];
    unset($_SESSION['Carrito'][$id]);
    header("Location: Carrito.php");
} else if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET) && $_GET['Operation'] == "Update") {
    $id = $_GET['id'];
    $cantidad = $_GET['cantidad'];
    $_SESSION['Carrito'][$id]['cantidad'] = $cantidad;
    $_SESSION['Carrito'][$id]['importe'] = $_SESSION['Carrito'][$id]['precio'] * $_SESSION['Carrito'][$id]['cantidad'];
}


if (isset($_SESSION['Carrito'])) {
    foreach ($_SESSION['Carrito'] as $item) {
        $subTotal += $subTotal + $item['importe'];
    }

    $valorIva = $subTotal * $iva;
    $aPagar = $subTotal + $valorIva;

    $valorIva = round($valorIva, 2);
    $aPagar = round($aPagar, 2);
    //$valorIva = round((($subTotal * $iva) * 100), 2);
    //$aPagar = round((($subTotal + $valorIva) * 100), 2);

    $_SESSION['VALORES']['SUBTOTAL'] = $subTotal;
    $_SESSION['VALORES']['VALORIVA'] = $valorIva;
    $_SESSION['VALORES']['TOTAL'] = $aPagar;
}
