if($('#medida').val()==-1) {

    $( "#formularioNew" ).show();

}

/*
 *Funcion AJAX que trae la medida que queremos
 */
$( "#medida" ).change(function () {
    if($('#medida').val()==-1){
        $('#medidaUpdate').css('display','none');
        $('#formularioNew').show();

    }else{

        $('#formularioNew').css('display','none');
        $('#medidaUpdate').show();

        $(document).ready(function(){
            var sigla = $('#medida').val();
            $.ajax({
                type:   'GET',
                url:    '/medida/'+sigla,

                success: function(medida) {
                    medida = medida[0];
                    $('input[name="update_siglas"]').attr('value',medida.SiglasMedida);
                    $('input[name="update_denominacion"]').attr('value',medida.Denominacion);
                    $('input[name="update_unidades"]').attr('value',medida.Unidades);


                },
                error: function(data){
                    alert('Error');
                }
            });
        });


    }

});

