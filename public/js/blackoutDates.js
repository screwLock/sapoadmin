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
    
    //Initialize the max-time datepicker
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
                jQuery('#range-dates').fadeOut('fast', function(){
                    jQuery('#single-date').fadeIn('fast');
                });
                break;
            case 'date-range-radio':
                jQuery('#single-date').fadeOut('fast', function(){
                    jQuery('#range-dates').fadeIn('fast');
                });
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
        addSingleDate(jQuery('#blackout-dates-single').datepicker('getDate'), jQuery('#single-date-reason').val(), blackoutDates);
    });

    //add click event listener to date-range add button
    jQuery('#add-date-range-button').on('click', function(e){
        e.preventDefault();
        addDateRange(jQuery('#blackout-date-range-start').datepicker('getDate'), jQuery('#blackout-date-range-end').datepicker('getDate'), 
            jQuery('#date-range-reason').val(), blackoutDates);
    });

    //add event listener to the max time save button
    jQuery('#change-max-time').on('click', function(e){
        e.preventDefault();
    });

    jQuery('#add-date-button').popover({
        content: "Date is already present",
        title: "ERROR",
        trigger: "manual"
    });

    jQuery('#add-date-range-button').popover({
        content: "Date is already present",
        title: "ERROR",
        trigger: "manual"
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


function getCheckedValues(){
    return jQuery('input[name="weekday-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

function addNewDisabledDate(date, reason, dateID, dateArray) {

    var newBlackoutDate = createBlackoutDate(date, reason, dateID);
    dateArray.push(newBlackoutDate);

    return true;
}       

function addSingleDateEntry(addedDate, reason, dateID){
    var formattedDate = addedDate.toLocaleDateString('en-US', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });

    var buttonID = '#' + dateID;
    var newDateCard =   '<tr>' +
                        '<td>' + reason + '</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td>' +
                        '<button class="btn btn-primary btn-sm" id = "' + dateID + '">Delete</button></td>'
                        '</tr>';
    
    jQuery("#new-date-cards").on("click", buttonID, function(){
        var target = jQuery(this).closest("tr");
        target.fadeOut(500, function(){jQuery(this).remove()});
        blackoutDates = deleteBlackoutDates(dateID, blackoutDates);
    });                        
    return newDateCard;
}

function addRangeDateEntry(startDate, endDate, reason, dateID){
    var formattedStartDate = startDate.toLocaleDateString('en-US', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });
    var formattedEndDate = endDate.toLocaleDateString('en-US', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });

    var buttonID = '#' + dateID;
    var newDateCard =   '<tr>' +
                        '<td>' + reason + '</td>' +
                        '<td>' + formattedStartDate + ' - ' + formattedEndDate + '</td>' +
                        '<td>' +
                        '<button class="btn btn-primary btn-sm" id = "' + dateID + '">Delete</button></td>' +
                        '</tr>';

    jQuery("#new-date-cards").on("click", buttonID, function(event){
        var target = jQuery(this).closest("tr");
        target.fadeOut(500, function(){jQuery(this).remove()});
        blackoutDates = deleteBlackoutDates(dateID, blackoutDates);
    });

    return newDateCard;
}

function addDateRange(start, end, reason, dateArray){
    var startDate = start;
    var endDate = end;
    var currentDate = new Date(startDate.getTime());

    if(!areDatesPresent(startDate, endDate, dateArray)){

        while(currentDate <= endDate){
            addNewDisabledDate(currentDate.toISOString().split('T')[0], reason, start.toISOString().split('T')[0], dateArray);
            currentDate.setDate(currentDate.getDate() + 1);
        }
        jQuery('#new-date-cards').append(addRangeDateEntry(start, end, reason, start.toISOString().split('T')[0])).hide().show('slow');

    }
}

function addSingleDate(date, reason, dateArray){

    if(!areDatesPresent(date, date, dateArray)){
        addNewDisabledDate(date.toISOString().split('T')[0], reason, date.toISOString().split('T')[0], dateArray);
        jQuery('#new-date-cards').append(addSingleDateEntry(date, reason, date.toISOString().split('T')[0])).hide().show('slow');
    }
}

function createBlackoutDate(date, reason, id){
    blackoutDate = {
        date: date,
        reason: reason,
        id: id
    };
    return blackoutDate;
};

function deleteBlackoutDates(dateID, dateArray){
    return dateArray.filter(function(date){
            return date.id !== dateID;
        });
}

//SELECT date, reason FROM SAPO_DATES WHERE USER_ID = current_user ORDER BY date ASCENDING;
//SELECT * FROM SAPO_DAYS WHERE USER_ID = current_user;

//popup-for whether mysql was successful after submit clicked


function areDatesPresent(start, end, dateArray){
    var currentDate = new Date(start.getTime());
    var isDatePresent = false;
    while(currentDate <= end){

        dateArray.forEach(function(oldDate){
            if(oldDate.date === currentDate.toISOString().split('T')[0]){
                jQuery('#add-date-button').popover('show');
                jQuery('#add-date-range-button').popover('show');
                setTimeout(function(){ 
                    jQuery('#add-date-button').popover('hide');
                    jQuery('#add-date-range-button').popover('hide');
                }, 1000);
                isDatePresent = true;
            }
        });
        currentDate.setDate(currentDate.getDate() + 1);

    }
    return isDatePresent;
}

//ajax get old dates
//create new date objects
//in areDatesPresent also check for these old dates