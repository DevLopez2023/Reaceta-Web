<?php
include('conexion.php');
session_start();

if (empty($_SESSION["usuario"])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: index.php");
    //exit();
}
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
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <title>ReacETA 2023</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!--LOADER-->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-right" style="display: flex; justify-content:center; height:100vh; align-items:center;">
        <img src="imagenes/logo_2.png" alt="logo_utm" width="300px"></div>
        <div class="loader-section section-left" style="display: flex; justify-content:center; height:100vh; align-items:center;">
        <img src="imagenes/logo.png" alt="logo_utm" width="400px"></div>
    </div>

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding"
        style="z-index:3;width:200px;font-weight:bold; background: linear-gradient(0deg, rgba(255,255,0,1) 0%, rgba(45,253,50,1) 100%);" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px"><i class="fa fa-window-close" aria-hidden="true"></i></a>
        <div class="w3-container w3-center">
            <img src="imagenes/logo.png" alt="LOGO UTM" class="w3-image" width="200%">
            <?php echo "<p style='font-size:13px;'>Técnico: ". $_SESSION["usuario"]."</p>"?>
            <p style="margin:40px;"></p>
            
        </div>
        <div class="w3-bar-block">
            <a href="" onclick="w3_close()" class="opc1 w3-bar-item w3-button w3-hover-white"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;REGISTRO</a>
            <a href="reporte.php" onclick="w3_close()" class="opc2 w3-bar-item w3-button w3-hover-white"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;REPORTE</a>
        </div>

        <br>
        <br>
        <div class="w3-bar-block">
            <a href="logout.php" onclick="w3_close()" class="opc2 w3-bar-item w3-button w3-hover-black"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Salir</a>
        </div>

    </nav>

    <!-- Menú en pantallas pequeñas -->
    <header class="w3-container w3-top w3-hide-large w3-yellow w3-xlarge w3-padding">
        <a href="javascript:void(0)" class="w3-button w3-black w3-margin-right" onclick="w3_open()">☰</a>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- Contenido -->
    <div class="w3-main" style="margin-left:230px;margin-right:40px">
      <!--alert-->
            <?php
              if (!empty($_SESSION['registro'])){
                echo '<script type="text/javascript">
              $(document).ready(function() {
                swal({
                    title: "Reactivos registrados con éxito, ahora lo puede ver en el reporte.",
                    text: "Enhorabuena",
                    icon: "success",
                    button: "Ok",
                    timer: 2000
                });
                });
                </script>';
              }
              unset($_SESSION['registro']);
                ?>
    </div>

        <script src="js/conf_ventana.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</body>
</html>
