var elementBurgerMenu = document.getElementById("burger-menu");
$(document).ready(function(){
    $(function(){
        $('#burger').on('click', function() {
            $('#burger-menu').slideToggle(200);
        });
    });
});