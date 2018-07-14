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
                <h5 class="card-title">Select Days For Zipcode</h5>
                <div class="form-group row weekday-checkbox">
                        <?php get_weekdays() ?>
                </div>
        </form>
    </div>
</div>