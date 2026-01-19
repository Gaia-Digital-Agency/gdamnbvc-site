<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Status WP
 * Plugin URI:        https://gaiada.com
 * Description:       Status Checker for gaiada website
 * Version:           1.0.0
 * Author:            Gaia Digital Agency
 * Author URI:        https://gaiada.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       status-wp
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'STATUS_WP_VERSION', '1.0.0' );

if(defined('WP_ENV') && WP_ENV == 'development') {
	define( 'STATUS_WP_ENDPOINT_MAIN', 'http://localhost:3000' );
} else {
	define( 'STATUS_WP_ENDPOINT_MAIN', 'https://' );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-status-wp-activator.php
 */
function activate_status_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-status-wp-activator.php';
	Status_WP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-status-wp-deactivator.php
 */
function deactivate_status_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-status-wp-deactivator.php';
	Status_WP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_status_wp' );
register_deactivation_hook( __FILE__, 'deactivate_status_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-status-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_status_wp() {

	$plugin = new Status_WP();
	$plugin->run();

}
run_status_wp();