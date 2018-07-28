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

<nav class="navbar fixed-top navbar-light bg-light">
    <a class="navbar-brand" href="#">SAPO</a>
</nav>

<div id="sapo-sidebar" class="sidenav border-right">
  <a href="./zipcodes">Zipcodes</a>
  <a href="./blackout-dates">Blackout Dates</a>
  <a href="./categories">Categories</a>
  <a href="./employees">Employees</a>
  <a href="./emails">Emails</a>
</div>

<div class="main">
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
                            <label class="sr-only" for="employee-first-name-input">First Name</label>
                            <input type="text" class="form-control" id="employee-first-name" aria-describedby="employee-first-name" placeholder="First Name" maxlength=10>
                        </div>
                        <div class="col-3">
                            <label class="sr-only" for="employee-last-name-input">Last Name</label>
                            <input type="text" class="form-control" id="employee-last-name" aria-describedby="employee-last-name" placeholder="Last Name" maxlength=10>
                        </div>
                        <div class="col-1">
                            <label class="sr-only" for="employee-middle-name-input">Middle Initial</label>
                            <input type="text" class="form-control" id="employee-middle-initial" aria-describedby="employee-middle-initial" placeholder="MI" maxlength=1 size="1">
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="employee-email-input">E-mail</label>
                            <input type="email" class="form-control" id="employee-email" aria-describedby="employee-email" placeholder="Email" maxlength=15>
                        </div>
                        <div class="col-3">
                            <label class="sr-only" for="employee-phone-input">Phone Number</label>
                            <input type="text" class="form-control" id="employee-phone-number" aria-describedby="employee-phone-number" placeholder="Phone Number" maxlength=10>
                        </div>
                    </div>      
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="employee-number-input">Employee Number</label>
                            <input type="text" class="form-control" id="employee-number" aria-describedby="employee-number" placeholder="Employee Number" maxlength=10>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="employee-password-input">Password</label>
                            <input type="password" class="form-control" id="employee-password" aria-describedby="employee-password" placeholder="Password" maxlength=10>
                        </div>
                        <div class="col-3">
                            <label class="sr-only" for="employee-repeat-password-input">Repeat Password</label>
                            <input type="password" class="form-control" id="employee-repeat-password" aria-describedby="employee-repeat-password" placeholder="Repeat Password" maxlength=10>
                        </div>
                        <div class = "col-2">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="access-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Access Level
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-value = 2>Employee</a>
                                    <a class="dropdown-item" href="#" data-value = 1>Admin</a>
                                    <a class="dropdown-item" href="#" data-value = 3>Supervisor</a>
                                    <a class="dropdown-item" href="#" data-value = 4>Contractor</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <label class="sr-only" for="add-employee-button">Save Employee Button</label>
                            <button class="btn btn-primary" id="add-employee-button">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End of Employees card -->
        <div class="card">
            <div class="card-body">
            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#employees-table-collapse" aria-expanded="false" aria-controls="collapseExample">
            Current Employees <i class="fa fa-chevron-down"></i></button>
            <div class="collapse" id = "employees-table-collapse">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Employee</th>
                            <th scope="col">Access Level</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><button class="btn btn-primary btn-sm" id="delete-employees-button">Delete</button></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    <tbody id="current-employees">
                    </tbody>
                </table>
            </div><!-- end of div .collapse -->
            </div>
        </div><!-- End of Table Tab -->
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
                            <input type="email" class="form-control" id="driver-email" aria-describedby="driver-email" placeholder="Email" maxlength=15>
                        </div>
                        <div class="col-3">
                            <label class="sr-only" for="driver-phone-number-input">Phone Number</label>
                            <input type="text" class="form-control" id="driver-phone-number" aria-describedby="driver-phone-number" placeholder="Phone Number" maxlength=15>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="driver-number-input">Truck Number</label>
                            <input type="text" class="form-control" id="driver-truck-number" aria-describedby="driver-truck-number" placeholder="Truck Number" maxlength=10>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <div class="col-3">
                            <label class="sr-only" for="driver-phone-input">Password</label>
                            <input type="text" class="form-control" id="driver-password" aria-describedby="driver-password" placeholder="Password" maxlength=10>
                        </div>
                        <div class="col-3">
                            <label class="sr-only" for="truck-repeat-password-input">Repeat Password</label>
                            <input type="password" class="form-control" id="truck-repeat-password" aria-describedby="truck-repeat-password" placeholder="Repeat Password" maxlength=10>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary" id="add-driver-button">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End of Trucks card -->
        <div class="card">
            <div class="card-body">
            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#drivers-table-collapse" aria-expanded="false" aria-controls="collapse-drivers">
            Current Drivers <i class="fa fa-chevron-down"></i></button>
            <div class="collapse" id = "drivers-table-collapse">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Driver</th>
                            <th scope="col">Access Level</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><button class="btn btn-primary btn-sm" id="delete-drivers-button">Delete</button></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    <tbody id="current-drivers">
                    </tbody>
                </table>
            </div><!-- end of div .collapse -->
            </div>
        </div><!-- End of Table Tab -->
    </div><!-- End of Trucks tab -->
</div><!-- End of Tabs -->

/<div><!-- End of main -->