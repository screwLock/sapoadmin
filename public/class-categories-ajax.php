<?php

/**
 * The file that defines the category ajax functionality.
 *
 * A class definition that includes ajax functionality
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 */

/**
 * All Ajax code for the category page should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */

 class CategoriesAjax {

    public function save_category(){
        global $wpdb;
        $categories_table = $wpdb->prefix . 'sapo_categories';
        $category = $_POST['new_category'];
        
        $status = 
            $wpdb->insert( 
                $categories_table, 
                array( 
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'user_id' => get_current_user_id() 
                ), 
                array( 
                    '%s', 
                    '%s',
                    '%d' 
                ) 
            );


        wp_send_json_success($status);
    }

    public function save_size(){
        global $wpdb;
        $sizes_table = $wpdb->prefix . 'sapo_sizes';
        $size = $_POST['new_size'];
        
        $status = 
            $wpdb->insert( 
                $sizes_table, 
                array( 
                    'name' => $size['name'],
                    'description' => $size['description'],
                    'user_id' => get_current_user_id() 
                ), 
                array( 
                    '%s', 
                    '%s',
                    '%d' 
                ) 
            );


        wp_send_json_success($status);
    }

    public function get_categories(){
        global $wpdb;
        $categories_table = $wpdb->prefix . 'sapo_categories';
        $categories = $wpdb->get_results("SELECT name, description FROM " . $categories_table . 
        " WHERE USER_ID = " . get_current_user_id());


        wp_send_json_success($categories);
    }

    public function get_sizes(){
        global $wpdb;
        $sizes_table = $wpdb->prefix . 'sapo_sizes';
        $sizes = $wpdb->get_results("SELECT name, description FROM " . $sizes_table . 
        " WHERE USER_ID = " . get_current_user_id());


        wp_send_json_success($sizes);
    }

    public function delete_category(){
        global $wpdb;
        $categories_table = $wpdb->prefix . 'sapo_categories';
        $categories = array();
        forEach($_POST['categoriesToRemove'] as $category)
            array_push($categories, $category);

        $categories = "'" .implode("','", $categories ) . "'"; 
        $isSuccess = $wpdb->query( 
            $wpdb->prepare( "DELETE FROM " . $categories_table . " WHERE name IN ($categories) AND user_id = %d", get_current_user_id())
        );

        wp_send_json_success($isSuccess);
    }
    
    public function delete_size(){
        global $wpdb;
        $sizes_table = $wpdb->prefix . 'sapo_sizes';
        $sizes = array();
        forEach($_POST['sizesToRemove'] as $size)
            array_push($sizes, $size);

        $sizes = "'" .implode("','", $sizes ) . "'"; 
        $isSuccess = $wpdb->query( 
            $wpdb->prepare( "DELETE FROM " . $sizes_table . " WHERE name IN ($sizes) AND user_id = %d", get_current_user_id())
        );

        wp_send_json_success($isSuccess);
    }

    public function save_location_details(){
        global $wpdb;
        $location_details_table=$wpdb->prefix . 'sapo_location_details';
        $location_details = $_POST['location_details'];
    }

 }