<?php
  /*Libreria de clases y funciones necesarias para el sistema*/
  require_once("../necessary/init.php");
  $items = $_GET["items"];// --> Se valida el get
  /*Se reemplaza para que se pueda leer correctamente*/
  $file_index = "files.index";
  $attributes = "@attributes";
  $url = "https://data.icecat.biz/export/freexml/ES_MX";// --> url para traer todos los items de icecat
  $icecat_items_id = _IcecatItems($url); // --> funcion para traer todos los id que estan en free
  /*Ciclo*/
  if(isset($items))
    $items = $items;
  else
    $items = 50;
  $items_new = $items-50;
  $cont = 0;
  for ($x = $items_new; $x <= $items; $x++) {
    if($icecat_items_id->$file_index->file[$x]){
      /*Accesos a icecat*/
      $user = "AlejandroFlores";
      $lang = "es";
      $app_key = "YX1TfjanaEZIWAgTzyL2S8S3Tz0oVj2p";
      $icecat_id = $icecat_items_id->$file_index->file[$x]->$attributes->Product_ID;// --> se parametriza el id de icecat
      echo "item_id: " . $icecat_id . "<br>"; //--> se imprime el valor de id como punto de control
      $icecat_item_id = _IcecatItem($user,$lang,$icecat_id,$app_key); //--> se manda a llamar la informacion de cada item por separado
      /*Se imprimen los valores de nombre y modelo como puntos de control*/
      echo "nombre: " . $icecat_item_id->data->GeneralInfo->Title . "<br>";
      echo "modelo: " . $icecat_item_id->data->GeneralInfo->BrandPartCode . "<br>";
      $icecat_sku = $icecat_item_id->data->GeneralInfo->IcecatId;//--> se parametriza el id
      $ItemsCount = _getIcecatItem($icecat_sku);//--> se el id para saber si se actualiza o se agrega dependiendo del resultado
      /*Se genera array para insertar valores en la base de datos*/
      $data2send = array(
          "IcecatId" => $icecat_sku,
          "ReleaseDate" => $icecat_item_id->data->GeneralInfo->ReleaseDate,
          "EndOfLifeDate" => $icecat_item_id->data->GeneralInfo->EndOfLifeDate,
          "Title" => $icecat_item_id->data->GeneralInfo->Title,
          "Brand" => $icecat_item_id->data->GeneralInfo->Brand,
          "BrandID" => $icecat_item_id->data->GeneralInfo->BrandID,
          "BrandInfo_BrandName" => $icecat_item_id->data->GeneralInfo->BrandInfo->BrandName,
          "BrandInfo_BrandLocalName" => $icecat_item_id->data->GeneralInfo->BrandInfo->BrandLocalName,
          "BrandInfo_BrandLogo" => $icecat_item_id->data->GeneralInfo->BrandInfo->BrandLogo,
          "ProductName" => $icecat_item_id->data->GeneralInfo->ProductName,
          "BrandPartCode" => $icecat_item_id->data->GeneralInfo->BrandPartCode,
          "Category_Name_Value" => $icecat_item_id->data->GeneralInfo->Category->Name->Value,
          "ProductFamily" => $icecat_item_id->data->GeneralInfo->ProductFamily->Value,
          "ProductSeries_SeriesID" => $icecat_item_id->data->GeneralInfo->ProductSeries->SeriesID,
          "ShortSummaryDescription" => $icecat_item_id->data->GeneralInfo->SummaryDescription->ShortSummaryDescription,
          "LongSummaryDescription" => $icecat_item_id->data->GeneralInfo->SummaryDescription->LongSummaryDescription,
          "Image_HighPic" => $icecat_item_id->data->Image->HighPic,
          "Gallery_Pic" => $icecat_item_id->data->Gallery[0]->Pic
          );
          /*Ciclo para saber si se actualiza o se agrega a la base de datos*/
          if($ItemsCount>=1){
              $where_order_upd = array("IcecatId" => $icecat_item_id->data->GeneralInfo->IcecatId);
              _updItem($data2send,$where_order_upd);
              $data2send = array("last_update" => date("Y-m-d G:i:s"));
              _updItem($data2send,$where_order_upd);
              echo "update --> " . date("Y-m-d G:i:s") . "<br />";
          }else{
              _addItem($data2send);
              echo "add --> "  . date("Y-m-d G:i:s") . "<br />";
          }
          echo "************************" . "<br>";
    }
    $cont+=1;
  }
  if ($cont < 50){
    echo "<div style='width:200px;height:100px;position:fixed;top:50%;left:50%;font-size:32;margin: -50px 0 0 -100px;border:5px solid #aaacolor:900;font-family:arial;text-align:center;padding-top:55px;'>Termine: $cont<br />Ultima vez ejecutado: $ndate</div>";
  } else {
    $new_items = $items +50;
    echo"-- Proceso Terminado --<br />";
    echo "***********************************************<br />"; // termina ciclo items
    die("<div style='width:200px;height:100px;position:fixed;top:50%;left:50%;font-size:32;margin: -50px 0 0 -100px;border:5px solid #aaacolor:900;font-family:arial;text-align:center;padding-top:55px;'>Termine: $cont <br />Ultima vez ejecutado: $ndate</div>
    <script>
    window.location.reload(true);
    window.location.replace(\"http://unikphp.azurewebsites.net/go/backend/_icecat_items_.php?items=$new_items\");
    </script>");
  }
  echo "-- TERMINE: " . $cont . " --" . $new_items;
?>
