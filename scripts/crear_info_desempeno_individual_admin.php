<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: ../index.php");}
    else {
		if ($_SESSION['RANGO'] == 2 || $_SESSION['RANGO'] == 3) header("Location: home_lo_rank.php");
	}

    //if ($_SESSION['RANGO'] == 3) header("Location: crear_info_desempeno_individual_admin.php");

    // Inicializando variables fecha, colaborador a evaluar y variable para calculo de promedios

    $mes = date("m");
    $ano = date("y");
    $colaborador = $_POST["colaborador"];
    $_SESSION['conteo'] = 1;
    $_SESSION['promedio'] = 0;

    include_once('../includes/funciones.php');

    //Consulta Meta de Desempeño 0:
 
    $meta_0 = '%';                                                      // Esto hace que jale cualquier meta de desempeño
	$result_meta_0 = consultaBD($meta_0, $colaborador,$mes, $ano);      //  Hacemos consulta a la con una función BD
    $peso_meta_0 = 0.4;

    //Consulta Meta de Desempeño 1:
 
    $meta_1 = 'Administrativo';
	$result_meta_1 = consultaBD($meta_1, $colaborador, $mes, $ano); //  Hacemos consulta a la con una función BD
    $peso_meta_1 = 0.6;


?>

<!DOCTYPE HTML>
<html>
	<head>
		<!-- <meta charset="utf-8"> -->
        <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/test_borders.css">
		<title>Sistema de Informes</title>
	</head>
<body>
	<div class = "container mi_cont">

        <?php include '../includes/header.php'; ?>
			
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
			<!-- (row_!nav!) -->
			<p class="text-center font-weight-light">
				<a href="../index.php" class="btn btn-secondary" role="button">Inicio</a>
				<a href="../includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesi&oacute;n</a> 
				<a href="../cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contraseña</a><br>
				Usuario: <?php echo $_SESSION['USUARIO'];?>
			</p>
			</div>
		</div>
          
		<div class = "row justify-content-center mi_row">
			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-bordered" id="tblData">

                <!-- (meta 0 bloque) -->                    
                    <?php
                        $meta_cabecera = 'Atender la Jefatura';
                        include '../includes/cabecera_desempeno.php';                        
                        armarTabla($result_meta_0);
                    ?>     
                    <tr>
                        <td colspan=7></td>
                        <td class="alert alert-primary">Promedio:</td>
                        <?php $_SESSION['promedio'] = $_SESSION['promedio']/($_SESSION['conteo'] - 1) ?>
                        <td class="alert alert-primary"><?php  echo $_SESSION['promedio']."%"; ?></td>
                    </tr>
                    <tr>
                        <td colspan=7></td>
                        <td class="alert alert-primary">Peso obtenido:</td>
                        <td class="alert alert-primary">
                            <?php
                                $peso_final = $_SESSION['promedio'] * $peso_meta_0."%";   
                                echo $peso_final; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=7></td>
                        <td class="alert alert-primary">Calificaci&oacute;n:</td>
                        <td class="alert alert-primary"><?php calculoNOTA($peso_final, $peso_meta_0); ?></td>
                    </tr>
                    <?php  
                        $_SESSION['conteo'] = 1;
                        $_SESSION['promedio'] = 0;
                    ?>

                <!-- (meta 0 fin bloque) -->

                <!-- (meta 1 bloque) -->                    
                    <?php
                        $meta_cabecera = 'Administrativo';
                        include '../includes/cabecera_desempeno.php';                        
                        armarTabla($result_meta_1);
                    ?>     
                    <tr>
                        <td colspan=7></td>
                        <td class="alert alert-primary">Promedio:</td>
                        <?php $_SESSION['promedio'] = $_SESSION['promedio']/($_SESSION['conteo'] - 1) ?>
                        <td class="alert alert-primary"><?php  echo $_SESSION['promedio']."%"; ?></td>
                    </tr>
                    <tr>
                        <td colspan=7></td>
                        <td class="alert alert-primary">Peso obtenido:</td>
                        <td class="alert alert-primary">
                            <?php
                                $peso_final = $_SESSION['promedio'] * $peso_meta_1."%";   
                                echo $peso_final; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=7></td>
                        <td class="alert alert-primary">Calificaci&oacute;n:</td>
                        <td class="alert alert-primary"><?php calculoNOTA($peso_final, $peso_meta_1); ?></td>
                    </tr>
                    <?php  
                        $_SESSION['conteo'] = 1;
                        $_SESSION['promedio'] = 0;
                    ?>

                <!-- (meta 1 fin bloque) -->

                </table>
            </div>
            <button class="btn btn-warning" onclick="exportTableToExcel('tblData', 'informe_desempeno')">
                Exportar a Excel
            </button>
		</div>

        <div class = "row justify-content-center mi_row">
                <div class = "col-6 mi_col">
                    <p class="text-center"><a class="btn btn-info" href="../index.php">Volver</a></p>
                </div>                
        </div>

        <?php include '../includes/footer.php'; ?>

	</div>
<script src="export_excel.js"></script> 
</body>
</html>
