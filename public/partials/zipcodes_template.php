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

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Add New Zipcodes</h5>
        <form>
                <div class="form-group row">
                    <div class="col-4">
                        <label class="sr-only" for="inlineFormInput">New Zipcode</label>
                        <input type="text" class="form-control" id="add-zipcode" placeholder="Enter a zipcode">
                    </div>
                </div>
                <h5 class="card-title">Select Days For Zipcode</h5>
                <div class="form-group row weekday-checkbox">
                        <?php get_weekdays() ?>
                </div>
        </form>
    </div>
</div>