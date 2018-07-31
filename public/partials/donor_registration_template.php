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
<article class="card-body mx-auto" style= "max-width: 293px">
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
        <input id="first-name-input" class="form-control" placeholder="First name" type="text" required>
    </div> <!-- form-group// -->
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input id="last-name-input" class="form-control" placeholder="Last name" type="text" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i id="email-env" class="fa fa-envelope"></i> </span>
		 </div>
        <input id="email-input" class="form-control" placeholder="Email address" type="email" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Create password" type="password" id="pw-input" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
			<input class="form-control" placeholder="Repeat password" type="password" id="rpw-input" required>
    </div> <!-- form-group// -->          
	<div class="form-group input-group">
		<meter max="4" id="password-strength-meter"></meter>
		<p id="password-strength-text"></p>
	</div>                          
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" id="create-donor-button"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a id="login-anchor" href="#login-modal" data-toggle="modal" role="button">Log In</a> </p>
		<input type="checkbox" name="website" value="1" style="display:none !important" tabindex="-1" autocomplete="off">
    </form>
</article>
</div> <!-- card.// -->

<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Login</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control form-control-lg" name="email" id="modal-email" required="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-lg" id="modal-pw" required="" autocomplete="new-password">
                        <div class="invalid-feedback">Enter your password too!</div>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="rememberMe">
                      <label class="custom-control-label" for="rememberMe">Remember me on this computer</label>
                    </div>
                    <div class="form-group py-4">
                        <button class="btn btn-outline-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-primary float-right" id="modal-login-button">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--
-Include form validation in honeypot algorithm. (most end-user will only get 1 or 2 fields wrong; spambots will typically get most of the fields wrong)
-Use a service like CloudFlare that automatically blocks known spam IPs
-Have form timeouts, and prevent instant posting. (forms submitted in under 3 seconds of the page loading are typically spam)
-Prevent any IP from posting more than once a second.
-->