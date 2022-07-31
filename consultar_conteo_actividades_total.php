<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}

    $mes = date("m");
    //$mes = '06';                  //arreglar torta de Luiskis
    $ano = date("y");	
    
    include 'includes/connection.php';                                           // Conexion a BD

    include 'includes/connection.php';  
    $query2 = "SELECT COUNT(*) as total FROM actividades WHERE mes LIKE '$mes' AND ano LIKE '$ano' ";
    //echo $query2;
    $resul2 = mysqli_query($conn, $query2, MYSQLI_USE_RESULT);
    $data = mysqli_fetch_assoc($resul2);  
    
    echo $data["total"];
	
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
			<div class = "">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2">Actividades Creadas</th>
						</tr>
						<tr>
							<th colspan="2"> 
								Mes:   
								<?php                                  
									echo cualMes($mes);                         //funcion de mes
								?>
							</th>
						</tr>
                    </thead>
					<tr>
							<td colspan="2"><img src="imgs/carga_trab.png"></td>
					</tr>

                        <?php

                                echo '<tr><td>'."Total Actividades:"."</td>";
                                echo '<td>'.$data["total"]."</td></tr>";

                        ?>   

                <tr><td colspan="2"><a href="index.php">Volver</a></td></tr>  
                </table>
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