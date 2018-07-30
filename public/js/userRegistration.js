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
    var orgID = getUrlParam("orgID", -1);

    jQuery("#create-user-button").on('click', function(e){
        e.preventDefault();
        //FB.api('/me', 'GET', {fields: 'id,first_name,last_name,email'}, function(response) {
        //    console.log(response);
        //    //check db for alrady created accoutn by email
        //  });
    });
});

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

//users should be associated with a organizationID.  Organization ID in url

