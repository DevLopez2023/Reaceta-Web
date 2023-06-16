<?php 

include('conexion.php');
session_start();

$carrera = $_POST['s_c'];
$materia = $_POST['s_m'];
$profesor = $_POST['s_p'];
$reac1 = $_POST['u1'];
$reac2 = $_POST['u2'];
$reac3 = $_POST['u3'];
$reac4 = $_POST['u4'];
$fi = $_POST['fi']; 
$ff = $_POST['ff'];
//$reac_t = $_POST['total'];
$obs = $_POST['observaciones'];
$tec_res = $_POST['tec'];


$sentencia_d = $conexion_pdo->prepare("INSERT INTO distributivo(cod_carrera,cod_materia,id_profesor,unidad1,unidad2,unidad3,unidad4,fecha_ini,fecha_fin,cod_tec,observaciones) VALUES ('$carrera','$materia','$profesor','$reac1','$reac2','$reac3','$reac4','$fi','$ff','$tec_res','$obs')");

$sentencia_d->execute();

if($sentencia_d == true){
    $_SESSION['registro'] = "Reactivos registrados";
    header("Location: dashboard.php");
}else{
    header("Location: index.php");
}





?>