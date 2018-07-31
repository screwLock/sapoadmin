//Facebook Login functinality
window.fbAsyncInit = function() {
    FB.init({
      appId      : '2156344984583735',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.0'
    });
      
    //FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


   function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

function fbLogout() {
    FB.logout(function() {
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
    });
}

//Google login functionality

var client_id = '826070324612-brfobr4nrq2vje6mbmdk2isp01dlmrll.apps.googleusercontent.com';
var startApp = function() {
  gapi.load('auth2', function(){
    // Retrieve the singleton for the GoogleAuth library and set up the client.
    auth2 = gapi.auth2.init({
      client_id: client_id,
      cookiepolicy: 'single_host_origin',
      // Request scopes in addition to 'profile' and 'email'
      //scope: 'additional_scope'
    });
    attachSignin(document.getElementById('google-login-button'));
  });
};

function attachSignin(element) {
  console.log(element.id);
  auth2.attachClickHandler(element, {},
      function(googleUser) {
        console.log('works');
        googleUser = auth2.currentUser.get().getBasicProfile();
      }, function(error) {
        //alert(JSON.stringify(error, undefined, 2));
      });
}


jQuery(window).load(function(){
    startApp();

    //Initialize popovers
    jQuery('#email-input').popover({
      content: "An account already exists with this email.  Login instead.",
      trigger: "manual",
    })
    jQuery('#email-env').popover({
      content: "Enter a valid email",
      trigger: "manual",
      placement: 'left'
    })
    jQuery('#pw-input').popover({
      content: "Password must be strong.",
      trigger: "manual",
    })
    jQuery('#rpw-input').popover({
      content: "Passwords must match",
      trigger: "manual",
    })
    jQuery('#create-donor-button').popover({
      content: "All fields required",
      trigger: "manual",
    })
    var orgID = getUrlParam("orgID", -1);

    jQuery("#create-donor-button").on('click', function(e){
        e.preventDefault();
        if(areFieldsEmpty()){
          jQuery('#create-donor-button').popover('show');
          setTimeout(function () {
              jQuery('#create-donor-button').popover('hide');
          }, 2000);
          return false;
        }
        var fn = jQuery('#first-name-input').val();
        var ln = jQuery('#last-name-input').val();
        var email = jQuery('#email-input').val();
        var orgID = getUrlParam('id', 0);
        var login = 0;
        var pw = jQuery('#pw-input').val();
        var rpw = jQuery('#rpw-input').val();
        var pwScore = zxcvbn(password.value);
        if(!validEmail(email)){
          jQuery('#email-env').popover('show');
          setTimeout(function () {
              jQuery('#email-env').popover('hide');
          }, 2000);
          return false;
        }
        if(pwScore.score !== 4) {
          jQuery('#pw-input').popover('show');
          setTimeout(function () {
              jQuery('#pw-input').popover('hide');
          }, 2000);
          return false;
        }
        if(pw !== rpw) {
          jQuery('#rpw-input').popover('show');
          setTimeout(function () {
              jQuery('#rpw-input').popover('hide');
          }, 2000);
          return false;
        }
        var newDonor = createDonor(fn, ln, email, pw,orgID, login);
        jQuery.ajax({
          type:"POST",
          url: new_donors_ajax.ajax_url,
          dataType: 'json',
          data: {
              action: 'register_donor',
              new_donor: newDonor
          },
          success: function (response) {
            if(response.success === false) {
              jQuery('#email-input').popover('show');
              setTimeout(function () {
                  jQuery('#email-input').popover('hide');
              }, 2000);
            }
            else
              window.location.replace("/user-account");
          },
          error: function(error){
          }
      });        //FB.api('/me', 'GET', {fields: 'id,first_name,last_name,email'}, function(response) {
        //    console.log(response);
        //    //check db for alrady created accoutn by email
        //  });
    });
});

function createDonor(firstName,lastName,email,password, orgID=0, login=0){
    var donor = {
      firstName: firstName,
      lastName: lastName,
      email: email,
      password: password,
      orgID: orgID,
      login: login
    };
    return donor;
}

/**
* Setting up the password strength meter
*
*
**/
var strength = {
  0: "Worst ",
  1: "Bad ",
  2: "Weak ",
  3: "Good ",
  4: "Strong "
}

var password = document.getElementById('pw-input');
var meter = document.getElementById('password-strength-meter');
var text = document.getElementById('password-strength-text');

password.addEventListener('input', function()
{
  var val = password.value;
  var result = zxcvbn(val);
  // Update the password strength meter
  meter.value = result.score;
  // Update the text indicator
  if(val !== "") {
      text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong>" + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span>"; 
  }
  else {
      text.innerHTML = "";
  }
});

//Utility functions for getting URL parameters
function getUrlParam(parameter, defaultvalue){
    var urlparameter = defaultvalue;
    if(window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
        }
    return urlparameter;
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function areFieldsEmpty(){
  var fields = jQuery('input:text').filter(function() { return jQuery(this).val() == ""; });
  if(fields.length > 1) return true;
  else return false;
}

function validEmail(email){
  var reEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return reEmail.test(email);
}