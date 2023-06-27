
<?php
include('conexion.php');

session_start();
if (empty($_SESSION["usuario"])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: index.html");
    exit();
}

$fila_dm = $_SESSION['fila_dm'];
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
    <title>ReacETA 2023</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-amber w3-collapse w3-top w3-large w3-padding"
        style="z-index:3;width:200px;font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px"><i class="fa fa-window-close" aria-hidden="true"></i></a>
        <div class="w3-container w3-center">
            <img src="imagenes/logo.png" alt="LOGO UTM" class="w3-image">
            <h3 class="w3-padding-64 capp w3-center w3-xxlarge"><b>ReacETA Web</b></h3>
            <?php echo "<p style='font-size:13px;'>Técnico: ". $_SESSION["usuario"]."</p>"?>
            <p style="margin:40px;"></p>
            
        </div>
        <div class="w3-bar-block">
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
    <!-- Header -->
    <div class="w3-container" style="margin-top:75px" id="showcase">
            <h1 class="w3-xlarge"><b>ACTUALIZACIÓN DE DATOS [REACTIVOS] - UTM</b></h1>
            <hr style="width:150px;border:5px solid blue" class="w3-round">
        </div>


        <!-- Contact -->
        <div class="w3-container" id="contact" style="margin-top:30px">
               <!--alert-->
            <?php
              if (!empty($_SESSION['registro'])){
                echo '<script type="text/javascript">
              $(document).ready(function() {
                swal({
                    title: "Reactivos registrados con éxito",
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
            <form method="post" action="actualizar.php?cod_materia=<?php foreach($fila_dm as $fdm):
                echo $fdm->cod_profesor;
            endforeach; ?>">
                <div class="w3-section">
                <label class="w3-tag w3-padding w3-round-large w3-light-grey w3-margin-bottom"><b>Carrera:</b></label>
                <input type="text" name="carrera" id="s_c" value="<?php
                foreach($fila_dm as $fdm):
                    echo $fdm->nombre_c;
                endforeach; ?>" disabled id="carrera">

                <input type="hidden" name="c_materia" value="<?php 
                foreach($fila_dm as $fdm):
                    echo $fdm->cod_materia;
                endforeach;?>">
                </div>

                <div class="w3-section">
                <label class="w3-tag w3-padding w3-round-large w3-light-grey w3-margin-bottom"><b>Materia:</b></label>
                    <input type="text" name="materia" id="s_m" value="<?php 
                    foreach($fila_dm as $fdm):
                        echo $fdm->nombre_m;
                    endforeach;?>" disabled>
                </div>

                <!--INPUT PARA PROFESORES QUE DAN LA ASIGNATURA-->
                <div class="w3-section">
                <label class="w3-tag w3-padding w3-round-large w3-light-grey w3-margin-bottom"><b>Profesores:</b></label>
                    <input type="text" name="profesor" id="s_p" value="<?php foreach($fila_dm as $fdm):
                    echo $fdm->nombre_p;
                    endforeach;?>" disabled>
                </div>

                <label class="w3-tag w3-padding w3-round-large w3-light-grey w3-margin-bottom"><b>Reactivos por unidad</b></label>
                <div class="w3-row-padding">
                    <div class="w3-third">
                        <input class="w3-input w3-border monto" value="<?php foreach($fila_dm as $fdm):
                echo $fdm->unidad1;
                endforeach;?>" type="text" width="20" name="u1" onkeyup="sumar();" placeholder="Unidad 1" required>
                    </div>
                    <div class="w3-third">
                        <input class="w3-input w3-border monto" value="<?php foreach($fila_dm as $fdm):
                echo $fdm->unidad2;
                endforeach;?>" type="text" width="20" name="u2" onkeyup="sumar();" placeholder="Unidad 2" required>
                    </div>
                    <div class="w3-third">
                        <input class="w3-input w3-border monto" value="<?php foreach($fila_dm as $fdm):
                echo $fdm->unidad3;
                endforeach;?>" type="text" width="20" name="u3" onkeyup="sumar();" placeholder="Unidad 3" required>
                    </div>
                    <div class="w3-third w3-margin-top">
                        <input class="w3-input w3-border monto" value="<?php foreach($fila_dm as $fdm):
                echo $fdm->unidad4;
                endforeach;?>" type="text" width="20" name="u4" onkeyup="sumar();" placeholder="Unidad 4" required>
                    </div>
                </div>

                <div class="w3-section w3-tag w3-padding w3-round-large w3-light-grey">
                    <label><b>Total de reactivos</b></label>
                    <p><b>N°= </b><span id="res" class="w3-large" name="total"></span></p>
                </div>
                <div class="w3-section">
                    <label class="w3-tag w3-padding w3-round-large w3-light-grey"><b>Observaciones</b></label>
                    <br>
                    <input class="w3-radio" type="radio" name="observaciones" value="CUMPLE" checked>
                    <label>CUMPLE</label>
                    <input class="w3-radio" type="radio" name="observaciones" value="CUMPLE PARCIALMENTE">
                    <label>CUMPLE PARCIALMENTE</label>
                    <input class="w3-radio" type="radio" name="observaciones" value="NO CUMPLE">
                    <label>NO CUMPLE</label>
                </div>

                <div class="w3-section">
                    <label><b>Actualiza:</b></label>
                    <input type="text" name="n_tec" id="" disabled value="<?php echo $_SESSION["usuario"]?>">
                    <input type="hidden" name="tec" id="" value="<?php echo $_SESSION["cod_usuario"]?>">
                    </select>
                </div>
                <input type="submit" class="w3-button w3-block w3-padding-large w3-blue w3-margin-bottom" value="Actualizar">
            </form>
        </div>

        <script src="js/conf_ventana.js"></script>
        <script src="js/suma.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</body>
</html>