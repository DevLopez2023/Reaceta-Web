<?php

//Credenciales de la BD y Server
$DB_USER = "postgres";
$DB_HOST = "localhost";
$DB_NAME = "eta";
$DB_PASSWORD = "123";

try{
    $conexion_pdo = new PDO("pgsql:host = $DB_HOST; dbname = $DB_NAME", $DB_USER, $DB_PASSWORD);
}catch(PDOException $exp){
    echo 'Error de conexión a la BD: '. $exp;
}
?>
