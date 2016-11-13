(function ($) {
    // Initialize
    $(document).one("ready", function () {
        // Toggle menu
        $(document).on('click', '.page-nav-menu .toggle_menu', function () {
            $(this).closest('.page-nav-menu').toggleClass('highlight');
            $('.navMenu.toggle').slideToggle(200);
        });
    });
})(jQuery);