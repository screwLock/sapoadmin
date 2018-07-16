var categories = [];
var sizes = [];
//load categories from the database while page is loading
jQuery.ajax({
    type:"POST",
    url: categories_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_categories'
    },
    success: function (response) {
        response.data.map(function(oldCategory){
            categories.push(createNewCategory(oldCategory.category, oldCategory.description));
            jQuery("#saved-categories").append(addCategoryEntry(oldCategory)).hide().show('slow');
        }); 
    },
    error: function(error){
       // console.log('error');
    }
});

//load sizes from the database while page is loading
jQuery.ajax({
    type:"POST",
    url: categories_ajax.ajax_url,
    dataType: 'json',
    data: {
        action: 'get_sizes'
    },
    success: function (response) {
        response.data.map(function(oldSize){
            sizes.push(createNewSize(oldSize.name, oldSize.description));
            jQuery("#saved-sizes").append(addSizeEntry(oldSize)).hide().show('slow');
        }); 
    },
    error: function(error){
       // console.log('error');
    }
});

jQuery(window).load(function(){

    jQuery('#add-category-button').on('click', function(e) {
        e.preventDefault();
        var categoryName = jQuery("#add-category").val();
        var categoryDescription = jQuery("#category-description").val();
        if(categoryName && !doesPropertyExist(categoryName, "name", categories)){
            var newCategory = createNewCategory(categoryName,categoryDescription);
            categories.push(newCategory);
            jQuery.ajax({
                type:"POST",
                url: categories_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'save_category',
                    new_category: newCategory
                },
                success: function (response) {
                    jQuery("#saved-categories").append(addCategoryEntry(newCategory)).hide().show('slow');
                    console.log(response.data);
                },
                error: function(xhr, error, status){
                    console.log(error);
                }
            });
        }
    });

    jQuery('#add-size-button').on('click', function(e) {
        e.preventDefault();
        var sizeName = jQuery("#size-name").val();
        var sizeDescription = jQuery("#size-description").val();
        if(sizeName && !doesPropertyExist(sizeName, "name", sizes)){
            var newSize = createNewSize(sizeName,sizeDescription);
            sizes.push(newSize);
            jQuery.ajax({
                type:"POST",
                url: categories_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'save_size',
                    new_size: newSize
                },
                success: function (response) {
                    jQuery("#saved-sizes").append(addSizeEntry(newSize)).hide().show('slow');
                    console.log(response.data);
                },
                error: function(xhr, error, status){
                    console.log(error);
                }
            });
        }
    });

    //event listener and AJAX for the delete button
    //on the saved categories table
    jQuery('#delete-categories').on('click', function(e){
        e.preventDefault();
        if(getCheckedCategories().length >= 1){
            jQuery.ajax({
                type:"POST",
                url: categories_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'delete_category',
                    categoriesToRemove: getCheckedCategories()
                },
                success: function (response) {
                    console.log(response);
                    if(response.success === true){
                        jQuery('input[name="saved-category-cb"]:checked').each(function(){
                            var target = jQuery(this).closest("tr");
                            target.fadeOut(500, function(){jQuery(this).remove()});
                                categories = deleteCategories (jQuery(this).val(), categories);
                        });
                    }
                    else
                    console.log("there was an error");
                },
                error: function(xhr, status, error){
                     console.log(status);
                }
            });
        }
    }); 
    //event listener and AJAX for the delete button
    //on the saved sizes table
    jQuery('#delete-sizes').on('click', function(e){
        e.preventDefault();
        if(getCheckedSizes().length >= 1){
            jQuery.ajax({
                type:"POST",
                url: categories_ajax.ajax_url,
                dataType: 'json',
                data: {
                    action: 'delete_size',
                    sizesToRemove: getCheckedSizes()
                },
                success: function (response) {
                    console.log(response);
                    if(response.success === true){
                        jQuery('input[name="saved-size-cb"]:checked').each(function(){
                            var target = jQuery(this).closest("tr");
                            target.fadeOut(500, function(){jQuery(this).remove()});
                                sizes = deleteSizes (jQuery(this).val(), sizes);
                        });
                    }
                    else
                    console.log("there was an error");
                },
                error: function(xhr, status, error){
                     console.log(status);
                }
            });
        }
    }); 
});//end of window load

function createNewCategory(name, description = ''){
    var newCategory = {
        name: name,
        description: description
    };
    return newCategory;
}

function createNewSize(name, description = '', priority){
    var newSize = {
        name: name,
        description: description,
        priority: priority
    };
    return newSize;
}

function createNewLocationDetails(stairs = 0, movingOut = 0, yardSale = 0, estateAuction = 0){
    var newCategory = {
        stairs: stairs,
        movingOut: movingOut,
        yardSale: yardSale,
        estateAuction: estateAuction
    };
    return newLocationDetails;
}

function deleteCategories(categoryName, categoryArray){
    return categoryArray.filter(function(category){
            return category.name !== categoryName;
        });
}

function addCategoryEntry(category){
    var newEntry =      '<tr>' +
                        '<td>' + category.name + '</td>' +
                        '<td>' + category.description + '</td>' + '<td>' +
                        '<div class="form-check"><label class="form-check-label">' +
                        '<input class="form-check-input"type="checkbox" name="saved-category-cb" value=' + category.name + '>Delete</label></div></td>'+  
                        '</tr>';
                          
    return newEntry;
}

function getCheckedCategories(){
    return jQuery('input[name="saved-category-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

function getCheckedSizes(){
    return jQuery('input[name="saved-size-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}

function deleteSizes(sizeName, sizeArray){
    return sizeArray.filter(function(size){
            return size.name !== sizeName;
        });
}

function addSizeEntry(size){
    var newEntry =      '<tr>' +
                        '<td>' + size.name + '</td>' +
                        '<td>' + size.description + '</td>' + '<td>' +
                        '<div class="form-check"><label class="form-check-label">' +
                        '<input class="form-check-input"type="checkbox" name="saved-size-cb" value=' + size.name + '>Delete</label></div></td>'+  
                        '</tr>';
                          
    return newEntry;
}

function getCheckedSize(){
    return jQuery('input[name="saved-size-cb"]:checked').map(function(){
                        return jQuery(this).val();
                         }).get();
}



/**
 * Determines if the input matches a property of an object
 * within an array of objects.  Returns true if match found
 */

function doesPropertyExist(property, objectProperty, objectArray){
    if(!Array.isArray(objectArray) || !objectArray.length) {
        return false;
    }
    var match = false;
    objectArray.forEach(function(object){
        if(match === false)
            match = (property === object[objectProperty]);
    })
    return match;
}