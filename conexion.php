<?php

//Credenciales de la BD y Server
$DB_USER = "";
$DB_HOST = "";
$DB_NAME = "";
$DB_PASSWORD = "";

try{
    $conexion_pdo = new PDO("pgsql:host = $DB_HOST; dbname = $DB_NAME", $DB_USER, $DB_PASSWORD);
}catch(PDOException $exp){
    echo 'Error de conexión a la BD: '. $exp;
}
?>
