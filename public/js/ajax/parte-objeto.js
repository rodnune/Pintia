var cat = $("#mySelect option:selected").val();


$.ajax({
    type: 'GET',
    url: '/subcategorias/' + cat,

    success: function (subcategorias) {
        $('#subcategorias').find("option").remove();
        render(subcategorias);
    }

});



$( "#mySelect" ).change(function () {
    var category = $("#mySelect option:selected").val();


    $.ajax({
        type: 'GET',
        url: '/subcategorias/' + category,

        success: function (subcategorias) {
            $('#subcategorias').find("option").remove();
            render(subcategorias);
        }

    });

});

function render(subcategorias) {

  

    if(subcategorias.length == 0){
        $('#subcategorias').append($('<option>', {
            value: 0,
            text: 'La categoria no tiene subcategorias'
        }));
    }

    subcategorias.map(function (subcat) {
        $('#subcategorias').append($('<option>', {
            value: subcat.IdSubcat,
            text: subcat.Denominacion
        }));


    });

}






