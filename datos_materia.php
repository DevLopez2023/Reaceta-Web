<?php
include('conexion.php');
session_start();

/*RECIBIENDO COD_MATERIA DESDE REPORTE*/
$cod_mate = $_GET['id_materia'];

/*CONSULTA PARA SACAR TODOS LOS DATOS - CARRERA>ASIGNATURA>PROFESOR SQL*/
$sel_mat = $conexion_pdo->query("SELECT DISTINCT p.nombre_p, m.cod_materia,c.nombre_c,m.nombre_m,m.unidad1,m.unidad2,m.unidad3,m.unidad4,m.r_t,m.observaciones
FROM distributivo d INNER JOIN carrera AS c
ON d.cod_materia = '$cod_mate' AND d.cod_carrera = c.cod_carrera
INNER JOIN materia AS m ON m.cod_materia = d.cod_materia
INNER JOIN profesor AS p ON p.cod_profesor = d.cod_profesor;");

/*
$sel_mat = $conexion_pdo->query("SELECT m.cod_materia,c.nombre_c,m.nombre_m,p.nombre_p,m.unidad1,m.unidad2,m.unidad3,m.unidad4,m.r_t,m.observaciones
FROM materia m INNER JOIN carrera AS c
ON m.cod_materia = '$cod_mate' AND m.cod_carrera = c.cod_carrera
INNER JOIN profesor AS p ON p.cod_profesor = m.cod_materia");
*/

$sel_mat->execute();

$fila_dm = $sel_mat->fetchAll(PDO::FETCH_OBJ); //lo saca como array
$_SESSION['fila_dm'] = $fila_dm;
header("Location: edit.php");

?>