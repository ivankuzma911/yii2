$(document).on('pjax:success', function() {
    var elements = document.getElementsByName("selection[]");
    for(var i=0;i<elements.length;i++){
        var result = runner.isSetCookieValue(elements[i].value);
        if(result != false){
            elements[i].checked = true;
        }
    }
   runner.run();
});
