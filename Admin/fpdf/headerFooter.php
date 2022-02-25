<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $hoy = date("Y-m-d H:i:s");
        // Logo
        $this->Image('img/logos/descarga.png', 10, 8, 70);
        // Arial bold 15
        $this->SetFont('Arial', '', 12);
        // Movernos a la derecha
        $this->Cell(80);
        $titulo = 'RUC: 1715730071001';
        $this->Cell(80, 0, utf8_decode($titulo));
        $this->Ln();
        $this->Cell(80);
        $titulo = 'FACTURA: ';
        $this->Cell(80, 10, utf8_decode($titulo));
        $this->Ln();
        $this->Cell(80);
        $titulo = 'FECHA: ' . $hoy;
        $this->Cell(80, 10, utf8_decode($titulo));
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', '', 8);
        // Número de página
        $page = "Página ";
        $this->Cell(0, 10, utf8_decode($page) . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
}
