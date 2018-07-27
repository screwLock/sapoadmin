<?php

/**
 * The view for the emails page
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public/partials
 */

?>
<div class="loading-page"></div>

<nav class="navbar fixed-top navbar-light bg-light navbar-expand-lg">
    <a class="navbar-brand" href="#">SAPO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home </a>
            <a class="nav-item nav-link" href="#">Pickup History</a>
            <a class="nav-item nav-link" href="#">Pricing</a>
            <a class="nav-item nav-link" href="<?php echo wp_logout_url("./user-registration"); ?>">Logout</a>
        </div>
    </div>
</nav>

<div id="sapo-sidebar" class="sidenav border-right">
  <a href="./zipcodes">Zipcodes</a>
  <a href="./blackout-dates">Blackout Dates</a>
  <a href="./categories">Categories</a>
  <a href="./employees">Employees</a>
  <a href="./emails">Emails</a>
</div>

<div class="main">
</div><!-- End of main -->

<!--
    user image = orgName + "avatarImage";