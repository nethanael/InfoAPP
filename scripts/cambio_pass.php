<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

	$user = $_SESSION['USUARIO'];
	$pass1 = $_POST["pass1"];
	$pass2 = $_POST["pass2"];
	
	if ($pass1 == '' || $pass2 == '') 
	{
		$_SESSION['CAMBIO_PASS_ERROR'] = "Datos incompletos!";
		header("Location: ../cambio_pass.php");
	}
	else
	{		
		if ($pass1 != $pass2)
		{
					$_SESSION['CAMBIO_PASS_ERROR'] = "Contrasenas no coinciden!";
					header("Location: ../cambio_pass.php");
		}
		else
		{	

	include '../includes/connection.php';	
	$encryptedPass = md5($pass1);
	$query = "UPDATE usuarios SET contrasena = '$encryptedPass' WHERE usuario = '$user' ";
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
	//mysqli_free_result($resul); 
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

		<?php include '../includes/header.php'; ?>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-4 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Cambio de contrase&ntilde;a</h3></span>
				<table class="table table-bordered">
					<tr>
						<td></td>
						<td class="mi_td"><img src="../imgs/cambio_pass.png"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Contrase&ntilde;a cambiada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td class="mi_td"><a class="btn btn-info" href="../index.php">Volver</a></td>
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

	<?php $_SESSION['CAMBIO_PASS_ERROR'] = '';}}?>
</body>
</html>