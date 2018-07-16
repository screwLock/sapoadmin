var categories = [];
var sizes = [];

jQuery(window).load(function(){

    jQuery('#add-category-button').on('click', function(e) {
        e.preventDefault();
        var categoryName = jQuery("#add-category").val();
        if(categoryName && !doesPropertyExist(categoryName, "name", categories)){
            var newCategory = createNewCategory(categoryName);
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
});

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
                        '<input class="form-check-input"type="checkbox" name="saved-categories-cb" value=' + category.name + '>Delete</label></div></td>'+  
                        '</tr>';
                          
    return newEntry;
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