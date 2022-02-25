<?php
include 'plantillas/Header.php';
include 'BDD/Conexion.php';
/*
if ($_SESSION['PERMISO']) {
    $sql = "SELECT * FROM tb_estudiantes WHERE idEstado = 1;";
    $result = $conn->query($sql);
} else {
    header("Location: Login.php");
}
*/

$sql = "SELECT * FROM tb_productos WHERE idEstado = 0";
$result = $conn->query($sql);
?>


<div class="container">
    <div class="row">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>MARCA</th>
                    <th>DETALLE</th>
                    <th>PRECIO</th>
                    <th>STOCK</th>
                    <th>FOTO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td scope="row"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['marca']; ?></td>
                        <td><?php echo $row['detalle']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                        <td><img class="card-img-top" src="../img/Productos/<?php echo $row['foto']; ?>" alt="aqui la foto"></td>
                        <td>
                            <form action="Productos.php" method="post">
                                <input type="hidden" class="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-primary" name="Enviar" value="Activar">
                                    <span><i class="bi-pencil" style="font-size: 1rem;"></i></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'plantillas/Footer.php'; ?>