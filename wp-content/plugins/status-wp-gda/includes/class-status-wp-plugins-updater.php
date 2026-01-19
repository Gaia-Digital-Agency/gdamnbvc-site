<?php

// The slug of the plugin to update (e.g., 'akismet/akismet.php')
// $plugin_slug = 'plugin-folder/plugin-file.php'; 

// Initialize the Plugin_Upgrader



class Status_WP_Plugins_Updater {

    public function __construct() {
        
    }

    public function loader() {
        require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/misc.php' );
        require_once( ABSPATH . 'wp-admin/includes/template.php' );
    }

    public function update() {
        $upgrader = new Plugin_Upgrader();
        
    }

    

}