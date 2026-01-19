<?php

function register_custom_post_type() {
    register_post_type('tab-content', [
        'labels' => array(
            'name' => __('Tab Content', 'textdomain'),
            'singuluar_name' => __('Tab Content', 'textdomain')
        ),
        'public' => true,
        'supports' => array('custom-fields', 'page-attributes', 'thumbnail', 'editor', 'title', 'post-formats', 'page-attributes'),
        'show_in_rest' => true
    ]);
}

add_action('init', 'register_custom_post_type');