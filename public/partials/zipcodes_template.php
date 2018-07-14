<?php

/**
 * The view for the zipcodes page
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public/partials
 */

?>

<?php require_once plugin_dir_path( __FILE__ ) . 'get_weekdays.php'; ?>

<div class="card">
    <div class="card-body pb-2">
        <h5 class="card-title">Add New Zipcodes</h5>
        <form>
                <div class="form-group row">
                    <div class="col-4">
                        <label class="sr-only" for="inlineFormInput">New Zipcode</label>
                        <input type="text" class="form-control" id="add-zipcode" placeholder="Enter a zipcode">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" id="add-zipcode-button"><strong>+</strong> Add</button>
                    </div>
                </div>
                <h5 class="card-title pb-2">Select Days For Zipcode</h5>
                <div class="form-group row weekday-checkbox">
                    <div class="col">
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="sunday">Sundays</label></div>
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="monday">Mondays</label></div>
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="tuesday">Tuesdays</label></div>
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="wednesday">Wednesdays</label></div>
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="thursday">Thursdays</label></div>
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="friday">Fridays</label></div>
                    <div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="saturday">Saturdays</label></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <h5 class="pb-2">Enable Same Day Pickups For This Zipcode?</h5>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary btn-sm"><input type="radio" name="max-time-enabled" id="max-time-on" value="1" autocomplete="off" checked>On</label>
                            <label class="btn btn-primary active btn-sm"><input type="radio" name="max-time-enabled" id="max-time-off" value="0" autocomplete="off" checked> Off</label>
                        </div>
                    </div>
                </div>
                <div id="max-time-select">
                    <h5 class="card-title pb-2">Select Max Time For Same Day Pickup</h5>
                    <div class="form-group row">
                        <div class="col-2">
                            <label class="sr-only" for="inlineFormInput">Select Max Time</label>
                            <input type="text" class="form-control" id="max-time">
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div> <!--End of Zipcodes Card -->

<div class="container-fluid pt-2">
<h5 class="p-2">Saved Zipcodes</h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Zipcode</th>
                <th scope="col">Days</th>
                <th scope="col">Max Time</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td><button class="btn btn-primary" id="delete-zipcodes">Delete</button></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
        <tbody id="saved-zipcodes">
        </tbody>
    </table>
</div>