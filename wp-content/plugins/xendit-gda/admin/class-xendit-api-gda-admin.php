<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/admin
 * @author     Your Name <email@example.com>
 */
class Xendit_Api_GDA_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/xendit-api-gda-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/xendit-api-gda-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_admin_settings() {
		// register_setting('options', 'xendit_api_gda_server_key', array(
		// 	'type' => 'string',
		// 	'show_in_rest' => false,
		// ));
		// register_setting('options', 'xendit_api_gda_client_key', array(
		// 	'type' => 'string',
		// 	'show_in_rest' => false,
		// ));

		register_setting('xendit_api_gda', 'xendit_api_gda_merchant_id');
		register_setting('xendit_api_gda', 'xendit_api_gda_server_key');
		register_setting('xendit_api_gda', 'xendit_api_gda_client_key');
	}

	public function register_admin_menu() {
		add_menu_page(
			'Xendit API GDA',
			'Xendit API GDA',
			'manage_options',
			'xendit-api-gda-setting',
			[$this, 'render_admin_menu']
		);
	}

	public function render_admin_menu() {
		ob_start();

		require_once("partials/xendit-api-gda-admin-display.php");

		echo ob_get_clean();
	}

}
