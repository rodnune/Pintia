function valorAnalisis(idSelect, idInput) {
    var tipo = document.getElementById(idSelect).value;
    if(tipo != 0){
	    document.getElementById(idInput).style.display = 'none';
    }else{
	    document.getElementById(idInput).style.display = 'block';
    }
}
