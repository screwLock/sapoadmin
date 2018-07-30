<?php

/**
 * The view for the user registration page
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public/partials
 */

?>
<div class="loading-page"></div>

<div class="card bg-light">
<article class="card-body mx-auto" style= "max-width: 295px">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<p class="text-center">Get started with your free account</p>
	<p>
		<button type="submit" class="btn btn-block btn-google" id="google-login-button"> <i class="fa fa-google"></i>   Continue with Google</button>
		<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
        <div id="name"></div>

    </p>
	<p class="divider-text">
        <span class="bg-light">OR</span>
    </p>
	<form>
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="First name" type="text">
    </div> <!-- form-group// -->
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Last name" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Email address" type="email">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Create password" type="password" id="pw-input">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <div class="input-group-text"> <i class="fa fa-lock"></i> </div>
			<input class="form-control" placeholder="Repeat password" type="password" id="rpw-input">
		</div>
    </div> <!-- form-group// -->          
	<div class="form-group input-group">
		<meter max="4" id="password-strength-meter"></meter>
		<p id="password-strength-text"></p>
	</div>                          
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" id="create-user-button"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a href="">Log In</a> </p>
		<input type="checkbox" name="website" value="1" style="display:none !important" tabindex="-1" autocomplete="off">
    </form>
</article>
</div> <!-- card.// -->

<!--
-Include form validation in honeypot algorithm. (most end-user will only get 1 or 2 fields wrong; spambots will typically get most of the fields wrong)
-Use a service like CloudFlare that automatically blocks known spam IPs
-Have form timeouts, and prevent instant posting. (forms submitted in under 3 seconds of the page loading are typically spam)
-Prevent any IP from posting more than once a second.
-->