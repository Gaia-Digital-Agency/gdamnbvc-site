<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/includes
 * @author     Your Name <email@example.com>
 */
class Xendit_Api_GDA_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	private $wpdb;
	private $table_prefix;
	private $charset_collate;

	public function __construct() {
		global $wpdb;
		$this->wpdb = $wpdb;
		$this->table_prefix = $wpdb->prefix . 'gda_';
		$this->charset_collate = $wpdb->get_charset_collate();
	}

	public static function activate() {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$self = new self();
		$self->create_cart_table();
		$self->create_cart_meta_table();

		add_option('xendit_api_gda_db_version', '1.0');
	}


	public function create_cart_table () {

		$table_name = $this->get_table_prefix() . 'cart';
		$charset_collate = $this->get_charset_collate();
	
		$sql = "CREATE TABLE $table_name (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			cart_id VARCHAR(255) NOT NULL,
			reference_id VARCHAR(255),
			idempotency_id VARCHAR(255),
			card_id VARCHAR(255),
			current_status ENUM ( 'inactive' , 'done' , 'pending' ) NOT NULL DEFAULT 'inactive',
			created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id)
		) $charset_collate;";
		dbDelta($sql);
	}

	public function create_cart_meta_table() {
		$table_name = $this->get_table_prefix() . 'cart_meta';
		$charset_collate = $this->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			cart_id VARCHAR(255) NOT NULL,
			meta_key VARCHAR(255) NOT NULL,
			meta_value VARCHAR(255),
			PRIMARY KEY (id)
		) $charset_collate;";
		dbDelta($sql);
	}

	private function get_wpdb() {
		return $this->wpdb;
	}

	private function get_table_prefix() {
		return $this->table_prefix;
	}

	private function get_charset_collate() {
		return $this->charset_collate;
	}

}
