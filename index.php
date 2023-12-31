<?php
session_start();
include("conexion.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="estilos/style.css">
    <!--Flaticon de la Web-->
    <link rel="shortcut icon" href="imagenes/icon_form.png" type="image/x-icon">
    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Login - ReacETA</title>

</head>

<body>
    <div id="particles-js"></div>
    <div class="container w3-card login">
        <form action="valida_acceso.php" method="post">
            <img src="imagenes/logo.png" class="w3-image" alt="LOGO_UTM">
            <div class="row">
                <div class="col-25">
                    <label for="">Usuario</label>
                </div>
                <div class="col-75">
                    <input type="text" class="w3-input" id="" title="Ingrese su correo institucional (@utm.edu.ec)" name="u" placeholder="Ingrese su usuario" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Contraseña</label>
                </div>
                <div class="col-75">
                    <input type="number" id="" title="Ingrese su contraseña" class="w3-input" name="p" placeholder="Ingrese su contraseña" required oninput="if( this.value.length > 10 )  this.value = this.value.slice(0,10)">
                </div>
            </div>
            <div class="row w3-margin-top">
                <input type="submit" class="w3-button w3-green w3-hover-amber" value="Ingresar">
            </div>
            <?php
              if (!empty($_SESSION['error'])){
                $mensaje_error = $_SESSION['error'];
                echo '<h6 style="color:red;"> 😭 '.$mensaje_error.'</h6>';
             
              }
              unset($_SESSION['error']);
            ?>
        </form>
    </div>

    <!--Agregando Scripts-->
    <script src="js/particles.min.js"></script>
    <script src="js/particles_js.js"></script>
    


</body>
</html>