<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */
class Sapoadmin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sapoadmin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sapoadmin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//Stylesheet for the datepicker
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bootstrap-datepicker3.standalone.css', array(), $this->version, false );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sapoadmin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sapoadmin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//The overview datepicker JS
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bootstrap-datepicker.js', array('jquery'), $this->version, false );		
	}

	/**
	 * This function is for registering scripts that are not going to be used sitewide
	 * but for shortcodes instead.  This function is to be called in define_public_hooks()
	 * of the class-sapoadmin class.
	 * 
	 * 
	 */
	public function register_scripts() {
		//Overview page
		wp_register_script('overview', plugin_dir_url( __FILE__ ) . 'js/overview.js', array(), $this->version, true );
		wp_register_script('google_maps',  'https://maps.googleapis.com/maps/api/js?key=AIzaSyAP9TsRTrHitDF4jNAwSXLLKajKM4LTGVc&callback=initMap', array('overview'), $this->version);

		//blackoutDates page
		//watch these two...could be a source of error/conflict with wpdatatables

		wp_register_style('sapo_bootstrap_css', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");

		wp_register_script('sapo_bootstrap_js', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js", array('jquery'));

		wp_register_script('blackout_dates', plugin_dir_url( __FILE__ ) . 'js/blackoutDates.js', array(), $this->version, true );

	}
	

	/**
	 * --------------------------------------------------------------------------------------------------------------------------------------------
	 * --------------------------------------------------------------------------------------------------------------------------------------------
	 * SHORTCODE CALLBACKS FOR PUBLIC FACING FUNCTIONALITY SHOULD BE INCLUDED BELOW
	 * AT THE END OF THE PLUGIN PUBLIC CLASS DEFINITION
	 * 
	 * --------------------------------------------------------------------------------------------------------------------------------------------
	 */

	public function overview_shortcode(){
		wp_enqueue_script( 'overview' );
		wp_enqueue_script( 'google_maps');
		add_filter('script_loader_tag', array($this, 'google_maps_script_attributes'), 10, 2);
		include_once('partials/overview.php');
		return '';
	}

	public function blackout_dates_shortcode(){
		//watch these two...could be a source of error/conflict with wpdatatables
		wp_enqueue_style('sapo_bootstrap_css');
		wp_enqueue_script('sapo_bootstrap_js');

		wp_enqueue_script('blackout_dates');
		include_once('partials/blackout_dates_card_template.php');
		return '';
	}


	// Add async and defer attributes
function google_maps_script_attributes( $tag, $handle) {
    if ( 'google_maps' !== $handle ) {
        return $tag;
  }
    
    return str_replace('src', ' async="async" defer src', $tag );
}
//
}
