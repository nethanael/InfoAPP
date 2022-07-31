<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    $cod_act = $_POST["codigo_actividad"];
    $titulo = $_POST["titulo_form"];
    $descripcion = $_POST["descripcion_form"];
	$avance_1 = $_POST["avance_1_form"];
	$avance_2 = $_POST["avance_2_form"];
	$avance_3 = $_POST["avance_3_form"];
	$avance_4 = $_POST["avance_4_form"];
	$avance_5 = $_POST["avance_5_form"];
    $asignar_1 = $_POST["asignar_1"];
    $asignar_2 = $_POST["asignar_2"];
	$asignar_3 = $_POST["asignar_3"];
	$tipo_actividad = $_POST["tipo_actividad"];
	$cambiar_asignado = $_POST["cambiar_asignado"];
	$cambiar_actividad = $_POST["cambiar_actividad"];
	$fecha_entrega = $_POST["fecha_entrega"];

    /*$mes = date("m");
	$ano = date("y");
	$fecha = date("d/m/y H:i a");*/
    	
	if ($titulo == '' || $descripcion == '' || $fecha_entrega == '') 
	{
		$_SESSION['EDITAR_ERROR'] = "No puede estar vac&iacute;o el t&iacute;tulo o la descripci&oacute;n o la fecha de entrega";
		$myheader = "Location: ../editar_actividad_2.php?superdato=" . $cod_act; 
		header($myheader);
	}
	else
	{		

        if ($cambiar_asignado) 
        {
            //echo "si quiere cambio!";
            include '../includes/connection.php';
            $query2 = "UPDATE actividades set asignado_1 = '$asignar_1', asignado_2 = '$asignar_2', asignado_3 = '$asignar_3' WHERE codigo_actividad LIKE '$cod_act'";
            $resul2 = mysqli_query($conn, $query2);
		}
		
		if ($cambiar_actividad) 
        {
            //echo "si quiere cambio!";
            include '../includes/connection.php';
            $query3 = "UPDATE actividades set tipo_actividad = '$tipo_actividad' WHERE codigo_actividad LIKE '$cod_act'";
            $resul3 = mysqli_query($conn, $query3);
        }
        
        include '../includes/connection.php';
        
        $query = "UPDATE actividades set titulo = '$titulo', descripcion = '$descripcion', 
		avance_1 = '$avance_1', avance_2 = '$avance_2', avance_3 = '$avance_3', avance_4 = '$avance_4', avance_5 = '$avance_5',
		fecha_entrega = '$fecha_entrega' WHERE codigo_actividad LIKE '$cod_act'";
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
				<span class="text-center"><h3>Edici&oacute;n de Actividades</h3></span>
					<table class="table table-bordered">
						<tr>
							<td></td>
							<td><img src="../imgs/editar_act.png"></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>Actividad editada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></td>
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

	<?php 
		$_SESSION['EDITAR_ERROR'] = '';}
	?>
</body>
</html>