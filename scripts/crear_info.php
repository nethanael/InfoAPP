<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    //$mes = '11';                          //arreglar torta de Luiskis
    $mes = date("m");
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

    function actividadesInforme($data, $label)
    {
        if ($data->num_rows > 0)                            //aca validamos que haya actividades de cierto tipo
        {                                                   //si no lo hay entonces brinca al siguiente tipo de acitividad
            echo "<tr>";
            echo "<td><h3>";
            echo $label;
            echo "</h3></td>";
            echo "</tr>";

            while ($line = $data->fetch_assoc())           //saca todos los valores de la base de datos y
                {                                              // los hace filas
                    echo "<tr>";
                    echo "<td>";
                    echo "<hr>";
                    foreach ($line as $campo => $col_value)
                        {
                            if ($col_value == "") {echo "";}
                            if ($campo == "titulo")
                            {
                                echo "<strong>";
                            }
                            if ($campo == "descripcion")
                            {
                                echo "<i>";
                            }
                            if ($campo == "avance_1")
                            {
                                echo "<strong>Actividades realizadas: </strong>";
                                echo "<br>";
                                echo "<br>";
                            }

                            echo "$col_value";

                            if ($campo == "titulo")
                            {
                                echo "</strong>";
                            }
                            if ($campo == "descripcion")
                            {
                                echo "</i>";
                            
                            }
                            echo "<br>";
                            echo "<br>";               
                        }
                    echo "</td>";
                    echo "</tr>";
                }
        }      
    }

    function conexionesBD($tipo_actividad, $mes, $ano){
        include '../includes/connection.php';                                        // Conexion a BD
        $sql = "SELECT titulo, descripcion, avance_1, avance_2, avance_3, avance_4, avance_5 FROM actividades 
        WHERE mes LIKE '$mes' AND ano LIKE '$ano' AND informe LIKE 'listo' AND tipo_actividad LIKE '$tipo_actividad'"; 
        //echo $sql;                                 // Consulta del campo necesario
        return ($conn->query($sql));  
    }
    
    {       // Bloque de conexiones a la BD 
        $resul00 = conexionesBD("Proyecto", $mes, $ano );
        $resul01 = conexionesBD("Investigacion", $mes, $ano );
        $resul02 = conexionesBD("Trabajo_Lab", $mes, $ano );
        $resul11 = conexionesBD("Homologacion_Equipos", $mes, $ano );
        $resul03 = conexionesBD("Colaboracion", $mes, $ano );
        $resul04 = conexionesBD("Capacitacion", $mes, $ano );
        $resul05 = conexionesBD("Transferencia_Conocimiento", $mes, $ano );
        $resul06 = conexionesBD("Averia_SIGA", $mes, $ano );
        $resul07 = conexionesBD("Averia_no_SIGA", $mes, $ano );
        $resul08 = conexionesBD("Actividad_CS", $mes, $ano );
        $resul09 = conexionesBD("Contratacion_Admin", $mes, $ano );
        $resul10 = conexionesBD("Otros", $mes, $ano );
    } 

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
			<div class = "col-10 mi_col">
				<!-- (row_!Centro!) -->
                <div id="exportContent">
                <table class="table-responsive" id="tablin">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2"><h1>Investigaci&oacute;n y Desarrollo - Sistemas Fijos</h1></th>
                        </tr>
                        <tr>
                            <td colspan="2"><h2>Informe Mensual de actividades</h2></td>
                        </tr>
                        <tr>
                            <td colspan="2">Correspondiente al mes de 
                            <?php                                  
                                    echo cualMes($mes)."del 20".$ano;                         //funcion de mes
                                ?> 
                            </td>
                        </tr>
                    </thead>
                        <?php  
                            actividadesInforme($resul00, "Proyectos");
                            actividadesInforme($resul01, "Investigaci&oacuten");
                            actividadesInforme($resul02, "Trabajo de Laboratorio");
                            actividadesInforme($resul11, "Homologacion y Aceptacion de Equipos");
                            actividadesInforme($resul03, "Colaboraci&oacuten");
                            actividadesInforme($resul04, "Capacitaci&oacuten");
                            actividadesInforme($resul05, "Transferencia del conocimiento");
                            actividadesInforme($resul06, "Aver&iacuteas SIGA");
                            actividadesInforme($resul07, "Aver&iacuteas sin SIGA");
                            actividadesInforme($resul08, "Actividades CS");
                            actividadesInforme($resul09, "Contrataci&oacuten Administrativa");
                            actividadesInforme($resul10, "Otros");
                        ?> 

                </table>
                </div>
                <p class="text-center"><button class="btn btn-primary" onclick="Export2Doc('exportContent', 'Investigación y Desarrollo' );">Exportar Word</button></p>
			</div>
    	</div>

        <div class = "row justify-content-center mi_row">
                <div class = "col-10 mi_col">
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
<script src="export.js"></script> 