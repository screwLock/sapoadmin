<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/includes
 * @author     Travus Helmly <helmlyw@gmail.com>
 */
class Sapoadmin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Sapoadmin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'sapoadmin';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Sapoadmin_Loader. Orchestrates the hooks of the plugin.
	 * - Sapoadmin_i18n. Defines internationalization functionality.
	 * - Sapoadmin_Admin. Defines all hooks for the admin area.
	 * - Sapoadmin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sapoadmin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sapoadmin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-sapoadmin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-sapoadmin-public.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-blackout-dates-ajax.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-zipcodes-ajax.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-categories-ajax.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-employees-ajax.php';



		

		$this->loader = new Sapoadmin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Sapoadmin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Sapoadmin_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Sapoadmin_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );

		// Add Settings link to the plugin
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Sapoadmin_Public( $this->get_plugin_name(), $this->get_version() );
		$blackout_dates_ajax = new BlackoutDatesAjax();
		$zipcodes_ajax = new ZipcodesAjax();
		$categories_ajax = new CategoriesAjax();
		$employees_ajax = new EmployeesAjax();
		
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'register_scripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//Shortcodes
        $this->loader->add_shortcode( 'overview', $plugin_public, 'overview_shortcode' , 10, 2 );
		$this->loader->add_shortcode( 'blackout_dates', $plugin_public, 'blackout_dates_shortcode' , 10, 2 );
		$this->loader->add_shortcode( 'zipcodes', $plugin_public, 'zipcodes_shortcode' , 10, 2 );
		$this->loader->add_shortcode( 'categories', $plugin_public, 'categories_shortcode' , 10, 2 );
		$this->loader->add_shortcode( 'employees', $plugin_public, 'employees_shortcode',  10, 2);
		$this->loader->add_shortcode( 'user_registration', $plugin_public, 'user_registration_shortcode',  10, 2);
		$this->loader->add_shortcode( 'user_account', $plugin_public, 'user_account_shortcode',  10, 2);
		$this->loader->add_shortcode( 'emails', $plugin_public, 'emails_shortcode',  10, 2);


		//Ajax related code
		//Ajax for blackoutDates
		$this->loader->add_action( 'wp_ajax_get_blackout_dates', $blackout_dates_ajax, 'get_blackout_dates' );
		$this->loader->add_action( 'wp_ajax_delete_old_dates', $blackout_dates_ajax, 'delete_old_dates' );
		$this->loader->add_action( 'wp_ajax_add_new_dates', $blackout_dates_ajax, 'add_new_dates' );
		$this->loader->add_action( 'wp_ajax_save_disabled_weekdays', $blackout_dates_ajax, 'save_disabled_weekdays' );

		//Ajax for zipcodes
		$this->loader->add_action( 'wp_ajax_save_zipcodes', $zipcodes_ajax, 'save_zipcodes');
		$this->loader->add_action('wp_ajax_delete_saved_zipcodes', $zipcodes_ajax, 'delete_saved_zipcodes');
		$this->loader->add_action('wp_ajax_get_zipcodes', $zipcodes_ajax, 'get_zipcodes');

		//Ajax for categories page
		$this->loader->add_action( 'wp_ajax_save_category', $categories_ajax, 'save_category');
		$this->loader->add_action( 'wp_ajax_get_categories', $categories_ajax, 'get_categories');
		$this->loader->add_action( 'wp_ajax_delete_category', $categories_ajax, 'delete_category');

		$this->loader->add_action( 'wp_ajax_save_size', $categories_ajax, 'save_size');
		$this->loader->add_action( 'wp_ajax_get_sizes', $categories_ajax, 'get_sizes');
		$this->loader->add_action( 'wp_ajax_delete_size', $categories_ajax, 'delete_size');

		$this->loader->add_action( 'wp_ajax_save_location_details', $categories_ajax, 'save_location_details');
		$this->loader->add_action( 'wp_ajax_get_location_details', $categories_ajax, 'get_location_details');

		//Ajax for employees table
		$this->loader->add_action( 'wp_ajax_save_employee', $employees_ajax, 'save_employee');
		$this->loader->add_action( 'wp_ajax_save_driver', $employees_ajax, 'save_driver');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Sapoadmin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
