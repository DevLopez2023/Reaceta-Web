<?php
/**
 * Plantilla para encabezado y pie de página
 * 
 */

require 'fpdf/fpdf.php';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        global $tituloCarrera;
        global $tituloReporte;
        // Logos
        $this->Image("images/logo.png", 10, 5, 75);
        $this->Image("images/utm-pie.png", 230, 5, 60);

        // Arial bold 15
        $this->SetFont("Arial", "B", 17);

        // Título
        $this->Cell(70);
        $this->Cell(140, 5,  mb_convert_encoding($tituloReporte, 'ISO-8859-1', 'UTF-8'), 0, 6, "C");

        //Fecha
        $this->SetFont("Arial", "", 12);
        $this->Cell(135, 10, "CARRERA: " . $tituloCarrera, 0, 1, "C");

        // Salto de línea
        $this->Ln(10);
        $this->SetFont("Arial", "", 8);
        $this->Cell(90, 20, "INFORME CON VALIDEZ TECNICA, GENERADO EL: " . date("d/m/Y"), 0, 1, "C");
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}