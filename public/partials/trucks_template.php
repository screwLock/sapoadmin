<?php

/**
 * The functionality for the trucks page
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
    <h5 class="card-title">Register a New Truck Driver</h5>
        <form>
            <div class="form-group row pb-2">
                <div class="col-3">
                    <label class="sr-only" for="driver-first-name-input">First Name</label>
                    <input type="text" class="form-control" id="driver-first-name" aria-describedby="driver-first-name" placeholder="First Name" maxlength=10>
                </div>
                <div class="col-3">
                    <label class="sr-only" for="driver-last-name-input">Last Name</label>
                    <input type="text" class="form-control" id="driver-last-name" aria-describedby="driver-last-name" placeholder="Last Name" maxlength=10>
                </div>
                <div class="col-1">
                    <label class="sr-only" for="driver-middle-name-input">Middle Initial</label>
                    <input type="text" class="form-control" id="driver-middle-name" aria-describedby="driver-middle-name" placeholder="MI" maxlength=2>
                </div>
            </div>
            <div class="form-group row pb-2">
                <div class="col-3">
                    <label class="sr-only" for="driver-email-input">E-mail</label>
                    <input type="text" class="form-control" id="driver-email" aria-describedby="driver-email" placeholder="Driver Email" maxlength=15>
                </div>
            </div>
            <div class="form-group row pb-2">
                <div class="col-3">
                    <label class="sr-only" for="driver-email-input">Driver Number</label>
                    <input type="text" class="form-control" id="driver-number" aria-describedby="driver-number" placeholder="Driver Number" maxlength=10>
                </div>
                <div class="col-3">
                    <label class="sr-only" for="driver-phone-input">Phone Number</label>
                    <input type="text" class="form-control" id="driver-phone-number" aria-describedby="driver-phone-number" placeholder="Driver Phone Number" maxlength=10>
                </div>
                <div class="col-4">
                        <button class="btn btn-primary" id="add-driver-button">Save</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- End of Pickup Information card -->