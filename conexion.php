<?php
session_start();
//Credenciales de la BD y Server
$DB_USER = "postgres";
$DB_HOST = "containers-us-west-43.railway.app";
$DB_NAME = "railway";
$DB_PASSWORD = "u0eCMiHvRDadpEZtVKSr";
$DB_PORT = "7935";

try{
    $conexion_pdo = new PDO("pgsql:host = $DB_HOST; port=$DB_PORT; dbname = $DB_NAME", $DB_USER, $DB_PASSWORD);
}catch(PDOException $exp){
    echo 'Error de conexión a la BD: '. $exp;
}
?>
