<?php
session_start();
include('conexion.php');

if($_POST['cod_carr'] == 0){
    $_SESSION['alerta'] = "Debes seleccionar una carrera";
    header('Location: reporte.php');
}else{
    /*SENTENCIA PARA MOSTRAR CARRERA ELEGIDA EN COMBOBOX*/
    $id_ca = $_POST['cod_carr'];
    $con_ppc = $conexion_pdo->query("SELECT cod_carrera, nombre_c FROM carrera WHERE cod_carrera = '$id_ca'");
    $fila_car = $con_ppc->fetchAll(PDO::FETCH_OBJ); //lo saca como array
    $_SESSION['carrera_escogida'] = $fila_car;

    /*SENTENCIA PARA MOSTRAR DATOS EN TABLA REPORTE*/
    $con_ca = $conexion_pdo->query("SELECT cod_materia,nombre_m,unidad1,unidad2,unidad3,unidad4,r_t,fecha_ini,observaciones FROM materia WHERE cod_carrera = '$id_ca' ORDER BY cod_materia");
    $fila_c = $con_ca->fetchAll(PDO::FETCH_OBJ); //lo saca como array
    $_SESSION['con'] = $fila_c;
    
    header('Location: reporte.php');
    }

?>