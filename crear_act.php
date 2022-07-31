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
	$query = "SELECT apellidos FROM usuarios WHERE rango = 2 OR rango = 3";                   // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos_test_2D = mysqli_fetch_all($resul);                                   // Construimos el array con los datos
    $datos_test_1D = array_reduce($datos_test_2D, 'array_merge', array());       //  Convertirmos array multidimensional a uno sencillo
    
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

    date_default_timezone_set('CST');
    $hoy = date("Y-m-d H:i");
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
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/crear_act.php"> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2">Crear Actividad:</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span class="lead text-info">
                                    Aqu&iacute; podr&aacute; crear cualquier tipo de actividad y asignar personal que se encargue de la misma en el tiempo y prioridad que se crea necesario.
                                    </span>
                                </td>
                            </tr>
                        </thead>
                        <tr>
                            <td></td>
                            <td>
                                <img src="imgs/crear_act.png"><br>
                                <span class="text-danger">
                                    <?php echo $_SESSION['ACT_ERROR'];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de Actividad:</td>
                            <td>    
                                <select id="tipo_actividad" name="tipo_actividad">
                                    <option value="Proyecto">Proyecto</option>
                                    <option value="Investigacion">Investigacion</option>
                                    <option value="Trabajo_Lab">Trabajo en Laboratorio</option>
                                    <option value="Homologacion_Equipos">Homologacion y Aceptacion de Equipos</option>
                                    <option value="Colaboracion">Colaboracion otros Procesos</option>
                                    <option value="Capacitacion">Capacitacion</option>
                                    <option value="Transferencia_Conocimiento">Transferencia de Conocimiento</option>
                                    <option value="Averia_SIGA">Avería con SIGA</option>
                                    <option value="Averia_no_SIGA">Avería sin SIGA</option>
                                    <option value="Actividad_CS">Actividad con CS</option>
                                    <option value="Contratacion_Admin">Contratacion Administrativa</option>
                                    <option value="Otros">Otros</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>Meta de Desempeno A:</td>
                            <td>    
                                <select id="tipo_actividad_2" name="tipo_actividad_2">
                                    <option value="Homologacion_Aceptacion">Homologaci&oacute;n y/o Aceptaci&oacute;n</option>
                                    <option value="Colaboracion_Transferencia">Transferencia conocimiento/colaboraci&oacute;n otras &aacute;reas</option>
                                    <option value="Averias">Atenci&oacute;n de aver&iacute;as</option>
                                    <option value="Administrativo">Contrataciones y/o seguimientos Administrativos</option>
                                    <option value="na">n/a</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>Meta de desempeno B:</td>
                            <td>    
                                <select id="tipo_actividad_3" name="tipo_actividad_3">
                                    <option value="na">n/a</option>
                                    <option value="Homologacion_Aceptacion">Homologaci&oacute;n y/o Aceptaci&oacute;n</option>
                                    <option value="Colaboracion_Transferencia">Transferencia conocimiento/colaboraci&oacute;n otras &aacute;reas</option>
                                    <option value="Averias">Atenci&oacute;n de aver&iacute;as</option>
                                    <option value="Administrativo">Contrataciones y/o seguimientos Administrativos</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>T&iacute;tulo de la Actividad:</td>
                            <td> 
                                <input name="titulo_actividad" type="text" id="titulo_actividad" size="" maxlength="100">
                            </td>
                        </tr>
                        <tr>
                            <td>Descripci&oacute;n (Recordar mencionar qui&eacute;n solicita)</td>
                            <td>
                                <textarea name="descripcion" rows="10" cols="30" maxlength="400"></textarea>
                            <td>
                        </tr>
                        <tr>
                            <td>Asignar a:</td>
                            <td><?php echo dynamic_select($datos_test_1D, 'asignar_1', '', 'some_var');?></td>
                        </tr>
                        <tr>
                            <td>Asignar a: (opcional)</td>
                            <td><?php echo dynamic_select($datos_test_1D, 'asignar_2', '', 'some_var');?></td>
                        </tr>
                        <tr>
                            <td>Asignar a: (opcional)</td>
                            <td><?php echo dynamic_select($datos_test_1D, 'asignar_3', '', 'some_var');?></td>
                        </tr>
                        <tr>
                            <td>Prioridad:</td>
                            <td>    
                                <select id="prioridad" name="prioridad">
                                    <option value="baja">Baja</option>
                                    <option value="media">Media</option>
                                    <option value="alta">Alta</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha Solicitud:</td>
                            <td>
                                <input name="fecha_solicitud" type="text" id="fecha_solicitud" size="15"
                                maxlength="100" value="<?php echo $hoy;?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha de Entrega:</td>
                            <td>
                                <input name="fecha_entrega" type="datetime-local" id="fecha_entrega" size="8" maxlength="100">
                            </td>
                        </tr>
                        <tr>
                                <td><input type="submit" name="Submit" value="Crear"></td>
                                <td><?php echo $_SESSION['ACT_ERROR'];?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="index.php">Volver</a></td>
                        </tr>
                    </table>
                </form>
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