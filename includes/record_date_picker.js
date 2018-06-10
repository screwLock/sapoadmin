jQuery(document).ready(function(){
   jQuery('#record_datepicker').datepicker({
      dateFormat: 'dd-mm-yy'
      }).datepicker('setDate', 'today');
   });
jQuery("#record_datepicker").datepicker( 'option' , 'onSelect', function() {
   wpDataTables.table_1.fnDraw();
});




