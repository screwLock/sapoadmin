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

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-dates-tab" data-toggle="tab" href="#nav-dates" role="tab" aria-controls="nav-dates" aria-selected="true">Blackout Dates</a>
    <a class="nav-item nav-link" id="nav-weekdays-tab" data-toggle="tab" href="#nav-weekdays" role="tab" aria-controls="nav-weekdays" aria-selected="false">Weekdays</a>
    <a class="nav-item nav-link" id="nav-max-times-tab" data-toggle="tab" href="#nav-max-times" role="tab" aria-controls="nav-max-times" aria-selected="false">Max Times</a>
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
                        <input type="text" class="form-control" id="blackout-dates-single">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label class="sr-only" for="inlineFormInput">Single Date Reason</label>
                        <input type="text" class="form-control" id="single-date-reason" placeholder="Reason">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" id="add-date-button"><strong>+</strong> Add</button>
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
                        <button class="btn btn-primary" id="add-date-range-button"><strong>+</strong> Add</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div><!-- End of blackout dates card -->

<div class="container-fluid">
<h5>Dates To Be Saved</h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Reason</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="new-date-cards">
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

<div class="tab-pane fade" id="nav-max-times" role="tabpanel" aria-labelledby="nav-max-times-tab">
<div class="card">
    <div class="card-body">
    <h5 class="card-title">Set Max Time</h5>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="max-time-radio" value="Sunday" checked>Sunday</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="max-time-radio" value="Monday">Monday</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="max-time-radio" value="Tuesday">Tuesday</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="max-time-radio" value="Wednesday">Wednesday</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="max-time-radio" value="Thursday">Thursday</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="max-time-radio" value="Friday">Friday</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="max-time-radio" value="Saturday">Saturday</label>
        </div>
        <form>
            <div class="row p-2">
                <div class="col-4">
                    <label class="sr-only" for="inlineFormInput">Select Max Time</label>
                    <input type="text" class="form-control" id="max-time">
                </div>
            </div>
            <div class="row p-2">
                <div class="col-4">                    
                    <button class="btn btn-primary" id="change-max-time">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

</div><!-- End of tab-content wrapper -->

<?php
    function get_previous_blackout_dates() {
        global $wpdb;
        $blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";
        $result = $wpdb->get_results( "SELECT blackout_date, reason FROM " . $blackout_dates_table . 
                                      " WHERE USER_ID = " . get_current_user_id() . " ORDER BY blackout_date ASC;");
        foreach ( $result as $print )   {
            echo '<tr>';
            echo "<td class='date-to-be-disabled'>" . $print->blackout_date.'</td>';
            echo "<td class='reason-to-be-disabled'>" . $print->reason.'</td>';
            echo '<td class="text-center text-nowrap"><button class="btn btn-xs btn-default"><span class="glyphicon glyphicon-trash"></span></button></td>';
            echo '</tr>';
        };
    }
?>

