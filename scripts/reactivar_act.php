<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    $cod_act = $_POST["codigo_actividad"];
    $informe = $_POST["informe_form"];
	$fecha_entrega = $_POST["fecha_entrega"];
	$fecha_solicitud = $_POST["fecha_solicitud"];
	//$mes = "05";
	$mes = date("m");
	$ano = date("y");
    //$fecha = date("d/m/y H:i a");
	
    	
	if ($cod_act == '' || $fecha_entrega == '' || $informe == '') 
	{
		$_SESSION['REACT_ERROR'] = "Fecha de entrega err&oacute;nea";
		header("Location: ../reactivar_act.php");
	}
	else
	{		

        include '../includes/connection.php';
        
        $query = "UPDATE actividades set informe = '$informe', mes = '$mes', ano = '$ano', avance_1 = '', avance_2 = '', 
		avance_3 = '', avance_4 = '', avance_5 = '', fecha_solicitud = '$fecha_solicitud', fecha_entrega = '$fecha_entrega', 
		fecha_real = '', desempeno = '' WHERE codigo_actividad LIKE '$cod_act'";
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

		<?php include '../includes/header.php'; ?>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-4 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Reapertura de Actividades</h3></span>
				<table class="table table-bordered">
					<tr>
						<td></td>
						<td class="mi_td"><img src="../imgs/devolver_act.png"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Actividad reactivada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></td>
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

	<?php $_SESSION['REACT_ERROR'] = '';}?>
</body>
</html>