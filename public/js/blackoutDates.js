//Before the DOM is ready, get the blackout dates from the database
var blackoutDates= [];
jQuery.ajax({
    type:"POST",
    url: blackout_dates_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_blackout_dates'
    },
    success: function (response) {
        response.data.map(function(oldDate){
            blackoutDates.push(createBlackoutDate(oldDate.date,oldDate.reason,oldDate.groupID));
            createAndRenderOldDate(oldDate.groupID, oldDate.reason);
        }); 
    },
    error: function(error){
        console.log('error');
    }
});

jQuery(window).load(function(){
    jQuery('#date-present-alert').hide();
    jQuery('#date-range-alert').hide();
    jQuery('#range-dates').hide();

    //Single date datepicker
    jQuery('#blackout-dates-single').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true,
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
    
    //AJAX
    //jQuery('#each-datepicker').datepicker('setDatesDisabled', blackoutDates);


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
        e.preventDefault();
        addSingleDate(jQuery('#blackout-dates-single').datepicker('getDate'), jQuery('#single-date-reason').val(), blackoutDates);
    });

    //add click event listener to date-range add button
    jQuery('#add-date-range-button').on('click', function(e){
        e.preventDefault();
        if(jQuery('#blackout-date-range-start').datepicker('getDate').toDateString() ===  jQuery('#blackout-date-range-end').datepicker('getDate').toDateString()){
            jQuery('#blackout-date-range-end').popover('show');
            setTimeout(function(){
                jQuery('#blackout-date-range-end').popover('hide');
            }, 1000);
        }
        else
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

    jQuery('#blackout-date-range-end').popover({
        content: "Start and End Dates cannot be the same",
        title: "ERROR",
        trigger: "manual"
    });

    //add click event listener to submit button
    jQuery('#save-dates').on('click', function(e){
        e.preventDefault();
        //Only contact the server if there is data in the table
        //to be saved
        if(jQuery('#new-date-cards tr').length > 0){
            jQuery.ajax({
                type:"POST",
                url: blackout_dates_ajax.ajax_url,
                dataType: 'text',
                data: {
                    action: 'add_new_dates',
                    new_dates: blackoutDates
                },
                success: function (response) {
                    console.log(response);
                    console.log(blackout_dates_ajax.ajax_url);
                    //console.log(JSON.parse(data[0]));
                    //data.map(function(oldDate)createBlackoutDate(oldDate->date,oldDate->reason,oldDate->id))
                    //OR data.forEach(function(oldDate) {blackoutDates.push(JSON.parse(oldDate);})
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            });
        }
    })
    
}); // End of the Window load Block


function getCheckedWeekdayValues(){
    return jQuery('input[name="weekday-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

function addNewDisabledDate(date, reason, groupID, dateArray) {

    var newBlackoutDate = createBlackoutDate(date, reason, groupID);
    dateArray.push(newBlackoutDate);

    return true;
}       

function addSingleDateEntry(addedDate, reason, groupID){
    var formattedDate = addedDate.toLocaleDateString('en-US', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });

    var buttonID = '#' + groupID;
    var newDateCard =   '<tr>' +
                        '<td>' + reason + '</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td>' +
                        '<button class="btn btn-primary btn-sm" id = "' + groupID + '">Delete</button></td>'
                        '</tr>';
    
    jQuery("#new-date-cards").on("click", buttonID, function(){
        var target = jQuery(this).closest("tr");
        target.fadeOut(500, function(){jQuery(this).remove()});
        blackoutDates = deleteBlackoutDates(groupID, blackoutDates);
    });                        
    return newDateCard;
}

function addRangeDateEntry(startDate, endDate, reason, groupID){

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

    var buttonID = '#' + groupID;
    var newDateCard =   '<tr>' +
                        '<td>' + reason + '</td>' +
                        '<td>' + formattedStartDate + ' - ' + formattedEndDate + '</td>' +
                        '<td><button class="btn btn-primary btn-sm" id = "' + groupID + '">Delete</button></td>' +
                        '</tr>';

    jQuery("#new-date-cards").on("click", buttonID, function(event){
        var target = jQuery(this).closest("tr");
        target.fadeOut(500, function(){jQuery(this).remove()});
        blackoutDates = deleteBlackoutDates(groupID, blackoutDates);
    });

    return newDateCard;
}

function addDateRange(start, end, reason, dateArray){
    var startDate = start;
    var endDate = end;
    var groupID = start.toISOString().split('T')[0] + '_' + end.toISOString().split('T')[0];
    var currentDate = new Date(startDate.getTime());

    if(!areDatesPresent(startDate, endDate, dateArray)){

        while(currentDate <= endDate){
            addNewDisabledDate(currentDate.toISOString().split('T')[0], reason, groupID, dateArray);
            currentDate.setDate(currentDate.getDate() + 1);
        }
        jQuery('#new-date-cards').append(addRangeDateEntry(start, end, reason, groupID)).hide().show('slow');

    }
}

function addSingleDate(date, reason, dateArray){
    var groupID = date.toISOString().split('T')[0];
    if(!areDatesPresent(date, date, dateArray)){
        addNewDisabledDate(date.toISOString().split('T')[0], reason, date.toISOString().split('T')[0], dateArray);
        jQuery('#new-date-cards').append(addSingleDateEntry(date, reason, groupID)).hide().show('slow');
    }
}

function createBlackoutDate(date, reason, id){
    blackoutDate = {
        date: date,
        reason: reason,
        groupID: id
    };
    return blackoutDate;
}

function deleteBlackoutDates(groupID, dateArray){
    return dateArray.filter(function(date){
            return date.groupID !== groupID;
        });
}

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

function createAndRenderOldDate(oldGroupID, reason,){

    var formattedDate = '';
    var startDate = oldGroupID.split('_')[0];
    var startDateParts = startDate.split('-');
    startDate = new Date(startDateParts[0], startDateParts[1] - 1, startDateParts[2]);
    var formattedStartDate = startDate.toLocaleDateString('en-US', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });
    
    if((oldGroupID.split('_')).length>1){
        var endDate = oldGroupID.split('_')[1];
        var endDateParts = endDate.split('-');
        endDate = new Date(endDateParts[0], endDateParts[1]-1, endDateParts[2]);
        var formattedEndDate = endDate.toLocaleDateString('en-US', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
        formattedDate = formattedStartDate + ' - ' + formattedEndDate;
    }
    else
        formattedDate = formattedStartDate;

    var buttonID = '#' + oldGroupID;
    var oldDateEntry =  '<tr>' +
                        '<td>' + reason + '</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td><div class="form-check"><label class="form-check-label">' +
                        '<input class="form-check-input"type="checkbox" name="oldDate-cb" value=' + oldGroupID + '>Remove</label></div></td>'+  
                        '</tr>';

    jQuery('#old-date-entries').append(oldDateEntry).hide().show('slow');

}

function getCheckedOldDates(){
    return jQuery('input[name="oldDate-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

jQuery('#alter-old-dates').on('click', function(e){
    e.preventDefault();
    if(getCheckedOldDates().length >= 1){
        jQuery.ajax({
            type:"POST",
            url: blackout_dates_ajax.ajax_url,
            dataType: 'json',
            data: {
                action: 'delete_old_dates',
                datesToRemove: getCheckedOldDates()
            },
            success: function (response) {
                console.log(response);
                if(response.success === true){
                    jQuery('input[name="oldDate-cb"]:checked').each(function(){
                    var target = jQuery(this).closest("tr");
                    target.fadeOut(500, function(){jQuery(this).remove()});
                    blackoutDates = deleteBlackoutDates(jQuery(this).val(), blackoutDates);
                });
                }
                else
                    console.log("there was an error");
            },
            error: function(xhr, status, error){
                console.log(status);
            }
        });
    }
});