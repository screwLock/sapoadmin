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

<div class="container"> 
    <div class="form-check form-check-inline">
        <label class="form-check-label"><input class="form-check-input" type="radio" name="dateradio" value="single-date-radio" checked>Single Date</label>
    </div>
    <div class="form-check form-check-inline">
        <label class="form-check-label"><input class="form-check-input" type="radio" name="dateradio" value="date-range-radio">Date Range</label>
    </div>
</div>

<div class="container" id="single-date">
    <form class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" id="blackout-dates-single">
            <input type="text" class="form-control" id="single-date-reason" placeholder="Reason">
            <span><button class="btn btn-primary" id="add-date-button"><strong>+</strong> Add</button></span>  
        </div>
    </form>
</div>


<div class="container" id="range-dates">
    <form class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" id="blackout-date-range-start" placeholder="Start Date">
            <input type="text" class="form-control" id="blackout-date-range-end" placeholder="End Date">
            <input type="text" class="form-control" id="date-range-reason" placeholder="Reason">
            <span><button class="btn btn-primary" id="add-date-range-button"><strong>+</strong> Add</button></span>  
        </div>
    </form>
</div>



<div class="alert alert-warning" id="date-present-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    Date Already Added
</div>

<div class="alert alert-warning" id="date-range-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    First Date Must Precede Second Selected Date
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
        <div id="weekday-checkbox"> 
           <?php get_weekdays(); ?>
        </div>
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
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Sundays">Sundays</label>';
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Mondays">Mondays</label>' ;
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Tuesdays">Tuesdays</label>';
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Wednesdays">Wednesdays</label>';
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Thursdays">Thursdays</label>';
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Fridays">Fridays</label>';
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Saturdays">Saturdays</label>';
            return;
        };
        
                                       
        //if there is data in the result set, render the checkboxes according to the results 
        if($weekdays->sunday)
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Sundays" checked>Sundays</label>';
        else   
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Sundays">Sundays</label>';
        if($weekdays->monday)
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Mondays" checked>Mondays</label>';
        else   
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Mondays">Mondays</label>';
        if($weekdays->tuesday)
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Tuesdays" checked>Tuesdays</label>';
        else   
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Tuesdays">Tuesdays</label>';
        if($weekdays->wednesday)
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Wednesdays" checked>Wednesdays</label>';
        else   
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Wednesdays">Wednesdays</label>';
        if($weekdays->thursday)
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Thursdays" checked>Thursdays</label>';
        else   
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Thursdays">Thursdays</label>';
        if($weekdays->friday)
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Fridays" checked>Fridays</label>';
        else   
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Fridays">Fridays</label>';    
        if($weekdays->saturday)
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Saturdays" checked>Saturdays</label>';
        else   
            echo '<label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Saturdays">Saturdays</label>';
    }
        
        
?>