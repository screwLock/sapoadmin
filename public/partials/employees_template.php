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

<div class="loading-page"></div>
<nav id="sapo-nav">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-employees-tab" data-toggle="tab" href="#nav-employees" role="tab" aria-controls="nav-employees" aria-selected="true">Employees</a>
    <a class="nav-item nav-link" id="nav-truck-drivers-tab" data-toggle="tab" href="#nav-truck-drivers" role="tab" aria-controls="nav-truck-drivers" aria-selected="false">Truck Drivers</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-employees" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Register a New Employee</h5>
                <form>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="employee-name-input">First Name</label>
                            <input type="text" class="form-control" id="employee-name" aria-describedby="employee-name" placeholder="First Name" maxlength=10>
                        </div>
                        <div class="col-3">
                            <label class="sr-only" for="employee-name-input">Last Name</label>
                            <input type="text" class="form-control" id="employee-name" aria-describedby="employee-name" placeholder="Last Name" maxlength=10>
                        </div>
                        <div class="col-1">
                            <label class="sr-only" for="employee-name-input">Middle Initial</label>
                            <input type="text" class="form-control" id="employee-name" aria-describedby="employee-name" placeholder="MI" maxlength=1 size="1">
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="employee-email-input">E-mail</label>
                            <input type="email" class="form-control" id="employee" aria-describedby="employee-email" placeholder="Employee Email" maxlength=15>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="employee-number-input">Employee Number</label>
                            <input type="number" class="form-control" id="employee-number" aria-describedby="employee-number" placeholder="Employee Number" maxlength=10>
                        </div>
                        <div class="col-3">
                            <label class="sr-only" for="employee-phone-input">Phone Number</label>
                            <input type="text" class="form-control" id="employee-phone-number" aria-describedby="employee-phone-number" placeholder="Employee Phone Number" maxlength=10>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary" id="add-employee-button">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End of Employees card -->
    </div><!-- End of Employees Tab-->

    <div class="tab-pane fade" id="nav-truck-drivers" role="tabpanel" aria-labelledby="nav-trucks-tab">
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
                            <input type="text" class="form-control" id="driver-middle-name" aria-describedby="driver-middle-name" placeholder="MI" maxlength=1 size="1">
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="driver-email-input">E-mail</label>
                            <input type="email" class="form-control" id="driver-email" aria-describedby="driver-email" placeholder="Driver Email" maxlength=15>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="driver-email-input">Truck Number</label>
                            <input type="number" class="form-control" id="driver-truck-number" aria-describedby="driver-truck-number" placeholder="Truck Number" maxlength=10>
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
        </div><!-- End of Trucks card -->
    </div><!-- End of Trucks tab -->
</div><!-- End of Tabs -->