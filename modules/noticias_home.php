<?php
$Textos = new Textos;
$rs = $Textos->getTexto(array("pk_texto" => intval($_GET["i"])));
?>


<div class="banner">
        <div class="fixed-image dark-translucent-bg section" style="background-image:url('modules/img/portfolio-2.jpg'); height: 70%;">
                <div class="container">
                        <div class="space"></div>
                        <h1>Autorizaciones &amp; Providencias </h1>
                        <div class="separator-2"></div>

                </div>
        </div>
</div>
<br>
<br>

<div class="container">
<table class="table cart table-hover table-striped">
    <tr>
        <thead>
            <tr>
                <th class="text-center">Autorizaciónes </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Descargar </th>
            </tr>
        </thead>
        <tbody>
            <tr class="remove-data">
                <?php
                $rss = $Shop->getNoticia(array("fk_tipo" => 2, "orderby" => "pk_noticia desc"), $_GET["page"], 14);
                foreach ($rss["results"] as $key => $value) {
                    ?>
                <td class="product col-md-5" colspan="3" style="font-size:13px; padding-right:0px; color:#A30327;"><?= $value["titulo" . $_SESSION["LOCALE"]] ?></td>
                    <td class="text-center"></td>
                    <td class="quantity"></td>
                    <td></td>
                    <td class="price color: #a30327;" style="padding-right: 0px;padding-left: 43px;"><button><a href="?dw=<?= $Shop->encode($value["pk_noticia"]) ?>" target="_blank" style="text-decoration:none; line-height:14px" class="aoverunderline"><img src="modules/img/download.png"></a></button></td>
            </tr>
            <?php } ?>  
        </tbody>
    </table>
<br>
<br>
<table class="table cart table-hover table-striped">
        <thead>
            <tr>
                <th class="text-center">Providencias y Resoluciones</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Descargar </th>
            </tr>
        </thead>
        <tbody>
            <tr class="remove-data">
                <?php
                $rss = $Shop->getNoticia(array("fk_tipo" => 3, "orderby" => "pk_noticia desc"), $_GET["page"], 14);
                foreach ($rss["results"] as $key => $value) {
                    ?>
                <td class="product col-md-5" colspan="3" style="font-size:13px; padding-right:0px; color:#A30327;"><?= str_replace('', "", str_replace('_', " ", $value["titulo" . $_SESSION["LOCALE"]])) ?></td>
                    <td class="text-center"></td>
                    <td class="quantity"></td>
                    <td></td>
                    <td class="price color: #a30327;" style="padding-right: 0px;padding-left: 43px;"><button><a href="?dw=<?= $Shop->encode($value["pk_noticia"]) ?>" target="_blank" style="text-decoration:none; line-height:14px" class="aoverunderline"><img src="modules/img/download.png"></a></button></td>
            </tr>
            <?php } ?>  
        </tbody>
</table>
</div>
<br>


        