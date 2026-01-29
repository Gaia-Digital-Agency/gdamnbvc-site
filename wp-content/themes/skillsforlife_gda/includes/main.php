<?php
/**
 * Add theme support
 */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats');
    add_theme_support('menus');
    add_theme_support('editor-styles');
    add_theme_support('custom-logo');

    register_nav_menus([
        'main_header' => __('Main Header'),
        'sub_navigation' => __('Sub Navigation'),
        'footer_navigation_1' => __('Footer Navigation 1'),
        'footer_navigation_2' => __('Footer Navigation 2'),
    ]);

});

/**
 * Enqueue script and styles
 */
// add_action('wp_enqueue_scripts', function () {
//     wp_enqueue_style('app', assets_url('/dist/app.css'), [], null);
//     wp_enqueue_script('app', assets_url('/dist/app.js'), ['jquery'], null, true);

//     // Register script for blocks
//     // If needed, separate the script per block

// });

function loadfontcss() {
    $theme_dir = get_template_directory_uri();
    if(file_exists(get_template_directory() . '/hot')) {
        $address = file_get_contents(get_template_directory() . '/hot');
        $home_url = home_url();
        $relative_uri = str_replace($home_url, '', $theme_dir);
        wp_enqueue_style('fonts', $address . $relative_uri . '/font.css', [], null);

    } else {
        wp_enqueue_style('fonts', $theme_dir . '/font.css', [], null);
    }
}

add_action('wp_enqueue_scripts', 'loadfontcss');
add_action('admin_enqueue_scripts', 'loadfontcss');

function enqueue_scripts_from_manifest ($entry = 'app') {
    $manifest = json_decode(file_get_contents(get_theme_file_path('src/dist/.vite/manifest.json')), true);
    $theme_dir = get_template_directory();
    if(file_exists($theme_dir . '/hot')) {
        $address = file_get_contents($theme_dir . '/hot');;
        wp_enqueue_script_module('vite-dev', $address . '@vite/client', [], null);
        wp_enqueue_script_module($entry, $address . 'js/'.$entry.'.js', [], null);
    } else {;
        $chunk = $manifest["js/$entry.js"];
        wp_enqueue_script_module($entry, get_theme_file_uri('src/dist/' . $chunk['file']), [], null);
        wp_enqueue_style($entry, get_theme_file_uri('src/dist/' . $chunk['css'][0]));
    }
}

add_action('wp_enqueue_scripts', function () {
    // $manifest = json_decode(file_get_contents(get_theme_file_path('src/dist/.vite/manifest.json')), true);
    // $theme_dir = get_template_directory();
    // if(file_exists($theme_dir . '/hot')) {
    //     $address = file_get_contents($theme_dir . '/hot');;
    //     wp_enqueue_script_module('vite-dev', $address . '@vite/client', [], null);
    //     wp_enqueue_script_module('app', $address . 'js/app.js', [], null);
    // } else {
    //     $entry = 'app';
    //     $chunk = $manifest["js/$entry.js"];
    //     wp_enqueue_script_module($entry, get_theme_file_uri('src/dist/' . $chunk['file']), [], null);
    //     wp_enqueue_style($entry, get_theme_file_uri('src/dist/' . $chunk['css'][0]));
    // }
    enqueue_scripts_from_manifest('app');
});

add_action('admin_enqueue_scripts', function () {
    // $manifest = json_decode(file_get_contents(get_theme_file_path('src/dist/.vite/manifest.json')), true);
    // $theme_dir = get_template_directory();
    // if(file_exists($theme_dir . '/hot')) {
    //     $address = file_get_contents($theme_dir . '/hot');;
    //     wp_enqueue_script_module('vite-dev', $address . '@vite/client', [], null);
    //     wp_enqueue_script_module('app', $address . 'js/app.js', [], null);
    //     // wp_enqueue_style($entry, get_theme_file_uri('dist/' . $chunk['css'][0]));
    // } else {
    //     // foreach (['app', 'editor'] as $entry) {
    //     $entry = 'editor';
    //     $chunk = $manifest["js/$entry.js"];
    //     wp_enqueue_script_module($entry, get_theme_file_uri('src/dist/' . $chunk['file']), [], null);
    //     wp_enqueue_style($entry, get_theme_file_uri('src/dist/' . $chunk['css'][0]));
    //     // }
    // }
    enqueue_scripts_from_manifest('editor');
});
// 
add_filter('show_admin_bar', '__return_false');

function check_active_menu( $menu_item ) {
    $actual_link = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ( $actual_link == $menu_item->url ) {
        return true;
    }
    $page = get_page_by_path(str_replace(home_url(), '', $actual_link));
    $menu_page = get_page_by_path(str_replace(home_url(), '', $menu_item->url));
    if($page->post_parent === $menu_page->ID) {
        return true;
    }
    return false;
}


function wp_get_menu_array($current_menu) {

    $array_menu = wp_get_nav_menu_items($current_menu);
	$menu = array();
	foreach ($array_menu as $m) {
        $isActive = check_active_menu($m);
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
			$menu[$m->ID]['ID'] 		= 	$m->ID;
			$menu[$m->ID]['title'] 		= 	$m->title;
			$menu[$m->ID]['url'] 		= 	$m->url;
			$menu[$m->ID]['children']	= 	array();
			$menu[$m->ID]['is_active']	= 	$isActive;
			// $menu[$m->ID]['classes']	= 	$m->classes;
		}
	}
	$submenu = array();
	foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
			$submenu[$m->ID] = array();
			$submenu[$m->ID]['ID'] 		= 	$m->ID;
			$submenu[$m->ID]['title']	= 	$m->title;
			$submenu[$m->ID]['url'] 	= 	$m->url;
			$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
		}
	}
    return $menu;
    
}


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}
  
	$filetype = wp_check_filetype( $filename, $mimes );
  
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );

add_filter( 'acf/load_attachment', 'custom_load_attachment', 10, 3);
function custom_load_attachment ($response, $attachment, $meta){
  if ($response['type'] == 'image'){
    $response['icon'] = $response['sizes']['thumbnail'];
  }
  return $response;
}

add_filter('wpcf7_autop_or_not', '__return_false');


add_filter( 'acf/blocks/wrap_frontend_innerblocks', '__return_false' );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

function add_footer_image($wp_customize) {

    $wp_customize->add_setting('footer_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'footer_image_control',
            [
                'label' => __('Footer Image', 'skillsforlife'),
                'section' => 'title_tagline',
                'settings' => 'footer_image',
                'priority' => 20,
            ]
        )
    );
}

add_action('customize_register', 'add_footer_image');

add_action('acf/init', function () {
    if(function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'CTA Header Setting',
            'menu_title' => 'CTA Header',
            'menu_slug' => 'cta-header-setting',

        ));
    }
});