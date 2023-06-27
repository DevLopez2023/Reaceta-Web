<?php
session_start();
include ('conexion.php');

if (isset($_GET['cod_materia'])){
    $id_mat = $_GET['cod_materia'];
    $obs_df = '...';
    //sentencia SQL
    $res = $conexion_pdo->query("UPDATE distributivo SET unidad1 = 0, unidad2 = 0, unidad3 = 0, unidad4 = 0, r_t = 0, fecha_ini = NULL, observaciones = '$obs_df'
    WHERE cod_profesor = $id_mat");
    //ejecutar aquella sentencia
    $e_reset = $res->execute();
    $_SESSION['reseteado'] = "Reseteado con éxito";
    header("Location: reporte.php");
}else{
    echo 'Datos no fueron eliminados correctamente';
}



?>