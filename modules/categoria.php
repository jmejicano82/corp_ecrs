<?php
//error_reporting(-1);

if (isset($_GET["buscar"])) {
    $productos = $Shop->searchProducto($_GET["buscar"], "relevancia desc", 0, 999);
    $rscch2["results"] = array('');
} else {
    $rscch = $Shop->getCategoria(array("pk_categoria" => intval($_GET["i"])));
    $rscch2 = $Shop->getCategoria(array("fk_categoria_padre" => intval($_GET["i"])));
}
?>

<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>



<!-- banner start -->
<!-- ================ -->
<div class="banner">

    <!-- slideshow start -->
    <!-- ================ -->
    <div class="slideshow white-bg">

        <!-- slider revolution start -->
        <!-- ================ -->
        <div class="slider-banner-container">
            <div class="slider-banner-3">
                <ul>
                    <!-- slide 1 start -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1000" data-saveperformance="on" data-title="Slide 1">

                        <!-- main image -->
                        <img class="fade" src="modules/img/slider-2-slide-1.jpg" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption very_large_text sft tp-resizeme" data-x="center" data-y="70" data-speed="700" data-start="200" data-end="10000" data-endspeed="">Cajas Registradoras Fiscales
                        </div>

                        <!-- LAYER NR. 2 -->
                        <h2 class="tp-caption small_thin_white sfb text-center tp-resizeme" data-x="center" data-y="170" data-speed="700" data-start="400" data-end="10000" data-endspeed="">Las características y especificaciones técnicas de las Cajas Registradoras Fiscales QUORiON <br>le permiten adaptarse a cada uno de los requerimeintos de su negocio, ofreciendole una gran variedad de funciones para el control <br>y manejo de sus ventas. Consulte con su Distribuidor más cercano...!
                        </h2>
                    </li>

                </ul>
            </div>
        </div>
        <!-- slider revolution end -->
    </div>
    <!-- slideshow end -->
</div>
<!-- banner end -->


<section class="main-container object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="200">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <div class="filters text-center">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#" data-filter="*">Todas</a></li>
                        <li><a href="#" data-filter="#portatiles">Portátiles</a></li>
                        <li><a href="#" data-filter="#por_menor">Ventas al por menor</a></li>
                        <li><a href="#" data-filter="#multiples">Multiples Propósitos</a></li>
                    </ul>
                </div>
                <!-- isotope filters end -->

            </div>
            <!-- main end -->
        </div>
    </div>
    
   

    <div class="gray-bg section">
        <div class="container">
            <div class="isotope-container row grid-space-11">

                <?php foreach ($rscch2["results"] as $k => $v) { ?>
                    <?php if (!isset($_GET["buscar"])) { 
                                    
                        $tipo_categorias = $v["categoria"];

                        if($tipo_categorias == 'Cajas Registradoras Fiscales Portátiles'){
                            $show_category = 'portatiles';
                        }
                        if($tipo_categorias == 'Cajas Registradoras Fiscales para Ventas al por Menor'){
                            $show_category = 'por_menor';
                        }
                        if($tipo_categorias == 'Cajas Registradoras de Múltiples-Propósitos'){
                            $show_category = 'multiples';
                        }
                        
                    } ?>

                    <?php if (isset($_GET["buscar"]) && sizeof($productos["results"]) == 0) { ?>

                        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <th align="left" scope="col" align="center" class="producto_tituhome">Su búsqueda no arrojó resultados</th>
                            </tr>
                        </table>
                        <br />
                    <?php
                    }
                    if (trim($_GET["buscar"]) == '') {
                        $params = array(
                            TBL_PRODUCTOS_VS_CATEGORIAS . ".fk_categoria" => $v["pk_categoria"],
                            TBL_PRODUCTOS_VS_CATEGORIAS . ".fk_estatus" => 1,
                            TBL_PRODUCTOS . ".fk_estatus" => 1
                        );
                        $productos = $Shop->getProducto($params, 0, 99);
                    }

                    //echo sizeof($productos["results"]);

                    if (sizeof($productos["results"]) > 0) {
                        for ($a = 0; $a < sizeof($productos["results"]); $a = $a + 2){ ?>                           

                        
                            <div class="container"> 
                                <?php if (isset($productos["results"][$a])) { ?>
                                    <div class="col-sm-6 col-md-4 isotope-item" id="<?php echo $show_category;?>">
                                        <div class="box-style-1 white-bg">
                                            <div>
                                                <img src="/images/products/tb2_<?= $productos["results"][$a]["pk_producto"] ?>.jpg"/>
                                                <a href="?module=product_detail&pkcat=<?= $_GET["i"] ?>&pro=<?= md5(HASH . $productos["results"][$a]["pk_producto"]) ?><?= $productos["results"][$a]["pk_producto"] ?>" class="overlay small">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <h3><?= $productos["results"][$a]["nombre" . $_SESSION["LOCALE"]] ?></h3>
                                            <div style="width:350px; height:100px; overflow:hidden;" class="text-center">
                                                <p><?= $productos["results"][$a]["sumario" . $_SESSION["LOCALE"]] ?></p>
                                            </div>
                                        </div>       
                                    </div> 
                                <?php } ?>

                                <?php if (isset($productos["results"][$a + 1])) { ?>
                                    <div class="col-sm-6 col-md-4 isotope-item" id="<?php echo $show_category;?>">
                                        <div class="box-style-1 white-bg">
                                            <div>
                                                <img src="/images/products/tb2_<?= $productos["results"][$a + 1]["pk_producto"] ?>.jpg"/>
                                                <a href="?module=product_detail&pkcat=<?= $_GET["i"] ?>&pro=<?= md5(HASH . $productos["results"][$a + 1]["pk_producto"]) ?><?= $productos["results"][$a + 1]["pk_producto"] ?>" class="overlay small">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            
                                                <h3><?= $productos["results"][$a + 1]["nombre" . $_SESSION["LOCALE"]] ?></h3>
                                                <div style="width:350px; height:100px; overflow:hidden;" class="text-center">
                                                <p><?= $productos["results"][$a + 1]["sumario" . $_SESSION["LOCALE"]] ?></p>
                                            </div>
                                        </div>       
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>   
                    <?php } ?>   
                <?php } ?>


            
        </div>
    </div>
    
</div>

</section>


