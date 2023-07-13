<?php
include('conexion.php');
session_start();

//Actualización
if(isset($_GET['cod_materia'])){
    $id_materia = $_GET['cod_materia'];
    $un1 = $_POST['u1']; 
    $un2 = $_POST['u2']; 
    $un3 = $_POST['u3']; 
    $un4 = $_POST['u4'];
    $reac_t = (int) $un1+$un2+$un3+$un4;
    $fei = date("Y-m-d"); //fecha actual en la que se hace el registro
    $obs = $_POST['observaciones'];

    $sentencia_a = $conexion_pdo->prepare("UPDATE distributivo SET unidad1 = '$un1',
    unidad2 = '$un2',
    unidad3 = '$un3',
    unidad4 = '$un4',
    r_t = '$reac_t',
    fecha_ini = '$fei',
    observaciones = '$obs'
    WHERE cod_profesor = '$id_materia'");

    $sentencia_a->execute();

    if($sentencia_a == true){
        $_SESSION['actualizado'] = "Reactivos actualizados";
        header("Location: reporte.php");
    }else{
        header("Location: index.php");
    } 
}
?>
