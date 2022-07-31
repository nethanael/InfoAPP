<?php

    function consultaBD($meta, $colaborador, $mes, $ano){

        //echo $meta;
        //echo $colaborador;
        include 'connection.php';  
        $sql= "SELECT codigo_actividad, titulo, descripcion, 
        estado, informe, fecha_solicitud, fecha_entrega, fecha_real, desempeno 
        FROM actividades 
        WHERE ( asignado_1 LIKE '$colaborador' OR asignado_2 LIKE '$colaborador' OR asignado_3 LIKE '$colaborador') 
        AND ( tipo_actividad_2 LIKE '$meta' OR tipo_actividad_3 LIKE '$meta') 
        AND mes LIKE '$mes' 
        AND ano LIKE '$ano' 
        AND informe LIKE 'listo' "; // Consulta del campo necesario
        //echo $sql;
        return $conn->query($sql);   //  Hacemos consulta a la BD
    }

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

    function armarTabla($result){
        while ($line =  $result->fetch_assoc()) 
        {
            echo "<tr>"; 
            foreach ($line as $campo => $col_value)
                {
                    echo "<td><small>";
                    if ($campo == "desempeno"){
                        $_SESSION['promedio'] = ($col_value + $_SESSION['promedio']);
                        $desempeno = $col_value;
                        ++$_SESSION['conteo'];
                    }
                    echo "$col_value";
                    echo "</small></td>";
                }
                //echo "<td><small>";
                    //$peso = $desempeno * 0.3;
                    //echo $peso."%";
                //echo "</small></td>";    
            echo "</tr>";
        }
    }

    function calculoNOTA($peso_obtenido, $peso_esperado){
    $peso_esperado = $peso_esperado * 100;
     //echo "Peso obtenido: ", $peso_obtenido;
     //echo"<br>";
     echo '<p class="font-italic">' . "Esperado: ", $peso_esperado, "%".'</span>';
     echo "<br>";
        if ($peso_obtenido == "NAN%"){
            echo '<span class="badge badge-secondary">Sin Actividad</span>';
        }
        if ($peso_obtenido > $peso_esperado && $peso_obtenido != "NAN%"){
            echo '<span class="badge badge-success">Sobresaliente</span>';
        }
        if ($peso_obtenido == $peso_esperado && $peso_obtenido != "NAN%"){
            echo '<span class="badge badge-warning">Cuanto</span>';
        }
        if ($peso_obtenido < $peso_esperado && $peso_obtenido != "NAN%"){
            echo '<span class="badge badge-danger">Bajo</span>';
        }
    }
?>