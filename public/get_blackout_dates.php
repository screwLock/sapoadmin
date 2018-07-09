<?php
    global $wpdb;
    $blackout_dates_array = array();
    $blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";

    $blackout_dates = $wpdb->get_results("SELECT blackout_date, reason, group_id FROM " . $blackout_dates_table . 
    " WHERE USER_ID = " . get_current_user_id() . " ORDER BY DATE(blackout_date)");

    foreach($blackout_dates as $date){
        $blackout_dates_array['date'][] = $date->blackout_date;
        $blackout_dates_array['reason'][] = $date->reason;
        $blackout_dates_array['groupID'][] = $date->group_id;
    }

    echo json_encode($blackout_dates_array);
?>