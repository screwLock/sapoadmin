<?php

/**
 * The file that defines the drivers ajax functionality.
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
 * All Ajax code for the drivers page should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */

 class EmployeesAjax{

    public function save_employee(){
        global $wpdb;
        $employees_table = $wpdb->prefix . 'sapo_employees';
        $employee = $_POST['new_employee'];
       
        $status = 
            $wpdb->replace( 
                $employees_table, 
                array( 
                    'first_name' => $employee['firstName'],
                    'last_name' => $employee['lastName'],
                    'middle_initial' => $employee['middleInitial'],
                    'email' => $employee['email'],
                    'access_level' => $employee['accessLevel'],
                    'phone_number' => $employee['phoneNumber'],
                    'employee_password' =>$employee['password'],
                    'employee_id' => $employee['id'],
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
                    '%s',
                    '%s',
                    '%d' 
                ) 
            );


        wp_send_json_success($status); 
    }


    public function save_driver(){
        global $wpdb;
        $drivers_table = $wpdb->prefix . 'sapo_drivers';
        $driver = $_POST['new_driver'];
        
        $status = 
            $wpdb->replace( 
                $drivers_table, 
                array( 
                    'first_name' => $driver['firstName'],
                    'last_name' => $driver['lastName'],
                    'middle_initial' => $driver['middleInitial'],
                    'email' => $driver['email'],
                    'access_level' => $driver['accessLevel'],
                    'phone_number' => $driver['phoneNumber'],
                    'driver_password' => $driver['password'],
                    'driver_number' => $driver['id'],
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
                    '%s',
                    '%s',
                    '%d' 
                ) 
            );


        wp_send_json_success($status); 
    }
 }