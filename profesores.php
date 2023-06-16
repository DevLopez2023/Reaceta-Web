<?php
//Incluyendo conexión
include('conexion.php');
$html = '';

//Recibiendo valor de variable id_carrera
$id_materia = $_POST['id_materia'];

//Consulta para validar que el $id_carrera sea el mismo del campo de la columna cod_carrera de la tabla materia
$consulta_p = $conexion_pdo->prepare("SELECT id_profesor,nombre FROM profesor WHERE cod_materia = '$id_materia' ORDER BY nombre ASC");
$consulta_p->execute();
$profesores = $consulta_p->fetchAll();

//Foreach para hacer el recorrido.
foreach($profesores as $p):
    $html .= '<option value="'.$p['id_profesor'].'">'.$p['nombre'].'</option>';
endforeach;

//Imprimiendo el resultado de integrar la sentencia html y variable de php
echo $html;
?>