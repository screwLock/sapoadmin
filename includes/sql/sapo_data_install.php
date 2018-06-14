<?php

/**
 * A series of methods for installing data into the SAPO database tables
 * 
 * @package SapoAdmin
 * @author Travus Helmly
 *  
 */

/**
* Install the data into the confirmation table 
*/
function install_sapo_data_confirmation() {
    require_once plugin_dir_path( __FILE__ ) . 'wp_insert_rows.php';
    global $wpdb;
    $confirmation_status_table = $wpdb->prefix . "sapo_confirmation_status";
    $insert_arrays = array();
    
    $insert_arrays[0] = array(
        'status' => "Yes"
    );

    $insert_arrays[1] = array(
        'status' => "No"
    );

    wp_insert_rows($insert_arrays, $confirmation_status_table);
}


/**
* All data install functions should be called here
*/
function sapo_install_all_data(){
    install_sapo_data_confirmation();
}