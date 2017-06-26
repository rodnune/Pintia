


    $(document).ready(function(){
        var seccion = $('select').val();

        var ue =  $("input[name=ue]").val();

        var encoded_seccion = encodeURI(seccion);

        $.ajax({
            type:   'GET',
            url:     '/notas_ue_seccion/'+ue+'/'+encoded_seccion,

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

            var ue =  $("input[name=ue]").val();

            var encoded_seccion = encodeURI(seccion);

            $.ajax({
                type:   'GET',
                url:     '/notas_ue_seccion/'+ue+'/'+encoded_seccion,

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
