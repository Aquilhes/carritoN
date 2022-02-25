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
$marca = "";
$detalle = "";
$precio = "";
$stock = "";
$foto = "";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST) && $_POST['Enviar'] === "Actualizar") {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_productos WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $ruta = "../img/Productos/";
    $nombre = $row['nombre'];
    $marca = $row['marca'];
    $detalle = $row['detalle'];
    $precio = $row['precio'];
    $stock = $row['stock'];
    $foto = $row['foto'];
}
?>
<h1 class="display-4 text-danger text-center">CONTACT SOLUTIONS</h1>
<main>
    <section class="row mt-4">
        <div class="col- 4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Productos</h4>
                </div>
                <div class="card-body">
                    <form class="row" action="BDD/ProductosCRUD.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="txtId" id="txtId" value="<?php echo $id; ?>">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Nombre:</label>
                            <input type="text" name="txtNombre" id="txtNombre" class="form-control" placeholder="Nombre del producto" value="<?php echo $nombre; ?>" onkeyup="mayusculas(this)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Precio:</label>
                            <input type="text" name="txtPrecio" id="txtPrecio" class="form-control" placeholder="Precio del producto" value="<?php echo $precio ?>" onkeypress="return decimales(event)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Stock:</label>
                            <input type="text" name="txtStock" id="txtStock" class="form-control" placeholder="Cantidad del producto" value="<?php echo $stock ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Marca:</label>
                            <input type="text" name="txtMarca" id="txtMarca" class="form-control" placeholder="Marca del producto" value="<?php echo $marca ?>" onkeyup="mayusculas(this)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Seleccione una foto:</label>
                            <input type="hidden" name="txtFotoActual" id="txtFotoActual" value="<?php echo $foto; ?>">
                            <input type="file" class="file form-control" name="txtFoto" id="txtFoto" value="<?php echo $foto; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label">Descripción:</label>
                            <textarea name="txtDetalle" id="txtDetalle" class="form-control" rows="3" onkeyup="mayusculas(this)"><?php echo $detalle; ?></textarea><br>
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