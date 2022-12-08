<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    $asignar_1 = $_POST["asignar_1"];
    $mensaje = $_POST["mensaje_form"];
    $mes = date("m");
	$ano = date("y");
    $fecha = date("d/m/y");

	if ($mensaje){
		$mensaje = $mensaje." ".$fecha; 
	}else{
		$mensaje = '';
	}
    
    	
	if ($usuario == '' || $mensaje == '' || $asignar_1 == '') 
	{
		$_SESSION['MSJ_ERROR'] = "¡Existen campos sin rellenar!";
		header("Location: ../crear_mensaje.php");
	}
	else
	{		

        include '../includes/connection.php';

        $query = "UPDATE usuarios set mensaje_personal = '$mensaje' WHERE apellidos LIKE '$asignar_1'";
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

		<?php include '../includes/header.php'; ?>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-4 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Creacion de Mensaje Personal</h3></span>
				<table class="table table-bordered">
					<tr>
						<td></td>
						<td class="mi_td"><img src="../imgs/crear_act.png"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Mensaje creado con exito por <?php echo $_SESSION['NOMBRE'];?></td>
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

		<?php include '../includes/footer.php'; ?>

	</div>

	<?php $_SESSION['MSJ_ERROR'] = '';}?>
</body>
</html>