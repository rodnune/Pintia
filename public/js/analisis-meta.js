function valorAnalisis(idSelect, idInput) {
    var tipo = $('#'+idSelect).val();
    if(tipo != 0){
	    $('#'+idInput).style.display = 'none';
    }else{
        $('#'+idInput).style.display = 'block';
    }
}
