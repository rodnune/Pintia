/* Negrita, cursiva y subrayado */
function displayHtml(source, display) {
	/* Obtener texto del div en formato html */
	HTMLCode = document.getElementById(source).innerHTML;
	
	/* Añadir texto del div en formato html al textarea */
	document.getElementById(display).textContent = HTMLCode;
	return HTMLCode;
}


/* Negrita, cursiva y subrayado */

function formatText(el,tag) {
	var selectedText=document.selection?document.selection.createRange().text:el.value.substring(el.selectionStart,el.selectionEnd);// IE:Moz
	var newText='<'+tag+'>'+selectedText+'</'+tag+'>';
	// Do IE compatible replacements
	if(document.selection){
		document.selection.createRange().text=newText;
	}
	// Do mozilla compatible replacements
	else{
		el.value=el.value.substring(0,el.selectionStart)+newText+el.value.substring(el.selectionEnd,el.value.length);
	}
}

/* Salto de línea */

function newLine(myField, myValue) {
//IE support
if (document.selection) {
myField.focus();
sel = document.selection.createRange();
sel.text = myValue;
}
//MOZILLA/NETSCAPE support
else if (myField.selectionStart || myField.selectionStart == '0') {
var startPos = myField.selectionStart;
var endPos = myField.selectionEnd;
myField.value = myField.value.substring(0, startPos)
+ myValue
+ myField.value.substring(endPos, myField.value.length);
} else {
myField.value += myValue;
}
}