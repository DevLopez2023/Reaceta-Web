<?php
include('conexion.php');
session_start();

$materia = $_POST['s_m'];
//echo $materia;
$profesor = $_POST['s_p'];
$reac1 = $_POST['u1'];
$reac2 = $_POST['u2'];
$reac3 = $_POST['u3'];
$reac4 = $_POST['u4'];
$reac_t = (int) $reac1+$reac2+$reac3+$reac4;
$fi = date("d-m-Y h:i:s"); //fecha actual en la que se hace el registro
//$ff = $_POST['ff'];
$obs = $_POST['observaciones'];


$sentencia_d = $conexion_pdo->prepare("UPDATE distributivo SET unidad1 = '$reac1',
unidad2 = '$reac2',
unidad3 = '$reac3',
unidad4 = '$reac4',
r_t = '$reac_t',
fecha_ini = '$fi',
observaciones = '$obs'
WHERE cod_materia = '$materia' AND cod_profesor = '$profesor';");

$sentencia_d->execute();

if($sentencia_d == true){
    $_SESSION['registro'] = "Reactivos registrados";
    header("Location: reporte.php");
}else{
    header("Location: index.php");
}

?>
