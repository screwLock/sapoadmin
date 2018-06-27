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

<div class="alert alert-warning" id="date-present-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Error</strong>
    :Date Already Added 
</div>


<div class="container">
    <div class="form-row">
        <div class="form-group col-xs-2">
            <input type="text" class="form-control" id="blackout-dates">
        </div>
        <div class="input-group col-xs-4">
            <input type="text" class="form-control" id="reason">
            <span class="input-group-btn"><button  class="btn btn-default" id="add-date-button"><i class="glyphicon glyphicon-plus-sign"></i></button></span>  
        </div>
    </div>
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

