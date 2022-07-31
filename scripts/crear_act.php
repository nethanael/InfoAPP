<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    $tipo_actividad = $_POST["tipo_actividad"];
	$tipo_actividad_2 = $_POST["tipo_actividad_2"];
	$tipo_actividad_3 = $_POST["tipo_actividad_3"];
    $titulo_actividad = $_POST["titulo_actividad"];
    $descripcion = $_POST["descripcion"];
    $asignar_1 = $_POST["asignar_1"];
    $asignar_2 = $_POST["asignar_2"];
    $asignar_3 = $_POST["asignar_3"];
    $prioridad = $_POST["prioridad"];
	$fecha_solicitud = $_POST["fecha_solicitud"];
	$fecha_entrega = $_POST["fecha_entrega"];
    $mes = date("m");
	$ano = date("y");
    $fecha = date("d/m/y H:i a");
    	
	if ($usuario == '' || $tipo_actividad == '' || $tipo_actividad_2 == '' || $titulo_actividad == ''
	|| $descripcion == '' || $asignar_1 == '' || $asignar_2 == '' || $asignar_3 == '' || $fecha_solicitud == '' 
	|| $fecha_entrega == '' ) 
	{
		$_SESSION['ACT_ERROR'] = "¡Todos los campos son obligatorios!";
		header("Location: ../crear_act.php");
	}
	else
	{		

        include '../includes/connection.php';
        
        $query = "INSERT INTO actividades (tipo_actividad, tipo_actividad_2, tipo_actividad_3, creada_por, titulo, descripcion, asignado_1, asignado_2, 
		asignado_3, estado, informe, prioridad, porcentaje, mes, ano, fecha_solicitud, fecha_entrega) 
		VALUES ( '$tipo_actividad', '$tipo_actividad_2', '$tipo_actividad_3', '$usuario', '$titulo_actividad', '$descripcion', '$asignar_1', 
		'$asignar_2', '$asignar_3', 'abierta', 'no_listo', '$prioridad', '0', '$mes', '$ano', '$fecha_solicitud', '$fecha_entrega')";
		//echo $query;
		$resul = mysqli_query($conn, $query);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/test_borders.css">
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
				<a href="../index.php" class="btn btn-secondary" role="button">Inicio</a>
				<a href="../includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesi&oacute;n</a> 
				<a href="../cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contraseña</a><br>
				Usuario: <?php echo $_SESSION['USUARIO'];?>
			</p>
			</div>
		</div>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-4 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Creaci&oacute;n de Actividades</h3></span>
				<table class="table table-bordered">
					<tr>
						<td></td>
						<td><img src="../imgs/crear_act.png"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Actividad creada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="../index.php"><h4>Volver</h4></a></td>
						<td></td>
					</tr>
				</table>
			</div>
    	</div>

		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col blockquote-footer">
				<!--(row_!abajo!)-->
				<p class="text-center">- Desarrollado por Laboratorio I + D - 2020 - </p>
			</div>
		</div>

	</div>

	<?php $_SESSION['ACT_ERROR'] = '';}?>
</body>
</html>