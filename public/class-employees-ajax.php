<?php

/**
 * The file that defines the trucks ajax functionality.
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
 * All Ajax code for the trucks page should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */

 class TrucksAjax{

    public function save_employee(){
        wp_send_json_success();
        global $wpdb;
        $sizes_table = $wpdb->prefix . 'sapo_sizes';
        $employee = $_POST['new_employee'];
        
        $status = 
            $wpdb->replace( 
                $sizes_table, 
                array( 
                    'first_name' => $employee['firstName'],
                    'last_name' => $employee['lastName'],
                    'middle_initial' => $employee['MiddleInitial'],
                    'email' => $employee['email'],
                    'access' => $employee['access'],
                    'phone_number' => $employee['phoneNumber'],
                    //get_current_user_org
                    'user_id' => get_current_user_id() 
                ), 
                array( 
                    '%s', 
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%d' 
                ) 
            );


        wp_send_json_success($status); 
    }
 }