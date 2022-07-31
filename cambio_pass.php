<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();
	
	if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
	
	$user = $_SESSION['USUARIO'];
	$nombre = $_SESSION['NOMBRE'];
	
	include 'includes/connection.php';

	$query = "SELECT * FROM usuarios WHERE usuario like '$user'"; 
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
	
	$datos = mysqli_fetch_array($resul);
	$user_bd = $datos["usuario"];
	$pass_bd = $datos["contrasena"];
	mysqli_free_result($resul); 
	
	$_SESSION['CAMBIO_PASS_TEMP1'] = $pass_bd;
	
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
		</div>
        
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 justify-content-center mi_col">
				<!-- (row_!Centro!) -->
				<form name="form1" method="post" action="scripts/cambio_pass.php">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th colspan="2">Cambio de Contrase&ntilde;a</th>
							</tr>
						</thead>
						
						<tr>	
							<td></td>
							<td colspan="2">
							<img src="imgs/cambio_pass.png"><br>
								<span class="text-danger">
									<?php echo $_SESSION['CAMBIO_PASS_ERROR'] ?>
								</span>
							</td>
						</tr>
						
						<tr>
							<td><?php echo $_SESSION['NOMBRE'];?></td>
							<td><?php echo $_SESSION['APELLIDOS'];?></td>
						</tr>

						<tr>
							<td><?php echo $_SESSION['CEDULA'];?></td>
							<td><?php echo $_SESSION['PERFIL'];?></td>
						</tr>
						
						<tr>
							<td>Usuario:</td>
							<td><?php echo $_SESSION['USUARIO'];?></td>
						</tr>

						<tr>
							<td>Contrase&ntilde;a encriptada:</td>
							<td><?php echo $_SESSION['CAMBIO_PASS_TEMP1'];?></td>
						</tr>
						
						<tr>
							<td>Contrase&ntilde;a:</td>
							<td><input name="pass1" type="password" id="pass1"></td>
						</tr>
						
						<tr>
							<td>Confirmaci&oacute;n:</td>
							<td><input name="pass2" type="password" id="pass2"></td>
						</tr>
						
						<tr>
							<td colspan="2"><input type="submit" name="Submit" value="Cambiar"></td>
						</tr>
				
						<tr>
							<td colspan="2"><a href="index.php">No quiero cambiar mi contrase&ntilde;a.</a></td>
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