/* Negrita, cursiva y subrayado */


function displayHtml(source, display) {
    /* Obtener texto del div en formato html */
    HTMLCode = $('#'+source).html();
    /* Añadir texto del div en formato html al textarea */

    return $('#'+display).text(HTMLCode);
}



$(function(){
    $('.form-control.fake-textarea').each(function() {

        var html =  $(this).text();
        $(this).empty();
        var text = $.parseHTML(html);

        $(this).append(text);


    });

});

$(function(){
    $('.form-control.fake-textarea-lg').each(function() {

        var html =  $(this).text();
        $(this).empty();
        var text = $.parseHTML(html);

        $(this).append(text);


    });
});

