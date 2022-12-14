<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}

    $who_is_this = $_SESSION['APELLIDOS'];
    $mes = date("m");
    //$mes = '06';                  //arreglar torta de Luiskis
    $ano = date("y");	
	
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

	<?php include 'includes/header.php'; ?>
	<?php include 'includes/navBar.php'; ?>
          
		<div class = "row justify-content-center mi_row">
            <div class="col-3 mi_col">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
			<div class = "col-3 mi_col">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th class="mi_td" colspan="2">Actividades asignadas:</th>
						</tr>
						<tr>
							<th class="mi_td" colspan="2"> 
								Mes:   
								<?php                                  
									echo cualMes($mes);                         //funcion de mes
								?>
							</th>
						</tr>
                    </thead>
					<tr>
							<td colspan="2"><img src=""></td>
					</tr>

                        <?php
                                $phpDataPoints = array();                       //se crear array de php para meter los datos del grafico    
                                include 'includes/connection.php';  
                                $query1 = "SELECT COUNT(*) as total FROM actividades WHERE (asignado_1 LIKE '$who_is_this' OR asignado_2 LIKE '$who_is_this' OR asignado_3 LIKE '$who_is_this') AND mes LIKE '$mes' AND ano LIKE '$ano' ";
                                //echo $query2;
                                $resul1 = mysqli_query($conn, $query1, MYSQLI_USE_RESULT);
                                $data1 = mysqli_fetch_assoc($resul1);  
                                echo '<tr><td class="mi_td">'.$who_is_this.":</td>";
                                echo '<td class="mi_td">'.$data1["total"]."</td></tr>";

                                include 'includes/connection.php';  
                                $query2 = "SELECT COUNT(*) as total FROM actividades WHERE mes LIKE '$mes' AND ano LIKE '$ano' ";
                                //echo $query2;
                                $resul2 = mysqli_query($conn, $query2, MYSQLI_USE_RESULT);
                                $data2 = mysqli_fetch_assoc($resul2);  
                                echo '<tr><td class="mi_td">Total del ??rea:</td>';
                                echo '<td class="mi_td">'.$data2["total"].'</td></tr>';

                                $data3 = ($data1["total"] * 100) / $data2["total"];  
                                echo '<tr><td class="mi_td">Porcentaje:</td>';
                                echo '<td class="mi_td">'.round($data3, 2).'%</td></tr>';

                                //include 'includes/connection.php';  
                                //$query3 = "SELECT COUNT(*) as total FROM actividades WHERE mes LIKE '$mes' AND ano LIKE '$ano' ";
                                //echo $query3;
                                //SELECT MAX(amount) FROM payments;

                                $nombre = $who_is_this;
                                $participacion = $data1["total"];
                                $total_area = $data2["total"];
                                array_push($phpDataPoints, $participacion, $nombre);        //Se insertan datos al array de php para el grafico
                                array_push($phpDataPoints, $total_area, "Total Area");
                                $js_dataPoints = json_encode($phpDataPoints);               //Se transforma array de PHP a array JS
                                //var_dump($dataPoints);
                        ?>   

                <tr><td class="mi_td" colspan="2"><a class="btn btn-sm btn-info" href="index.php">Volver</a></td></tr>  
                </table>
            </div>
		</div>

        <?php include 'includes/footer.php'; ?>

	</div>
</body>
<script>
    data = crearData(<?php echo $js_dataPoints; ?>); //Se llama funci??n que crea los labels compatibles al chart.js
    //console.log(data);
    labels = crearLabels(<?php echo $js_dataPoints; ?>); //Se llama funci??n que crea la data compatible al chart.js
    //console.log(labels);
</script>
</html>