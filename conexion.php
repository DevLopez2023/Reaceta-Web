<?php

//Credenciales de la BD y Server
$usuario = "eta";
$host = "192.168.2.95";
$bd = "eta";
$pas = "123456";

try{
    $conexion_pdo = new PDO("pgsql:host = $host; dbname = $bd", $usuario, $pas);
}catch(PDOException $exp){
    echo 'Error de conexión a la BD: '. $exp;
}
?>