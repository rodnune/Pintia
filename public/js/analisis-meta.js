function valorAnalisis(idSelect, idInput) {
    var tipo = $('#'+idSelect).val();
    if(tipo != 0){
	    $('#'+idInput).hide();
    }else{
        $('#'+idInput).css("display","block");
    }
}
