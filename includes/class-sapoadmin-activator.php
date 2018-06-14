<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/includes
 * @author     Travus Helmly <helmlyw@gmail.com>
 */
class Sapoadmin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		require_once plugin_dir_path( __FILE__ ) . 'sql/sapo_tables_install.php';
		require_once plugin_dir_path( __FILE__ ) . 'sql/sapo_data_install.php';
		sapo_tables_install();
		sapo_install_all_data();
	}


	 
}
