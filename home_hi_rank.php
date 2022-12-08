<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

	if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
	else {
		if ($_SESSION['RANGO'] == 2 || $_SESSION['RANGO'] == 3) header("Location: home_lo_rank.php");
	}
		
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

		<?php include 'includes/header.php'; ?>
		<?php include 'includes/navBar.php'; ?>
		
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th colspan="2"><p class="mi_td h5">Men&uacute; Principal (Asignador):</p></th>
							</tr>
						</thead>
						<tr>
							<td colspan="2">
								<p class="mi_td h5">Gesti&oacute;n de Actividades</p>
							</td>
						</tr>
						<tr>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="crear_act.php">Crear</a></p></td>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="editar_actividad.php">Editar</a></p></td>
						</tr>
						<tr>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="reactivar_act.php">Reactivar</a></p></td>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="reabrir_act.php">Devolver</a></p></td>
						</tr>
						<tr>
							<td colspan="2"><p class="mi_td"><a class="btn btn-light btn-block" href="crear_mensaje.php">Enviar Mensaje Personal</a></p></td>
						</tr>
						<tr>
							<td colspan="2">
								<p class="mi_td h5">An&aacutelisis Actividades</p>
							</td>
						</tr>
						<tr>
						<tr>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="consultar_conteo_actividades.php">Distribuci&oacute;n de las actividades</a></p></td>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="consultar_act_mes.php">Trabajos pendientes</a></p></td>
						</tr>
						<tr>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="consultar_conteo_actividades_total.php">Conteo Total del Mes</a></p></td>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="scripts/crear_info.php">Crear Informe Mensual</a></p></td>
						</tr>
						<tr>
							<td colspan="2"><p class="mi_td"><a class="btn btn-light btn-block" href="consultar_act_general.php">Actividades Totales del Sistema</a></p></td>
						</tr>
						<tr>
							<td colspan="2">
								<p class="mi_td h5">An&aacutelisis Desempe&ntildeo</p>
							</td>
						</tr>
						<tr>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="crear_info_desempeno_individual.php">Crear Informe Individual Técnico</a></p></td>
							<td><p class="mi_td"><a class="btn btn-light btn-block" href="crear_info_desempeno_individual_admin.php">Crear Informe Individual Administrativo</a></p></td>
						</tr>
						<tr>
							<td colspan="2"><p class="mi_td"><a class="btn btn-light btn-block" href="crear_info_desempeno.php">Crear Informe Desempe&ntilde;o General</a></p></td>
						</tr>
					</table>
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

		<?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>