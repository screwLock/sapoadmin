var blackoutDates= [];


jQuery(window).load(function(){
    jQuery('#date-present-alert').hide();
    jQuery('#date-range-alert').hide();
    jQuery('#range-dates').hide();

    //Single date datepicker
    jQuery('#blackout-dates-single').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true
        });
    jQuery('#blackout-dates-single').datepicker('setDate', 'today');

    //Create the datepicker range effect
    jQuery('.input-daterange').datepicker();
    
    //Start range datepicker
    jQuery('#blackout-date-range-start').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true
        });
    jQuery('#blackout-date-range-start').datepicker('setDate', 'today');

    //End range datepicker
    jQuery('#blackout-date-range-end').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true
        });
    jQuery('#blackout-date-range-end').datepicker('setDate', '+1d'); 

    jQuery('#max-time').timepicker(
        {
            useSelect: true,
            minTime: '08:00:00', 
            startTime: '08:00:00',
            step: 15
        });
    
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

    jQuery('input[type=radio][name=max-time-radio]').on('change', function(){
        return;
 
    });
        
   

    //add click event listener to single date add button
    jQuery('#add-date-button').on('click', function(e){
        //for some reason without preventing default behavior
        //clicking button redirects to homepage
        e.preventDefault();
        addSingleDate(jQuery('#blackout-dates-single').val(), jQuery('#single-date-reason').val(), blackoutDates);
    });

    //add click event listener to date-range add button
    jQuery('#add-date-range-button').on('click', function(e){
        e.preventDefault();
        addDateRange(jQuery('#blackout-date-range-start').datepicker('getDate'), jQuery('#blackout-date-range-end').datepicker('getDate'), 
            jQuery('#date-range-reason').val(), blackoutDates);
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
    
    //check if date is already in array
    dateArray.forEach(function(oldDate){
        if(oldDate.date===date){
            //show warning if it is
            presentFlag++;
            jQuery("#date-present-alert").fadeTo(2000, 500).slideUp(500, function(){
                jQuery("#date-present-alert").slideUp(500);
            
            });   
        };
    });
    
    if(presentFlag > 0) return false;
    //if date is not present, add the new date to the date array and as a row to the table
    var newBlackoutDate = createBlackoutDate(date, reason);
    dateArray.push(newBlackoutDate);

    return true;
}       

function getCheckedValues(){
    return jQuery('input[name="weekday-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

function addSingleDateCard(addedDate, reason){
    var newDateCard = '<div class="card">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + reason + '</h5>' +
                        '<div class="row">' +
                        '<div class="col-4">' +
                        addedDate +
                        '<button class="btn btn-primary">Delete</button>' +
                        '</div></div></div></div></div>';
    return newDateCard;
}

function addRangeDateCard(startDate, endDate, reason){
    var newDateCard = '<div class="card">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + reason + '</h5>' +
                        '<div class="row">' +
                        '<div class="col-4">' +
                        startDate + '-' + endDate +
                        '<button class="btn btn-primary">Delete</button>' +
                        '</div></div></div></div></div>';
    //jQuery()
    return newDateCard;
}

function addDateRange(start, end, reason, dateArray){
    var startDate = start;
    var endDate = end;
    var currentDate = new Date(startDate.getTime());
    var isNewDate = false;

    //add the dates
    while(currentDate <= endDate){
        isNewDate = addNewDisabledDate(currentDate.toISOString().split('T')[0], reason, dateArray);
        //if the date is already been added, return false and DO NOT RENDER A NEW CARD
        if(!isNewDate) return false;

        currentDate.setDate(currentDate.getDate() + 1);
    }

    //if the date is not present, render a new card
    if(isNewDate)jQuery('#new-date-cards').after(start, end, reason);
    return true;
}

function addSingleDate(date, reason, dateArray){
    var isNewDate = false;
    isNewDate = addNewDisabledDate(date, reason, dateArray);
    //if the date is already present, return false
    if(!isNewDate) return false;

    //if the date is not present, render a new card
    jQuery('#new-date-cards').after(addSingleDateCard(date, reason));
    return true;
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