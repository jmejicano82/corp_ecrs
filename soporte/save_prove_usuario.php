
<?php
session_start();
require_once("dal/conexion.php");  
$mensaje='';
$id_registro = ''; 
$acepta_delete = '';
?>

<?php if (isset($_GET["Ope"])){  ?>
    
  <div id="openModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Confirmación</h3>
  </div>
  <div class="modal-body">
    <p>¿Esta Seguro que desea eliminar este registro?</p>
  </div>
  <div class="modal-footer">
      <center>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <button class="btnn-default" data-dismiss="modal" id="delete_registro" >Aceptar</button>
        <input type="hidden" value="<?php echo $id_registro = $_GET["id"];?>" id="numero_registro" >
    </center>
  </div>
</div>

<?php
    
}else{
    
$sql_tipo= "SELECT tip.tipo 
            FROM tbl_usuarios AS us
            INNER JOIN tbl_usuarios_tipo AS tip
            ON us.fk_usuario_tipo = tip.pk_usuario_tipo
            WHERE us.pk_usuario = {$_SESSION["user"]["pk_usuario"]}";
$res_tipo = mysql_query($sql_tipo);
$num_tipo = mysql_num_rows($res_tipo);

if ($num_tipo > 0) {
    while($row= mysql_fetch_array($res_tipo)) {
        $tipo_cliente = $row["tipo"];
    }
}

//var_dump($tipo_cliente);
    

// estos datos son ingresados por el usuario
$mes_enajenar = $_POST["mes_enajenar"];
$anio_enajenar = $_POST["anio_enajenar"];
$anio_vacio = $anio_enajenar;
$razon_distri = $_SESSION["user"]["nombres"];
$numero_factura = $_POST["numero_factura"];  //agregar
$numero_control = $_POST["numero_control"];  //agregar
$contacto_contrib = $_POST["contacto_contrib"];
$id_cliente = $_POST["Letra_rif_cliente"].$_POST["id_cliente"];
$direccion_contrib = $_POST["direccion_contrib"];
$pais_contrib = $_POST["pais_contrib"];
$estado_contrib = $_POST["estado_contrib"];
$ciudad_contrib = $_POST["ciudad_contrib"];
$telefono_contrib = $_POST["phone_contrib"];
$email_contrib = $_POST["email_contrib"];
$serial_equipo = $_POST["serial_equipo"];
$precinto = $_POST["precinto"];
$producto = $_POST["producto"];       //agregar
$fecha_enajenacion = $_POST["fecha_enajenacion"];
$tipo_op = $_POST["tipo_op"];
$observacion = $_POST["observacion"];
$id_tecnico = $_POST["nombre_tecnico"];

// busco el nombre del tecnico en la tabla de usuarios para guardarlo en la enajenacion
$datosTecnico = "SELECT nombre_tecnico FROM tbl_tecnicos WHERE id_tecnico = '{$id_tecnico}'";
$result = mysql_query($datosTecnico);
$num_datos = mysql_num_rows($result);
if ($num_datos > 0) {
    while($filas= mysql_fetch_array($result)) {
        $nombre_tecnico = $filas["nombre_tecnico"];
    }
}


// estos datos son tomados de la sesion del usuario
$tipo_cliente = $tipo_cliente;
$id_distribuidor = $_SESSION["user"]["id_distribuidor"];
$id_usuario = $_SESSION["user"]["id_usuario"];
$razon_contrib = $_POST["razon_contrib"];
$fecha_registro = date("Y-m-d");
$hora_registro = date("H:i:s");

$id_proveedor = 'J313222798';
$id_estatus_enajenacion = 1;    //agregar



if(isset($_POST["editar_datos"])){
    $editar_datos = $_POST["editar_datos"];
}else{
    $editar_datos = '';
}

if($editar_datos == ''){
    //echo 'cargo un nuevo registro';
    
    $sql = "INSERT INTO q_enajenacion (nombre_tecnico,id_tecnico,hora_registro,ciudad_contribuyente,estado_contribuyente,id_cliente,id_estatus_enajenacion,id_producto,numero_control,numero_factura,id_usuario,id_proveedor,tipo_cliente,id_distribuidor,mes_enajenar,anio_enajenar,razon_contribuyente,contacto_contribuyente,direccion_contribuyente,
        pais_contribuyente,telefono_contribuyente,email_contribuyente,serial,fecha_enajenacion,tipo_op,observaciones,precinto_maquina,fecha_registro,razon_distribuidor)
        VALUES ('".$nombre_tecnico."','".$id_tecnico."','".$hora_registro."','".$ciudad_contrib."','".$estado_contrib."','".$id_cliente."','".$id_estatus_enajenacion."','".$producto."','".$numero_control."','".$numero_factura."','".$id_usuario."','".$id_proveedor."','".$tipo_cliente."','".$id_distribuidor."','".$mes_enajenar."','".$anio_enajenar."','".$razon_contrib."','".$contacto_contrib."','".$direccion_contrib."',
        '".$pais_contrib."','".$telefono_contrib."','".$email_contrib."','".$serial_equipo."','".$fecha_enajenacion."','".$tipo_op."','".$observacion."','".$precinto."','".$fecha_registro."','".$razon_distri."')";

    // var_dump($sql);
    
    $resultados_inser = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
        
}else{
    //echo 'voy hacer una actualizacion';
    //echo $editar_datos;
    
    $update="UPDATE q_enajenacion SET hora_registro='$hora_registro',mes_enajenar='$mes_enajenar',anio_enajenar='$anio_enajenar',razon_contribuyente='$razon_contrib',numero_factura='$numero_factura', numero_control='$numero_control',
            contacto_contribuyente='$contacto_contrib',id_cliente='$id_cliente',direccion_contribuyente='$direccion_contrib',pais_contribuyente='$pais_contrib',estado_contribuyente='$estado_contrib',
            ciudad_contribuyente='$ciudad_contrib',telefono_contribuyente='$telefono_contrib',email_contribuyente='$email_contrib',serial='$serial_equipo',precinto_maquina='$precinto', 
            id_producto='$producto',fecha_enajenacion='$fecha_enajenacion',tipo_op='$tipo_op',id_tecnico='$id_tecnico',observaciones='$observacion'
            WHERE id=$editar_datos";
    $resultados = mysql_query($update) or die('Consulta fallida: ' . mysql_error());
    
    if($resultados==true){
        $mensaje="Los Datos se han Actualizado Exitosamente";
    }else{
        $mensaje="No se pudo Actualizar el Registro";
    }
    
}  


