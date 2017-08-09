$(document).ready(function(){
    $(function(){
        var bgimage = new Image();      
        bgimage.src="../img/background.jpg";       
        $(bgimage).on('load', function(){
            $("#bg-image").css("background-image","url("+$(this).attr("src")+")").addClass('bg-image-loaded');
        });
    });
});