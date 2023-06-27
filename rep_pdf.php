<?php
/**
 * Reporte en PDF con FPDF v1.85
 * 
 * Fecha: 23/06/2023
 * Autor: Oscar López G
 */

require "conexion.php";
require "plantilla.php";

if (!empty($_GET)) {
    $codi_carrera = $_GET['codi_carrera'];
    $c_c = $codi_carrera[0]; //sacando el primer valor del array


    /*$sqlMateria = $conexion_pdo->query("SELECT nombre_m,unidad1,unidad2,unidad3,unidad4,r_t,fecha_ini,observaciones FROM materia WHERE cod_carrera = '$c_c' ORDER BY cod_materia");*/

    //CONSULTA PARA SACAR TODOS LOS DATOS - CARRERA>ASIGNATURA>PROFESOR SQL
    $sqlMateria = $conexion_pdo->query("SELECT p.nombre_p, m.cod_materia,c.nombre_c,m.nombre_m,d.unidad1,d.unidad2,d.unidad3,d.unidad4,d.r_t,d.fecha_ini,d.observaciones
    FROM distributivo d INNER JOIN materia AS m
    ON d.cod_carrera = '$c_c' AND d.cod_materia = m.cod_materia
    INNER JOIN carrera AS c ON c.cod_carrera = d.cod_carrera
    INNER JOIN profesor AS p ON p.cod_profesor = d.cod_profesor;");


    $resultadoMateria = $sqlMateria->fetchAll(PDO::FETCH_OBJ);
    $tituloReporte = "CUMPLIMIENTO DE REACTIVOS";

    foreach($resultadoMateria as $r_m):
        $tituloCarrera = $r_m->nombre_c;
    endforeach;

    $pdf = new PDF('L','mm','A4');
    
    $pdf->SetTitle($tituloReporte);
    $pdf->SetTitle($tituloCarrera);
    $pdf->SetAuthor('Ing. Oscar López - ETA');
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 9);

    $pdf->Cell(80, 5, "ASIGNATURA", 1, 0, "C");
    $pdf->Cell(80, 5, "PROFESOR", 1, 0, "C");
    $pdf->Cell(10, 5, "U1", 1, 0, "C");
    $pdf->Cell(10, 5, "U2", 1, 0, "C");
    $pdf->Cell(10, 5, "U3", 1, 0, "C");
    $pdf->Cell(10, 5, "U4", 1, 0, "C");
    $pdf->Cell(10, 5, "TR", 1, 0, "C");
    $pdf->Cell(30, 5, "F.REG", 1, 0, "C");
    $pdf->Cell(40, 5, "OBSERVACION", 1, 1, "C");

    $pdf->SetFont("Arial", "", 9);

    //Tamaño de letra de contenido (asignaturas).
    $pdf->SetFontSize("4");

    //impresión de asignaturas en celdas
    foreach($resultadoMateria as $r_m):
        $pdf->Cell(80, 5, $r_m->nombre_m, 1, 0, "L");
        $pdf->Cell(80, 5, $r_m->nombre_p, 1, 0, "L");
        $pdf->Cell(10, 5, $r_m->unidad1, 1, 0, "L");
        $pdf->Cell(10, 5, $r_m->unidad2, 1, 0, "L");
        $pdf->Cell(10, 5, $r_m->unidad3, 1, 0, "L");
        $pdf->Cell(10, 5, $r_m->unidad4, 1, 0, "L");
        $pdf->Cell(10, 5, $r_m->r_t, 1, 0, "L");
        $pdf->Cell(30, 5, $r_m->fecha_ini, 1, 0, "L");
        $pdf->Cell(40, 5, $r_m->observaciones, 1, 1, "L");
    endforeach;

    $pdf->Output('I', $tituloReporte.'.pdf');
}
 ?>