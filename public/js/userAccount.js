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
    type: "POST",
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
    error: function (error) {
        // console.log('error');
    }
});
//load zipcodes from the database while page is loading
jQuery.ajax({
    type: "POST",
    url: zipcodes_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_zipcodes'
    },
    success: function (response) {
        response.data.map(function (oldZipcode) {
            zipcodes[oldZipcode.zipcode] = (createNewZipcode(oldZipcode.zipcode, oldZipcode.days, oldZipcode.isMaxTimeEnabled, oldZipcode.maxTime));
            jQuery("#zipcode-select").append(renderZipcodeOption(oldZipcode));
        });
    },
    error: function (error) {
        // console.log('error');
    }
});

//Get blackout dates
jQuery.ajax({
    type: "POST",
    url: blackout_dates_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_blackout_dates'
    },
    success: function (response) {
        response.data.map(function (oldDate) {
            blackoutDates.push((oldDate.date));
        });
    },
    error: function (error) {
        //console.log(error);
    }
});

jQuery(window).load(function () {
    jQuery("#pickup-datepicker-card").hide();
    jQuery("#location-details-card").hide();
    jQuery("#pickup-address-card").hide();
    jQuery("#stairs-toggle").hide();
    jQuery("#move-toggle").hide();
    jQuery("#yard-sale-toggle").hide();
    jQuery("#estate-toggle").hide();

    jQuery('#pickup-datepicker').datepicker(
        {
            format: 'yyyy-mm-dd',
            toggleActive: true,
        });
    jQuery('#pickup-datepicker').datepicker('setDate', 'today');

    jQuery("#zipcode-select").on("change", function (e) {
        jQuery("#pickup-datepicker-card").show('slow');
        jQuery('#pickup-datepicker').datepicker('setDaysOfWeekDisabled', getDisabledWeekdays(zipcodes[jQuery("select option:selected").val()].days));
        jQuery('#pickup-datepicker').datepicker('setDatesDisabled', blackoutDates);
    });

    jQuery("#pickup-datepicker").datepicker().on('changeDate', function () {
        jQuery('#location-details-card').show('slow');
        jQuery('#pickup-address-card').show('slow');
        renderLocationDetails(locationDetails[0]);
    });
});

function createNewZipcode(zip, days, maxTimeEnabled = 0, maxTime = "8:00am", maxPickups = 5) {
    newZipcode = {
        zipcode: zip,
        days: days,
        maxTimeEnabled: maxTimeEnabled,
        maxTime: maxTime,
        maxPickups: maxPickups
    }
    return newZipcode;
}

function createNewCategory(name, description = '') {
    var newCategory = {
        name: name,
        description: description
    };
    return newCategory;
}

function createNewSize(name, description = '', priority) {
    var newSize = {
        name: name,
        description: description,
        priority: priority
    };
    return newSize;
}

function createNewLocationDetails(stairs = 0, movingOut = 0, yardSale = 0, estateAuction = 0) {
    var newLocationDetails = {
        stairs: stairs,
        movingOut: movingOut,
        yardSale: yardSale,
        estateAuction: estateAuction
    };
    return newLocationDetails;
}

function renderZipcodeOption(zipcode) {
    return "<option value=" + zipcode.zipcode + "> " + zipcode.zipcode + "</option>";
}

function renderLocationDetails(locationDetails) {
    if (locationDetails.stairs == 1)
        jQuery("#stairs-toggle").show();
    if (locationDetails.movingOut == 1)
        jQuery("#move-toggle").show();
    if (locationDetails.yardSale == 1)
        jQuery("#yard-sale-toggle").show();
    if (locationDetails.estateAuction == 1)
        jQuery("#estate-toggle").show();
}

/**
 * Convert days of week to int values for datepicker
 * @param {*} days 
 */
function getDisabledWeekdays(days) {
    var intDays = [];
    var weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    weekdays.forEach(function (day, index) {
        if (!days.includes(day)) intDays.push(index);
    });
    return intDays;
}

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('pickup-address')),
        { types: ['geocode'] });

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}