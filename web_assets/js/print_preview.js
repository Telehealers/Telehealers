function printContent(el){
    'use strict';
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}

$(document).ready(function(){
    'use strict';

    $('#others').hide();
    $('#pad_p').hide();

    $("#pad").on('click',function(){
        $('#div1').hide();
        $('#dif_p').hide();
        $('#others').show();
        $('#pad_p').show();
    });

    $("#dif").on('click',function(){
        $('#div1').show();
        $('#dif_p').show();
        $('#others').hide();
        $('#pad_p').hide();
    });
})