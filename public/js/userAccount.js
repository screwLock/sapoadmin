var zipcodes = [];
var blackoutDates = [];
var categories = [];
var sizes = [];
var locationDetails = [];

//load categories from the database while page is loading
/*
jQuery.ajax({
    type:"POST",
    url: categories_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_categories'
    },
    success: function (response) {
        response.data.map(function(oldCategory){
            categories.push(createNewCategory(oldCategory.category, oldCategory.description));
            jQuery("#saved-categories").append(addCategoryEntry(oldCategory)).hide().show('slow');
        }); 
    },
    error: function(error){
       // console.log('error');
    }
});

//load sizes from the database while page is loading
jQuery.ajax({
    type:"POST",
    url: categories_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_sizes'
    },
    success: function (response) {
        response.data.map(function(oldSize){
            sizes.push(createNewSize(oldSize.name, oldSize.description));
            jQuery("#saved-sizes").append(addSizeEntry(oldSize)).hide().show('slow');
        }); 
    },
    error: function(error){
       // console.log('error');
    }
});
*/

//load locationDetails from the database while page is loading
jQuery.ajax({
    type:"POST",
    url: categories_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_location_details'
    },
    success: function (response) {
            console.log(response.data[0]);
            var oldLocationDetails = response.data[0];
            locationDetails[0] = createNewLocationDetails(oldLocationDetails.stairs, oldLocationDetails.moving_out, 
                oldLocationDetails.yard_sale, oldLocationDetails.estate_auction);
 
    },
    error: function(error){
       // console.log('error');
    }
});
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
    jQuery("#location-details-card").hide();

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
    });

    jQuery("#confirm-date-button").on('click', function(){
        jQuery('#location-details-card').show('slow');
    });
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

function createNewCategory(name, description = ''){
    var newCategory = {
        name: name,
        description: description
    };
    return newCategory;
}

function createNewSize(name, description = '', priority){
    var newSize = {
        name: name,
        description: description,
        priority: priority
    };
    return newSize;
}

function createNewLocationDetails(stairs = 0, movingOut = 0, yardSale = 0, estateAuction = 0){
    var newLocationDetails = {
        stairs: stairs,
        movingOut: movingOut,
        yardSale: yardSale,
        estateAuction: estateAuction
    };
    return newLocationDetails;
}

function renderZipcodeOption(zipcode){
    return "<option value=" + zipcode.zipcode + "> " +  zipcode.zipcode + "</option>";
}

function renderLocationDetails(locationDetails){
    if(locationDetails.stairs === true)
        JQuery("#location-details-form").append(
            '<div class="form-group row">' +
            '<div class="col">' +
                '<h6 class="pb-2">Will There Be Stairs Involved? How Many Flights?</h6>' +
                '<div class="btn-group btn-group-toggle" data-toggle="buttons">' +
                '<label class="btn btn-primary active btn-sm"><input type="radio" name="stairs-radio" id="stairs-no" value=0 autocomplete="No" checked value=0> No</label>' +
                '<label class="btn btn-primary btn-sm"><input type="radio" name="stairs-radio" id="stairs-yes" value=1 autocomplete="yes"> Yes</label>' +
                '</div>' +
            '</div>' +
        '</div>'
        );
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
