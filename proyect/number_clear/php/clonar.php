<?php

$mysqli = new mysqli("localhost","root","","compnum");
$mysqli->set_charset("utf8");
date_default_timezone_set('America/Mexico_City');
$now = date('ymdHis');

$tabla = $_POST['tabla'];

$created = $tabla."_".$now;

$clonar = $mysqli -> query ("CREATE TABLE $created SELECT * FROM $tabla;");

if ($clonar == 1) {
  //echo "La tabla se copio de forma exitosa\n";
  $truncar = $mysqli -> query ("TRUNCATE TABLE $tabla;");
  if($truncar == 1){
    echo "La tabla se copio y reinicio correctamente\n";
  }else {
    echo "La tabla no se logro borrar completamente\n";
  }
}else {
  echo "Error a la hora de copiar, pr favor revisar con area de sistemas\n";
}

?>
