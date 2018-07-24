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
            //jQuery("#saved-zipcodes").append(addZipcodeEntry(oldZipcode)).hide().show('slow');
        }); 
    },
    error: function(error){
       // console.log('error');
    }
});