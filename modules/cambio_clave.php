<?php

require_once("../soporte/dal/conexion.php");  

    $clave_anterior = '';
    $clave_nueva = '';
    $rif = '';
    
    if (isset($_POST))
    {
        $clave_anterior = md5($_POST["clave_anterior"]);
        $clave_nueva = md5($_POST["clave_nueva"]);
        $rif = $_POST["rif"];
        
        $sql_pass ="SELECT pass FROM tbl_usuarios
                    WHERE cedula_rif = '{$rif}' 
                    AND pass = '{$clave_anterior}'";         
           
        $result_pass = mysql_query($sql_pass) or die('Consulta fallida clave anterior: ' . mysql_error());
        $num_pass = mysql_num_rows($result_pass);

        if ($num_pass > 0) {
                
            $sql_change ="UPDATE tbl_usuarios SET pass = '{$clave_nueva}'
                          WHERE cedula_rif = '{$rif}'";         
           
            $result_change = mysql_query($sql_change) or die('Consulta fallida nueva clave: ' . mysql_error());

            if ($result_change) {
                $mensaje = 1;
                // se actualizo
            }else{
                $mensaje = -1;
                // no se pudo cambiar la clave
            }
            
        }else{
            $mensaje = 0;
            // la clave es invalida.
        }
        echo $mensaje;
               
    }
    