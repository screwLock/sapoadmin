
jQuery(window).load(function(){
  var dateColumn = 3;
  var addressColumn = 13;
  var mapTable = wpDataTables.table_1.DataTable();

    jQuery('#sapo_datepicker').datepicker( {dateFormat: 'yy-mm-dd'})
        .datepicker('setDate', 'today')
        .datepicker( 'option' , 'onSelect', function(dateText) {
           drawTableByDate(wpDataTables.table_1, dateColumn, dateText);
        });



    //Display dates loaded on page load
    drawTableByDate(wpDataTables.table_1, dateColumn, moment().utc().format('YYYY-MM-DD'));
    //Add a timeout so table can finish drawing before search (prevents annoying geocoding popups)
    setTimeout(function() {changeMarkers(wpDataTables.table_1, addressColumn);}, 500);
    
    //Add a timeout to prevent double entry of first marker
    setTimeout(function(){
        wpDataTables.table_1.addOnDrawCallback(function() { 
        updateMarkersOnRedraw(wpDataTables.table_1, addressColumn)
        });
        }, 1000);
       
       //complete this when sample database complete
       //mapTableData is address->Not lat/long->Not marker
       //also check for when table is empty(otherwise get error)

       jQuery('#table_1 tbody').on('click', 'tr', function(){
        if(!jQuery(this).hasClass('selected')){
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

       marker.addListener('click', addInfoWindow.bind(this, marker, infowindow, 15));
      console.log("agin");
       markers.push(marker);
       } 
   else {
      alert('Geocode was not successful for the following reason: ' + status);
   }
   });
}   

function addInfoWindow(marker, infowindow, zoom){
    infowindow.open(map, marker);
    map.setZoom(zoom);
    map.panTo(marker.position);
}


function updateMarkersOnRedraw(tableName, column){
  deleteMarkers();
  changeMarkers(tableName, column); 
}

function changeMarkers(tableName, addressColumn){
  tableName.DataTable()
  .column(addressColumn)
  .data()
  .each(function(address){
    codeAddress(address);
  });
}

function drawTableByDate(tableName, dateColumn, date){
  tableName.DataTable()
  .column(dateColumn)
  .search(date)
  .draw();
}