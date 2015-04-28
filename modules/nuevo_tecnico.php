<?php

require_once("../soporte/dal/conexion.php");  

    $nombre_tecnico = '';
    $rif_tecnico = '';
    $rif = '';
    
    if (isset($_POST))
    {
        
        $nombre_tecnico = $_POST["nombre_tecnico"];
        $rif_tecnico = $_POST["rif_tecnico"];
        $rif = $_POST["rif"];
        
        
        $sql_existe ="SELECT * FROM tbl_tecnicos 
                        WHERE id_tecnico = '{$rif_tecnico}'";         
           
        $result_existe = mysql_query($sql_existe) or die('Consulta fallida clave anterior: ' . mysql_error());
        $num_existe = mysql_num_rows($result_existe);

        if ($num_existe) {
            $mensaje = 0;   
            // el tecnico existe
        }else{
            
            $sql_tec ="INSERT INTO tbl_tecnicos (id_distribuidor,id_tecnico,nombre_tecnico)
                       VALUES ('".$rif."','".$rif_tecnico."','".$nombre_tecnico."')";         
           
            $result_tec = mysql_query($sql_tec) or die('Consulta fallida clave anterior: ' . mysql_error());

            if ($result_tec) {
                $mensaje = 1;   
                //se agrego el tecnico
            }else{
                $mensaje = -1;
                //  no se guardo el tecnico.
            }
            
        }
        
        echo $mensaje;
               
    }
    

