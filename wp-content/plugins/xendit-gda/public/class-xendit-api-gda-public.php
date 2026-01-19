<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://gaiada.com
 * @since      1.0.0
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/public
 * @author     Your Name <email@example.com>
 */
class Xendit_Api_GDA_Public {

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
		 * defined in Xendit_Api_GDA_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Xendit_Api_GDA_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/xendit-api-gda-public.css', array(), $this->version, 'all' );

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
		 * defined in Xendit_Api_GDA_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Xendit_Api_GDA_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name . '-cookie', 'https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js', array(  ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/xendit-api-gda-public.js', array( 'jquery', $this->plugin_name . '-cookie' ), null, false );
		wp_enqueue_script( $this->plugin_name . '-cards-session', 'https://js.xendit.co/cards-session.min.js', array(), $this->version );
	}

	public function embed_head_scripts() {
		echo '<script id="xendit_public">';
		echo json_encode(
			array(
				'xendit_public' => 'xnd_public_development_L9PqSaNPfi_pgffBjGM2k7nnDoyDBAIXVqZze1fnKoD1DUuJsnB8Tpw6bS06pmJ',
				'xendit_endpoint' => XENDIT_API_ENDPOINT
			)
		);
		echo "</script>";
	}

}
