<?php

//Credenciales de la BD y Server
$usuario = "postgres";
$host = "localhost";
$bd = "eta";
$pas = "123";

try{
    $conexion_pdo = new PDO("pgsql:host = $host; dbname = $bd", $usuario, $pas);
}catch(PDOException $exp){
    echo 'Error de conexión a la BD: '. $exp;
}
?>