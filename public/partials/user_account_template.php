<?php

/**
 * The view for the user account page
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
  <a class="nav-item nav-link active" id="nav-new-pickup-tab" data-toggle="tab" href="#nav-new-pickup" role="tab" aria-controls="nav-new-pickup" aria-selected="true">New Pickup</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</a>
    <a class="nav-item nav-link" id="nav-pickup-history-tab" data-toggle="tab" href="#nav-pickup-history" role="tab" aria-controls="nav-pickup-history" aria-selected="false">Previous Pickups</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-new-pickup" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Select The Pickup Zipcode</h5>
                <select class="custom-select class col-2" id="zipcode-select">
                    <option selected>Select a Zipcode</option>
                </select>
            </div>
        </div><!-- End of my-account card-->
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Select The Pickup Date</h5>
                <form>
                    <div class="form-group row">
                        <div class="col-2">
                            <label class="sr-only" for="inlineFormInput">Pickup Datepicker</label>
                            <input type="text" class="form-control" id="pickup-datepicker">
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End of my-account card-->
    </div><!-- End of my-account tab-->

    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-account-tab">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Profile</h5>
            </div>
        </div><!-- End of my-account card-->
    </div><!-- End of my-account tab-->

    <div class="tab-pane fade" id="nav-pickup-history" role="tabpanel" aria-labelledby="nav-pickup-history">
    <div class="card">
            <div class="card-body">
            <h5 class="card-title">Previous Pickups</h5>
            </div>
        </div><!-- End of my-account card-->
    </div><!-- End of pickup history tab-->
</div><!--End of tab-content -->