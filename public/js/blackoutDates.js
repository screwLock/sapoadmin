jQuery(window).load(function(){
    jQuery('#blackoutDates').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true,
          todayBtn: "linked",
          todayHighlight: true
        });
    jQuery('#blackoutDates').datepicker('setDate', 'today');
    jQuery('#blackoutDates').on( 'changeDate', function(dateText) {
        //jQuery('#new-blackout-dates').append(dateText);
    });


    });
