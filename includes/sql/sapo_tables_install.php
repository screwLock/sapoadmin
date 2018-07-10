<?php

function sapo_tables_install() {

		global $wpdb;
	 
		$sql = array();
		$charset_collate = $wpdb->get_charset_collate();
	 
		
		//1. Create the zipcodes table
		//---This table should be used as a reference table for 
		//---creating pickup addresses
		//TODO: In another part of code,
		//use the count() function
		//with query to mepr_
		$zipcodes_table = $wpdb->prefix . "sapo_zipcodes";
	 
		if($wpdb->get_var("SHOW TABLES LIKE '" . $zipcodes_table . "'") !== $zipcodes_table) {
		   $sql[] = "CREATE TABLE $zipcodes_table (
			  id BIGINT(20) NOT NULL AUTO_INCREMENT,
			  user_id BIGINT(20) NOT NULL,
			  zipcode VARCHAR(6) NOT NULL,
			  sunday BOOLEAN NOT NULL DEFAULT 0,
			  monday BOOLEAN NOT NULL DEFAULT 0,
			  tuesday BOOLEAN NOT NULL DEFAULT 0,
			  wednesday BOOLEAN NOT NULL DEFAULT 0,
			  thursday BOOLEAN NOT NULL DEFAULT 0,
			  friday BOOLEAN NOT NULL DEFAULT 0,
			  saturday BOOLEAN NOT NULL DEFAULT 0,
			  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
			  PRIMARY KEY  (id)    
		   ) $charset_collate;";
		}
	 
	 
	 
		//2. Create the blackout dates table
		$blackout_dates_table = $wpdb->prefix . "sapo_blackout_dates";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $blackout_dates_table . "'") !== $blackout_dates_table) {

	       $sql[] = "CREATE TABLE $blackout_dates_table(
		      id BIGINT(20) NOT NULL AUTO_INCREMENT,
		      user_id BIGINT(20) NOT NULL,
		      blackout_date DATE NOT NULL,
			  reason VARCHAR(50) NOT NULL DEFAULT '',
			  group_id VARCHAR(30) NOT NULL DEFAULT '',
			  updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp,
		      created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
		      UNIQUE (id),
			  PRIMARY KEY  (id)
			) $charset_collate;";
		}
	 
		//3. Create the pickups table
		$pickups_table = $wpdb->prefix . "sapo_pickups";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $pickups_table . "'") !== $pickups_table) {
	       $sql[] = "CREATE TABLE $pickups_table(
		      id BIGINT(20) NOT NULL AUTO_INCREMENT,
		      user_id BIGINT(20) NOT NULL,
		      priority TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
		      pickup_date DATE NOT NULL,
		      street_address VARCHAR(100) NOT NULL,
		      city VARCHAR(30) NOT NULL,
		      state_province CHAR(2) NOT NULL,
		      postal_code VARCHAR(6) NOT NULL,
		      truck_number BIGINT(20) NOT NULL,
		      size VARCHAR(15) NOT NULL,
		      items VARCHAR(100) NOT NULL,
		      confirmed VARCHAR(3) NOT NULL DEFAULT 'NO', 
		      completed VARCHAR(3) NOT NULL DEFAULT 'NO', 
		      updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp,
		      created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
		      UNIQUE (id),
		      PRIMARY KEY  (id)
		   ) $charset_collate;";   
		}

		//4. Create Trucks table
		$trucks_table = $wpdb->prefix . "sapo_trucks";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $trucks_table . "'") !== $trucks_table) {
	       $sql[] = "CREATE TABLE $trucks_table(
		      id BIGINT(20) NOT NULL AUTO_INCREMENT,
		      user_id BIGINT(20) NOT NULL,
		      truck_number BIGINT(20) NOT NULL,
		      driver_name VARCHAR(30) NOT NULL,
		      driver_phone VARCHAR(10) NOT NULL,
		      driver_email VARCHAR(30),
			  updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp,
		      created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
		      UNIQUE(id),
			  PRIMARY KEY  (id)
			) $charset_collate;";
		}
		//5.  Create Employees table
		//TODO:  If user not in employee table or is not parent account, cannot access main page
		$employees_table = $wpdb->prefix . "sapo_employees";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $employees_table . "'") !== $employees_table) { 
		   $sql[] = "CREATE TABLE $employees_table(
		      id BIGINT(20) NOT NULL AUTO_INCREMENT,
		      user_id BIGINT(20) NOT NULL,
			  employee_id BIGINT(20) NOT NULL,
			  access_level VARCHAR(10) NOT NULL DEFAULT 'employee',
		      updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp,
		      created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
	          UNIQUE(id),
		      PRIMARY KEY  (id)
		   ) $charset_collate;";   
		}

		//6. Create Reference Table for Yes/No values
		$confirmation_status_table = $wpdb->prefix . "sapo_confirmation_status";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $confirmation_status_table . "'") !== $confirmation_status_table){
			$sql[] = "CREATE TABLE $confirmation_status_table(
			   id BIGINT(20) NOT NULL AUTO_INCREMENT,
			   status VARCHAR(5) NOT NULL,
			   PRIMARY KEY  (id)
			) $charset_collate;";
		}

		//7. Create Categories Table
		$categories_table = $wpdb->prefix . "sapo_categories";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $categories_table . "'") !== $categories_table){
			$sql[] = "CREATE TABLE $categories_table(
			   id BIGINT(20) NOT NULL AUTO_INCREMENT,
			   user_id BIGINT(20) NOT NULL,
			   category VARCHAR(30) NOT NULL,
			   comments VARCHAR(200) NOT NULL,
			   updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp,
		       created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
	           UNIQUE(id),
		       PRIMARY KEY  (id)
		   ) $charset_collate;";   
		}

		//8. Create the blackout weekdays table
		$blackout_weekdays_table = $wpdb->prefix . "sapo_blackout_weekdays";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $blackout_weekdays_table . "'") !== $blackout_weekdays_table) {

	       $sql[] = "CREATE TABLE $blackout_weekdays_table(
		      id BIGINT(20) NOT NULL AUTO_INCREMENT,
		      user_id BIGINT(20) NOT NULL,
			  sunday BOOLEAN NOT NULL DEFAULT 0,
			  monday BOOLEAN NOT NULL DEFAULT 0,
			  tuesday BOOLEAN NOT NULL DEFAULT 0,
			  wednesday BOOLEAN NOT NULL DEFAULT 0,
			  thursday BOOLEAN NOT NULL DEFAULT 0,
			  friday BOOLEAN NOT NULL DEFAULT 0,
			  saturday BOOLEAN NOT NULL DEFAULT 0,
			  updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp,
		      created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
		      UNIQUE (id),
			  PRIMARY KEY  (user_id)
			) $charset_collate;";
		}

		//9. Create the maximum pickups per weekday table
		$max_pickups_table = $wpdb->prefix . "sapo_max_pickups";

		if($wpdb->get_var("SHOW TABLES LIKE '" . $max_pickups_table . "'") !== $max_pickups_table){
			$sql[] = "CREATE TABLE $max_pickups_table(
			   id BIGINT(20) NOT NULL AUTO_INCREMENT,
			   user_id BIGINT(20) NOT NULL,
			   max_pickups TINYINT(200) NOT NULL DEFAULT 5,
			   PRIMARY KEY  (id)
			) $charset_collate;";
		}		
			
		
		if(!empty($sql)){
		   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		   dbDelta($sql);
		}
	 }