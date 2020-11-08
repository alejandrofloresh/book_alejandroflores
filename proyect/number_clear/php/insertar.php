<?php
$mysqli = new mysqli("localhost","root","","compnum");
$mysqli->set_charset("utf8");
date_default_timezone_set('America/Mexico_City');
$now = date('ymdHis');
$ahora = date('y-m-d H:i:s');
require('SimpleXLS.php');
$fichero = $_FILES["file-upload"];
if(file_exists('archivos/'.$fichero['name']) == 1){
  unlink('archivos/'.$fichero['name']);
  if ($fichero['name']) {
     $ruta_destino_archivo = "archivos/".$fichero['name'];
     $archivo_ok = move_uploaded_file($fichero['tmp_name'], $ruta_destino_archivo);
  }
}else {
  if ($fichero['name']) {
     $ruta_destino_archivo = "archivos/".$fichero['name'];
     $archivo_ok = move_uploaded_file($fichero['tmp_name'], $ruta_destino_archivo);
  }
}
if ( $xls = SimpleXLS::parse('archivos/tmp_archivo_numeros.xls') ) {
    $lineas = $xls->rows();
    $lineas_num = count($lineas);
    for ($x = 1; $x < $lineas_num; $x++) {
      list($valor0, $valor1,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9) = $lineas[$x];
       $insertar_tabla_principal = $mysqli -> query ("INSERT INTO m_tblprincipal(nombre, paterno, materno, telefono, domicilio, cp, colonia, ciudad, estado, nivel, date_add) VALUES ('$valor0', '$valor1', '$valor2', '$valor3', '$valor4', '$valor5', '$valor6', '$valor7', '$valor8', '$valor9','$ahora');");
    }
    if($insertar_tabla_principal == 1){
      echo "Los datos fueron insertados correctamente";
    }else {
      echo "Error al insertar los datos, por favor verificar su archivo y volver a intentar";
    }
} else {
    echo SimpleXLS::parseError();
}
header("Location: ../html/clear.html");
?>
