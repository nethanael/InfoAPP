<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
 
    include 'includes/connection.php';                                           // Conexion a BD
    $sql= "SELECT * FROM actividades";                                          // Consulta del campo necesario
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
			<div class = "col-6 mi_col">
					<!--(row_!Titulo!) -->
					<h1>Sistema de Informes</h1>
			</div>
		</div>
        
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
			<!-- (row_!nav!) -->
				Usuario registrado: <?php echo $_SESSION['USUARIO'];?> - 
				<a href="includes/session_kill.php" class="btn btn-primary" role="button">Cerrar Sesión</a> - 
				<a href="cambio_pass.php" class="btn btn-primary" role="button">Cambiar Contraseña</a>
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
                    </thead>
                    <tr>
                        <th>Codigo Actividad:</th>
                        <th>Tipo de Actividad:</th>
                        <th>Creada por:</th>
                        <th>Titulo:</th>
                        <th>Descripion:</th>
                        <th>Asignado a:</th>
                        <th>Asignado a:</th>
                        <th>Asignado a:</th>
                        <th>Estado:</th>
                        <th>Prioridad:</th>
                        <th>Porcentaje:</th>
                        <th>Avance 1:</th>
                        <th>Avance 2:</th>			
                        <th>Avance 3:</th>
                        <th>Avance 4:</th>		
                        <th>Avance 5:</th>	
                        <th>Mes:</th>		
                        <th>Ano:</th>
                        <th>Estimado 1:</th>	
                        <th>Estimado 2:</th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                            echo "<td>$col_value</td>";
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
				<!-- (row_!abajo!) -->
				- Desarrollado por Centro I + D / Laboratorio Hatillo - 2020 -
				<?php echo $_SERVER['SERVER_SIGNATURE']; ?> 
			</div>
		</div>

	</div>
</body>
</html>