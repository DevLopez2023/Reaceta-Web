<?php
include('conexion.php');

session_start();

if (empty($_SESSION["usuario"])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: index.html");
    exit();
}
?>

<?php
/* CARRERAS */
$consulta_c = $conexion_pdo->prepare("SELECT * FROM carrera ORDER BY nombre_c");
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
    <link rel="shortcut icon" href="imagenes/report.png" type="image/x-icon">
    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

    <title>Reporte | ReacETA 2023</title>
</head>

<body>
    
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:200px; font-weight:bold; background: linear-gradient(0deg, rgba(255,255,0,1) 0%, rgba(45,253,50,1) 100%);" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px"><i class="fa fa-window-close" aria-hidden="true"></i></a>
        <div class="w3-container w3-center">
            <img src="imagenes/logo.png" alt="LOGO UTM" class="w3-image" width="200%">
            <?php echo "<p style='font-size:13px;'>Técnico: " . $_SESSION["usuario"] . "</p>" ?>
            <p style="margin:40px;"></p>

        </div>
        <div class="w3-bar-block">
            <a href="dashboard.php" onclick="w3_close()" class="opc1 w3-bar-item w3-button w3-hover-white"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;REGISTRO</a>
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
              if (!empty($_SESSION['reseteado'])){
                echo '<script type="text/javascript">
              $(document).ready(function() {
                swal({
                    title: "Reactivos reseteados con éxito 🤷‍♂️",
                    text: "Enhorabuena",
                    icon: "error",
                    button: "Ok",
                    timer: 2000
                });
                });
                </script>';
              }
              unset($_SESSION['reseteado']);
                ?>

            <!--alert2-->
            <?php
              if (!empty($_SESSION['alerta'])){
                echo '<script type="text/javascript">
              $(document).ready(function() {
                swal({
                    title: "Ya esta filtrado en la actual carrera, para filtrar otra debe seleccionarla primeramente del menu 😲",
                    text: "Pilas!",
                    icon: "warning",
                    button: "Ok",
                    timer: 2000
                });
                });
                </script>';
              }
              unset($_SESSION['alerta']);
            ?>
            <!--alert3-->
        <?php
              if (!empty($_SESSION['actualizado'])){
                echo '<script type="text/javascript">
              $(document).ready(function() {
                swal({
                    title: "Reactivos actualizados con éxito 🙊",
                    text: "Enhorabuena",
                    icon: "info",
                    button: "Ok",
                    timer: 2000
                });
                });
                </script>';
              }
              unset($_SESSION['actualizado']);
                ?>

            <form action="busqueda_c.php" method="POST" style="margin-top:70px;">
                <div class="w3-section">
                    <label><b>Carrera</b></label>
                    <select class="w3-select" name="cod_carr" required>
                        <option value="0" selected disabled>Seleccione una carrera</option>
                        <?php
                        foreach ($carreras as $c):
                            echo '<option value="'.$c["cod_carrera"].'">'.$c["nombre_c"]."</option>'";
                        endforeach;
                        ?>
                    </select>
                </div>
                <input type="submit" class="w3-button w3-block w3-padding-large w3-amber w3-margin-bottom" value="Filtrar">
            </form>

            <div class="w3-panel">
            <?php
            if(!isset($_SESSION['carrera_escogida'])){
                echo "<div class='w3-panel w3-animate-bottom w3-center w3-yellow'>No se ha eligido la carrera</div>";
            }else{
                $ce = $_SESSION['carrera_escogida'];
            foreach ($ce as $cce): ?>
               <h5 class="w3-center"><b style="color:green;">Has escogido:</b> <?php echo $cce->nombre_c; ?></h5>
            <?php endforeach;
            } ?>
            </div>

            <?php
            if(empty($_SESSION['con'])){
                echo '<script type="text/javascript">
              $(document).ready(function() {
                swal({
                    title: "Primer paso, seleccione una carrera 😄",
                    text: "Pilas!",
                    icon: "warning",
                    button: "Ok",
                    timer: 2000
                });
                });
                </script>';
            }else{?>
            <!--BOTÓN DE GENERACIÓN PDF-->
            <div class="boton_pdf w3-right">
                <a href="rep_pdf.php?codi_carrera=<?php $fc = $_SESSION['con'];
                foreach ($fc as $dd):
                    echo $dd->cod_carrera;
                endforeach; ?>" class="w3-button w3-red w3-margin-right w3-round-xxlarge"><i class="fa fa-file-pdf" aria-hidden="true"></i> Generar PDF</a>
            </div>
            <?php } ?>

        <!-- Tabla de Reporte -->
        <div class="input-group" style="margin-top: 50px;"> <span class="input-group-addon">Búsqueda ágil: </span>
            <input id="entradafilter" type="text" class="form-control w3-sand">
        </div>

        <div class="w3-container" id="contact" style="margin-top:30px">
            <table class="w3-table w3-striped w3-border w3-responsive w3-small" style="margin-bottom:50px;">
                <tr>
                    <th>Asignatura</th>
                    <th>Profesor</th>
                    <th>U1</th>
                    <th>U2</th>
                    <th>U3</th>
                    <th>U4</th>
                    <th>Total</th>
                    <th>Registro</th>
                    <th>Observaciones</th>
                    <th class="" colspan="3" style="text-align:center;"><i class="fa fa-cog" aria-hidden="true"></i> Opciones</th>
                </tr>
                    <tbody class="contenidobusqueda">
                        <tr>
                        <div class="w3-panel">
                        <?php
                        if(!isset($_SESSION['con'])){

                        }else{
                            $fc = $_SESSION['con'];
                        foreach ($fc as $dd): ?>
                            <td><?php echo $dd->nombre_m; ?></td>
                            <td><?php echo $dd->nombre_p; ?></td>
                            <td><?php echo $dd->unidad1; ?></td>
                            <td><?php echo $dd->unidad2; ?></td>
                            <td><?php echo $dd->unidad3; ?></td>
                            <td><?php echo $dd->unidad4; ?></td>
                            <td><?php echo $dd->r_t; ?></td>
                            <td><?php echo $dd->fecha_ini; ?></td>
                            <td><?php echo $dd->observaciones; ?></td>
                            <td><a href="datos_materia.php?id_materia=<?php echo $dd->cod_profesor; ?>" class="w3-button w3-indigo w3-round-xxlarge"><i class="fa fa-pencil" aria-hidden="true"></i> Inspeccionar</a></td>
                            <td><a href="resetear.php?cod_materia=<?php echo $dd->cod_profesor; ?>" class="w3-button w3-amber w3-round-xxlarge"><i class="fa fa-trash" aria-hidden="true"></i> Resetear</a></td>
                        </tr>
                        <?php  endforeach;
                        }?>
                    </tbody>
            </table>
        </div>
        <script src="js/conf_ventana.js"></script>
        <script src="js/filtrar_resultados.js"></script>



</body>

</html>
