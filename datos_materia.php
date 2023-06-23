<?php
include('conexion.php');
session_start();

/*RECIBIENDO COD_MATERIA DESDE REPORTE*/
$cod_mate = $_GET['id_materia'];

/*ARREGLAR CONSULTA SQL*/
$sel_mat = $conexion_pdo->query("SELECT m.cod_materia,c.nombre_c,m.nombre_m,m.unidad1,m.unidad2,m.unidad3,m.unidad4,m.r_t,m.observaciones
FROM materia m INNER JOIN carrera AS c
ON m.cod_materia = '$cod_mate' AND m.cod_carrera = c.cod_carrera");
$sel_mat->execute();



$fila_dm = $sel_mat->fetchAll(PDO::FETCH_OBJ); //lo saca como array
$_SESSION['fila_dm'] = $fila_dm;
header("Location: edit.php");

?>