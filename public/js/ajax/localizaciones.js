
$( "#selec_zona" ).change(function () {



    $(document).ready(function(){
        var siglazona = $('#selec_zona').val();
        $.ajax({
            type:   'GET',
            url:    '/localizaciones/'+siglazona,

            success: function(locations) {
                if (!$('.text-center.text-muted').is(':empty')) {
                    $('.text-center.text-muted').children().remove();
                }
                $('#pagination_table tr').remove();
                localizaciones(locations);


            },
            error: function(data){
                alert('Error en la conexion');
            }
        });
    });

});


function localizaciones(locations) {

    var info ="<tr class='info'>"

        + "<th scope='col' align='center'<strong>Sigla Zona</strong></th>"
        + "<th scope='col' align='center'<strong>Sector Trama</strong></th>"
        + "<th scope='col' align='center'<strong>Sector Subtrama</strong></th>"
        + "<th scope='col' align='center'></th>"
        + "</tr>";

    $('#pagination_table thead').append(info);

    locations.map(function(location){







        var loc = "<tr>"

            + "<td>" + location.SiglaZona + "</td>"
            + "<td>" + location.SectorTrama + "</td>"
            + "<td>" + location.SectorSubtrama + "</td>"
            +"<td align='center'>  <a href='/localizacion/"+location.IdLocalizacion+"' class='btn btn-primary' value='Ver'><i class='fa fa-eye'></i> Ver</a>" +
            "</td> </tr>";

        $('#pagination_table tbody').append(loc);









    });
    var resultados = ($('#pagination_table tr').length) - 1;

    $('.text-center.text-muted').append( "<strong>Total de resultados encontrados: "+ resultados +"</strong>");
}
