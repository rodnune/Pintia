var valor =  $("#ajuar_select option:selected").val();

if (valor == "No") {
    $('#ajuar').css('display','none');
    $('#ajuar2').css('display', 'none');

} else {
    $('#ajuar').show();
    $('#ajuar2').show();
}

$('#ajuar_select').change(function() {

    var valor = $("#ajuar_select option:selected").val();

    if (valor == "No") {
        $('#ajuar').css('display','none');
        $('#ajuar2').css('display', 'none');

    } else {
        $('#ajuar').show();
        $('#ajuar2').show();
    }

});