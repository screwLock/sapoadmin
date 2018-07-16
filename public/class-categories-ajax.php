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
                    'category' => $category['name'],
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
 }