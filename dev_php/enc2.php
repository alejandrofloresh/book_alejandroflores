<form action="enc3.php" method="POST">
  <table border="0">
<?php
  $respuestas = $_POST["respuestas"];
  $titulo = $_POST["titulo"];
  for($i=1;$i<=$respuestas;$i++){
    echo "<tr><td>respuesta $i </td><td><input name= p$i type=text size=50 maxlength=50></td></tr>";
  }
  echo"<input type=hidden name=respuestas value=$respuestas>" .
      "</p><input name=titulo type=hidden value=$titulo>";
?>
</table>
<input type=submit name=Submit value=Enviar>
</form>
