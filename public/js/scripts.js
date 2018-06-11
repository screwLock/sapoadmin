
jQuery(document).ready(function($){
    $('#sapo_datepicker').datepicker({
       dateFormat: 'dd-mm-yy'
       }).datepicker('setDate', 'today')
         .datepicker( 'option' , 'onSelect', function() {
         wpDataTables.table_1.fnDraw();
        });
    });


(function($) {
    //runs jquery before DOM is ready
})(jQuery);



