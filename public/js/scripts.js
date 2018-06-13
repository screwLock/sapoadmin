
jQuery(window).load(function(){

  var mapTable = wpDataTables.table_1.DataTable();

    jQuery('#sapo_datepicker').datepicker({
       dateFormat: 'dd-mm-yy'
       }).datepicker('setDate', 'today')
         .datepicker( 'option' , 'onSelect', function(dateText, insta) {
         
            

         //TODO:  Change column and search to reflect date, not priority
            wpDataTables.table_1.DataTable()
                     .column(2)
                     .search(15)
                     .draw();
            });
         wpDataTables.table_1.addOnDrawCallback(function(){
            deleteMarkers();
            wpDataTables.table_1.DataTable()
                    .column(13)
                    .data()
                    .each(function(value){
                        codeAddress(value);
                    //});
                    });
         });

    //Display dates loaded on page load
    wpDataTables.table_1.DataTable()
       .column(13)
       .data()
       .each(function(value){
          codeAddress(value);
       });
       
       //complete this when sample database complete
       //mapTableData is address->Not lat/long->Not marker

       jQuery('#table_1 tbody').on('click', 'tr', function(){
        if(!$(this).hasClass('selected')){
          //deleteMarkers();
          var mapTableData = mapTable.rows(0).data()[0][13];
          if(markers.includes(mapTableData))console.log(mapTableData);
        }
      });


})        
    

function initMap() {
    map = new google.maps.Map(document.getElementById('sapo_map'), {
    center: {lat: 48.3552767, lng: -99.9995795},
    zoom: 3
    
    });
    geocoder = new google.maps.Geocoder;    
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
        animation: google.maps.Animation.DROP,
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