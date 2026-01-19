<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/includes
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
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/includes
 * @author     Your Name <email@example.com>
 */
class Xendit_Api_GDA {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Xendit_Api_GDA_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if ( defined( 'Xendit_Api_GDA_VERSION' ) ) {
			$this->version = Xendit_Api_GDA_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'xendit-api-gda';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_ajax_hooks();
		$this->define_rest_hooks();

		// temp debugger will delete in prod
		$this->debugger();

	}

	public function debugger($debug = '') {
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-xendit-api-gda-payment.php';
		// var_dump($plugin_admin);
		add_action('page_theme_debugger', function () {

			ob_start();

			require_once(plugin_dir_path( dirname( __FILE__ ) ) . "public/partials/xendit-api-gda-public-display.php");

			echo ob_get_clean();

			echo "<-------------- start of Xendit API GDA --------------> \n";
			echo "<br />";
			// $payment = new Xendit_Api_GDA_Payment();
			// $payment->set_key('xnd_development_FzUYAKbp0ec2EcOrx9ytmKVb6QHL6UNRKj5Wd3UpYFyTKE90tJpjdKxg6c8CV');
			// $create = $payment->create_payment();
			// !$params['card_number'] ||
            //     !$params['expiry_month'] ||
            //     !$params['expiry_year'] ||
            //     !$params['cvv'] ||
            //     !$params['cardholder_name']
			// $cart = new Xendit_Api_GDA_Cart();
			// $generate = $cart->generate_cart_id();
			// $cart->set_cart_id($generate);
			// $invoice = $payment->create_payment_link($cart);
			$ajax = new Xendit_Api_GDA_Ajax();
			$test = $ajax->create_payment_request();
			echo "<pre>";
			var_dump($test);
			echo "</pre>";
			
			
			echo "<br />";
			echo "<-------------- end of Xendit API GDA --------------> \n";
		});

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Xendit_Api_GDA_Loader. Orchestrates the hooks of the plugin.
	 * - Xendit_Api_GDA_i18n. Defines internationalization functionality.
	 * - Xendit_Api_GDA_Admin. Defines all hooks for the admin area.
	 * - Xendit_Api_GDA_Public. Defines all hooks for the public side of the site.
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

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-xendit-api-gda-loader.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-xendit-api-gda-payment.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-xendit-api-gda-cart.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-xendit-api-gda-ajax.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-xendit-api-gda-rest-api.php';
		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-xendit-api-gda-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-xendit-api-gda-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-xendit-api-gda-public.php';

		$this->loader = new Xendit_Api_GDA_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Xendit_Api_GDA_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Xendit_Api_GDA_i18n();

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

		$plugin_admin = new Xendit_Api_GDA_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_admin_settings' );
	}

	private function define_ajax_hooks() {
		$plugin_ajax = new Xendit_Api_GDA_Ajax();
		$this->loader->add_action('wp_ajax_nopriv_gda_req_cart', $plugin_ajax, 'register_cart');
		$this->loader->add_action('wp_ajax_gda_req_cart', $plugin_ajax, 'register_cart');

		$this->loader->add_action('wp_ajax_nopriv_gda_ver_cart', $plugin_ajax, 'verify_cart');
		$this->loader->add_action('wp_ajax_gda_ver_cart', $plugin_ajax, 'verify_cart');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Xendit_Api_GDA_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	private function define_rest_hooks() {
		$plugin_rest = new Xendit_Api_GDA_Rest_Api();

		$this->loader->add_action( 'rest_api_init', $plugin_rest, 'register_rest_api' );
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
	 * @return    Xendit_Api_GDA_Loader    Orchestrates the hooks of the plugin.
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
