<!DOCTYPE html>
<?php 

session_start();
require_once("dal/conexion.php");  

?>


<html xmlns="">
    
<head>
    <!-- Initialization of Plugins -->
    <script type="text/javascript" src="../estilos/js/template.js"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript" src="../estilos/js/custom.js"></script>
    
    <script language="JavaScript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="javascript\enajenar\jquery-1.9.1.js"></script>
    <script src="modules\javascript\account\account.js"></script>

</head>
    
<body class=" ">
    
<?php
if(!isset($_SESSION["user"])  ){
	echo $_SESSION["user"];
}

$strsqls= "SELECT pa.pais, es.estado, ci.ciudad, tip.tipo 
            FROM tbl_usuarios AS us
            INNER JOIN tbl_paises AS pa
            ON us.fk_pais = pa.pk_pais
            INNER JOIN tbl_estados AS es
            ON us.fk_estado = es.pk_estado
            INNER JOIN tbl_ciudades AS ci
            ON us.fk_ciudad = ci.pk_ciudad
            INNER JOIN tbl_usuarios_tipo AS tip
            ON us.fk_usuario_tipo = tip.pk_usuario_tipo
            WHERE us.pk_usuario = {$_SESSION["user"]["pk_usuario"]}";
$rss = mysql_query($strsqls);
$num_regs = mysql_num_rows($rss);

if ($num_regs > 0) {
    while($row= mysql_fetch_array($rss)) {
        $pais = $row["pais"];
        $estado = $row["estado"];
        $ciudad = $row["ciudad"];
        $tipo_cliente = $row["tipo"];
    }
}