$mes_vacio = '';
    $mes=date("m");

    if ($mes_enajenar==01){
    $mes_vacio = "Enero";
    } else if ($mes_enajenar==02){
    $mes_vacio = "Febrero";
    } else if ($mes_enajenar==03){
    $mes_vacio = "Marzo";
    } else if ($mes_enajenar==04){
    $mes_vacio = "Abril";
    } else if ($mes_enajenar==05){
    $mes_vacio = "Mayo";
    } else if ($mes_enajenar==06){
    $mes_vacio = "Junio";
    } else if ($mes_enajenar==07){
    $mes_vacio = "Julio";
    } else if ($mes_enajenar==08){
    $mes_vacio = "Agosto";
    } else if ($mes_enajenar==09){
    $mes_vacio = "Septiembre";
    } else if ($mes_enajenar==10){
    $mes_vacio = "Octubre";
    } else if ($mes_enajenar==11){
    $mes_vacio = "Noviembre";
    } else if ($mes_enajenar==12){
    $mes_vacio = "Diciembre";
    }


        
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

$fecha_actual = date("Y-m-d");

$Hora = Time() + (60 *60 * -1); 
$nueva_hora = date('H:i:s',$Hora); //  -1 hora

    

?>
<div style="background-color: #f5f5f5;">

<h3>Declaración Informativa de Máquinas Fiscales</h3>
                                    
<h3 align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    (DIMAFI)</h3>

<h4>&nbsp;&nbsp;Período de Declaración (<?php echo $mes_vacio ?> / <?php echo $anio_vacio ?>)</h4>
<div style="border-bottom: 4px solid; color:#a30327;"></div>


<?php  if($mensaje == "Los Datos se han Eliminado Correctamente"){ ?>
<h4><div align="center" class="alert alert-success" id="mensaje_eliminado"><?php echo $mensaje ?>&nbsp;</div></h4>
<?php } ?> 

<h4><div align="center" class="alert alert-success" id="mensaje_editado"></div></h4>


