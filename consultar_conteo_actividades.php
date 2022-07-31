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
    //$mes = '11';                  //arreglar torta de Luiskis
    $ano = date("y");	
    
    include 'includes/connection.php';                                           // Conexion a BD

    $query = "SELECT apellidos FROM usuarios WHERE rango LIKE '2' or rango LiKE '3'";              // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos_test_2D = mysqli_fetch_all($resul);                                   // Construimos el array con los datos
    $datos_test_1D = array_reduce($datos_test_2D, 'array_merge', array());       //  Convertirmos array multidimensional a uno sencillo
    
    //print("<pre>".print_r($datos_test_2D,true)."</pre>");                         //  Debugging para ver array original
    //print("<pre>".print_r($datos_test_1D,true)."</pre>");                           //  Debugging para ver array nuevo
    
    include 'includes/connection.php';  
    $queryTOTAL = "SELECT COUNT(*) as total FROM actividades WHERE mes LIKE '$mes' AND ano LIKE '$ano' ";
    //echo $query2;
    $resulTOTAL = mysqli_query($conn, $queryTOTAL, MYSQLI_USE_RESULT);
    $dataTOTAL = mysqli_fetch_assoc($resulTOTAL);  
    //echo $dataTOTAL[total];
	
	function cualMes($mes){
        switch ($mes) {
            case 1:
                return "Enero ";
                break;
            case 2:
                return "Febrero ";
                break;
            case 3:
                return "Marzo ";
                break;
            case 4:
                return "Abril ";
                break;
            case 5:
                return "Mayo ";
                break;
            case 6:
                return "Junio ";
                break;
            case 7:
                return "Julio ";
                break;
            case 8:
                return "Agosto ";
                break;
            case 9:
                return "Setiembre ";
                break;
            case 10:
                return "Octubre ";
                break;
            case 11:
                return "Noviembre ";
                break;
            case 12:
                return "Diciembre ";
                break;
        }

    }

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/test_borders.css"> 
        <script src="./scripts/crearDataGrafico.js"></script>
        <script src="./scripts/chart.min.js"></script>
        <script src="./scripts/chart.js"></script>
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
            <div class="col-6 mi_col">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
			<div class = "col-6 mi_col">
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="4">Asignaci&oacute;n de actividades para el mes de <?php echo cualMes($mes);?></th>
						</tr>
                        <tr>
                            <th>Colaborador</th>
                            <th>Asignadas</th>
                            <th>Total</th>
                            <th>Participaci&oacute;n</th>
                        </tr>
                    </thead>
					<tr>
                        <?php
                            $phpDataPoints = array();                       //se crear array de php para meter los datos del grafico
                            foreach ($datos_test_1D as $valor){
                                include 'includes/connection.php';  
                                $query2 = "SELECT COUNT(*) as total FROM actividades WHERE (asignado_1 LIKE '$valor' OR asignado_2 LIKE '$valor' OR asignado_3 LIKE '$valor') AND mes LIKE '$mes' AND ano LIKE '$ano' ";
                                //echo $query2;
                                $resul2 = mysqli_query($conn, $query2, MYSQLI_USE_RESULT);
                                $data = mysqli_fetch_assoc($resul2);  

                                if ($valor != 'No asignar')
                                {
                                    $nombre = $valor;
                                    $participacion = round(($data[total] * 100) / $dataTOTAL[total], 1);
                                    echo '<tr><td>'.$nombre."</td>";
                                    echo '<td>'.$data["total"]."</td>";
                                    echo '<td>'.$dataTOTAL[total].'</td>';
                                    echo '<td>'.$participacion.'%</td></tr>';
                                    array_push($phpDataPoints, $participacion, $nombre); //Se insertan datos al array de php para el grafico
                                }
                            }
                            $js_dataPoints = json_encode($phpDataPoints);               //Se transforma array de PHP a array JS
                            //var_dump($dataPoints);
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
    <script>
        data = crearData(<?php echo $js_dataPoints; ?>); //Se llama función que crea los labels compatibles al chart.js
        //console.log(data);
        labels = crearLabels(<?php echo $js_dataPoints; ?>); //Se llama función que crea la data compatible al chart.js
        //console.log(labels);
    </script>
</html>