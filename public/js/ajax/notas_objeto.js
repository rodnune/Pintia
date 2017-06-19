$(document).ready(function(){


   var seccion_ini =  $('select').val();

  var ref =  $("input[name=ref]").val();
    var encoded_seccion = encodeURI(seccion_ini);

    $.ajax({
        type:   'GET',
        url:     '/notas_objeto_seccion/'+ref+'/'+encoded_seccion,

        success: function(data) {

            $('textarea').text('');
            content(data);




        },
        error: function(data){
            alert('Error en la conexion');
        }
    });

});

$( 'select' ).change(function () {



    $(document).ready(function(){
        var seccion = $('select').val();

        var ref =  $("input[name=ref]").val();

        var encoded_seccion = encodeURI(seccion);

        $.ajax({
            type:   'GET',
            url:     '/notas_objeto_seccion/'+ref+'/'+encoded_seccion,

            success: function(data) {

                $('textarea').text('');
                content(data);




            },
            error: function(data){
                alert('Error en la conexion');
            }
        });
    });

});

function content(data){

    data =  JSON.parse(data);
    $('textarea').append(data.Contenido);

}

