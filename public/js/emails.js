
jQuery(window).on('load', function(){
    highlightMenu();
})


/**
 * Highlights the active anchor link on the 
 * sidebar
 */
function highlightMenu() {
    // this will get the full URL at the address bar
    var url = window.location.href;

    // passes on every "a" tag
    jQuery(".sidenav a").each(function() {
        // checks if its the same on the address bar

        if (url == (this.href)) {
            jQuery(this).closest("a").addClass("active");
            //for making parent of submenu active
           jQuery(this).closest("a").parent().parent().addClass("active");
        }
    });
};    