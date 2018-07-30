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

    public function get_employees(){
        global $wpdb;
        $employees_table = $wpdb->prefix . 'sapo_employees';
        $employees = $wpdb->get_results("SELECT first_name,last_name,middle_initial,access_level,phone_number,employee_password,employee_id,email FROM " . $employees_table . 
        " WHERE USER_ID = " . get_current_user_id());


        wp_send_json_success($employees);
    }

    public function get_drivers(){
        global $wpdb;
        $drivers_table = $wpdb->prefix . 'sapo_drivers';
        $drivers = $wpdb->get_results("SELECT first_name,last_name,middle_initial,access_level,phone_number,driver_number,email FROM " . $drivers_table . 
        " WHERE USER_ID = " . get_current_user_id());


        wp_send_json_success($drivers);
    }

    public function delete_employee(){
        global $wpdb;
        $employees_table = $wpdb->prefix . 'sapo_employees';
        $employees = array();
        forEach($_POST['employeesToRemove'] as $employee)
            array_push($employees, $employee);

        $employees = "'" .implode("','", $employees ) . "'"; 
        $isSuccess = $wpdb->query( 
            $wpdb->prepare( "DELETE FROM " . $employees_table . " WHERE email IN ($employees) AND user_id = %d", get_current_user_id())
        );

        wp_send_json_success();
    }
    
    public function delete_driver(){
        global $wpdb;
        $drivers_table = $wpdb->prefix . 'sapo_drivers';
        $drivers = array();
        forEach($_POST['driversToRemove'] as $driver)
            array_push($drivers, $driver);

        $drivers = "'" .implode("','", $drivers ) . "'"; 
        $isSuccess = $wpdb->query( 
            $wpdb->prepare( "DELETE FROM " . $drivers_table . " WHERE email IN ($drivers) AND user_id = %d", get_current_user_id())
        );

        wp_send_json_success($isSuccess);
    }
 }