<?php
//Incluyendo conexión
include('conexion.php');
$html = '';

//Recibiendo valor de variable id_carrera
$id_materia = $_POST['id_materia'];

//HALLAR PROFESORES
$consulta_p = $conexion_pdo->prepare("SELECT d.cod_profesor,p.nombre_p FROM distributivo d 
INNER JOIN profesor p ON p.cod_profesor = d.cod_profesor
WHERE cod_materia = '$id_materia' AND cod_carrera = d.cod_carrera");

$consulta_p->execute();
$profesores = $consulta_p->fetchAll();

//Foreach para hacer el recorrido.
foreach($profesores as $p):
    $html .= '<option value="'.$p['cod_profesor'].'">'.$p['nombre_p'].'</option>';
endforeach;

//Imprimiendo el resultado de integrar la sentencia html y variable de php

echo $html;
?>