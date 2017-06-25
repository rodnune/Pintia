

$(function(){
    $('select option').each(function() {

        var html =  $(this).text();

        $(this).empty();

        var text = $.parseHTML(html);

        $(this).append(text);




    });
});