<?php

  /*

  Este scrapp se conecta directo a la pagina de priceshoes y saca imagenes / disponibilidad / titulos / precio / descripcion

  */

  $url = $_GET["url"];// -->  se hace un get por url ya que todos los campos estan parametrizados

  $html = file_get_contents($url); // --> se descompone la url y su contenido
  /*DATOS DEL PRODUCTO*/

  /*NOMBRE*/
  if ( preg_match('|<span class="base" data-ui-id="page-title-wrapper" itemprop="name">(.*?)</span>|is' , $html , $cap ) )
  {
    echo $cap[1] . "<br>";
  }
  /*Descripcion*/
  if ( preg_match('|<table class="data table additional-attributes" id="product-attribute-specs-table">(.*?)</table>|is' , $html , $cap ) )
  {
    echo $cap[1] . "<br>";
  }
  /*Estatus*/
  if ( preg_match('|<div class="product-info-stock-sku">\s+<div class="stock available" title="Disponibilidad">\s+<span>(.*?)</span>|is' , $html , $cap ) )
  {
    echo $cap[1] . "<br>";
  }
  /*Sku*/
  if ( preg_match('|<strong class="type">SKU</strong>    <div class="value" itemprop="sku">(.*?)</div>|is' , $html , $cap ) )
  {
    echo $cap[1] . "<br>";
  }
  /*PVP*/
  if ( preg_match('|<span class="price">(.*?)</span>|is' , $html , $cap ) )
  {
    echo $cap[1] . "<br>";
  }
  /*IMG*/
  if ( preg_match('|<div class="swatch-opt" data-role="swatch-options"></div>\s+<script>(.*?)</script>|is' , $html , $cap ) )
  {
    echo $cap[1] . "<br>";
  }
  /*IMG Tallas*/
  if ( preg_match('|<div style="display:none" class="sizeguideContent">\s+<img src="(.*?)"/>\s+</div>|is' , $html , $cap ) )
  {
    echo $cap[1] . "<br>";
  }
?>
