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
    $sql= "SELECT codigo_actividad, tipo_actividad, titulo, descripcion, estado, informe, prioridad, mes, ano, fecha_solicitud, fecha_entrega 
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
				<a href="index.php" class="btn btn-secondary" role="button">Inicio</a>
				<a href="includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesión</a> 
				<a href="cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contraseña</a><br>
				Usuario: <?php echo $_SESSION['USUARIO'];?>
			</p>
			</div>
		</div>
          
		<div class = "row justify-content-center mi_row">
			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="12">Actividades Asignadas:</th>
                        </tr>
                        <tr>
                            <td colspan="12"><small>Puede hacer click en el codigo de actividad para hacer un avance.</small></td>
                        </tr>                
                    </thead>
                    <tr>
                        <th><small>Codigo Actividad:</small></th>
                        <th><small>Tipo de Actividad:</small></th>
                        <th><small>Titulo:</small></th>
                        <th><small>Descripcion:</small></th>
                        <th><small>Estado:</small></th>
                        <th><small>Listo Informe:</small></th>
                        <th><small>Prioridad:</small></th>	
                        <th><small>Mes:</small></th>		
                        <th><small>Ano:</small></th>
                        <th><small>Fecha Solicitud:</small></th>	
                        <th><small>Dias de tiempo:</small></th>
                        <th><small>Fecha Entrega:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line = $resul->fetch_assoc()) 
                                {
                                    
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                            if ($campo == 'codigo_actividad'){
                                                 echo "<td><a href=hacer_avance_2_especial.php?superdato=",$col_value,">$col_value</a></td>";
                                             }else
                                                {
                                                    
                                                    if ($campo == 'fecha_entrega'){
                                                        $chance = dateDifference($hoy,$col_value);

                                                        if ($chance == "N/A"){
                                                            $miclase = "";
                                                        }else{
                                                            if ($chance <= 0){
                                                                $miclase = "table-danger";
                                                            }else {
                                                                if ($chance <= 2){
                                                                    $miclase = "table-warning";
                                                                }else{
                                                                    $miclase = "table-success";
                                                                }
                                                            }
                                                        }
                                                        echo "<td class=$miclase><small>$chance</td></small>";
                                                    } 
                                                    
                                                    echo "<td><small>$col_value</small></td>";
                                                }
                                        }
                                    echo "</tr>";
                                }
                        ?>   
                </table>
            </div>
            <a href="index.php">Volver</a>
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