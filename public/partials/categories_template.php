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
    <a class="nav-item nav-link" id="nav-location-details-tab" data-toggle="tab" href="#nav-location-details" role="tab" aria-controls="nav-location-details" aria-selected="false">Location Details</a>
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
                            <label class="sr-only" for="category-input">Add Category</label>
                            <input type="text" class="form-control" id="add-category" aria-describedby="enter-category" placeholder="Enter A Name" maxlength=20>
                        </div>
                        <div class="col-4">
                            <label class="sr-only" for="size-input">Category Description</label>
                            <input type="text" class="form-control" id="category-description" aria-describedby="describe-category" placeholder="Describe The Category" maxlength=100>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-4">
                            <button class="btn btn-primary" id="add-category-button">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End of categories card -->
        <div class="container-fluid pt-2">
            <h5 class="p-2">Saved Categories</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td><button class="btn btn-primary" id="delete-categories">Delete</button></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
                <tbody id="saved-categories">
                </tbody>
            </table>
        </div>
    </div><!--End of categories tab -->

    <div class="tab-pane fade" id="nav-sizes" role="tabpanel" aria-labelledby="nav-sizes-tab">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Create New Sizes</h5>
                <form>
                    <div class="form-group row pb-2">
                        <div class="col-4">
                            <label class="sr-only" for="size-input">Create A Size</label>
                            <input type="text" class="form-control" id="size-name" aria-describedby="name-size" placeholder="Name a size" maxlength=10>
                        </div>
                        <div class="col-4">
                            <label class="sr-only" for="size-input">Size Description</label>
                            <input type="text" class="form-control" id="size-description" aria-describedby="describe-size" placeholder="Describe a Size" maxlength=100>
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
        <div class="container-fluid pt-2">
            <h5 class="p-2">Saved Sizes</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Size</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td><button class="btn btn-primary" id="delete-sizes">Delete</button></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
                <tbody id="saved-sizes">
                </tbody>
            </table>
        </div>
    </div><!-- End of sizes tab -->

    <div class="tab-pane fade" id="nav-location-details" role="tabpanel" aria-labelledby="nav-location-details-tab">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Specify Location Details</h5>
                <form>
                    <div class="form-group row">
                        <div class="col">
                            <h6 class="pb-2">Will There Be Stairs Involved? (Yes/No) How Many Flights?</h6>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active btn-sm"><input type="radio" name="stairs-radio" id="stairs-off" autocomplete="off" checked> Off</label>
                                <label class="btn btn-primary btn-sm"><input type="radio" name="stairs-radio" id="stairs-on" autocomplete="off"> On</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <h6 class="pb-2">Are You Moving Out? (Yes/No)</h6>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active btn-sm"><input type="radio" name="Move-radio" id="Move-off" autocomplete="off" checked> Off</label>
                                <label class="btn btn-primary btn-sm"><input type="radio" name="Move-radio" id="Move-on" autocomplete="off"> On</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <h6 class="pb-2">Is This Part of A Yard Sale (Yes/No) End Time?</h6>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active btn-sm"><input type="radio" name="yard-radio" id="yard-off" autocomplete="off" checked> Off</label>
                                <label class="btn btn-primary btn-sm"><input type="radio" name="yard-radio" id="yard-on" autocomplete="off"> On</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <h6 class="pb-2">Is This Part of An Estate Auction (Yes/No) End Time?</h6>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active btn-sm"><input type="radio" name="estate-radio" id="estate-off" autocomplete="off" checked> Off</label>
                                <label class="btn btn-primary btn-sm"><input type="radio" name="estate-radio" id="estate-on" autocomplete="off"> On</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div><!--End of tab content -->