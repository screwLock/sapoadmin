var zipcodes = [];

jQuery(window).load(function(){
    jQuery('#add-zipcode-button').on('click', function(e) {
        e.preventDefault();
        var zipEntry = jQuery("#add-zipcode").val();
        var weekdays = getCheckedWeekdayValues();
        if(validZip(zipEntry) && !doesPropertyExist(zipEntry, "zipcode", zipcodes) && (weekdays.length > 0)){
            zipcodes.push(createNewZipcode(zipEntry, weekdays));
        }
    });

    //Initialize the max-time datepicker
    jQuery('#max-time').timepicker(
        {
            useSelect: true,
            minTime: '08:00:00', 
            startTime: '08:00:00',
            step: 15
        });

});// End of window.load

  //create callback function
  //also validate in server-side
  //if (validZip(this.value)) {alert('*** Please enter a valid zip code.')};

function validZip(zip) {
    var reUS = /^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/; // US Zip
    var reCA = /^([A-Z][0-9][A-Z])\s*([0-9][A-Z][0-9])$/; // CA Zip
  
    return reUS.test(zip) || reCA.test(zip);
}

function createNewZipcode(zip, days){
    newZipcode = {
        zipcode: zip,
        days: days
    }
    return newZipcode;
}

function getCheckedWeekdayValues(){
    return jQuery('input[name="weekday-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

/**
 * Determines if the input matches a property of an object
 * within an array of objects.  Returns true if match found
 */

function doesPropertyExist(property, objectProperty, objectArray){
    if(!Array.isArray(objectArray) || !objectArray.length) {
        return false;
    }
    var match = false;
    objectArray.forEach(function(object){
        if(match === false)
            match = (property === object[objectProperty]);
    })
    return match;
}