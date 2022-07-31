<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
    $cod_act = $_POST["codigo_actividad"];
    
    include 'includes/connection.php';                                           // Conexion a BD
	$query = "SELECT * FROM actividades WHERE codigo_actividad LIKE '$cod_act'"; // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos = mysqli_fetch_assoc($resul);
    
	$tipo_actividad = $datos["tipo_actividad"];
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

    <div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col bg-info text-white">
					<!--(row_!Titulo!)-->
					<p class="text-center h1">Sistema de Informes</p>
			</div>
		</div>
			
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
			<!-- (row_!nav!) -->
			<p class="text-center font-weight-light">
				<a href="index.php" class="btn btn-secondary" role="button">Inicio</a>
				<a href="includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesión</a> 
				<a href="cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contraseña</a><br>
				Usuario: <?php echo $_SESSION['USUARIO'];?>
			</p>
			</div>
		</div>
          
        <div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/crear_avance.php"> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2">Detalles de actividad:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>Codigo de Actividad:</td>  
                            <td>
                                <input name="codigo_actividad" size="1" id="codigo_actividad" value="<?php echo $cod_act;?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de Actividad:</td>  
                            <td><?php echo $tipo_actividad;?></td>
                        </tr>
                    <!--<tr>
                            <td>Creada por:</td>  
                            <td><?php echo $creada_por;?></td>
                        </tr> -->
                        <tr>
                            <td>Titulo:</td>  
                            <td><?php echo $titulo;?></td>
                        </tr>
                        <tr>
                            <td>Descripcion de actividad:</td>  
                            <td><?php echo $descripcion;?></td>
                        </tr>
                        <tr>
                            <td>Atiende:</td>  
                            <td><?php echo $asignado_1.", ".$asignado_2.", ".$asignado_3;?></td>
                        </tr>
                        <!--<tr>
                            <td>Atiende:</td>  
                            <td><?php echo $asignado_2;?></td>
                        </tr>-->
                        <!--<tr>
                            <td>Atiende:</td>  
                            <td><?php echo $asignado_3;?></td>
                        </tr>-->
                        <tr>
                            <td>Estado de actividad :</td>  
                            <td><?php echo $estado;?></td>
                        </tr>
                        <tr>
                            <td>Cambiar estado a:</td> 
                            <td>    
                                <select id="estado_form" name="estado_form" value="<?php echo $estado;?>">
                                    <option value="abierta">Abierta</option>
                                    <option value="cerrada">Cerrada</option>
                                </select> 
                                <p><em>Al cambiar de estado a cerrado ya no se puede actualizar mas la actividad.</p></em>
                            </td>
                        </tr>

                        <tr>
                            <td>Listo para informe? </td>  
                            <td><?php echo $informe;?></td>
                        </tr>
                        <tr>
                            <td>Cambiar estado a:</td> 
                            <td>    
                                <select id="informe_form" name="informe_form">
                                    <option value="no_listo">No Listo</option>
                                    <option value="listo">Listo</option>
                                </select> 
                                <p><em>Al cambiar a "Listo" la actividad está lista para aparecer en el informe mensual y no se podrán actualizar más sus avances. Para esto deberá solicitar su reapertura.</p></em>
                            </td>
                        </tr>

                        <tr>
                            <td>Prioridad:</td>  
                            <td><?php echo $prioridad;?></td>
                        </tr>
                        <tr>
                        <td>porcentaje:</td>  
                            <td>
                                <input type="number" value="<?php echo $porcentaje;?>" id="porcentaje_form" name="porcentaje_form" min="0" max="100" size="3"> 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><p class="text-info">Tamaño máximo por avance 450 caractéres</p></td>
                        </tr>
                        <tr>
                            <td>Avance 1:</td>  
                            <td>
                                <textarea name="avance_1_form" id="avance_1_form" value="" rows="5" cols="35" maxlength="450"><?php echo $avance_1;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 2:</td>  
                            <td>
                                <textarea name="avance_2_form" id="avance_2_form" value="" rows="5" cols="35" maxlength="450"><?php echo $avance_2;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 3:</td>  
                            <td>
                                <textarea name="avance_3_form" id="avance_3_form" value="" rows="5" cols="35" maxlength="450"><?php echo $avance_3;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 4:</td>  
                            <td>
                                <textarea name="avance_4_form" id="avance_4_form" value="" rows="5" cols="35" maxlength="450"><?php echo $avance_4;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Avance 5:</td>  
                            <td>
                                <textarea name="avance_5_form" id="avance_5_form" value="" rows="5" cols="35" maxlength="450"><?php echo $avance_5;?></textarea>
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
                                <td><input type="submit" name="Submit" value="Actualizar"></td>
                                <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="index.php">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col blockquote-footer">
				<!--(row_!abajo!)-->
				<p class="text-center">- Desarrollado por Laboratorio I + D - 2020 - </p>
			</div>
		</div>

	</div>
</body>
</html>