
jQuery(document).ready(function($){
    $('#sapo_datepicker').datepicker({
       dateFormat: 'dd-mm-yy'
       }).datepicker('setDate', 'today')
         .datepicker( 'option' , 'onSelect', function(dateText, insta) {
         

         //TODO:  Change column and search to reflect date, not priority
         wpDataTables.table_1.DataTable()
                     .column(2)
                     .search(15)
                     .draw();

         wpDataTables.table_1.DataTable()
                     .column(13)
                     .data()
                     .each(function(value){
                        codeAddress(value);
                          });
                     
         
        });
    });


(function($) {
    //runs jquery before DOM is ready
})(jQuery);

var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('sapo_map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 11
    });
}


    function codeAddress(address) {
       //var address = document.getElementById('address').value;
       geocoder.geocode( { 'address': address}, function(results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
       });
       } else {
          alert('Geocode was not successful for the following reason: ' + status);
         }
       });
    }   