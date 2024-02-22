$(document).ready(function() {
    $(".menu a").click(function() {
        if ($(this).siblings(".submenu").length) {
            $(this).siblings(".submenu").slideToggle();
            return false;
        }
    });
});