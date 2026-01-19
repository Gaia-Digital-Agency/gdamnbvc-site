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
 * @package           Xendit_Api_GDA
 *
 * @wordpress-plugin
 * Plugin Name:       Xendit API GDA
 * Plugin URI:        http://example.com/xendit-api-gda-uri/
 * Description:       Xendit API GDA
 * Version:           1.0.0
 * Author:            Gaia Digital Agency
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       xendit-api-gda
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once(__DIR__ . '/vendor/autoload.php');

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Xendit_Api_GDA_VERSION', '1.0.0' );

define( 'XENDIT_API_ENDPOINT', 'https://api.xendit.co' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-xendit-api-gda-activator.php
 */
function activate_xendit_api_gda() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-xendit-api-gda-activator.php';
	Xendit_Api_GDA_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-xendit-api-gda-deactivator.php
 */
function deactivate_xendit_api_gda() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-xendit-api-gda-deactivator.php';
	Xendit_Api_GDA_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_xendit_api_gda' );
register_deactivation_hook( __FILE__, 'deactivate_xendit_api_gda' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-xendit-api-gda.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_xendit_api_gda() {

	$plugin = new Xendit_Api_GDA();
	$plugin->run();

}
run_xendit_api_gda();
