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
        $q_zipcode= "'" . esc_sql($new_zipcode['zipcode']) . "'";

        forEach($new_zipcode['days'] as $day)
            $q_weekdays .= ',' . $day;
        $q_weekdays = substr($q_weekdays, 1);

        $q_max_time = $new_zipcode['maxTime'];
        $q_max_time = sprintf("STR_TO_DATE('%s'", $q_max_time);
        $q_max_time .= ", '%h:%i %p')";
        wp_send_json_success($q_max_time);
    }

 }
