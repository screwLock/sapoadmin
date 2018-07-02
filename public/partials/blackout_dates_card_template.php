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
    <div class="btn-group" data-toggle="buttons" id="date-radio-buttons">
        <label class="radio-inline"><input type="radio" name="dateradio" value="single-date-radio" checked>Single Date</label>
        <label class="radio-inline"><input type="radio" name="dateradio" value="date-range-radio">Date Range</label>
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
    <div class="panel panel-default">
        <div class="panel-heading text-center">New Dates</div>
        <table class="table table-hover" id="new-date-table">
            <tbody>
                <tr>
                    <td class="date-to-be-disabled">Needs to be here but change content</td>
                    <td class="reason-to-be-disabled">Needs to be here but change content</td>
                    <td class="text-right text-nowrap"></td>
                </tr>
            </tbody>
        </table>
    <div class="panel-footer">
        <div id="weekday-checkbox">
            <label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Sundays">Sundays</label>
            <label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Mondays">Mondays</label>
            <label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Tuesdays">Tuesdays</label>
            <label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Wednesdays">Wednesdays</label> 
            <label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Thursdays">Thursdays</label>
            <label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Fridays">Fridays</label>
            <label class="checkbox-inline"><input type="checkbox" name="weekday-cb" value="Saturdays">Saturdays</label>
        </div>
        <div><button class="btn btn-primary" id="submit">Submit</button></div>
        </div>
    </div>
</div>