?>

    <div class="container">
        
    <br>
        
        <center><h2>Cambio de Contraseña</h2></center>
        <br>
    
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="separador"></div>
        </div>
        <div class="col-md-1"></div>
        

        <div class="col-md-4"></div>
        
        <div class="col-md-4">
            <form method="post" id="formulario1" onsubmit="return cambio_clave()">
                <div class="row">
                        <div class="row">
                            <div class="col-xs-12">
                                <br>
                                <label>Contraseña Anterior</label>
                                <input type="password" required id="clave_anterior" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <label for="numero">Nueva Contraseña</label>
                                <input type="password" required id="clave_nueva" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <label for="numero">Repetir Contraseña</label>
                                <input type="password" required id="clave_repetir" class="form-control">
                                <input type="hidden" value="<?php echo $_SESSION["user"]["id_distribuidor"];?>" id="rif_user">
                            </div>
                        </div>
                    <br>
                </div>
                <div class="alert alert-danger" style="display:none" id="diferentes" style="margin-right: 75px; margin-left: 75px;">
                    Las contraseñas no coinciden.
                </div>
                <div class="alert alert-danger" style="display:none" id="clave_errada" style="margin-right: 75px; margin-left: 75px;">
                    La clave no es correcta.
                </div>
                <div class="alert alert-success " style="display:none" id="clave_correcta" style="margin-right: 75px; margin-left: 75px;">
                    Su clave se ha Actualizado Correctamente.
                </div>
                <div class="alert alert-danger" style="display:none" id="clave_error" style="margin-right: 75px; margin-left: 75px;">
                    No se pudo actualizar la clave.
                </div>
                
                <center>
                <input type="submit" value="Guardar" id="Enviar" name="Enviar" class="btn btn-default">
                </center>
            </form>
            <br>
            
        </div>
        
        <div class="col-md-4"></div>
        
    </div>
    
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="separador"></div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <center><h2>Agregar Personal Técnico</h2></center>
    <br>
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            
            <center>
                <form class="form-inline" onsubmit="return nuevo_tecnico()">
                    <div class="form-group">
                        <label>Nombre y Apellido
                            <input type="text" required class="form-control" id="nombre_tecnico">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>RIF N°
                            <select class="form-control" required id="letra_rif">
                                <option value="">--</option>
                                <option value="G">G</option>
                                <option value="V">V</option>
                                <option value="E">E</option>
                                <option value="P">P</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group" style="margin-top: -6px;">
                        <input type="text" required maxlength="9" class="form-control" id="rif_tecnico">
                    </div>
                    <button type="submit" style="margin-top: 3px;" class="btn btn-sm btn-default">Guardar</button>
                </form>
                <br>
                
                <div class="container">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        
                        <div class="alert alert-danger" style="display:none" id="tec_exist" style="margin-right: 75px; margin-left: 75px;">
                            EL Personal Técnico que intenta validar, se encuentra activo en otro Distribuidor. Por favor contacte al Proveedor.
                        </div>
                        <div class="alert alert-danger" style="display:none" id="tec_error" style="margin-right: 75px; margin-left: 75px;">
                            Ha ocurido un error al cargar los datos. Por favor intente nuevamente.
                        </div>
                        <div class="alert alert-success" style="display:none" id="tec_save" style="margin-right: 75px; margin-left: 75px;">
                            El Personal Técnico se ha asociado correctamente.
                        </div>
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>        
                
                
                
                
                <h2>Personal Técnico Asociado</h2>
                
                <table class='table table-condensed' id="datatable" width="1000" style="font-family : Arial; font-size : 9pt; background-color: #fff;"><br>
                        <tr style='background-color:#a30327;color:#fff'>
                            <th>N°</th>
                            <th>Nombre del Personal Técnico</th>
                            <th>RIF</th>
                        </tr>

                    <?php 

                    $query_tec = "SELECT id,nombre_tecnico,id_tecnico FROM tbl_tecnicos
                              WHERE id_distribuidor = '{$_SESSION["user"]["id_distribuidor"]}'";

                    $result_tec = mysql_query($query_tec) or die('Consulta fallida N° 2: ' . mysql_error());
                    while($tecnicos=mysql_fetch_array($result_tec,MYSQL_ASSOC)){
                                    ?>
                                    <tr id="opcion_tabla">
                                      <td><?php echo $tecnicos["id"] ?></td>
                                      <td><?php echo $tecnicos["nombre_tecnico"] ?></td>
                                      <td><?php echo $tecnicos["id_tecnico"] ?></td>
                                    </tr>
                                    <?php } ?>
                    </table>
                
            </center>
            
        </div>
        <div class="col-md-1"></div>
    </div>
    
    
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="separador"></div>
        </div>
        <div class="col-md-1"></div>
    </div>
    
    
    <div class="container">
    
        <div class="col-md-1"></div>

        <div class="col-md-10">


            <center><h2>Mis Datos</h2></center>
            <br>

            <div class="row">
                <div class="row">
                    <div class="col-xs-5">
                        <label for="nombre">Tipo de Usuario</label>
                        <input type="text" class="form-control" id="nombre" value="<?php echo $tipo_cliente;?>" disabled >
                    </div>
                    <div class="col-xs-5" style="margin-left: 15px;">
                        <label for="razon">Razón Social</label>
                        <input type="text" class="form-control" id="razon" value="<?php echo $_SESSION["user"]["nombres"];?>" disabled >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-5">
                        <label>RIF</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["id_distribuidor"];?>" disabled >
                    </div>
                    <div class="col-xs-5" style="margin-left: 15px;">
                        <label for="numero">Contacto</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["apellidos"];?>" disabled >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-9">
                        <label for="numero">Dirección</label>
                        <textarea row="2" class="form-control input-xxlarge" disabled ><?php echo $_SESSION["user"]["direccion"];?></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-3">
                        <label>País</label>
                        <input type="text" class="form-control" value="<?php echo $pais;?>" disabled >
                    </div>
                    <div class="col-xs-3" style="margin-left: 15px;">
                        <label for="numero">Estado</label>
                        <input type="text" class="form-control" value="<?php echo $estado;?>" disabled >
                    </div>
                    <div class="col-xs-3" style="margin-left: 15px;">
                        <label for="numero">Ciudad</label>
                        <input type="text" class="form-control" value="<?php echo $ciudad;?>" disabled >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-5">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["telefono1"];?>" disabled >
                    </div>
                    <div class="col-xs-5" style="margin-left: 15px;">
                        <label for="numero">Email</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["email"];?>" disabled >
                    </div>
                </div>

            </div>
            <br>
            <div class="separador"></div>

        </div>

        <div class="col-md-1"></div>
        
    </div>    
    
    
    
    <br><br>

</body>
</html>