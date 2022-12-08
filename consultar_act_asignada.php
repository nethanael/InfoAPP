<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%R%a' )
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

        if ($datetime1 == false || $datetime2 == false){
            return "N/A";
        }
	
		$interval = date_diff($datetime1, $datetime2);
	
		return $interval->format($differenceFormat);
	}
    
    $hoy = date("Y-m-d H:i");

    $who_is_this = $_SESSION['APELLIDOS'];
    //echo $who_is_this;

    include 'includes/connection.php';                                           // Conexion a BD
    $sql= "SELECT codigo_actividad, tipo_actividad, titulo, descripcion, fecha_entrega 
    FROM actividades WHERE ( asignado_1 LIKE '$who_is_this' 
    OR asignado_2 LIKE '$who_is_this' OR asignado_3 LIKE '$who_is_this') 
    AND informe LIKE 'no_listo'";                                                 // Consulta del campo necesario
    $resul = $conn->query($sql);                                              //  Hacemos consulta a la BD
    
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
        <meta http-equiv="refresh" content="60" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/test_borders.css">
		<title>Sistema de Informes</title>
	</head>
<body>
	<div class = "container mi_cont">

	<?php include 'includes/header.php'; ?>
	<?php include 'includes/navBar.php'; ?>
          
		<div class = "row justify-content-center mi_row mi_scrollable_div">
            <?php
                foreach ($resul as $row) {

					$chance = dateDifference($hoy,$row["fecha_entrega"]);
				
					if ($chance == "N/A")
					{
						$miclase = "";
						}else{
							if ($chance <= 0){
								$miclase = "text-danger";
							}else {
								if ($chance <= 2){
									$miclase = "text-warning";
								}else{
									$miclase = "text-primary";
							}
						}
					};

					echo '<div class = "col-sm-6 mi_col">';
						echo '<div class="card bg-light mb-3">';

							echo '<div class="card-header">';
								echo $row['tipo_actividad'];
							echo '</div>';

							echo '<div class="card-body '.$miclase.'">';
								echo '<h5 class="card-title">'.$row["titulo"].'</h5>';
								echo '<h6 class="card-subtitle mb-2 text-muted">Codigo: '.$row["codigo_actividad"].'</h6>';
								echo '<p class="card-text">'.$row["descripcion"].'</p>';
								echo '<h6 class="card-subtitle mb-2 text-muted">Entrega: '.$row["fecha_entrega"].'</h6>';
								echo '<h6 class="card-subtitle mb-2 text-muted">Dias: '.$chance.'</h6>';
								echo '<a href="hacer_avance_2_especial.php?superdato='.$row['codigo_actividad'].'" class="btn btn-primary">Avances</a>';
							echo '</div>';

						echo '</div>';
					echo '</div>';
                }
            ?>
            </div>
			<div class = "row justify-content-center mi_row">
				<div class = "col-4 mi_td"><a class="btn btn-info" href="index.php">Volver</a></div>
			</div>
        </div> 


		<?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>