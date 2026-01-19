<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Status_WP
 * @subpackage Status_WP/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Status_WP
 * @subpackage Status_WP/includes
 * @author     Reva Athallah Rizky
 */

class Status_WP_Rest_Api {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function register_rest_api() {

        register_rest_route("gaia/v1", "/status", array(
            'methods' => "GET",
            'callback' => [$this, 'get_general_status']
        ));

    }

    function get_general_status() {

        $apiKey = get_option('status_wp_api_key');

        $auth = new Status_WP_Authentication();
        $auth->set_api_key($apiKey);
        

        global $wpdb;
    
        $updates = get_site_transient('update_core');
        $plugin_updates = get_site_transient('update_plugins');
        $theme_updates = get_site_transient('update_themes');
    
        $autoload_size = $wpdb->get_var("
            SELECT ROUND(SUM(LENGTH(option_value))/1024/1024, 2)
            FROM {$wpdb->options}
            WHERE autoload = 'yes'
        ");
    
        $https = is_ssl();
    
        $memory = ini_get('memory_limit');
    
        $debug = defined('WP_DEBUG') && WP_DEBUG;
    
        $file_edit = defined('DISALLOW_FILE_EDIT') && DISALLOW_FILE_EDIT;
    
        $xmlrpc = file_exists(ABSPATH . 'xmlrpc.php');
    
        $cron_status = !!wp_next_scheduled('wp_version_check');
    
        $errors = [];
    
        if (!$https) $errors[] = 'no_https';
        if ($debug) $errors[] = 'debug_on';
        if ($autoload_size > 5) $errors[] = 'autoload_bloat';
        if (!empty($plugin_updates->response)) $errors[] = 'plugin_updates';
        if (!empty($theme_updates->response)) $errors[] = 'theme_updates';
    
        $status = empty($errors) ? 'healthy' : (count($errors) < 3 ? 'warning' : 'critical');
    
        return [
            'site' => [
                'url' => get_site_url(),
                'wp_version' => get_bloginfo('version'),
                'php_version' => PHP_VERSION,
                'https' => $https
            ],
            'updates' => [
                'core' => !empty($updates->updates) && $updates->updates[0]->response === 'upgrade',
                'plugins' => count($plugin_updates->response ?? []),
                'themes' => count($theme_updates->response ?? [])
            ],
            'performance' => [
                'memory_limit' => $memory,
                'autoload_size_mb' => $autoload_size
            ],
            'security' => [
                'debug' => $debug,
                'file_edit_disabled' => $file_edit,
                'xmlrpc_exists' => $xmlrpc
            ],
            'cron' => $cron_status,
            'errors' => $errors,
            'status' => $status
        ];
    }

}