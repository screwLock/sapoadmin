var zipcodes = [];

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

jQuery(window).load(function(){

    jQuery('#pickup-datepicker').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true,
        });
    jQuery('#pickup-datepicker').datepicker('setDate', 'today');

    jQuery("#zipcode-select").on("change", function(e){
        jQuery('#pickup-datepicker').datepicker('setDaysOfWeekDisabled', convertWeekdaysToInt(zipcodes[jQuery("select option:selected").val()].days));
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
function convertWeekdaysToInt(days){
    var intDays = [];
    var weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    weekdays.forEach(function(day, index){
        if(days.includes(day)) intDays.push(index);
    });
    return intDays;
}