var blackoutDates= [];


jQuery(window).load(function(){
    jQuery('#date-present-alert').hide();
    jQuery('#date-range-alert').hide();
    jQuery('#range-dates').hide();
    
    //Single date datepicker
    jQuery('#blackout-dates-single').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true,
          todayBtn: "linked",
          todayHighlight: true
        });
    jQuery('#blackout-dates-single').datepicker('setDate', 'today');

    //Start range datepicker
    jQuery('#blackout-date-range-start').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true
        });
    jQuery('#blackout-date-range-start').datepicker('setDate', 'today');
    jQuery('#blackout-date-range-start').on('change', function(){
        //jQuery('#blackout-date-range-end').datepicker('setStartDate', jQuery('#blackout-date-range-start').val());
    }); 

    //End range datepicker
    jQuery('#blackout-date-range-end').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true
        });
    jQuery('#blackout-date-range-end').datepicker('setDate', '+1d'); 
    
    //only show forms relevant to the datepicker (single or range)
    jQuery('input[type=radio][name=dateradio]').on('change', function(){
        switch(jQuery(this).val()){
            case 'single-date-radio':
                jQuery('#range-dates').hide();
                jQuery('#single-date').show();
                break;
            case 'date-range-radio':
                jQuery('#single-date').hide();
                jQuery('#range-dates').show();
                break;
        }
    });

    //add click event listener to single date add button
    jQuery('#add-date-button').on('click', function(e){
        //for some reason without preventing default behavior
        //clicking button redirects to homepage
        e.preventDefault();
        addNewDisabledDate(jQuery('#blackout-dates-single').val(), jQuery('#single-date-reason').val(), blackoutDates);
    });

    //add click event listener to date-range add button
    jQuery('#add-date-range-button').on('click', function(e){
        e.preventDefault();
        addDateRange(blackoutDates);
    });

    //add click event listener to submit button
    jQuery('#submit').on('click', function(e){
        e.preventDefault();
      /*  jQuery.ajax({
            type: "GET",
            url: "submit_blackout_dates.php",
            dataType: "html",
            success: function(response){
                console.log(response);
            }
        });//end of ajax */
    })
});


function addNewDisabledDate(date, reason, dateArray) {
    var presentFlag = 0;
    jQuery('#new-date-table tr td.date-to-be-disabled').each(function () {

        //check if date is already in table
        if(date === jQuery(this).text()){
            //show warning if it is
            jQuery("#date-present-alert").fadeTo(2000, 500).slideUp(500, function(){
                jQuery("#date-present-alert").slideUp(500);
                 });   
                  
            presentFlag = 1;
        }
    });
        //if date is not present, add the new date to the date array and as a row to the table
        if(presentFlag === 0){
            var newBlackoutDate = createBlackoutDate(date, reason);
            dateArray.push(newBlackoutDate);
            jQuery('#new-date-table tr:last').after('<tr><td class="date-to-be-disabled">' +
                                                date + '</td>' +
                                                '<td class="reason-to-be-disabled">' + reason + '</td>' +
                                                '<td class="text-center text-nowrap">' + 
                                                '<button class="btn btn-xs btn-default">' +
                                                '<span class="glyphicon glyphicon-trash"></span>' +
                                                '</button></td></tr>');
            jQuery('#new-date-table tr:last button').on('click', function(){
                jQuery(this).closest('tr').remove();
                dateArray.pop(newBlackoutDate);
            });
        }
}       

function getCheckedValues(){
    return jQuery('input[name="weekday-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}


function addDateRange(dateArray){
    var startDate = jQuery('#blackout-date-range-start').datepicker('getDate');
    var endDate = jQuery('#blackout-date-range-end').datepicker('getDate');

    //check if end date is after startdate
    if(startDate > endDate){
        jQuery("#date-range-alert").fadeTo(2000, 500).slideUp(500, function(){
            jQuery("#date-range-alert").slideUp(500);
            });  
        return;
        }
    
    //add the dates
    var currentDate = new Date(startDate.getTime());
    while(currentDate <= endDate){
        addNewDisabledDate(currentDate.toISOString().split('T')[0], jQuery('#date-range-reason').val(), dateArray);
        currentDate.setDate(currentDate.getDate() + 1);
    }
    
}

function createBlackoutDate(date, reason){
    blackoutDate = {
        date: date,
        reason: reason
    };
    return blackoutDate;
};

//SELECT date, reason FROM SAPO_DATES WHERE USER_ID = current_user ORDER BY date ASCENDING;
//SELECT * FROM SAPO_DAYS WHERE USER_ID = current_user;

//popup-for whether mysql was successful after submit clicked