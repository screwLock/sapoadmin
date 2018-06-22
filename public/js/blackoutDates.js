jQuery(window).load(function(){
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
    jQuery('#remove-date-button').on('click', function(){
        jQuery(this).closest('tr').remove();
    });
});

//Add reason column to disabled dates tables
//get current date from input box jQuery('#blackout-dates').val()
//check that date isnt already in date box

function addNewDisabledDate() {
    var presentFlag = 0;
    var index = 0;
    jQuery('#new-date-table tr').each(function (i, row) {
        // reference all the stuff you need first
        index = i;
        var row = jQuery(row);
        var date = row.first('td.date-to-be-disabled');
        console.log(date.text());
        if(jQuery('#blackout-dates').val() === date.text()){
            alert('shit dont work');
            presentFlag = 1;
        }
    });
        if(presentFlag === 0){
            jQuery('#new-date-table tr:last').after('<tr><td class="date-to-be-disabled">' +
                                                jQuery('#blackout-dates').val() +
                                                '</td><td class="text-right text-nowrap">' + 
                                                '<button class="btn btn-xs btn-warning">' +
                                                '<span class="glyphicon glyphicon-trash"></span>' +
                                                '</button></td></tr>');
            jQuery('#new-date-table tr:last').on('click', function(){
            jQuery(this).closest('tr').remove();
            });
        }
}       




