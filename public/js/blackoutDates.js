jQuery(window).load(function(){
    jQuery("#date-present-alert").hide();
    jQuery('#blackout-dates').datepicker( 
        {
          format: 'yyyy-mm-dd',
          toggleActive: true,
          todayBtn: "linked",
          todayHighlight: true
        });
    jQuery('#blackout-dates').datepicker('setDate', 'today');
    jQuery('#add-date-button').on('click', function(){
        addNewDisabledDate();
    });
});


function addNewDisabledDate() {
    var presentFlag = 0;
    jQuery('#new-date-table tr td.date-to-be-disabled').each(function () {

        //check if date is already in table
        if(jQuery('#blackout-dates').val() === jQuery(this).text()){
            //show warning if it is
            jQuery("#date-present-alert").fadeTo(2000, 500).slideUp(500, function(){
                jQuery("#date-present-alert").slideUp(500);
                 });   
                  
            presentFlag = 1;
        }
    });
        //if date is not present, add the new date row to the table
        if(presentFlag === 0){
            jQuery('#new-date-table tr:last').after('<tr><td class="date-to-be-disabled">' +
                                                jQuery('#blackout-dates').val() + '</td>' +
                                                '<td class="reason-to-be-disabled">' + jQuery('#reason').val() + '</td>' +
                                                '<td class="text-right text-nowrap">' + 
                                                '<button class="btn btn-xs btn-default">' +
                                                '<span class="glyphicon glyphicon-trash"></span>' +
                                                '</button></td></tr>');
            jQuery('#new-date-table tr:last button').on('click', function(){
            jQuery(this).closest('tr').remove();
            });
        }
}       




