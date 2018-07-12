jQuery(window).load(function(){
    jQuery('#add-zipcode').on('change', validZip(jQuery(this).val()));
});

  //create callback function
  //also validate in server-side
  if (validZip(this.value)) {alert('*** Please enter a valid zip code.')};

function validZip(zip) {
    var reUS = /^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/; // US Zip
    var reCA = /^([A-Z][0-9][A-Z])\s*([0-9][A-Z][0-9])$/; // CA Zip
  
    return zip.match(reUS) || zip.match(reCA);
}