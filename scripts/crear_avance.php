<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    $cod_act = $_POST["codigo_actividad"];
    $avance_1 = $_POST["avance_1_form"];
    $avance_2 = $_POST["avance_2_form"];
    $avance_3 = $_POST["avance_3_form"];
    $avance_4 = $_POST["avance_4_form"];
    $avance_5 = $_POST["avance_5_form"];
	$porcentaje = $_POST["porcentaje_form"];
	$estado = $_POST["estado_form"];
	$informe = $_POST["informe_form"];
	$fecha_real = $_POST["fecha_real"];
	$desempeno = $_POST["desempeno"];

    /*$mes = date("m");
	$ano = date("y");
    $fecha = date("d/m/y H:i a");*/
    	
	if ($avance_1 == '') 
	{
		$_SESSION['AVC_ERROR'] = "Avance 1 no puede estar vacio";
		header("Location: ../hacer_avance_2_especial.php");
	}
	else
	{		

        include '../includes/connection.php';
        
        $query = "UPDATE actividades set avance_1 = '$avance_1', avance_2 = '$avance_2',avance_3 = '$avance_3',
		avance_4 = '$avance_4',avance_5 = '$avance_5', porcentaje = '$porcentaje', estado = '$estado', 
		informe = '$informe', fecha_real = '$fecha_real', desempeno = '$desempeno' 
		WHERE codigo_actividad LIKE '$cod_act'";
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
				<span class="text-center"><h3>Avance de Actividades</h3></span>
				<table class="table table-bordered">
					<tr>
						<td></td>
						<td class="mi_td"><img src="../imgs/hacer_avance.png"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Actividad actualizada con exito por <?php echo $_SESSION['NOMBRE'];?></td>
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

	<?php $_SESSION['AVC_ERROR'] = '';}?>
</body>
</html>