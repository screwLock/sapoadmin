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
    }

 }
