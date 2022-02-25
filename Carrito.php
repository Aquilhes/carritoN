<?php
include 'Plantillas/Header.php';
include 'Admin/BDD/Conexion.php';
session_start();

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
                foreach ($_SESSION['Carrito'] as $elemento) {
                ?>
                    <tr>
                        <td><?php echo $elemento['id']; ?></td>
                        <td><?php echo $elemento['nombre']; ?></td>
                        <td><?php echo $elemento['precio']; ?></td>
                        <td><input type="number" onchange="actualizar(<?php echo $elemento['id']; ?>, this.value);" value="<?php echo $elemento["cantidad"]; ?>" /></td>
                        <td><?php echo $elemento['importe']; ?></td>
                        <td>
                            <form action="CarritoLogica.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $elemento['id'] ?>">
                                <button type="submit" class="btn btn-black" name="Operation" value="Delete">
                                    <span><i class="bi bi-trash" style="font-size: 1rem;"></i></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">
                    <td class="card-title display-7 text-danger" style="text-align: right;">SubTotal:
                        <?php
                        echo '<td class="text-danger" style="text-align: left;">$' . $_SESSION['VALORES']['SUBTOTAL'] . '</td>';
                        ?>
                    </td>
                    </th>
                </tr>
                <tr>
                    <th colspan="3">
                    <td class="card-title text-danger" style="text-align: right;">Iva 12%:</label>
                        <?php
                        echo '<td class="text-danger text-bold" style="text-align: left;">$' . $_SESSION['VALORES']['VALORIVA'] . '</td>';
                        ?>
                    </td>
                    </th>
                </tr>
                <tr>
                    <th colspan="3">
                    <td class="text-danger" style="text-align: right;">Total:
                        <?php
                        echo '<td class="text-danger" style="text-align: left;">$' . $_SESSION['VALORES']['TOTAL'] . '</td>';
                        ?>
                        </label>
                        </th>
                </tr>
            </tfoot>
        </table>
        <div class="col-md-9">
        </div>
        <div class="col-md-3">
            <a href="Pagar.php" class="btn btn-success">Pagar</a>
        </div>
    </div>
</div>

<script>
    function actualizar(id, cantidad) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'CarritoLogica.php?id=' + id + '&Operation=Update&cantidad=' + cantidad, false);
        xhr.send();

        /*         Verificar si se envian los datos al servidor
        xhr.onreadystatechange = (e) => {
                    alert("Datos: " + xhr.responseText);
                } */

        location.reload();
    }
</script>
<?php
include 'Plantillas/Footer.php';
?>