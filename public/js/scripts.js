
jQuery(window).load(function(){
    jQuery('#sapo_datepicker').datepicker({
       dateFormat: 'dd-mm-yy'
       }).datepicker('setDate', 'today')
         .datepicker( 'option' , 'onSelect', function(dateText, insta) {
         
            deleteMarkers();

         //TODO:  Change column and search to reflect date, not priority
         wpDataTables.table_1.DataTable()
                     .column(2)
                     .search(15)
                     .draw();
                     //.column(13)
                     //.data()
                     //.each(function(value){
                     //    codeAddress(value);
                     //});
         
         wpDataTables.table_1.addOnDrawCallback(function(){
            wpDataTables.table_1.DataTable()
                    .column(13)
                    .data()
                    .each(function(value){
                        codeAddress(value);
                    });
         });
    });

    //Display dates loaded on page load
    wpDataTables.table_1.DataTable()
       .column(13)
       .data()
       .each(function(value){
          codeAddress(value);
       });


})        
    

function initMap() {
    map = new google.maps.Map(document.getElementById('sapo_map'), {
    center: {lat: 48.3552767, lng: -99.9995795},
    zoom: 3
    
    });
    geocoder = new google.maps.Geocoder;
    //infowindow = new google.maps.InfoWindow;
   // marker = new google.maps.Marker;
    
}

function clearMarkers() {
    setMapOnAll(null);
  }

function deleteMarkers() {
    clearMarkers();
    markers = [];
  }

  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

var markers = [];

function codeAddress(address) {
   geocoder.geocode( { 'address': address}, function(results, status) {
   if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
          
      marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
      });
          
      var infowindow = new google.maps.InfoWindow({
        content: address
      });

       marker.addListener('click', addInfoWindow.bind(this, marker, infowindow)
       );

       markers.push(marker);
       } 
   else {
      alert('Geocode was not successful for the following reason: ' + status);
   }
   });
}   

function addInfoWindow(marker, infowindow){
    infowindow.open(map, marker);
    map.setZoom(17);
    map.panTo(marker.position);
}