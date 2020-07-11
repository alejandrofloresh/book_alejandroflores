<?php

//Conectamos con la base de datos
$host = "servantsaber.mysql.database.azure.com";
$usuario = "admin01@servantsaber.com";
$password = "CORONAVIRUS@2020";
$db = "atonsolution";
$conn = new mysqli($host, $usuario, $password,$db);


$titulo = $_POST['titulo'];
$respuestas = $_POST['respuestas'];

//Obtenemos la fecha del sistema
$fecha = date("Y-m-d G:i:s");

//Insertamos la nueva encuesta
$sql_insert = "INSERT INTO encuestas(titulo, fecha) VALUES ('$titulo', '$fecha') ";
$sql_1 = $conn->query($sql_insert);
echo "se inserto en la primera tabla que es encuestas". "<br>";

//Ahora obtenemos el ID de la encuesta que acabamos de insertar
$sql_query = "SELECT id FROM encuestas ORDER BY fecha DESC LIMIT 0,1";
$sql_2 = $conn->query($sql_query);
echo "se consulto en la primera tabla que es encuestas" . "<br>";
while($row = mysqli_fetch_array($sql_2)){
	$id=$row["id"];
}

//Recorremos todas las preguntas
for($i=1; $i<=$respuestas; $i++){

//Obtenemos el texto de la pregunta
	$preg = p.$i;
	$texto = $preg;

//Y lo insertamos
	$sql_insert2 = "INSERT INTO respuestas(texto, votos, idenc) VALUES('$texto', '$i', $id)";
	$sql_3 = $conn->query($sql_insert2);
	}
  echo "se inserto en la primera tabla que es respuestas". "<br>";
 ?>
<div align="center"><strong>Felicidades!! Si todo ha ido bien, tu encuesta ha
  sido insertada!! </strong> </div>
