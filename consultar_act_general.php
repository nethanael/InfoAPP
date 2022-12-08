<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
 
    include 'includes/connection.php';                                           // Conexion a BD
    $sql= "SELECT codigo_actividad, tipo_actividad, titulo, descripcion, asignado_1, asignado_2, asignado_3, mes, ano, desempeno FROM actividades";                                          // Consulta del campo necesario
	$resul = $conn->query($sql);                                                 //  Hacemos consulta a la BD
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
			<div class = "table-responsive mi_scrollable_div">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="mi_td" colspan="10">Actividades Totales Departamento:</th>
                        </tr>
                        <tr>
                            <td colspan="10"><small>Haga click en el codigo de actividad para ver en detalle.</small></td>
                        </tr>
                    </thead>
                    <tr>
                        <th><small>Codigo Actividad:</small></th>
                        <th><small>Tipo de Actividad:</small></th>
                        <th><small>Titulo:</small></th>
                        <th><small>Descripcion:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Mes:</small></th>		
                        <th><small>Ano:</small></th>
                        <th><small>Desempe&ntilde;o:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                            if ($col_value == "No asignar"){
                                                echo "<td><small></small></td>";
                                            }
                                            if ($campo == 'codigo_actividad'){
                                                echo "<td><a href=consultar_act_general_2.php?superdato=",$col_value,">$col_value</a></td>";
                                            }
                                            if (($col_value != "No asignar")&&($campo != 'codigo_actividad')){
                                                echo "<td><small>$col_value</small></td>";
                                            }
                                        }
                                    echo "</tr>";
                                }
                        ?>     
                </table>
            </div>
        <a class="btn btn-info" href="index.php">Volver</a>
		</div>

        <?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>