<?php
include('conexion.php'); //incluyendo conexión a BD
session_start(); //sesion de inicio

//Lo que se recibe del formulario
$usu = $_POST["u"]; //usuario
$cont = $_POST["p"]; //contraseña


//Trayendo desde la base de datos los usuarios y contraseñas
$sentencia = $conexion_pdo->query("SELECT cod_tec, usuario, nombre_tec, passw FROM usuarios WHERE usuario = '$usu' AND passw = '$cont'");
$filas = $sentencia->fetchAll(PDO::FETCH_OBJ); //lo saca como array
//print_r($filas);
//print($filas[0]->usuario)


if (empty($filas[0]->usuario)){ //Si no existe valor en el campo usuario de la tabla usuarios
    $_SESSION['error'] = "Usuario y/o contraseña incorrecta";
    header('Location: index.php');
}else{ //caso contrario se almacena en la variable de sesion[usuario] el valor de la columna nombre_tec.
    $_SESSION['usuario'] = $filas[0]->nombre_tec;
    $_SESSION['cod_usuario'] = $filas[0]->cod_tec;
    header('Location: dashboard.php'); //Redirecciona a la plantilla dashboard
}

?>