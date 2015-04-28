<!DOCTYPE html>
<?php 

session_start();
require_once("dal/conexion.php");  


?>


<html xmlns="">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles\enajenar\bootstrap.css" rel="stylesheet">
    <link href="styles\enajenar\bootstrap-responsiv|e.css" rel="stylesheet">
    <link href="styles\enajenar\preview.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="styles\enajenar\font-awesome.css" rel="stylesheet">
    <link href="styles\enajenar\styles.css" rel="stylesheet">
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



        <div class="row-fluid" id="demo">
            <div class="span12">
                <div class="tabbable custom-tabs tabs-animated  flat flat-all hide-label-980 shadow track-url auto-scroll">
                     
                            <div class="row-fluid">

                                <div class=" span10 offset1">
                                    
                                    <h4>&nbsp;&nbsp;Datos del Distribuidor</h4>
                                    
                                    <?php// var_dump('distribuidores'); ?>
                                   
                                    N° de Contrato &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" id="" disabled name="tipo_cliente" class="input-block-level span2">
                                    <br>

                                    Tipo de Usuario &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $tipo_cliente;?>" id="" disabled name="tipo_cliente" class="input-block-level span2">

                                    &nbsp;&nbsp;
                                    Razón Social &nbsp;&nbsp;<input type="text" disabled value="<?php echo $_SESSION["user"]["nombres"];?>" id="" name="razon_disri" class="input-block-level span5">
                                    <br>
                                    RIF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="text" value="<?php echo $_SESSION["user"]["id_distribuidor"];?>" id="" disabled name="id_distribuidor" class="input-block-level span2">

                                    <input type="hidden" value="<?php echo $_SESSION["user"]["id_usuario"];?>" name="id_usuario" >
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Contacto &nbsp;
                                    <input type="text" value="<?php echo $_SESSION["user"]["apellidos"];?>" id="" disabled name="nombre" class="input-block-level span5">

                                    <br>

                                    Dirección &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <textarea row="2" class="span8" disabled ><?php echo $_SESSION["user"]["direccion"];?></textarea>

                                    <br>

                                    País &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  
                                    <input type="text" value="<?php echo $pais;?>" id="" disabled name="nombre" class="input-block-level span2 " STYLE="font-family : Arial; font-size : 9pt">

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado&nbsp;&nbsp; <input type="text" value="<?php echo $estado;?>" id="" disabled name="nombre" class="input-block-level span2 " STYLE="font-family : Arial; font-size : 9pt">

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ciudad &nbsp;&nbsp; <input type="text" value="<?php echo $ciudad;?>" id="" disabled name="nombre" class="input-block-level span2 " STYLE="font-family : Arial; font-size : 9pt">

                                    <br>
                                    Teléfono &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" value="<?php echo $_SESSION["user"]["telefono1"];?>" id="" disabled name="nombre" class="input-block-level span3">
                                   &nbsp; &nbsp;&nbsp; &nbsp;
                                    Email  &nbsp; &nbsp; <input type="text" value="<?php echo $_SESSION["user"]["email"];?>" id="" disabled name="nombre" class="input-block-level span4">
                                    <br>

                                </div>

                            </div>
                                
                             

                </div>

            </div>
            
        </div>
    </div>

    <script language="JavaScript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="javascript\enajenar\campos.js"></script>
    <script src="javascript\enajenar\jquery-1.9.1.js"></script>
    <script src="javascript\enajenar\bootstrap.js"></script>
    <script src="javascript\enajenar\numerico.js"></script>
    <script src="javascript\enajenar\tabs-addon.js"></script>
    <script type="text/javascript">
        $(function ()
        {
            $("a[href^='#demo']").click(function (evt)
            {
                evt.preventDefault();
                var scroll_to = $($(this).attr("href")).offset().top;
                $("html,body").animate({ scrollTop: scroll_to - 80 }, 600);
            });
            $("a[href^='#bg']").click(function (evt)
            {
                evt.preventDefault();
                $("body").removeClass("light").removeClass("dark").addClass($(this).data("class")).css("background-image", "url('bgs/" + $(this).data("file") + "')");
                console.log($(this).data("file"));


            });
            $("a[href^='#color']").click(function (evt)
            {
                evt.preventDefault();
                var elm = $(".tabbable");
                elm.removeClass("grey").removeClass("dark").removeClass("dark-input").addClass($(this).data("class"));
                if (elm.hasClass("dark dark-input"))
                {
                    $(".btn", elm).addClass("btn-inverse");
                }
                else
                {
                    $(".btn", elm).removeClass("btn-inverse");

                }

            });
            $(".color-swatch div").each(function ()
            {
                $(this).css("background-color", $(this).data("color"));
            });
            $(".color-swatch div").click(function (evt)
            {
                evt.stopPropagation();
                $("body").removeClass("light").removeClass("dark").addClass($(this).data("class")).css("background-color", $(this).data("color"));
            });
            $("#texture-check").mouseup(function (evt)
            {
                evt.preventDefault();

                if (!$(this).hasClass("active"))
                {
                    $("body").css("background-image", "url(bgs/n1.png)");
                }
                else
                {
                    $("body").css("background-image", "none");
                }
            });

            $("a[href='#']").click(function (evt)
            {
                evt.preventDefault();

            });

            $("a[data-toggle='popover']").popover({
                trigger:"hover",html:true,placement:"top"
            });
        });

    </script>

</body>
</html>
