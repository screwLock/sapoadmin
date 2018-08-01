<?php

/**
 * The file that defines the ajax functionality for logging out.
 *
 * A class definition for registering new donors
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 */

/**
 * All logout code for sapo site should be included here.
 * 
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 * 
 */

 class LogoutAjax{
     
    public function logout(){
        require_once plugin_dir_path( __FILE__ ) . 'redirect.php'; 

        session_start();
        session_destroy();
        redirect('/user-registration');
        //echo wp_logout_url("./user-registration");
        wp_send_json_success();
    }
 }