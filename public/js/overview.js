/**
 * This script provides most of the functionality for the Overview page
 * of the SAPO product.  Requires datepicker html, the wpDatatables plugin,
 * and Google map markup to function.
 * 
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 */
//jQuery("#map-title").text("Pickups For: " + moment(dateText.date).format('YYYY-MM-DD'));

jQuery(window).load(function(){
  var dateColumn = 3;
  var addressColumn = 13;

    jQuery('#sapo_datepicker').datepicker( 
      {
        format: 'yyyy-mm-dd',
        toggleActive: true,
        todayBtn: "linked",
        todayHighlight: true
      });
    jQuery('#sapo_datepicker').datepicker('setDate', 'today');
    jQuery('#sapo_datepicker').on( 'changeDate', function(dateText) {
          jQuery("#map-title").text("Pickups For: " + moment(dateText.date).format('YYYY-MM-DD'));
          drawTableByDate(wpDataTables.table_1, dateColumn, moment(dateText.date).format('YYYY-MM-DD'))
        });



    //Display dates loaded on page load
    drawTableByDate(wpDataTables.table_1, dateColumn, moment().local().format('YYYY-MM-DD'));
    //Add a timeout so table can finish drawing before search (prevents annoying geocoding popups)
    setTimeout(function() {changeMarkers(wpDataTables.table_1, addressColumn);}, 1000);
    
    //Add a timeout to prevent double entry of first marker
    setTimeout(function(){
        wpDataTables.table_1.addOnDrawCallback(function() { 
        updateMarkersOnRedraw(wpDataTables.table_1, addressColumn)
        });
        }, 1100);
       
       //complete this when sample database complete
       //mapTableData is address->Not lat/long->Not marker
       //also check for when table is empty(otherwise get error)
       //could also create array of address

       jQuery('#table_1 tbody').on('click', 'tr', function(){
        if(wpDataTables.table_1.DataTable().data().any())
        {
          if(!jQuery(this).hasClass('selected')){
            deleteMarkers();
            var mapTableData = wpDataTables.table_1.DataTable().rows(0).data()[0][addressColumn];
            codeAddress(mapTableData);
          }
        }
      });


})        //END OF jQuery window load
    
var markers = [];


/**
 * The callback needed for the google maps URL.  Specifies the map
 * initial setting and zoom.
 * 
 *  
 */
function initMap() {

  var styledMapType = new google.maps.StyledMapType(
    sapoMapStyle,
    {name: 'Styled Map'});
    map = new google.maps.Map(document.getElementById('sapo_map'), {
    center: {lat: 48.3552767, lng: -99.9995795},
    zoom: 3
    
    });
    geocoder = new google.maps.Geocoder;   
    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map'); 
    jQuery("#cover").hide();
}

/**
 * The following three functions remove markers from the markers collection
 * and reinitialize the array for new additions.
 */

 //////////////////////////////////////////////////////////////////

function clearMarkers() {
    setMapOnAll(null);
  }

function deleteMarkers() {
    clearMarkers();
    map.setZoom(3);
    markers = [];
  }

  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

///////////////////////////////////////////////////////////////////

/**
 * Converts a physical address into a marker with lat and long coordinates
 * 
 * 
 * @param {*} address 
 * 
 */
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
       markers.push(marker);
       } 
   else {
      alert('Geocode was not successful for the following reason: ' + status);
   }
   });
}   


/**
 * Attach an infowindow to a marker with specified zoom settings
 * 
 * 
 * @param {*} marker 
 * @param {*} infowindow 
 * @param {*} zoom 
 * 
 */
function addInfoWindow(marker, infowindow, zoom){
    infowindow.open(map, marker);
    map.setZoom(zoom);
    map.panTo(marker.position);
}


/**
 * Delete and add new markers when table is redrawn
 * 
 * 
 * @param {*} tableName 
 * @param {*} column 
 * 
 */
function updateMarkersOnRedraw(tableName, column){
  deleteMarkers();
  changeMarkers(tableName, column); 
}


/**
 * Update the markers on the map by matches to a submitted address
 *
 * 
 * @param {*} tableName 
 * @param {*} addressColumn 
 * 
 */
function changeMarkers(tableName, addressColumn){
  tableName.DataTable()
  .column(addressColumn)
  .data()
  .each(function(address){
    codeAddress(address);
  });
}


/**
 * Draw the table based on row matches to a submitted date
 * 
 * 
 * @param {*} tableName 
 * @param {*} dateColumn 
 * @param {*} date 
 * 
 */
function drawTableByDate(tableName, dateColumn, date){
  tableName.DataTable()
  .column(dateColumn)
  .search(date)
  .draw();
}

//styling for the Google Map
var sapoMapStyle = 
[
  {
      "featureType": "all",
      "elementType": "labels",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "administrative",
      "elementType": "all",
      "stylers": [
          {
              "visibility": "simplified"
          },
          {
              "color": "#5b6571"
          },
          {
              "lightness": "35"
          }
      ]
  },
  {
      "featureType": "administrative.neighborhood",
      "elementType": "all",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "landscape",
      "elementType": "all",
      "stylers": [
          {
              "visibility": "on"
          },
          {
              "color": "#f3f4f4"
          }
      ]
  },
  {
      "featureType": "landscape.man_made",
      "elementType": "geometry",
      "stylers": [
          {
              "weight": 0.9
          },
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "poi.park",
      "elementType": "geometry.fill",
      "stylers": [
          {
              "visibility": "on"
          },
          {
              "color": "#83cead"
          }
      ]
  },
  {
      "featureType": "road",
      "elementType": "all",
      "stylers": [
          {
              "visibility": "on"
          },
          {
              "color": "#ffffff"
          }
      ]
  },
  {
      "featureType": "road",
      "elementType": "labels",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "road.highway",
      "elementType": "all",
      "stylers": [
          {
              "visibility": "on"
          },
          {
              "color": "#fee379"
          }
      ]
  },
  {
      "featureType": "road.highway",
      "elementType": "geometry",
      "stylers": [
          {
              "visibility": "on"
          }
      ]
  },
  {
      "featureType": "road.highway",
      "elementType": "labels",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "road.highway",
      "elementType": "labels.icon",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "road.highway.controlled_access",
      "elementType": "labels.icon",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "road.arterial",
      "elementType": "all",
      "stylers": [
          {
              "visibility": "simplified"
          },
          {
              "color": "#ffffff"
          }
      ]
  },
  {
      "featureType": "road.arterial",
      "elementType": "labels",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "road.arterial",
      "elementType": "labels.icon",
      "stylers": [
          {
              "visibility": "off"
          }
      ]
  },
  {
      "featureType": "water",
      "elementType": "all",
      "stylers": [
          {
              "visibility": "on"
          },
          {
              "color": "#7fc8ed"
          }
      ]
  }
];