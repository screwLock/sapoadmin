//Before the DOM is ready, get the blackout dates from the database
var loadedCheckedWeekdays = [];
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
            blackoutDates.push(createBlackoutDate(oldDate.date,oldDate.reason,oldDate.groupID, true));
        }); 

        var uniqueGroupIDs = blackoutDates.map(function(oldDate){
            return oldDate.groupID;
        });
        uniqueGroupIDs = uniq_fast(uniqueGroupIDs);
        blackoutDates.forEach(function(date){
            if(uniqueGroupIDs.includes(date.groupID)){
                removeItemFromArray(uniqueGroupIDs, date.groupID);
                createAndRenderOldDate(date.groupID, date.reason);
            }
        });
    },
    error: function(error){
       // console.log('error');
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

    jQuery('#change-weekdays').popover({
        content: "No changes have been made",
        title: "ERROR",
        trigger: "manual"
    });

    //add click event listener to submit button
    jQuery('#save-dates').on('click', function(e){
        e.preventDefault();
        newDates = getUnsavedDates(blackoutDates);
        //Only contact the server if there is data in the table
        //to be saved or
        if(jQuery('#new-date-cards tr').length > 0){
            jQuery.ajax({
                type:"POST",
                url: blackout_dates_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'add_new_dates',
                    new_dates: newDates
                },
                success: function (response) {
                    registerDatesAsSaved(newDates);
                    jQuery('#new-date-cards > tr').fadeOut(500, function(){jQuery(this).remove()});
                },
                error: function(xhr, error, status){
                   // console.log(error);
                }
            });
        }
        else
           ;// console.log("Nothing to save");
    })

    //event listener and AJAX for the delete button
    //on the old dates table
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
                    ;//console.log("there was an error");
                },
                error: function(xhr, status, error){
                    // console.log(status);
                }
            });
        }
    });

    loadedCheckedWeekdays = getCheckedWeekdayValues();
    //event listener and AJAX for the save button
    //of the disabled weekdays tab
    jQuery('#change-weekdays').on('click', function(e){
        e.preventDefault();
        var changedWeekdayValues = getCheckedWeekdayValues();
        if(!arraysEqual(loadedCheckedWeekdays, changedWeekdayValues)){
            jQuery.ajax({
                type:"POST",
                url: blackout_dates_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'save_disabled_weekdays',
                    weekdays: getCheckedWeekdayValues()
                },
                success: function (response) {
                    //console.log(response);
                    if(response.success === true){
                        loadedCheckedWeekdays = changedWeekdayValues;
                    }
                    else
                    ;//console.log("there was an error");
                },
                error: function(xhr, status, error){
                    //console.log(status);
                }
            });
        }
        else {
            jQuery('#change-weekdays').popover('show');
            setTimeout(function(){
                jQuery('#change-weekdays').popover('hide');
                }, 1000);
        }
    });
    
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
                        '<button class="btn btn-primary btn-sm" id = "' + groupID + '">Remove</button></td>'
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
                        '<td><button class="btn btn-primary btn-sm" id = "' + groupID + '">Remove</button></td>' +
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

function createBlackoutDate(date, reason, id, isSaved = false){

    blackoutDate = {
        date: date,
        reason: reason,
        groupID: id,
        isSaved: isSaved
    };
    return blackoutDate;
}

function deleteBlackoutDates(groupID, dateArray){
    return dateArray.filter(function(date){
            return date.groupID !== groupID;
        });
}

/**
 * Determine if a matching date is in the date array.
 * Returns TRUE is a match is found
 * @param {*} start 
 * @param {*} end 
 * @param {*} dateArray 
 */
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
                        '<input class="form-check-input"type="checkbox" name="oldDate-cb" value=' + oldGroupID + '>Delete</label></div></td>'+  
                        '</tr>';

    jQuery('#old-date-entries').append(oldDateEntry).hide().show('slow');

}

function getCheckedOldDates(){
    return jQuery('input[name="oldDate-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

function registerDatesAsSaved(dateArray){
    dateArray.forEach(function(date){
        if(date.isSaved == false) date.isSaved = true;
    });
}

function getUnsavedDates(dateArray){
    return dateArray.filter(function(date){
        return date.isSaved == false;
    });
}

//Utility functions should be included in separate js file

/**
 * Returns an array with only unique values
 */
function uniq_fast(a) {
    var seen = {};
    var out = [];
    var len = a.length;
    var j = 0;
    for(var i = 0; i < len; i++) {
         var item = a[i];
         if(seen[item] !== 1) {
               seen[item] = 1;
               out[j++] = item;
         }
    }
    return out;
}

function removeItemFromArray(array, item){
    var i = array.indexOf(item);
    if(i != -1) {
	    array.splice(i, 1);
    }
}

function arraysEqual(arr1, arr2) {
    if(arr1.length !== arr2.length)
        return false;
    for(var i = arr1.length; i--;) {
        if(arr1[i] !== arr2[i])
            return false;
    }

    return true;
}

