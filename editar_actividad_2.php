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

    include 'includes/connection.php';                                           // Conexion a BD
	$queryA = "SELECT apellidos FROM usuarios WHERE rango = 2 OR rango = 3";                                   // Consulta del campo necesario
	$resulA = mysqli_query($conn, $queryA, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos_test_2DA = mysqli_fetch_all($resulA);                                   // Construimos el array con los datos
    $datos_test_1DA = array_reduce($datos_test_2DA, 'array_merge', array());       //  Convertirmos array multidimensional a uno sencillo
    
    //print("<pre>".print_r($datos_test_2D,true)."</pre>");                         //  Debugging para ver array original
    //print("<pre>".print_r($datos_test_1D,true)."</pre>");                           //  Debugging para ver array nuevo
    
    function dynamic_select($the_array, $element_name, $label = '', $init_value = '') { //funcion que crea selects dinamicos
        $menu = '';
        if ($label != '') $menu .= '
            <label for="'.$element_name.'">'.$label.'</label>';
        $menu .= '
            <select name="'.$element_name.'" id="'.$element_name.'">';
        if (empty($_REQUEST[$element_name])) {
            $curr_val = $init_value;
        } else {
            $curr_val = $_REQUEST[$element_name];
        }
        foreach ($the_array as $key => $value) {
            $menu .= '
                <option value="'.$value.'"';
            if ($key == $curr_val) $menu .= ' selected="selected"';
            $menu .= '>'.$value.'</option>';
        }
        $menu .= '
            </select>';
        return $menu;
    }

    $cod_act = $_GET['superdato']; 
    
    include 'includes/connection.php';                                           // Conexion a BD
	$query = "SELECT * FROM actividades WHERE codigo_actividad LIKE '$cod_act'"; // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos = mysqli_fetch_assoc($resul);
    
	$tipo_actividad = $datos["tipo_actividad"];
    $creada_por = $datos["creada_por"];
    $titulo = $datos["titulo"];
    $descripcion = $datos["descripcion"];
    $asignado_1 = $datos["asignado_1"];
    $asignado_2 = $datos["asignado_2"];
    $asignado_3 = $datos["asignado_3"];
    $estado = $datos["estado"];
    $informe = $datos["informe"];
    $prioridad = $datos["prioridad"];
    $porcentaje = $datos["porcentaje"];
    $avance_1 = $datos["avance_1"];
    $avance_2 = $datos["avance_2"];
    $avance_3 = $datos["avance_3"];
    $avance_4 = $datos["avance_4"];
    $avance_5 = $datos["avance_5"];
    $mes = $datos["mes"];
    $ano = $datos["ano"];
    $fecha_solicitud = $datos["fecha_solicitud"];
    $fecha_entrega = $datos["fecha_entrega"];
    
	mysqli_free_result($resul);   
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
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/editar_actividad.php"> 
                    <table class="table table-sm table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="mi_td" colspan="2">Detalles de actividad: </th>
                            </tr>
                            <tr>
                                <th colspan="2"> <span class="text-danger"><?php echo $_SESSION['EDITAR_ERROR']; ?> </th>
                            </tr>
                           
                        </thead>
                        <tr>
                            <td>C&oacute;digo de Actividad:</td>  
                            <td><input name="codigo_actividad" id="codigo_actividad" size="1" value="<?php echo $cod_act;?>"readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de Actividad:</td>  
                            <td><?php echo $tipo_actividad;?></td>
                        </tr>
                        <tr>
                            <td>T&iacute;tulo:</td>
                            <td><textarea name="titulo_form" id="titulo_form" value="" rows="5" cols="35"><?php echo $titulo;?></textarea></td>
                        </tr>
                        <tr>
                            <td>Descripci&oacute;n:</td>  
                            <td><textarea name="descripcion_form" id="descripcion_form" value="" rows="5" cols="35"><?php echo $descripcion;?></textarea></td>
                        </tr>
                        <tr>
                            <td>Avance 1:</td>  
                            <td><textarea name="avance_1_form" id="avance_1_form" value="" rows="10" cols="35"><?php echo $avance_1;?></textarea></td>
                        </tr>
                        <tr>
                            <td>Avance 2:</td>  
                            <td><textarea name="avance_2_form" id="avance_2_form" value="" rows="10" cols="35"><?php echo $avance_2;?></textarea></td>
                        </tr>
                        <tr>
                            <td>Avance 3:</td>  
                            <td><textarea name="avance_3_form" id="avance_3_form" value="" rows="10" cols="35"><?php echo $avance_3;?></textarea></td>
                        </tr>
                        <tr>
                            <td>Avance 4:</td>  
                            <td><textarea name="avance_4_form" id="avance_4_form" value="" rows="10" cols="35"><?php echo $avance_4;?></textarea></td>
                        </tr>
                        <tr>
                            <td>Avance 5:</td>  
                            <td><textarea name="avance_5_form" id="avance_5_form" value="" rows="10" cols="35"><?php echo $avance_5;?></textarea></td>
                        </tr>
                        <tr>
                            <td>Atiende:</td>  
                            <td><?php echo $asignado_1.", ".$asignado_2.", ".$asignado_3;?></td>
                        </tr>
                        <tr>
                            <td>Cambiar personal asignado:</td>  
                            <td>
                                <input type="checkbox" id="cambiar_asignado" name="cambiar_asignado" value="cambiar">
                                S&iacute;.
                            </td>
                        </tr>
                        <tr>
                            <td>Asignar a:</td>  
                            <td>
                                <?php echo dynamic_select($datos_test_1DA, 'asignar_1', '', 'some_var');?>
                            </td>
                        </tr>
                        <tr>
                            <td>Asignar a:</td>  
                            <td>
                                <?php echo dynamic_select($datos_test_1DA, 'asignar_2', '', 'some_var');?>
                            </td>
                        </tr>
                        <tr>
                            <td>Asignar a:</td>  
                            <td>
                                <?php echo dynamic_select($datos_test_1DA, 'asignar_3', '', 'some_var');?>
                            </td>
                        </tr>
                        <tr>
                            <td>Cambiar tipo de actividad:</td>  
                            <td>
                                <input type="checkbox" id="cambiar_actividad" name="cambiar_actividad" value="cambiar">
                                S&iacute;.
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de Actividad:</td>
                            <td>    
                                <select id="tipo_actividad" name="tipo_actividad">
                                    <option value="Proyecto">Proyecto</option>
                                    <option value="Investigacion">Investigaci&oacute;n</option>
                                    <option value="Trabajo_Lab">Trabajo en Laboratorio</option>
                                    <option value="Homologacion_Equipos">Homologaci&oacute;n y Aceptaci&oacute;n de Equipos</option>
                                    <option value="Colaboracion">Colaboraci&oacute;n otros Procesos</option>
                                    <option value="Capacitacion">Capacitaci&oacute;n</option>
                                    <option value="Transferencia_Conocimiento">Transferencia de Conocimiento</option>
                                    <option value="Averia_SIGA">Aver&iacute;a con SIGA</option>
                                    <option value="Averia_no_SIGA">Aver&iacute;a sin SIGA</option>
                                    <option value="Actividad_CS">Actividad con CS</option>
                                    <option value="Contratacion_Admin">Contrataci&oacute;n Administrativa</option>
                                    <option value="Otros">Otros</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha Entrega: (a&ntildeo-mes-d&iacutea T hora:min)</td>
                            <td>
                                <input name="fecha_entrega" id="fecha_entrega" size="15" value="<?php echo $fecha_entrega;?>">
                            </td>
                        </tr>
                        <tr>
                                <td class="mi_td" colspan="2"><input class="btn btn-warning" type="submit" name="Submit" value="Actualizar"></td>
                                <td></td>
                        </tr>
                        <tr>
                            <td class="mi_td" colspan="2"><a class="btn btn-info" href="index.php">Volver</a></td>
                            
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>