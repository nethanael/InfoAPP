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
    estado, fecha_solicitud, fecha_entrega, fecha_real, desempeno 
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

	    <?php include '../includes/header.php'; ?>
          
		<div class = "row justify-content-center mi_row">
			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped" id="tblData">
                    <thead class="thead-dark">
                        <tr>
                            <th class="mi_td" colspan="14">Actividades Totales:</th>
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
                    <p class="text-center"><a class="btn btn-info" href="../index.php">Volver</a></p>  
                </div>                
        </div>

        <?php include '../includes/footer.php'; ?>

	</div>
</body>
</html>
<script src="export_excel.js"></script> 