$(document).on('ready',function(){
    $('#tablas').click(function(){
        var url = '../php/consultas_tablas.php';
        $.ajax({
           type: "POST",
           url: url,
           data: $("#consulta").serialize(),
           success: function(data)
           {
             $('#tablas_consulta').html(data);
           }
       });
    });
});
