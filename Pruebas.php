<?php
include 'Admin/fpdf/headerFooter.php';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'I', 36);
for ($i = 0; $i < 40; $i++) {
    $pdf->Cell(40, 10, 'Hola PDF');
    $pdf->Ln(12);
}
$pdf->Output();
