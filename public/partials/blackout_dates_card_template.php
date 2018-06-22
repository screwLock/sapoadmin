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
<div class="form-group row">
    <div class="col-xs-2">
        <div class="input-group">
        <input type="text" class="form-control" id="blackout-dates">
        <span class="input-group-btn">
        <button  class="btn btn-default" id="add-date-button"><i class="glyphicon glyphicon-plus-sign"></i></button>
        </span>  
        </div>
    </div>
</div>
</div>

<div class="container">

<div class="panel panel-default">
    <div class="panel-heading text-center">New Dates</div>
    <table class="table table-hover" id="new-date-table">
    <tbody>
      <tr>
        <td class="date-to-be-disabled">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
        <td class="text-right text-nowrap">
          <button class="btn btn-xs btn-warning">
            <span class="glyphicon glyphicon-trash" id="remove-date-button"></span>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</div>

