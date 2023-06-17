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
/* CONSULTA PARA TABLA DISTRIBUTIVO */
$consulta_distributivo = $conexion_pdo->query("SELECT * FROM distributivo");
$fila_d = $consulta_distributivo->fetchAll(PDO::FETCH_OBJ); //lo saca como array

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
    <title>Reporte | ReacETA 2023</title>

</head>

<body>
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-amber w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:200px; font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px"><i class="fa fa-window-close" aria-hidden="true"></i></a>
        <div class="w3-container w3-center">
            <img src="imagenes/logo.png" alt="LOGO UTM" class="w3-image">
            <h3 class="w3-padding-64 capp w3-center w3-xxlarge"><b>ReacETA Web</b></h3>
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

        <!-- Header -->
        <div class="w3-container" style="margin-top:75px" id="showcase">
            <h1 class="w3-xlarge"><b>REPORTE DE REACTIVOS PRESENTADOS</b></h1>
            <hr style="width:150px;border:5px solid greenyellow" class="w3-round">
        </div>


        <!-- Contact -->
        <div class="w3-container" id="contact" style="margin-top:30px">
            <div class="nota w3-panel w3-light-grey">
                <span style="font-size:150px;line-height:0.6em;opacity:0.2">&#10077;</span>
                <p class="w3-large" style="margin-top:-40px">
                    En esta tabla usted podrá visualizar información sobre los reactivos subidos a la plataforma. Además de poder actualizarlos o eliminarlos.</p>
                <p style="font-size:20px;line-height:0.6em;opacity:0.2; text-align: right;"><i class="fa fa-users" aria-hidden="true"></i> EQUIPO ETA</p>
            </div>
            <table class="w3-table w3-striped w3-border w3-responsive w3-small" style="margin-bottom:50px;">
                <tr>
                    <thead class="w3-green">
                        <th>Cod_distributivo</th>
                        <th>Cod_carrera</th>
                        <th>Cod_asignatura</th>
                        <th>Id_profesor</th>
                        <th>U1</th>
                        <th>U2</th>
                        <th>U3</th>
                        <th>U4</th>
                        <th>Total</th>
                        <th>Registro</th>
                        <th>FF</th>
                        <th>cod_tec</th>
                        <th>Observaciones</th>
                        <th class="w3-black" colspan="3" style="text-align:center;"><i class="fa fa-cog" aria-hidden="true"></i> Opciones</th>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                        foreach ($fila_d as $dd): ?>
                            <td><?php echo $dd->cod_distributivo; ?></td>
                            <td><?php echo $dd->cod_carrera; ?></td>
                            <td><?php echo $dd->cod_materia; ?></td>
                            <td><?php echo $dd->id_profesor; ?></td>
                            <td><?php echo $dd->unidad1; ?></td>
                            <td><?php echo $dd->unidad2; ?></td>
                            <td><?php echo $dd->unidad3; ?></td>
                            <td><?php echo $dd->unidad4; ?></td>
                            <td><?php echo $dd->r_t; ?></td>
                            <td><?php echo $dd->fecha_ini; ?></td>
                            <td><?php echo $dd->fecha_fin; ?></td>
                            <td><?php echo $dd->cod_tec; ?></td>
                            <td><?php echo $dd->observaciones; ?></td>
                            <td><a href="" class="w3-button w3-indigo"><i class="fa fa-pencil" aria-hidden="true"></i> Actualizar</a></td>
                            <td><a href="" class="w3-button w3-red"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a></td>
                            <td><a href="" class="w3-button w3-green"><i class="fa fa-handshake" aria-hidden="true"></i> Terminar</a></td>
                        </tr>
                        <?php  endforeach; ?>
                    </tbody>
            </table>
        </div>



        <script src="js/conf_ventana.js"></script>

</body>

</html>