
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title></title>
  </head>
  <body>
    <?php
      $mysqli = new mysqli("localhost","root","","compnum");
      $mysqli->set_charset("utf8");
      $query = $mysqli -> query ("SELECT table_name as Tables_in_compnum,CASE WHEN table_name = 'm_tblprincipal' THEN 'Tabla Principal' ELSE 'Otras Tablas' 	END AS 'name' FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'compnum' AND table_type = 'BASE TABLE';");
      echo "<center>";
      echo "<select class='custom-select' id='tables' name='tables' style='width:350px'>";
      echo "<option value='0' disabled selected required>Seleccione una opción</option>";
      foreach($query as $consultas){
        $tablas = $consultas["Tables_in_compnum"];
        $names = $consultas["name"];
        echo "<option value='$tablas'>$names</option>";
      }
      echo "</select>";
      echo "</center>";
    ?>
  </body>
</html>
