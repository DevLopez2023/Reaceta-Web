<?php

//Credenciales de la BD y Server
$DB_USER = "postgres";
$DB_HOST = "localhost";
$DB_NAME = "eta";
$DB_PASSWORD = "123";
$DB_PORT = 5432;

try{
    $conexion_pdo = new PDO("pgsql:$DB_PORT = $DB_HOST; dbname = $DB_NAME", $DB_USER, $DB_PASSWORD);
}catch(PDOException $exp){
    echo 'Error de conexión a la BD: '. $exp;
}
?>
