
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
            zipcodes.push(createNewZipcode(oldZipcode.zipcode, oldZipcode.days, oldZipcode.isMaxTimeEnabled, oldZipcode.maxTime));
            jQuery("#saved-zipcodes").append(addZipcodeEntry(oldZipcode)).hide().show('slow');
        }); 
    },
    error: function(error){
       // console.log('error');
    }
});


jQuery(window).load(function(){
    jQuery("#max-time-select").hide();
    jQuery('input[type=radio][name=max-time-enabled]').on('change', function(){
        switch(jQuery(this).val()){
            case '0':
                jQuery('#max-time-select').fadeOut('fast');
                break;
            case '1':
                jQuery('#max-time-select').fadeIn('fast');
                break;
        }
    });

    jQuery('#add-zipcode-button').on('click', function(e) {
        e.preventDefault();
        var zipEntry = jQuery("#add-zipcode").val();
        var weekdays = getCheckedWeekdayValues();
        var isMaxTimeEnabled = parseInt(jQuery('input[type=radio][name=max-time-enabled]:checked').val());
        var maxTime = jQuery('#max-time').val();
        var maxPickups = jQuery('#add-max-pickup').val();
        if(validZip(zipEntry) && !doesPropertyExist(zipEntry, "zipcode", zipcodes) && (weekdays.length > 0) && validTwoDigitNumber(maxPickups)){
            var newZipcode = createNewZipcode(zipEntry, weekdays, isMaxTimeEnabled, maxTime, maxPickups);
            zipcodes.push(newZipcode);
            jQuery.ajax({
                type:"POST",
                url: zipcodes_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'save_zipcodes',
                    new_zipcode: newZipcode,
                },
                success: function (response) {
                    jQuery("#saved-zipcodes").append(addZipcodeEntry(newZipcode)).hide().show('slow');
                },
                error: function(xhr, error, status){
                    ;
                }
            });
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

    //event listener and AJAX for the delete button
    //on the saved zipcodes table
    jQuery('#delete-zipcodes').on('click', function(e){
        e.preventDefault();
        if(getCheckedZipcodes().length >= 1){
            jQuery.ajax({
                type:"POST",
                url: zipcodes_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'delete_saved_zipcodes',
                    zipcodesToRemove: getCheckedZipcodes()
                },
                success: function (response) {
                    console.log(response);
                    if(response.success === true){
                        jQuery('input[name="saved-zipcode-cb"]:checked').each(function(){
                            var target = jQuery(this).closest("tr");
                            target.fadeOut(500, function(){jQuery(this).remove()});
                                zipcodes = deleteZipcodes(jQuery(this).val(), zipcodes);
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


});// End of window.load

function validZip(zip) {
    var reUS = /^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/; // US Zip
    var reCA = /^([A-Z][0-9][A-Z])\s*([0-9][A-Z][0-9])$/; // CA Zip
  
    return reUS.test(zip) || reCA.test(zip);
}

function validTwoDigitNumber(num){
    var reTDN = /^[1-9]?\d$/;

    return reTDN.test(num);
}

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

function deleteZipcodes(zipNumber, zipcodeArray){
    return zipcodeArray.filter(function(zipcode){
            return zipcode.zipcode !== zipNumber;
        });
}

function addZipcodeEntry(zipcode){
    var newEntry =      '<tr>' +
                        '<td>' + zipcode.zipcode + '</td>' +
                        '<td>' + zipcode.days + '</td>' +
                        '<td>' + zipcode.maxPickups + '</td>';
    if(zipcode.maxTimeEnabled){
        newEntry +=      '<td>' + 'Yes' + '</td>' +
                        '<td>' + toAMPM(zipcode.maxTime) + '</td>';
    }
    else {
        newEntry +=      '<td>' + 'No' + '</td>' +
                        '<td>' + 'N/A' + '</td>';
    }
        newEntry +=     '<td>' +
                        '<div class="form-check"><label class="form-check-label">' +
                        '<input class="form-check-input"type="checkbox" name="saved-zipcode-cb" value=' + zipcode.zipcode + '>Delete</label></div></td>'+  
                        '</tr>';
                          
    return newEntry;
}
function getCheckedWeekdayValues(){
    return jQuery('input[name="weekday-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}
function getCheckedZipcodes(){
    return jQuery('input[name="saved-zipcode-cb"]:checked').map(function(){
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

/**
 * Convert a MYSQL time string to am pm
 * format == "h:m"
 * @param {*} dStr 
 * @param {*} format 
 */
function toAMPM(dStr) {
	var now = new Date();
 	now.setHours(dStr.substr(0,dStr.indexOf(":")));
 	now.setMinutes(dStr.substr(dStr.indexOf(":")+1, dStr.indexOf(":")));
    now.setSeconds(0);
    now.toLocaleString('en-US', { hour: 'numeric', hour12: true });
	var hours = (now.getHours() % 12) || 12; // show midnight & noon as 12
	return (
		( hours < 10 ? '0' : '') + hours +
		( now.getMinutes() < 10 ? ':0' : ':') + now.getMinutes() +
                // optional seconds display
		// ( now.getSeconds() < 10 ? ':0' : ':') + now.getSeconds() + 
		( now.getHours() < 12 ? ' AM' : ' PM' )
	); 

}