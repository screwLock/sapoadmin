jQuery(document).ready(function () {
    //$("#sidebar").mCustomScrollbar({
    //    theme: "minimal"
    //});
    jQuery('#activate-sidebar').on('click', function() {
        jQuery('#sapo-sidebar').toggleClass('active');
    });
    jQuery('#dismiss').on('click', function () {
        // hide sidebar
        jQuery('#sapo-sidebar').removeClass('active');
        // hide overlay
        //$('.overlay').removeClass('active');
    });
/*
    $('#sidebarCollapse').on('click', function () {
        // open sidebar
        $('#sidebar').addClass('active');
        // fade in the overlay
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
*/
});