<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: ../index.php");}

    $mes = date("m");
    $ano = date("y");	
    $conteo = 0;
 
    include '../includes/connection.php';                                           // Conexion a BD
    $sql= "SELECT codigo_actividad, tipo_actividad, tipo_actividad_2, tipo_actividad_3, 
    titulo, descripcion, asignado_1, asignado_2, asignado_3, 
    estado, informe, prioridad, fecha_solicitud, fecha_entrega, fecha_real, desempeno 
    FROM actividades WHERE mes LIKE '$mes' AND ano LIKE '$ano' AND informe LIKE 'listo'"; // Consulta del campo necesario
	$resul = $conn->query($sql);                                                 //  Hacemos consulta a la BD
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
			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped" id="tblData">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2">Actividades Totales:</th>
                        </tr>
                        <tr>
                            <td colspan="14">
                                <span class="lead text-info">
                                    Desplegando las actividades "listas" del mes con su respectivo desempe&ntilde;o.
                                </span>
                            </td>
                        </tr>
                    </thead>
                    <tr>
                        <th><small>C&oacute;digo Actividad:</small></th>
                        <th><small>Tipo de Actividad:</small></th>
                        <th><small>Meta Desempe&ntilde;o A:</small></th>
                        <th><small>Meta Desempe&ntilde;o B:</small></th>
                        <th><small>T&iacute;tulo:</small></th>
                        <th><small>Descripci&oacuten:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Estado:</small></th>
                        <th><small>¿Listo informe?</small></th>
                        <th><small>Prioridad:</small></th>
                        <th><small>Fecha Solicitud:</small></th>	
                        <th><small>Fecha Entrega:</small></th>
                        <th><small>Fecha Real:</small></th>
                        <th><small>Desempe&ntilde;o:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    $conteo++;
                                    foreach ($line as $campo => $col_value)
                                        {
                                            if ($col_value != "No asignar"){
                                                echo "<td><small>";
                                                echo "$col_value";
                                                echo "</small></td>";
                                            }else{
                                                echo "<td><small></small></td>";
                                            }
                                        }
                                }
                                echo "</tr>";
                        ?>     
                </table>
            </div>
        <button class="btn btn-warning" onclick="exportTableToExcel('tblData', 'informe_desempeno')">Exportar a Excel</button><br>
		</div>

        <div class = "row justify-content-center mi_row">
                <div class = "col-6 mi_col">
                    <p class="text-center"><a href="../index.php">Volver</a></p>  
                </div>                
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
<script src="export_excel.js"></script> 