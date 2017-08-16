$(document).ready(function(){
    $(function(){
        $('#burger').on('click', function() {
            $('#burger-menu').slideToggle(200);
        });
    });
    
    $(function(){
        $('.header-icon').on('click', function() {
            var visible = $(this).children('.dropdown-nibble').is(":visible");
            $('.dropdown-nibble').hide();
            if(!visible)
                $(this).children('.dropdown-nibble').show();
        });
    });
});