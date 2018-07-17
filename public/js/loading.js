jQuery( window ).load(function() {
    loadingPageOff();
    //loadingAjaxSetup
  });

function loadingAjaxSetup(){
    var body = jQuery("body");

    jQuery.ajaxSetup({
        'beforeSend': function () {
            body.addClass("loading-ajax");
        },
        'complete': function () {
            body.removeClass("loading-ajax");
        },
        'global': true
    });
}



function loadingPageOff(){
    jQuery(".loading-page").fadeOut("slow");
}