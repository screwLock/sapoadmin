<?php

/**
 * The view for the categories page
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
    <h5 class="card-title">Add New Categories</h5>
        <form>
            <div class="form-group row pb-2">
                <div class="col-4">
                    <label class="sr-only" for="category-input">Category Input</label>
                    <input type="text" class="form-control" id="category-input" aria-describedby="enter-category" placeholder="Enter A Category" maxlength=20>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-4">
                    <button class="btn btn-primary" id="add-category">Save</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- End of weekdays card -->