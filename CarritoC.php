<?php
include 'Plantillas/Header.php';
include 'Admin/BDD/Conexion.php';
session_start();
$flag = true;


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST) && $_POST['Action'] == "Add") {
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
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST) && $_POST['Action'] == "Delete") {
    $id = $_POST['id'];
    foreach ($_SESSION['Carrito'] as $element) {
        if ($element['id'] == $id && $_SESSION['Carrito'][$id]['cantidad'] > 0) {
            $_SESSION['Carrito'][$id]['cantidad']--;
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

?>

<div class="container">
    <div class="row">
        <table class="table table-striped table-inverse table-responsive">
            <h4 class="card-title text-center display-4 text-danger">Orden de Compra</h4>
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>IMPORTE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo '<br>';

                foreach ($_SESSION['Carrito'] as $k) {
                    echo  '<td>'  . $k['id'] . '</td>';
                    echo  '<td>'  . $k['nombre'] . '</td>';
                    echo  '<td>'  . $k['precio'] . '</td>';
                    echo  '<td name="txtCantidad' . $k['id'] . '">'  . $k['cantidad'] . '</td>';
                    echo  '<td name="txtImporte' . $k['id'] . '">'  . $k['importe'] . '</td>';
                    echo '
                    <td>
                        <form method="post">
                            <input type="hidden" class="hidden" name="id" value="' . $k['id'] . '">
                            <button type="submit" class="btn btn-primary" name="Add" value="Add" onclick="location.refresh">
                                <span><i class="bi-plus" style="font-size: 1rem;"></i></span>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" class="hidden" name="id" value="' . $k['id'] . '">
                            <button type="submit" class="btn btn-danger" name="Add" value="Delete" onclick="location.refresh">
                                <span><i class="bi-trash" style="font-size: 1rem;"></i></span>
                            </button>
                        </form>
                    </td>';
                    echo '<tr>';
                }
                ?>
            </tbody>
        </table>
        <h5 class="card-title text-right display-3 text-danger">SubTotal:
            <?php
            $subtotal = 0;
            foreach ($_SESSION['Carrito'] as $element) {
                $subtotal = $subtotal + $element['importe'];
            }
            echo $subtotal;
            ?>
        </h5>
    </div>
</div>
<?php
include 'Plantillas/Footer.php';
?>