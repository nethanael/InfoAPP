<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();
	
	if ($_SESSION['LOGIN_informes'] == 'TRUE')
		{
			if ($_SESSION['RANGO'] == 1) header("Location: home_hi_rank.php");
			if ($_SESSION['RANGO'] == 2 || $_SESSION['RANGO'] == 3) header("Location: home_lo_rank.php");
		}
?>
<!DOCTYPE html>
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
			<div class = "col-6 mi_col">
					<!--(row_!Titulo!)-->
					<p class="text-center"><img src="imgs/logo_1.png"></p>
			</div>
		</div>

		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!--(row_!nav!)-->
			</div>
		</div>
		
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 justify-content-center mi_col">
				<!--(row_!Centro!)-->
				<form name="form1" method="post" action="scripts/ingreso.php">
					<table class="table">
						<tr>
							<th colspan="2"><p class="text-center h5">Ingrese sus datos:</p></th>
						</tr>
						<tr>
							<td><p class="text-right">Usuario:</p></td>
							<td><input name="user" type="text" id="user" value="<?php echo $_SESSION['USUARIO_TEMP']; ?>" size="10" maxlength="10"></td>
						</tr>
						<tr>
							<td><p class="text-right">Contrase&ntilde;a:</p></td>
							<td><input name="pass" type="password" id="pass" size="10" maxlength="10"></td>
						</tr>      
						<tr>
							<td></td>
							<td><input type="submit" name="Submit" value="Ingresar"></td>
						</tr>
						<tr>
							<th colspan="2"><p class="text-center font-italic text-danger"><?php echo $_SESSION['LOGIN_ERROR']; ?></p></th>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div class = "row justify-content-center mi_row">
			<div class="col-6 justify-content-center mi_col bg-secondary text-white">
				<p class="text-center font-weight-light">Este es un sistema automatizado para la confecci&oacute;n de 
				informes mensuales del departamento de investigaci&oacute;n y desarrollo. El nombre y apellidos de cada 
				usuario a sido registrado adecuadamente, por lo tanto, utilizar el sistema responsablemente. No se permite 
				el prestamo de usuarios y contrase&ntilde;as. Consultas y sugerencias a: phidalgoa@ice.go.cr </p>
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