<?php
include 'Admin/BDD/Conexion.php';
include 'Admin/fpdf/headerFooter.php';

$sql = "SELECT f.fechaCreacion, f.id, f.subtotal, f.total, f.valorIva, d.cantidad, d.precio, d.importe, p.nombre AS nomProducto, c.nombre, c.apellido, c.cedula, c.email
FROM tb_facturas f
INNER JOIN tb_detalle d ON f.id = d.idFactura
INNER JOIN tb_productos p ON d.idProducto = p.id
INNER JOIN tb_clientes c ON f.idCliente = c.id
WHERE f.id = 5
";

$result = $conn->query($sql);
$row = $result->fetch_assoc();


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//inicio datos cliente
$pdf->SetFont('Arial', '', 12);
// Movernos a la derecha
$cliente = 'NOMBRES: ' . $row['nombre'] . ' ' . $row['apellido'];
$pdf->Cell(1, 0, utf8_decode($cliente));
$pdf->Ln();
$cliente = 'RUC/CI: ' . $row['cedula'];
$pdf->Cell(1, 10, utf8_decode($cliente));
$pdf->Ln();
$cliente = 'Correo: ' . $row['email'];
$pdf->Cell(1, 0, utf8_decode($cliente));
// Salto de línea
$pdf->Ln(20);

//fin datos cliente


$y_axis_initial = 25;

//Seteamos el tiupo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(1, 6, '', 0, 0, 'C');
$pdf->Cell(170, 6, 'DETALLE DE LA COMPRA', 1, 0, 'C');

$pdf->Ln(10);

//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232, 232, 232);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 6, 'Cantidad', 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'Producto', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Precio', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Subtotal', 1, 0, 'C', 1);

$pdf->Ln(8);

while ($fila = $result->fetch_array()) {
    $producto = $fila['nomProducto'];
    $precio = $fila['precio'];
    $cantidad = $fila['cantidad'];
    $importe = $fila['importe'];

    $pdf->Cell(30, 15, $cantidad, 1, 0, 'R', 1);
    $pdf->Cell(80, 15, $producto, 1, 0, 'L', 0);
    $pdf->Cell(30, 15, $precio, 1, 0, 'R', 1);
    $pdf->Cell(30, 15, $importe, 1, 0, 'R', 1);

    $pdf->Ln(15);
}
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 12);
// Movernos a la derecha
$valores = 'SUBTOTAL: ' . $row['subtotal'];
$pdf->Cell(150, 0, utf8_decode($valores));
$pdf->Ln();
$valores = 'IVA 12%: ' . $row['valorIva'];
$pdf->Cell(150, 10, utf8_decode($valores));
$pdf->Ln();
$valores = 'TOTAL: ' . $row['total'];
$pdf->Cell(150, 0, utf8_decode($valores));


$conn->close();

//Mostramos el documento pdf
$pdf->Output();
