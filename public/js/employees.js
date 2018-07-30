
var employees = [];
var trucks = [];

jQuery(window).load(function(){
    highlightMenu();
    jQuery("#add-employee-button").on('click', function(e){
        e.preventDefault();
        var first = jQuery("#employee-first-name").val();
        var middle = jQuery("#employee-middle-initial").val();
        var last = jQuery("#employee-last-name").val();
        var email = jQuery("#employee-email").val();
        var pn = jQuery('#employee-phone-number-1').val() + jQuery('#employee-phone-number-2').val() + jQuery('#employee-phone-number-3').val();
        var pass = jQuery("#employee-password").val();
        var repPass = jQuery("#employee-repeat-password").val();
        var access = jQuery("#access-dropdown").val();
        var id = jQuery('#employee-number').val();
        if(validPhoneNumber(pn) && validEmail(email) && passwordSameAsRepeat(pass,repPass) && passwordEmpty(pass)){
            newEmployee = addEmployee(first, middle, last, email, pass, access, pn, id);
            jQuery.ajax({
                type:"POST",
                url: employees_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'save_employee',
                    new_employee: newEmployee
                },
                success: function (response) {
                    jQuery("#current-employees").append(addEmployeeEntry(newEmployee)).hide().show('slow');
                    console.log(response);
                },
                error: function(xhr, error, status){
                    console.log(status);
                }
            });
        }
    });

    jQuery("#add-driver-button").on('click', function(e){
        e.preventDefault();
        var first = jQuery("#driver-first-name").val();
        var middle = jQuery("#driver-middle-initial").val();
        var last = jQuery("#driver-last-name").val();
        var email = jQuery("#driver-email").val();
        var pn = jQuery('#driver-phone-number-1').val() + jQuery('#driver-phone-number-2').val() + jQuery('#driver-phone-number-3').val();
        var pass = jQuery("#driver-password").val();
        var repPass = jQuery("#driver-repeat-password").val();
        var access = jQuery("#access-dropdown").val();
        var id = jQuery('#driver-truck-number').val();
        if(validPhoneNumber(pn) && validEmail(email) && passwordSameAsRepeat(pass,repPass) && passwordEmpty(pass)){
            newDriver = addDriver(first, middle, last, email, pass, access, pn, id);
            jQuery.ajax({
                type:"POST",
                url: employees_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'save_driver',
                    new_driver: newDriver
                },
                success: function (response) {
                    jQuery("#current-drivers").append(addDriverEntry(newDriver)).hide().show('slow');
                    console.log(response);
                },
                error: function(xhr, error, status){
                    console.log(error);
                }
            });
        }
    });
    
    //change text and value of dropdown to selected dropdown item
    jQuery('.dropdown a').on('click', function(){
        jQuery(this).parents(".dropdown").find('.btn').html(jQuery(this).text() + ' <span class="caret"></span>');
        jQuery(this).parents(".dropdown").find('.btn').val(jQuery(this).data('value'));
    });
}); // end of window on load

function addEmployee(first, middle, last, email, pass, access, pn, id){
    var newEmployee = {
        firstName: first,
        middleInitial: middle,
        lastName: last,
        email: email,
        password: pass,
        phoneNumber: pn,
        accessLevel: access,
        id: id
    };
    return newEmployee;
}

function addDriver(first, middle, last, email, pass, access, pn, id){
    var newDriver = {
        firstName: first,
        middleInitial: middle,
        lastName: last,
        email: email,
        password: pass,
        phoneNumber: pn,
        accessLevel: access,
        id:id
    };
    return newDriver;
}

function addEmployeeEntry(employee){
        var newEntry =      '<tr>' +
                            '<td>' + employee.firstName + ' ' + employee.middleInitial + ' ' + employee.lastName + '</td>' +
                            '<td>' + employee.accessLevel + '</td>' + '<td>' +
                            '<div class="form-check"><label class="form-check-label">' +
                            '<input class="form-check-input"type="checkbox" name="saved-category-cb" value=' + employee.email + '>Delete</label></div></td>'+  
                            '</tr>';
                              
        return newEntry;
}

function addDriverEntry(driver){
    var newEntry =      '<tr>' +
                        '<td>' + driver.firstName + ' ' + driver.middleInitial + ' ' + driver.lastName + '</td>' +
                        '<td>' + driver.accessLevel + '</td>' + '<td>' +
                        '<div class="form-check"><label class="form-check-label">' +
                        '<input class="form-check-input"type="checkbox" name="saved-category-cb" value=' + driver.email + '>Delete</label></div></td>'+  
                        '</tr>';
                          
    return newEntry;
}

function validEmail(email){
    var reEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return reEmail.test(email);
}

function validPhoneNumber(phoneNumber){
    var rePhoneNumber = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;
    return rePhoneNumber.test(phoneNumber);
}

function passwordSameAsRepeat(pw, rpw){
    return pw == rpw;
}

function passwordEmpty(pw){
    return pw.length > 0;
}

/**
 * Highlights the active anchor link on the 
 * sidebar
 */
function highlightMenu() {
    // this will get the full URL at the address bar
    var url = window.location.href;

    // passes on every "a" tag
    jQuery(".sidenav a").each(function() {
        // checks if its the same on the address bar

        if (url == (this.href)) {
            jQuery(this).closest("a").addClass("active");
            //for making parent of submenu active
           jQuery(this).closest("a").parent().parent().addClass("active");
        }
    });
};    