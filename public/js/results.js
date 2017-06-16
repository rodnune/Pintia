$(function() {
    $("#myInput").keyup(function () {

        var numOfVisibleRows = $('#pagination_table tr').filter(function () {
                return $(this).css('display') !== 'none';
            }).length - 1;


        var results = $("#total").find("strong");
        results.remove();
        $('#total').append("<strong>Total de resultados encontrados: " + numOfVisibleRows + "</strong>");
    });

});