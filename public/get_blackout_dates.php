<?php
    global $wpdb;
    $blackout_dates_array = array();
    $blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";

    $blackout_dates = $wpdb->get_results("SELECT blackout_date, reason, group_id FROM " . $blackout_dates_table . 
    " WHERE USER_ID = " . get_current_user_id() . " ORDER BY DATE(blackout_date)");

    $index = 0;
    foreach($blackout_dates as $date){
        $blackout_dates_array[$index] = array(
            "date" => $date->blackout_date,
            "reason" => $date->reason,
            "groupID" => $date->group_id
        );
        $index++;
    }

    echo json_encode($blackout_dates_array);
?>