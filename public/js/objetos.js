$( document ).ready(function() {
    if ($("input[name*='es_tumba']").val() == 'Si') {
        $('#tumba').hide();
        $('#select_tumba').hide();
    }else{
        $('#tumba').show();
        $('#select_tumba').show();
    }

});


$("input[name*='es_tumba']").click(function () {

    if($(this).val() == 'No'){
        $('#tumba').hide();
        $('#select_tumba').hide();
    }else{
        $('#tumba').show();
        $('#select_tumba').show();
    }

});
