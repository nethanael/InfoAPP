<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
        else {
            if ($_SESSION['RANGO'] == 2) header("Location: home_lo_rank.php");
        }

    $mes = date("m");
    $ano = date("y");	
    
    include 'includes/connection.php';                                           // Conexion a BD
    $sql = "SELECT codigo_actividad, tipo_actividad, titulo, descripcion, estado, informe, prioridad, mes, ano, fecha_solicitud, fecha_entrega 
    FROM actividades WHERE informe LIKE 'listo' AND mes LIKE '$mes' AND ano LIKE '$ano'";  
    $resul = $conn->query($sql);                                    // Consulta del campo necesario

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
                            <th colspan="11">Actividades marcadas como "Listas para informe":</th>
                        </tr>
                        <tr>
                            <td colspan="11">
                                <span class="lead text-info">
                                    Puede hacer clic en el c&oacute;digo de la actividad para revisarla y devolverla sin los avances no cumplen lo establecido.
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <span class="lead text-danger">
                                    <?php echo $_SESSION['REABRIR_ERROR'];?>
                                </span>
                            </td>
                        </tr>                
                    </thead>
                    <tr>
                        <th><small>C&oacute;digo Actividad:</small></th>
                        <th><small>Tipo de Actividad:</small></th>
                        <th><small>T&iacute;tulo:</small></th>
                        <th><small>Descripci&oacute;n:</small></th>
                        <th><small>Estado:</small></th>
                        <th><small>Listo Informe:</small></th>
                        <th><small>Prioridad:</small></th>	
                        <th><small>Mes:</small></th>		
                        <th><small>Ano:</small></th>
                        <th><small>Fecha Entrega:</small></th>	
                        <th><small>Fecha Solicitud:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line = $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                             if ($campo== 'codigo_actividad'){
                                                 echo "<td><a href=reabrir_act_2.php?superdato=",$col_value,">$col_value</a></td>";
                                             }else{
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