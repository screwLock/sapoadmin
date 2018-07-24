var zipcodes = [];
var blackoutDates = [];

//load zipcodes from the database while page is loading
jQuery.ajax({
    type:"POST",
    url: zipcodes_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_zipcodes'
    },
    success: function (response) {
        response.data.map(function(oldZipcode){
            zipcodes[oldZipcode.zipcode] = (createNewZipcode(oldZipcode.zipcode, oldZipcode.days, oldZipcode.isMaxTimeEnabled, oldZipcode.maxTime));
            jQuery("#zipcode-select").append(renderZipcodeOption(oldZipcode));
        }); 
    },
    error: function(error){
       // console.log('error');
    }
});

//Get blackout dates
jQuery.ajax({
    type:"POST",
    url: blackout_dates_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_blackout_dates'
    },
    success: function (response) {
        response.data.map(function(oldDate){
            blackoutDates.push((oldDate.date));
        });
    },
    error: function(error){
        //console.log(error);
    }
});

jQuery(window).load(function(){
    jQuery("#pickup-datepicker-card").hide();
    jQuery('#pickup-datepicker').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true,
        });
    jQuery('#pickup-datepicker').datepicker('setDate', 'today');

    jQuery("#zipcode-select").on("change", function(e){
        jQuery("#pickup-datepicker-card").show('slow');
        jQuery('#pickup-datepicker').datepicker('setDaysOfWeekDisabled', getDisabledWeekdays(zipcodes[jQuery("select option:selected").val()].days));
        jQuery('#pickup-datepicker').datepicker('setDatesDisabled', blackoutDates); 
    })
});

function createNewZipcode(zip, days, maxTimeEnabled = 0, maxTime="8:00am", maxPickups=5){
    newZipcode = {
        zipcode: zip,
        days: days,
        maxTimeEnabled: maxTimeEnabled,
        maxTime: maxTime,
        maxPickups: maxPickups
    }
    return newZipcode;
}

function renderZipcodeOption(zipcode){
    return "<option value=" + zipcode.zipcode + "> " +  zipcode.zipcode + "</option>";

}

/**
 * Convert days of week to int values for datepicker
 * @param {*} days 
 */
function getDisabledWeekdays(days){
    var intDays = [];
    var weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    weekdays.forEach(function(day, index){
        if(!days.includes(day)) intDays.push(index);
    });
    return intDays;
}
