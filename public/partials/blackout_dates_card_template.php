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
        <label class="radio-inline"><input type="radio" name="dateradio" value="week-day-radio">Week Days</label>
    </div>
</div>

<div class="container" id="single-date">
    <form class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" id="blackout-dates">
        </div>
        <div class="input-group">
            <input type="text" class="form-control" id="reason" placeholder="Reason">
            <span class="input-group-btn"><button class="btn btn-default" id="add-date-button"><i class="glyphicon glyphicon-plus-sign"></i></button></span>  
        </div>
    </form>
</div>



<div class="container" id="range-dates">
    <form class="form-inline">
        <div class="input-group input-daterange">
            <input type="text" class="form-control">
            <input type="text" class="form-control">
        </div>
    </form>
</div>

<div class="container" id="weekdays">
    <label class="checkbox-inline"><input type="checkbox" value="">Sundays</label>
    <label class="checkbox-inline"><input type="checkbox" value="">Mondays</label>
    <label class="checkbox-inline"><input type="checkbox" value="">Tuesdays</label>
    <label class="checkbox-inline"><input type="checkbox" value="">Wednesdays</label> 
    <label class="checkbox-inline"><input type="checkbox" value="">Thursdays</label>
    <label class="checkbox-inline"><input type="checkbox" value="">Fridays</label>
    <label class="checkbox-inline"><input type="checkbox" value="">Saturdays</label>
</div>


<div class="alert alert-warning" id="date-present-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    Date Already Added
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
    <div class="panel-footer"><button class="btn btn-default" id="panel-submit">Submit</button></div>
    </div>
</div>

