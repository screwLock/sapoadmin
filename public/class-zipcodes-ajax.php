<?php

/**
 * The file that defines the zipcode ajax functionality.
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
 * All Ajax code for the zipcode page should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */

 class ZipcodesAjax {

    public function save_zipcodes(){
        global $wpdb;
        $zipcodes_table = $wpdb->prefix . "sapo_zipcodes";

        $new_zipcode = $_POST['new_zipcode'];

        $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $values = ""; 
        $columns = "";

        //If a day of the week is found within the 
        //dayys of the post, insert a 1.  Otherwise
        //insert 0
        forEach($daysOfWeek as $key=>$weekday){
            $columns .= sprintf(",%s", $weekday);
            if(in_array($weekday, $new_zipcode['days'], TRUE)){
                $values .= sprintf(",%s", "1");
            }
            else {
                $values .= sprintf(",%s", "0");
            }
        }
        //Formatting the SQL
        $columns = substr($columns, 1);
        $values = substr($values, 1);


        $q_zipcode= "'" . esc_sql($new_zipcode['zipcode']) . "'";
        $q_max_time = $new_zipcode['maxTime'];
        $q_max_time = sprintf("STR_TO_DATE('%s'", $q_max_time);
        $q_max_time .= ", '%h:%i %p')";
        $q_max_time_enabled = $new_zipcode['maxTimeEnabled'];
        $q_user_id = get_current_user_id();

        $q_insert = sprintf("REPLACE INTO %s ", $zipcodes_table);
        $q_columns = sprintf("(%s, %s, %s, %s, %s) ", $columns, "zipcode", "max_time", "enable_max_time", "user_id");
        $q_values = sprintf("VALUES (%s, %s, %s, %d, %d) ", $values, $q_zipcode, $q_max_time, $q_max_time_enabled, $q_user_id);

        $is_success = $wpdb->query($q_insert . $q_columns . $q_values);

        wp_send_json_success($is_success);
    }

    public function delete_saved_zipcodes(){
        global $wpdb;
        $zipcodes_table = $wpdb->prefix . "sapo_zipcodes";

        $zipcodes = array();
        forEach($_POST['zipcodesToRemove'] as $zip)
            array_push($zipcodes, $zip);

        $zipcodes = "'" .implode("','", $zipcodes  ) . "'"; 
        $isSuccess = $wpdb->query( 
            $wpdb->prepare( "DELETE FROM " . $zipcodes_table . " WHERE zipcode IN ($zipcodes) AND user_id = %d", get_current_user_id())
        );

        wp_send_json_success($isSuccess);
    }

    public function get_zipcodes(){
        global $wpdb;
        $zipcodes = array();
        $zipcodes_table = $wpdb->prefix . "sapo_zipcodes";

        $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];


        $zipcodes_results = $wpdb->get_results("SELECT * FROM " . $zipcodes_table . 
        " WHERE USER_ID = " . get_current_user_id()); //AND WHERE 

        //Send error message if error with query
        if (is_null($zipcodes) || !empty($wpdb->last_error)) wp_send_json_error();

        $index = 0;
        foreach($zipcodes_results as $zip){
            
            $zipcodes[$index] = array(
                "zipcode" => $zip->zipcode,
                "days" => $zip->zipcode,
                "maxtime" => $zip->max_time,
                "maxTimeEnabled" => $zip->enable_max_time
            );
            $index++;
        }

        wp_send_json_success($zipcodes);
    }

 }
