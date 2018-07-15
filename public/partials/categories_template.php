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

<nav id="sapo-nav">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-categories-tab" data-toggle="tab" href="#nav-categories" role="tab" aria-controls="nav-categories" aria-selected="true">Categories</a>
    <a class="nav-item nav-link" id="nav-sizes-tab" data-toggle="tab" href="#nav-sizes" role="tab" aria-controls="nav-sizes" aria-selected="false">Sizes</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-categories" role="tabpanel" aria-labelledby="nav-home-tab">
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
        </div><!-- End of categories card -->
    </div><!--End of categories tab -->

    <div class="tab-pane fade" id="nav-sizes" role="tabpanel" aria-labelledby="nav-sizes-tab">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Describe Sizes</h5>
                <form>
                    <div class="form-group row pb-2">
                        <div class="col-4">
                            <label class="sr-only" for="size-input">Size Input</label>
                            <input type="text" class="form-control" id="size-input" aria-describedby="enter-size" placeholder="Describe a Size" maxlength=10>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-4">
                            <button class="btn btn-primary" id="add-size">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End of sizes card -->
    </div><!-- End of sizes tab -->

</div><!--End of tab content -->