<?php


function install_sapo_data_confirmation() {
    
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

