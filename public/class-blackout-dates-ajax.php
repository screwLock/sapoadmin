<?php

/**
 * The file that defines the blackout dates ajax functionality.
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
 * All Ajax code for the blackout dates page should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */
class BlackoutDatesAjax {

    public function get_blackout_dates(){
        global $wpdb;
        $blackout_dates_array = array();
        $blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";

        $blackout_dates = $wpdb->get_results("SELECT blackout_date, reason, group_id FROM " . $blackout_dates_table . 
        " WHERE USER_ID = " . get_current_user_id() . " ORDER BY DATE(blackout_date)");

        //$blackout_dates = NULL;
        //Send error message if error with query
        if (is_null($blackout_dates) || !empty($wpdb->last_error)) wp_send_json_error();

        $index = 0;
        foreach($blackout_dates as $date){
            $blackout_dates_array[$index] = array(
                "date" => $date->blackout_date,
                "reason" => $date->reason,
                "groupID" => $date->group_id
            );
            $index++;
        }

        wp_send_json_success($blackout_dates_array);
    }

    public function delete_old_dates(){
        $groupID = array();
        if ( isset($_REQUEST) ) 
            $groupID = $_REQUEST['datesToRemove'];
        
        global $wpdb;
        $blackout_dates_array = array();
        $blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";

        //$blackout_dates = $wpdb->get_results("DELETE * FROM " . $blackout_dates_table . 
        //" WHERE USER_ID = " . get_current_user_id() . "AND groupID = " . );

        //Send error message if error with mysql
        if (is_null($blackout_dates) || !empty($wpdb->last_error)) wp_send_json_error();
        wp_send_json_success();    
    }

}
?>