<?php

class Status_WP_Logger {
    
    public function __construct() {

    }

    public function debug($args) {
        add_action('page_theme_debug', function() {
            $args;
        });
    }
}