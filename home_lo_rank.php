<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

	if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
	else {
		if ($_SESSION['RANGO'] == 1) header("Location: home_hi_rank.php");
	}
	$who_is_this = $_SESSION['USUARIO'];
	$rango = $_SESSION['RANGO'];

	if ($rango == 2){
		$link = "scripts/crear_info_desempeno_personal.php";
	}else{
		$link = "scripts/crear_info_desempeno_personal_admin.php";
	};
 
    include 'includes/connection.php';     			                                    // Conexion a BD
    $sql= "SELECT mensaje_personal FROM usuarios WHERE usuario LIKE '$who_is_this'";   	// Consulta del campo necesario
	$resul = $conn->query($sql);  
	$datos = mysqli_fetch_assoc($resul);                                               //  Hacemos consulta a la BD
	$mensaje_personal = $datos["mensaje_personal"];
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
				<div class = "col-6 justify-content-center mi_col">
					<!-- (row_!Centro!) -->
						<table class="table">
						<thead class="thead-light">
							<tr>
								<th colspan="2">Menu Principal (Asignable):</th>
							</tr>
						</thead>
						<tr>
							<td><a href="consultar_act_asignada.php">Actividades Asignadas Pendientes</a></td>
							<td><a href="consultar_conteo_actividades_2.php">Conteo de Actividades</a></td>
						</tr>
						<tr>
							<td><a href="consultar_act_general.php">Consultar Actividades General</a></td>
							<td><a href="consultar_act_personal.php">Historico Mis Actividades</a></td>
						</tr>
						<tr>
							<th colspan="2">Generación de informes:<th>
						</tr>
						<tr>
							<td><a href="crear_info_lo_rank.php">Informe Actividades Mensual</a></td>
							<td><a href=<?php echo $link; ?> >Informe Desempe&ntilde;o Mensual</a></td>
						</tr>
					</table>
				</div>
			</div>

		<div class = "row justify-content-center mi_row">
			<div class="col-6 justify-content-center mi_col">
				<div class="p-3 mb-2 bg-success text-white">Mensaje Importante: <?php echo $mensaje_personal;?></div>
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