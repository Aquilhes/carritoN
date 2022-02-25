<?php
include 'Plantillas/Header.php';
include 'Admin/BDD/Conexion.php';
$sql = "SELECT * FROM tb_productos WHERE stock > 3;";
$result = $conn->query($sql);
?>

<div class="container-fluid">
    <div class="row">
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="col-md-3">
                <div class="class-card text-black">
                    <img class="card-img-top" src="img/Productos/<?php echo $row['foto']; ?>" alt="imagen producto">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $row['nombre']; ?></h4>
                        <p class="card-text">Detalle: <?php echo $row['detalle']; ?></p>
                        <h4 class="card-title">$<?php echo $row['precio']; ?></h4>
                        <form action="CarritoLogica.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-primary" name="Operation" value="Add"><i class="bi bi-bag-plus"></i> Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        $conn->close();
        ?>
    </div>
</div>

<?php
include 'Plantillas/Footer.php';
?>