<table class='table table-condensed' width="1000" style="font-family : Arial; font-size : 9pt; background-color: #fff;"><br>
    <tr style='background-color:#a30327;color:#fff'>
        <th>Fecha</th>
        <th>Rif Distribuidor</th>
        <th>Nombre Distribuidor</th>
        <th>Rif Cliente</th>
        <th>Nombre Contribuyente</th>
        <th>Rif Técnico</th>
        <th>Nombre Cliente</th>
        <th>Maquina</th>
        <th>Tipo Op.</th>
        <th>Acciones</th>
    </tr>
    
<?php 
$query = "SELECT id,fecha_registro,id_distribuidor,razon_distribuidor,id_cliente,razon_contribuyente,id_tecnico,nombre_tecnico,serial,tipo_op
            FROM q_enajenacion WHERE id_usuario = '{$_SESSION["user"]["id_usuario"]}' AND fecha_registro = '$fecha_actual' AND hora_registro > '{$nueva_hora}' ";
            


$result = mysql_query($query) or die('Consulta fallida N° 2: ' . mysql_error());
while($usuario=mysql_fetch_array($result,MYSQL_ASSOC)){
                ?>
                <tr>
                  <td width="80"><?php echo $usuario["fecha_registro"] ?></td>
                  <td><?php echo $usuario["id_distribuidor"] ?></td>
                  <td width="120"><?php echo $usuario["razon_distribuidor"] ?></td>
                  <td><?php echo $usuario["id_cliente"] ?></td>
                  <td width="120"><?php echo $usuario["razon_contribuyente"] ?></td>
                  <td><?php echo $usuario["id_tecnico"] ?></td>
                  <td><?php echo $usuario["nombre_tecnico"] ?></td>
                  <td><?php echo $usuario["serial"] ?></td>
                  <td><?php echo $usuario["tipo_op"] ?></td>
                  <td>
                      <a title="Modificar" id="editar_da" href="enajenar_prove_usuario.php?id=<?php echo $usuario["id"] ?>&Ope=Editar"><img src="images/edit.png" width="20" height="20"></a>&nbsp; 
                      <a title="Eliminar" id="eliminar_da" href="save_prove_usuario.php?id=<?php echo $usuario["id"] ?>&Ope=Eliminar"><img src="images/delete.png" width="20" height="20"></a>
                  </td>
                </tr>
                <?php } ?>
                
    
</table>

<!--  echo $pais_contrib.'<br>'.$tipo_cliente.'<br>'.$id_distribuidor.'<br>'.$id_usuario.'<br>'.$fecha_ini
    .'<br>'.$fecha_fin.'<br>'.$razon_contrib.'<br>'.$id_cliente.'<br>'.$contacto_contrib.'<br>'.
    $direccion_contrib.'<br>'.$telefono_contrib.'<br>'.$email_contrib.'<br>'.$serial_equipo.'<br>'.
    $fecha_enajenacion.'<br>'.$tipo_op.'<br>'.$observacion.'<br>'.$precinto.'<br>'.$nombre_tecnico;-->

    <br>

<center>         
        <div class="form-inline">
            <button type="button" onclick="window.location.href='default.php'" class="btnn-default">Volver</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btnn-default" onclick="location.href='enajenar_prove_usuario.php'">Continuar Enajenando</button>
        </div>
    <br>
</center> 
        
        
</div>
<?php
//style='background-color:#0000FF;color:#fff'

if(isset($_POST["actStatus"])){
    $acepta_delete = $_POST["actStatus"];
    var_dump($acepta_delete);
}
?>   

 
    
<script language="JavaScript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="javascript\save_enajenacion\campos_save.js"></script>
<script src="javascript\save_enajenacion\jquery-1.9.1.js"></script>
<script src="javascript\save_enajenacion\bootstrap.js"></script>
<!--<script src="javascript\operaciones.js"></script>-->
<script src="javascript\save_enajenacion\tabs-addon.js"></script>

<link href="styles\save_enajenacion\bootstrap.css" rel="stylesheet">
<link href="styles\save_enajenacion\bootstrap-responsive.css" rel="stylesheet">
<link href="styles\save_enajenacion\font-awesome.css" rel="stylesheet">
<link href="styles\enajenar\styles.css" rel="stylesheet">