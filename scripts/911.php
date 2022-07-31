 <?php  
 
            //Script para ejecutar operaciones de emergencia

            session_start();

            if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
            else {
                if ($_SESSION['RANGO'] == 2) header("Location: home_lo_rank.php");
            }

            // Este bloque es para borrar actividades irregulares del sistema

            $codigo_actividad = '800';

            include '../includes/connection.php';
        
            $query = "DELETE FROM actividades WHERE codigo_actividad LIKE $codigo_actividad";
            //echo $query;
            $resul = mysqli_query($conn, $query);
            if ($resul){
                echo "Transacción Exitosa!";
            }else{
                echo "Transacción Fallida!";
            };

 ?>  