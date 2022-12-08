<?php
    session_start();

    $usuario = $_SESSION['USUARIO'];
    $who_is_this = $_SESSION['APELLIDOS'];
    $who_is_this_name = $_SESSION['NOMBRE'];
    $mes = date("m");
    $ano = date("y");	
    
    // Bloque de Funciones
    
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
                            if ($col_value != "")
                            {
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
                                if ($campo == "desempeno")
                                {
                                    echo "Se entrega con un % de desempe&ntilde;o de ";
                                }
                                if ($campo == "estado")
                                {
                                    echo "Esta actividad se encuentra ";
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
                        }
                    echo "</td>";
                    echo "</tr>";
                }
        }      
    }

    function conexionesBD($tipo_actividad, $who_is_this, $mes, $ano){
        include '../includes/connection.php';                                        // Conexion a BD
        $sql = "SELECT titulo, descripcion, avance_1, avance_2, avance_3, avance_4, avance_5, estado, desempeno FROM actividades 
        WHERE ( asignado_1 LIKE '$who_is_this' OR asignado_2 LIKE '$who_is_this' OR asignado_3 LIKE '$who_is_this') 
        AND mes LIKE '$mes' AND ano LIKE '$ano' AND informe LIKE 'listo' AND tipo_actividad LIKE '$tipo_actividad'"; 
        //echo $sql;                                 // Consulta del campo necesario
        return ($conn->query($sql));  
    }
    
    {       // Bloque de conexiones a la BD 
        $resul00 = conexionesBD("Proyecto", $who_is_this, $mes, $ano );
        $resul01 = conexionesBD("Investigacion", $who_is_this, $mes, $ano );
        $resul02 = conexionesBD("Trabajo_Lab", $who_is_this, $mes, $ano );
        $resul11 = conexionesBD("Homologacion_Equipos", $who_is_this, $mes, $ano );
        $resul03 = conexionesBD("Colaboracion", $who_is_this, $mes, $ano );
        $resul04 = conexionesBD("Capacitacion", $who_is_this, $mes, $ano );
        $resul05 = conexionesBD("Transferencia_Conocimiento", $who_is_this, $mes, $ano );
        $resul06 = conexionesBD("Averia_SIGA", $who_is_this, $mes, $ano );
        $resul07 = conexionesBD("Averia_no_SIGA", $who_is_this, $mes, $ano );
        $resul08 = conexionesBD("Actividad_CS", $who_is_this, $mes, $ano );
        $resul09 = conexionesBD("Contratacion_Admin", $who_is_this, $mes, $ano );
        $resul10 = conexionesBD("Otros", $who_is_this, $mes, $ano );
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

    <?php include '../includes/header.php'; ?>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-10 mi_col">
				<!-- (row_!Centro!) -->
                <div id="exportContent">
                <table class="table-responsive mi_tabla" id="tablin">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2"><h1>Investigación y Desarrollo - Sistemas Fijos</h1></th>
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
                        <tr>
                            <td colspan="2">Funcionario
                                <?php echo $who_is_this_name. ' '; 
                                echo $who_is_this;?>
                            </td>
                        </tr>
                    </thead>
                        <?php                    // Bloque de  construcción de actividades
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

			</div>
    	</div>

        <div class = "row justify-content-center mi_row">
            <div class = "col-4 mi_td">
                <button class="btn btn-primary" onclick="Export2Doc('exportContent', `<?php echo $who_is_this; ?>`);">Exportar Word</button>
            </div>
        </div>

        <div class = "row justify-content-center mi_row">
			<div class = "col-4 mi_td">
                <a class="btn btn-info" href="../index.php">Volver</a>
            </div>
		</div>
        
        <?php include '../includes/footer.php'; ?>

	</div>
</body>
</html>
<script src="export.js"></script> 
<?php $_SESSION['AVC_ERROR'] = '';