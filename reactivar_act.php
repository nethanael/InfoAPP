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

    // Para arreglar el cambio de año
    //$mes = 12;
    //$ano = 21;

    //Yesterday usar esta linea de comando para resolver el tema de cambio de año y2k estebitan
    //$yesterday = date("Y", strtotime("yesterday"));
    
    //echo $yesterday;

    $mes = date("m");
    $mes = $mes - 1;
    $ano = date("y");

    if ($mes <= 9){
            $mes = "0"."$mes";
        }

    if ($mes == 0){
        $mes = 12;
        $ano = $ano - 1;
    }

    include 'includes/connection.php';                                                               // Conexion a BD
    $sql= "SELECT codigo_actividad, tipo_actividad, titulo, descripcion, estado, informe, 
    prioridad, mes, ano, fecha_solicitud, fecha_entrega
    FROM actividades WHERE estado LIKE 'abierta' AND informe LIKE 'listo' AND mes LIKE '$mes' AND ano LIKE '$ano'";     // Consulta del campo necesario
    $resul = $conn->query($sql);   //  Hacemos consulta a la BD
    
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
			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="mi_td" colspan="11">Actividades Reactivables:</th>
                        </tr>
                        <tr>
                        <td colspan="11">
                                <span class="lead text-info">
                                    Puede hacer clic en el c&oacute;digo de la actividad para reactivarla, esto permite que el personal asignado pueda hacer nuevos avances.
                                </span>
                        </td>
                        </tr>
                        <tr>
                                <td colspan="3">
                                    <span class="lead text-danger">
                                        <?php echo $_SESSION['REACT_ERROR'];?>
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
                        <th><small>Fecha Solicitud:</small></th>	
                        <th><small>Fecha Entrega:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line = $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                             if ($campo== 'codigo_actividad'){
                                                 echo "<td><a href=reactivar_act_2.php?superdato=",$col_value,">$col_value</a></td>";
                                             }else{
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