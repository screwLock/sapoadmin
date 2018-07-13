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
        $groupIDs = array();
        forEach($_POST['datesToRemove'] as $id)
            array_push($groupIDs, $id);

        $groupIDs = "'" .implode("','", $groupIDs  ) . "'"; 

        global $wpdb;
        $blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";
        
        $isSuccess = $wpdb->query( 
            $wpdb->prepare( "DELETE FROM " . $blackout_dates_table . " WHERE group_id IN ($groupIDs) AND user_id = %d", get_current_user_id())
        );
        
        //Send error message if error with mysql
        //if (is_null($isSuccess) || !$isSuccess) wp_send_json_error();
        wp_send_json_success($isSuccess);    
    }

    public function add_new_dates(){
        global $wpdb;
        $blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";
        $newDates = array();
        $index = 0;
        forEach($_POST['new_dates'] as $date){
            $qReason= "'" . esc_sql($date['reason']) . "'";
            $qDate = sprintf("STR_TO_DATE('%s', '%s')", $date['date'], "%Y-%m-%d");
            $values = $qDate . ',' . $qReason . ', ' . "'" . $date['groupID'] . "'" . ', ' . get_current_user_id();
            $q1 = sprintf("REPLACE INTO %s (%s, %s, %s, %s) ", $blackout_dates_table, 'blackout_date', 'reason', 'group_id', 'user_id');
            $q2 = sprintf("VALUES (%s)", $values);
            $newDates[$index] = ($q1 . $q2);
            $wpdb->query($newDates[$index]);

            $index++;
        }

        wp_send_json_success();
    }

    public function save_disabled_weekdays(){
        global $wpdb;
        $blackout_weekdays_table = $wpdb->prefix . "sapo_blackout_weekdays";
        $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $values = ""; 
        $columns = "";

        //If a day of the week is found within the 
        //dayys of the post, insert a 1.  Otherwise
        //insert 0
        forEach($daysOfWeek as $key=>$weekday){
            $columns .= vsprintf(",%s", $weekday);
            if(in_array($weekday, $_POST['weekdays'], TRUE)){
                $values .= vsprintf(",%s", "1");
            }
            else {
                $values .= vsprintf(",%s", "0");
            }
        }

        //Formatting the SQL
        $columns = substr($columns, 1) . ",user_id";
        $values = substr($values, 1) . sprintf(",%d", get_current_user_id());

        $q1 = sprintf("REPLACE INTO %s ", $blackout_weekdays_table);
        $q2 = sprintf("(%s) ", $columns);
        $q3 = sprintf("VALUES (%s)", $values);

        $isSuccess = $wpdb->query($q1. $q2 . $q3. $q4);

        wp_send_json_success($isSuccess);
    
    }

} //END OF CLASS FILE
?>