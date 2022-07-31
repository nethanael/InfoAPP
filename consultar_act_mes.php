<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}

    $mes = date("m");
    $ano = date("y");	
    $conteo = 0;
 
    include 'includes/connection.php';                                           // Conexion a BD
    $sql= "SELECT codigo_actividad, tipo_actividad, tipo_actividad_2, tipo_actividad_3, titulo, descripcion, asignado_1, asignado_2, asignado_3, 
    estado, informe, prioridad, mes, ano, fecha_solicitud, fecha_entrega 
    FROM actividades WHERE mes LIKE '$mes' AND ano LIKE '$ano' AND informe LIKE 'no_listo'"; // Consulta del campo necesario
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
				<a href="includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesi&oacute;n</a> 
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
                            <th colspan="2">Actividades Totales:</th>
                        </tr>
                        <tr>
                            <td colspan="14">
                                <span class="lead text-info">
                                    Aqu&iacute; se puede consultar que actividades a&uacute;n no han sido marcadas como "listas" por el personal.
                                </span>
                            </td>
                        </tr>
                    </thead>
                    <tr>
                        <th><small>C&oacute;digo Actividad:</small></th>
                        <th><small>Tipo de Actividad:</small></th>
                        <th><small>Meta Desempe&ntilde;o 1:</small></th>
                        <th><small>Meta Desempe&ntilde;o 2:</small></th>
                        <th><small>T&iacute;tulo:</small></th>
                        <th><small>Descripci&oacuten:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Asignado a:</small></th>
                        <th><small>Estado:</small></th>
                        <th><small><h5>¿Listo para informe?</h5></small></th>
                        <th><small>Prioridad:</small></th>
                        <th><small>Mes:</small></th>		
                        <th><small>Ano:</small></th>
                        <th><small>Fecha Solicitud:</small></th>	
                        <th><small>Fecha Entrega:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    $conteo++;
                                    foreach ($line as $campo => $col_value)
                                        {
                                            {
                                                if ($col_value != "No asignar"){
                                                    echo "<td><small>";
                                                    
                                                    if ($campo == "informe")
                                                    {
                                                        
                                                        if ($col_value == "no_listo"){
                                                            echo '<p style="color:red">';
                                                        }else{
                                                            echo '<p style="color:blue">'; 
                                                        }
                                                    }

                                                        echo "$col_value";

                                                    if ($campo == "informe")
                                                    {
                                                        echo "</p>";
                                                    }
                                                    
                                                    echo "</small></td>";
                                                }else{
                                                    echo "<td><small></small></td>";
                                                }
                                            }
                                        }
                                }
                                echo "</tr>";
                        ?>     
                </table>
            </div>
        <a href="index.php">Volver</a>
		</div>

        <div class = "row justify-content-center mi_row">
            <div class="col-6 justify-content-center mi_col bg-secondary text-white">
				<p class="text-center font-weight-light">Antes de generar el informe mensual todas las actividades deben
                estar marcadas como "listo" en esta tabla.</p>    
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