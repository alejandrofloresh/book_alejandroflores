$(document).ready(function(){
  $("#clonar").click(function(){
    if (confirm('Estas por clonar y borrar el contenido de la Tabla Principal, deseas continuar?') == true) {
      $.post("../php/clonar.php",
      {
        tabla: document.getElementById("tables").value
      },
      function(data){
        alert(data);
      });
    }else {
      alert('Operacion cancelada');
    }
  });
});
