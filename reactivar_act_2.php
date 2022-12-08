<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
    else {
        if ($_SESSION['RANGO'] == 2) header("Location: home_lo_rank.php");
        }

    $cod_act = $_GET['superdato']; 
    $hoy = date("Y-m-d H:i");
    
    include 'includes/connection.php';                                           // Conexion a BD
	$query = "SELECT * FROM actividades WHERE codigo_actividad LIKE '$cod_act'"; // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos = mysqli_fetch_assoc($resul);
    
	$tipo_actividad = $datos["tipo_actividad"];
    $tipo_actividad_2 = $datos["tipo_actividad_2"];
    $tipo_actividad_3 = $datos["tipo_actividad_3"];
    $creada_por = $datos["creada_por"];
    $titulo = $datos["titulo"];
    $descripcion = $datos["descripcion"];
    $asignado_1 = $datos["asignado_1"];
    $asignado_2 = $datos["asignado_2"];
    $asignado_3 = $datos["asignado_3"];
    $estado = $datos["estado"];
    $informe = $datos["informe"];
    $prioridad = $datos["prioridad"];
    $porcentaje = $datos["porcentaje"];
    $avance_1 = $datos["avance_1"];
    $avance_2 = $datos["avance_2"];
    $avance_3 = $datos["avance_3"];
    $avance_4 = $datos["avance_4"];
    $avance_5 = $datos["avance_5"];
    $mes = $datos["mes"];
    $ano = $datos["ano"];
    $duracion_1 = $datos["duracion_1"];
    $duracion_2 = $datos["duracion_2"];
    
	mysqli_free_result($resul);   
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/test_borders.css">
		<title>Sistema de Informes</title>
	</head>
<body>
	<div class = "container mi_cont">

        <?php include 'includes/header.php'; ?>
	    <?php include 'includes/navBar.php'; ?>
          
        <div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/reactivar_act.php"> 
                    <table class="table table-sm table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="mi_td" colspan="2">Detalles de actividad:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>C&oacute;digo de Actividad:</td>  
                                <td><input name="codigo_actividad" id="codigo_actividad" size="1" value="<?php echo $cod_act;?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de Actividad:</td>  
                            <td><?php echo $tipo_actividad;?></td>
                        </tr>
                        <tr>
                            <td>Meta Desempeño A:</td>  
                            <td><?php echo $tipo_actividad_2;?></td>
                        </tr>
                        <tr>
                            <td>Meta Desempeño B:</td>  
                            <td><?php echo $tipo_actividad_3;?></td>
                        </tr>
                    <!--<tr>
                            <td>Creada por:</td>  
                            <td><?php echo $creada_por;?></td>
                        </tr> -->
                        <tr>
                            <td>T&iacute;tulo:</td>  
                            <td><?php echo $titulo;?></td>
                        </tr>
                        <tr>
                            <td>Descripci&oacute;n de actividad:</td>  
                            <td><?php echo $descripcion;?></td>
                        </tr>
                        <tr>
                            <td>Atiende:</td>  
                            <td><?php echo $asignado_1.", ".$asignado_2.", ".$asignado_3;?></td>
                        </tr>
                        <tr>
                            <td>Marcado como:</td>  
                            <td><?php echo $informe;?></td>
                        </tr>
                        <tr>
                            <td>Cambiar a:</td> 
                            <td>    
                                <input name="informe_form" id="informe_form" size="4" maxlength="10" value = "no_listo" readonly>
                                <p><em>Se cambiar&aacute; el estado "no listo" para que el personal asignado vuelva a tener pendiente el trabajo en este nuevo mes.</p></em>
                            </td>
                        </tr>
                        <tr>
                            <td>Prioridad:</td>  
                            <td>                                
                                <?php echo $prioridad;?>
                        </tr>
                        <tr>
                        <td>Porcentaje:</td>  
                            <td>
                                <?php echo $porcentaje;?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Advertencia:
                            </td>
                            <td>
                                Los siguientes avances ser&aacute;n eliminados:
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 1:</td>  
                            <td>
                                <?php echo $avance_1;?>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 2:</td>  
                            <td>
                                <?php echo $avance_2;?>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 3:</td>  
                            <td>
                                <?php echo $avance_3;?>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 4:</td>  
                            <td>
                                <?php echo $avance_4;?>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 5:</td>  
                            <td>
                                <?php echo $avance_5;?>
                            </td>
                        </tr>
                        <tr>
                    <!--<td>Mes:</td>  
                            <td><?php echo $mes;?></td>
                        </tr>
                        <tr>
                            <td>Año:</td>  
                            <td><?php echo $ano;?></td>
                        </tr>
                        <tr>
                            <td>Duración 1:</td>  
                            <td><?php echo $duracion_1;?></td>
                        </tr>
                        <tr>
                            <td>Duración 2:</td>  
                            <td><?php echo $duracion_2;?></td>
                        </tr>-->
                        <tr>
                            <td>Fecha Solicitud:</td>
                            <td>
                                <input name="fecha_solicitud" type="text" id="fecha_solicitud" size="15"
                                maxlength="100" value="<?php echo $hoy;?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha Entrega:</td>
                            <td>
                                <input name="fecha_entrega" type="datetime-local" id="fecha_entrega" size="8" maxlength="100">
                            </td>
                        </tr>
                        <tr>
                                <td class="mi_td" colspan="2"><input class="btn btn-warning" type="submit" name="Submit" value="Reactivar"></td>
                                <td></td>
                        </tr>
                        <tr>
                            <td class="mi_td" colspan="2">
                                <a class="btn btn-info" href="index.php">Volver</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>