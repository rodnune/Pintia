if($('#zona').val()==-1) {

    $( "#nuevaZona" ).show();

}

/*
 *Funcion AJAX que trae la medida que queremos
 */
$( "#zona" ).change(function () {
    if($('#zona').val()==-1){
        $('#zonaUpdate').css('display','none');
        $('#nuevaZona').show();

    }else{

        $('#nuevaZona').css('display','none');
        $('#zonaUpdate').show();

        $(document).ready(function(){
            var sigla = $('#zona').val();
            $.ajax({
                type:   'GET',
                url:    '/lugar/'+sigla,

                success: function(lugar) {
                    lugar = lugar[0];

                    $('#siglazona').val(lugar.SiglaZona);
                    $('#municipio').val(lugar.Municipio);
                    $('#toponimo').val(lugar.Toponimo);
                    $('#parcela').val(lugar.Parcela);


                },
                error: function(data){
                    alert('Error en la conexion');
                }
            });
        });


    }

});





