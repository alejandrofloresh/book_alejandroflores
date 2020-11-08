$(document).on('ready',function(){
    $('#visualizador').click(function(){
        var url = '../php/tabla.php';
        $.ajax({
           type: "POST",
           url: url,
           data: $("#consulta").serialize(),
           success: function(data)
           {
             $('#tabla').html(data);
           }
       });
    });
});
