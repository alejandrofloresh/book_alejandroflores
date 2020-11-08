<?php
  $mysqli = new mysqli("localhost","root","","compnum");
  $mysqli->set_charset("utf8");
  $query = $mysqli -> query ("SELECT a.ciudad,a.telefono,a.clave,(case when b.nir is null then 'false' else 'true' end) as nir FROM v_primerejemplo AS a LEFT JOIN v_segundoejemplo AS b ON a.clave = b.nir ORDER BY 4 desc");
?>
<html>
<head>
  <meta charset="utf8">
  <title>Reportes</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['table']});
    google.charts.setOnLoadCallback(drawTable);
    function drawTable() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Ciudad');
      data.addColumn('string', 'Teléfono');
      data.addColumn('string', 'Clave');
      data.addColumn('boolean', 'Válido');
      data.addRows([
    <?php
      foreach($query as $numeros){
        $ciudad = $numeros["ciudad"];
        $telefono = $numeros["telefono"];
        $clave = $numeros["clave"];
        $valido = $numeros["nir"];

        echo "['".$ciudad."', '".$telefono ."', '".$clave ."'," .$valido .",],";
      }
    ?>
]);
  var table = new google.visualization.Table(document.getElementById("tabla_numeros"));
  table.draw(data, {showRowNumber: false, width: '80%', height: '30%'});
}
</script>
</head>
<body>
  <center>
    <div id="tabla_numeros"></div>
  </center>
</body>
</html>
