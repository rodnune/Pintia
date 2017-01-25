/* Mostrar/ocultar los formularios de enviar mensaje privado o mensaje general */		
$(document).ready(function(){
	$("#verprivado").click(function(){
		$("#privado").fadeIn("slow");
		$("#sala").fadeOut("slow");
    });
    $("#ocultarprivado").click(function(){
		$("#privado").fadeOut("slow");
		$("#sala").fadeIn("slow");
    });
});