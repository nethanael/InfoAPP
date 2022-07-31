<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}

    $who_is_this = $_SESSION['APELLIDOS'];
    //echo $who_is_this;

	function dateDifference($date_1 , $date_2 , $differenceFormat = '%R%a' )
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
	
		$interval = date_diff($datetime1, $datetime2);
	
		return $interval->format($differenceFormat);
	
	}

    $fecha_real   = '2021-03-23 06:00';    // esto lo jala automaticamente cuando pone listo para informe
    $fecha_pedida = '2021-03-25T06:00';    // esto lo jala de la base de datos cuando consulta el dato de cuando tenia que entregar
    
	$valor = dateDifference($fecha_real, $fecha_pedida);

	echo $valor;

	if ($valor < 0 ) {
		echo "ROJO";
	}
	if ($valor > 0 ) {
		echo "Verde";
	}

    //echo date_format($interval, 'Y-m-d H:i:s');
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
				<a href="includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesi&oacute;n</a> 
				<a href="cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contraseña</a><br>
				Usuario: <?php echo $_SESSION['USUARIO'];?>
			</p>
			</div>
			<canvas id="myChart" width="400" height="400"></canvas>
		</div>
		
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
                TEST CHAMBER!
			</div>
		</div>

		<div class = "row justify-content-center mi_row">
			<div class="col-6 justify-content-center mi_col bg-secondary text-white">
				<p class="text-center font-weight-light">Este es el men&uacute; principal del sistema creado para 
				la jefatura directa de un grupo de trabajo determinado. Permite la creaci&oacute;n, edici&oacute;n y
				asignaci&oacute;n de actividades. Tambi&eacute;n permite visualizar las cargar de trabajo y automatizar
				la creaci&oacute;n del informe mensual de un departamento.</p>
			
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
