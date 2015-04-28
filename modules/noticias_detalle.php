<?php
$rs = $Shop->getNoticia(array("pk_noticia"=>$_GET["i"]));
$value = $rs["results"][0];
?>
<table width="980" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th valign="top" scope="col"><?= $Banners->showBanners(5);?></th>
              </tr>
          </table>
          
            <table width="990" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 8px;">

            <tr>
              <th colspan="7" background="images/new/titulo.jpg" style="text-align: left" scope="col">
              <span class="titulo1">
              <span class="Mapa">&nbsp;&nbsp;
              <?php
              $arr = array('',_("Noticias"),_("Autorizaciones"),_("Providencias y Resoluciones"));
              echo $arr[$_GET["t"]];
              ?>
              </span>
              </span>
              </th>
              <td><img src="images/new/spacer.gif" width="1" height="35" border="0" alt="" />
            </tr>            
            
        </table>
        
            <br />
            <table width="980" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="720" valign="top" scope="col"><table width="585" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <th align="left" valign="top" scope="col"><span class="noticias_detalletitulo"><?=$value["titulo" . $_SESSION["LOCALE"]]?><br />
                      </span><br />
                      <div class="noticias_titulo" style="text-align:justify !important"><?=$value["sumario" . $_SESSION["LOCALE"]]?></div><br /></th>
                  </tr>
                </table>
                  <br />
                  <br /> <?php if(is_file(SERVER_ROOT . "images/noticias/" . $value["pk_noticia"] . ".jpg")){ ?>
                  <table width="585" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <th scope="col"><table width="350" border="0" align="center" cellpadding="15" class="fotoborder">
                        <tr>
                          <th bgcolor="#efefef" scope="col">
                         
                          <img src="images/noticias/<?=$value["pk_noticia"]?>.jpg" width="322" height="200" />
                         
                          </th>
                        </tr>
                      </table></th>
                    </tr>
                  </table>
                  <br />
                  <br /> <?php } ?>
                  <table width="585" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <th scope="col" class="texto_general" align="left"><p style="text-align:justify !important" ><?=$value["texto" . $_SESSION["LOCALE"]]?></p></th>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table width="585" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <th align="left" scope="col">
                      <?php
                      if(is_file(SERVER_ROOT . "images/noticias/" . $value["pk_noticia"] . ".pdf")){
					  ?>
                      <a href="?dw=<?=$Shop->encode($value["pk_noticia"])?>" target="_blank" style="text-decoration:none; font-size:14px;" class="aoverunderline"><img src="../images/document-pdf-icon.png" alt="Descargar PDF" width="48" height="48" border="0" align="absmiddle" /> <?=_("Descargar Archivo PDF")?></a>
                      <?php
					  }
					  ?>
                      </th>
                    </tr>
                    <tr>
                      <td align="left"><br />
                      <div class="leertodasdiv"><a href="JavaScript:history.back()" class="leertodas"> &laquo; <?=_("Volver a noticias")?> </a></div>

                      </td>
                    </tr>
                  </table>
                <p></p></th>
                <th width="260" align="center" valign="top" scope="col"><?php require("inc_right.php") ?></th>
              </tr>
              <tr>
                <th scope="col">&nbsp;</th>
                <th align="center" valign="top" scope="col">&nbsp;</th>
              </tr>
          </table>