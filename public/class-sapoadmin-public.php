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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sapoadmin-public.css', array(), $this->version, 'all' );

		//Stylesheet for the datepicker
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/flick/jquery-ui.css');

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sapoadmin-public.js', array( 'jquery', 'jquery-ui-datepicker' ), $this->version, false );
		
		//wp_enqueue_script( 'google_js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyALjQTE9_fxGsFeWK-CulzUYAfkUOFtm94', '', '' );
	}

	/**
	 * This function is for registering scripts that are not going to be used sitewide
	 * but for shortcodes instead.  This function is to be called in define_public_hooks()
	 * of the class-sapoadmin class.
	 * 
	 * 
	 */
	public function register_scripts() {
		wp_register_script( 'script-name', plugin_dir_url( __FILE__ ) . 'js/scripts.js', array(), $this->version, true );
		wp_register_script('google_js',  'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyALjQTE9_fxGsFeWK-CulzUYAfkUOFtm94', array('script-name'), $this->version);
	}
	

	/**
	 * --------------------------------------------------------------------------------------------------------------------------------------------
	 * --------------------------------------------------------------------------------------------------------------------------------------------
	 * SHORTCODE CALLBACKS FOR PUBLIC FACING FUNCTIONALITY SHOULD BE INCLUDED BELOW
	 * AT THE END OF THE PLUGIN PUBLIC CLASS DEFINITION
	 * 
	 * --------------------------------------------------------------------------------------------------------------------------------------------
	 */

	public function shortcode_function(){
		wp_enqueue_script( 'script-name' );
		wp_enqueue_script( 'google_js');
		return '';
	}
}
