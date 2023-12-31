<?php
include('conexion.php');
session_start();

if (empty($_SESSION["usuario"])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: index.php");
    //exit();
}
?>

<?php
/* CARRERAS */
$consulta_c = $conexion_pdo->prepare("SELECT * FROM carrera");
$consulta_c->execute();
$carreras = $consulta_c->fetchAll();
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


    <!--Script para cargar valor de select carreras y luego validarlo con la sentencia sql en materias.php-->
    <script language="javascript">
    $(document).ready(function(){
        $("#s_c").on('change', function () {
            $('#s_p').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
            $("#s_c option:selected").each(function () {
                var id_carrera = $(this).val();
                $.post("materias.php", { id_carrera: id_carrera }, function(data) {
                    $("#s_m").html(data);
                });			
            });
        });
        });

    $(document).ready(function(){
        $("#s_m").on('change', function () {
            $("#s_m option:selected").each(function () {
                var id_materia = $(this).val();
                $.post("profesores.php", { id_materia: id_materia }, function(data) {
                    $("#s_p").html(data);
                });
            });
        });
        });

    </script>
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
        <!-- Header -->
        <div class="w3-container" style="margin-top:75px" id="showcase">
            <h1 class="w3-xlarge"><b>REGISTRO DE DATOS SOBRE REACTIVOS - UTM</b></h1>
            <hr style="width:300px;border:5px solid greenyellow" class="w3-round">
        </div>


        <!-- Contact -->
        <div class="w3-container" id="contact" style="margin-top:30px">
            <div class="nota w3-panel w3-light-grey">
                <span style="font-size:150px;line-height:0.6em;opacity:0.2">&#10077;</span>
                <p class="w3-large" style="margin-top:-40px">
                    En este formulario, usted podrá registrar la cantidad de reactivos que ha presentado un docente sobre alguna asignatura específica.</p>
                    <p style="font-size:20px;line-height:0.6em;opacity:0.2; text-align: right;"><i class="fa fa-users" aria-hidden="true"></i> EQUIPO ETA</p>
              </div>

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


            <form action="registrar.php" method="POST">
                <div class="w3-section">
                    <label class="w3-tag w3-padding w3-round-large w3-light-grey"><b>Carrera</b></label>
                    <select class="w3-select" name="s_c" id="s_c">
                        <option value="0" selected disabled>Seleccione una carrera</option>
                        <?php
                        foreach ($carreras as $c):
                            echo '<option value="'.$c["cod_carrera"].'">'.$c["nombre_c"]."</option>'";
                        endforeach;
                        ?>
                    </select>
                    
                </div>

                <div class="w3-section">
                    <label class="w3-tag w3-padding w3-round-large w3-light-grey"><b>Asignaturas:</b></label>
                    <select class="w3-select" name="s_m" id="s_m"></select>
                </div>

                <div class="w3-section">
                    <label class="w3-tag w3-padding w3-round-large w3-light-grey"><b>Profesores:</b></label>
                    <select class="w3-select" name="s_p" id="s_p"></select>
                </div>


                <label class="w3-tag w3-padding w3-round-large w3-light-grey w3-margin-bottom"><b>Reactivos por unidad</b></label>
                <div class="w3-row-padding">
                    <div class="w3-third">
                        <input class="w3-input w3-border monto" type="text" width="20" name="u1" onkeyup="sumar();" placeholder="Unidad 1" required>
                    </div>
                    <div class="w3-third">
                        <input class="w3-input w3-border monto" type="text" width="20" name="u2" onkeyup="sumar();" placeholder="Unidad 2" required>
                    </div>
                    <div class="w3-third">
                        <input class="w3-input w3-border monto" type="text" width="20" name="u3" onkeyup="sumar();" placeholder="Unidad 3" required>
                    </div>
                    <div class="w3-third w3-margin-top">
                        <input class="w3-input w3-border monto" type="text" width="20" name="u4" onkeyup="sumar();" placeholder="Unidad 4" required>
                    </div>
                </div>

                <div class="w3-section">
                    <label class="w3-tag w3-padding w3-round-large w3-light-grey"><b>Total de reactivos</b></label>
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
                    <label><b>REGISTRA: </b></label>
                    <input type="text" name="n_tec" id="" disabled value="<?php echo $_SESSION["usuario"]?>">
                    <input type="hidden" name="tec" id="" value="<?php echo $_SESSION["cod_usuario"]?>">
                    </select>
                </div>
                <input type="submit" class="w3-button w3-block w3-padding-large w3-green w3-margin-bottom" value="Registrar">
            </form>
        </div>

        <script src="js/conf_ventana.js"></script>
        <script src="js/suma.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="js/loader.js"></script>

</body>
</html>
