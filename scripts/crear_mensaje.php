<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    $asignar_1 = $_POST["asignar_1"];
    $mensaje = $_POST["mensaje_form"];
    $mes = date("m");
	$ano = date("y");
    $fecha = date("d/m/y");
    $mensaje = $mensaje. " ".$fecha; 
    	
	if ($usuario == '' || $mensaje == '' || $asignar_1 == '') 
	{
		$_SESSION['MSJ_ERROR'] = "¡Todos los campos son obligatorios!";
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
				<a href="../includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesión</a> 
				<a href="../cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contraseña</a><br>
				Usuario: <?php echo $_SESSION['USUARIO'];?>
			</p>
			</div>
		</div>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-4 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Creacion de Mensaje Personal</h3></span>
				<table class="table table-bordered">
					<tr>
						<td></td>
						<td><img src="../imgs/crear_act.png"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Mensaje creado con exito por <?php echo $_SESSION['NOMBRE'];?></td>
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

	<?php $_SESSION['MSJ_ERROR'] = '';}?>
</body>
</html>