<?php

//Credenciales de la BD y Server
$DB_USER = "postgres";
$DB_HOST = "containers-us-west-43.railway.app";
$DB_NAME = "railway";
$DB_PASSWORD = "u0eCMiHvRDadpEZtVKSr";

try{
    $conexion_pdo = new PDO("pgsql:7935 = $DB_HOST; dbname = $DB_NAME", $DB_USER, $DB_PASSWORD);
}catch(PDOException $exp){
    echo 'Error de conexión a la BD: '. $exp;
}
?>
