
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

         console.log(wpDataTables.table_1.DataTable()
                     .columns(3)
                     .data()
                     .concat(wpDataTables.table_1.DataTable().columns(4).data()));
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
