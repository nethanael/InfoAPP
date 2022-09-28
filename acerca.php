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
			
		<?php include 'includes/header.php'; ?>
		<?php include 'includes/navBar.php'; ?>

		<div class="row justify-content-center mi_row">

            <div class="col mi_col"></div>

            <div class="col mi_col">
                <!-- (row_!Centro!) -->

                <div class="card" style="width: 18rem;">
                    <img src="imgs/logo_1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Este es un sistema automatizado para la confecci&oacute;n de 
            informes mensuales del departamento y medici&oacute;n del desempe&ntilde;o de Investigaci&oacute;n y Desarrollo.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Diseño UI: <b>Ing. Pablo Hidalgo, Ing. Esteban Bolanos.</b></li>
                        <li class="list-group-item">Desarrollador: <b>Ing. Pablo Hidalgo.</b></li>
                        <li class="list-group-item">Requerimiento por: <b>Ing. Luis Carlos Duran.</b></li>
                    </ul>
                </div>
			</div>

            <div class="col mi_td"></div>

			</div>

			<div class = "row justify-content-center mi_row">
				<div class = "col mi_td"><a class="btn btn-info" href="index.php">Volver</a></div>
			</div>

		<?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>