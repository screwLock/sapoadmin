<?php

/**
 * The functionality for the blackout_dates 
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public/partials
 */

?>
<?php require_once plugin_dir_path( __FILE__ ) . 'get_weekdays.php'; ?>
<div class="loading-page"></div>

<nav class="navbar fixed-top navbar-light bg-light">
    <a class="navbar-brand" href="#">SAPO</a>
</nav>

<div id="sapo-sidebar" class="sidenav border-right">
  <a href="./zipcodes">Zipcodes</a>
  <a href="./blackout-dates">Blackout Dates</a>
  <a href="./categories">Categories</a>
  <a href="./employees">Employees</a>
  <a href="./emails">Emails</a>
</div>

<div class="main">

<nav id="sapo-nav">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-dates-tab" data-toggle="tab" href="#nav-dates" role="tab" aria-controls="nav-dates" aria-selected="true">Blackout Dates</a>
    <a class="nav-item nav-link" id="nav-weekdays-tab" data-toggle="tab" href="#nav-weekdays" role="tab" aria-controls="nav-weekdays" aria-selected="false">Weekdays</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-dates" role="tabpanel" aria-labelledby="nav-home-tab">
<div class="card">

    <div class="card-body">
        <h5 class="card-title pb-2">Create New Blackout Dates</h5>
        <div class="form-check form-check-inline pb-2">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="dateradio" value="single-date-radio" checked>Single Date</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="dateradio" value="date-range-radio">Date Range</label>
        </div>

        <div id="single-date">
            <form>
                <div class="form-group row">
                    <div class="col-4">
                        <label class="sr-only" for="inlineFormInput">Single Blackout Date</label>
                        <input type="text" class="form-control text-center" id="blackout-dates-single">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label class="sr-only" for="inlineFormInput">Single Date Reason</label>
                        <input type="text" class="form-control" id="single-date-reason" placeholder="Reason">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" id="save-date-button">Save</button>
                    </div>
                </div>  
            </form>
        </div>

        <div id="range-dates">
            <form>
                <div class="form-group row input-daterange">
                    <div class="col-4">
                        <input type="text" class="form-control" id="blackout-date-range-start" placeholder="Start Date">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" id="blackout-date-range-end" placeholder="End Date">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <input type="text" class="form-control" id="date-range-reason" placeholder="Reason">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" id="save-date-range-button">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div><!-- End of blackout dates card -->

<div class="container-fluid pt-2">
<h5 class="p-2">Current Blackout Dates</h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Reason</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td><button class="btn btn-primary" id="delete-dates-button">Delete</button></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
        <tbody id="current-blackout-dates-table">
        </tbody>
    </table>
</div>

</div><!-- End of blackout dates tab -->

<div class="tab-pane fade" id="nav-weekdays" role="tabpanel" aria-labelledby="nav-weekdays-tab">
<div class="card">
    <div class="card-body">
    <h5 class="card-title">Disable Weekdays</h5>
        <div class="weekday-checkbox">
            <div class="row pb-2">
                <div class="col">
                    <?php get_weekdays() ?>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-4">
                    <button class="btn btn-primary" id="change-weekdays">Save</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- End of weekdays card -->
</div><!-- End of weekdays tab -->

</div><!-- End of tab-content wrapper -->


</div> <!-- End of main -->