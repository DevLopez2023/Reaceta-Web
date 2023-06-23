<?php
//Incluyendo conexión
include('conexion.php');
$html = '';

//Recibiendo valor de variable id_carrera
$id_carrera = $_POST['id_carrera'];

//Consulta para validar que el $id_carrera sea el mismo del campo de la columna cod_carrera de la tabla materia
$consulta_m = $conexion_pdo->prepare("SELECT cod_materia,nombre_m FROM materia WHERE cod_carrera = '$id_carrera' ORDER BY nombre_m ASC");
$consulta_m->execute();
$materias = $consulta_m->fetchAll();

//Foreach para hacer el recorrido.
foreach($materias as $m):       
    $html .= '<option value="'.$m['cod_materia'].'">'.$m['nombre_m'].'</option>';
endforeach;

//Imprimiendo el resultado de integrar la sentencia html y variable de php
echo $html;
?>