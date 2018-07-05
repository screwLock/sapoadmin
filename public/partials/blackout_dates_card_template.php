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

<div class="card">

    <div class="card-body">
        <h5 class="card-title">Create New Blackout Dates</h5>
        <div class="form-check form-check-inline">
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
                <div class="form-group row">
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
</div>

<div class="card">
    <div class="card-body">
    <h5 class="card-title">Disable Weekdays</h5>
        <div class="weekday-checkbox">
            <?php get_weekdays() ?>
        </div>
    </div>
</div>

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
            <div class="row">
                    <div class="col-4">
                        <label class="sr-only" for="inlineFormInput">Select Max Time</label>
                        <input type="text" class="form-control" id="max-time">
                    </div>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <div class="alert alert-warning" id="date-present-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Date Already Added
    </div>
<div class="container">

<div class="container"
    <div class="alert alert-warning" id="date-range-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        First Date Must Precede Second Selected Date
    </div>
</div>



<div class="container">
        <table class="table table-hover" id="new-date-table">
            <tbody>
                <tr>
                    <td class="date-to-be-disabled">Needs to be here but change content</td>
                    <td class="reason-to-be-disabled">Needs to be here but change content</td>
                    <td class="text-right text-nowrap"></td>
                </tr>
                <?php get_previous_blackout_dates(); ?>
            </tbody>
        </table>
        <div><button class="btn btn-primary" id="submit">Submit</button></div>
</div>

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

<?php
    function get_weekdays(){
        global $wpdb;
        $blackout_weekdays_table = $wpdb->prefix . "sapo_blackout_weekdays";
        $weekdays = $wpdb->get_row("SELECT sunday,monday,tuesday,wednesday,thursday,friday, saturday FROM " . $blackout_weekdays_table . 
                                       " WHERE USER_ID = " . get_current_user_id());

        //if there is no data in the result set, display unchecked boxes and return
        if(empty($weekdays)) {
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Sundays">Sundays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Mondays">Mondays</label></div>' ;
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Tuesdays">Tuesdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Wednesdays">Wednesdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Thursdays">Thursdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Fridays">Fridays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Saturdays">Saturdays</label></div>';
            return;
        };
        
                                       
        //if there is data in the result set, render the checkboxes according to the results 
        if($weekdays->sunday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Sundays" checked>Sundays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Sundays">Sundays</label></div>';
        if($weekdays->monday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Mondays" checked>Mondays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Mondays">Mondays</label></div>';
        if($weekdays->tuesday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Tuesdays" checked>Tuesdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Tuesdays">Tuesdays</label></div>';
        if($weekdays->wednesday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Wednesdays" checked>Wednesdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Wednesdays">Wednesdays</label></div>';
        if($weekdays->thursday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Thursdays" checked>Thursdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Thursdays">Thursdays</label></div>';
        if($weekdays->friday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Fridays" checked>Fridays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Fridays">Fridays</label></div>';    
        if($weekdays->saturday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Saturdays" checked>Saturdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Saturdays">Saturdays</label></div>';
    }
        
        
?>