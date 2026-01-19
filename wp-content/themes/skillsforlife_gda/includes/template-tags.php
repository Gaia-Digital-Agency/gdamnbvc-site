<?php

/**
 * Assets helper
 */
// function assets_url($path)
// {
//     $theme_dir = get_template_directory();
//     if (file_exists($theme_dir . '/hot')) {
//         // $url = file_get_contents($theme_dir . '/hot');
        
//         return "//localhost:8080{$path}";
//     }
//     // if (file_exists($theme_dir . '/hot') && WP_SITEURL == "http://localhost") {
//         //     var_dump($theme_dir);
//         //     // $url = file_get_contents($theme_dir . '/hot');
        
//         //     return "//localhost:8080{$path}";
//         // }
        
//         $manifestPath = $theme_dir . '/mix-manifest.json';
//         $manifest = json_decode(file_get_contents($manifestPath), true);
        
//         if (isset($manifest[$path])) {
//         // var_dump(get_template_directory_uri() . $manifest[$path]);
//         return get_template_directory_uri() . $manifest[$path];
//     } else {
//         // var_dump(get_template_directory_uri() . $path);
//         return get_template_directory_uri() . $path;
//     }
// }

function assets_url($path) {
    $theme_dir = get_template_directory();
    if(file_exists($theme_dir . '/hot')) {
        $address = file_get_contents($theme_dir.'/hot');
        return $address . $path;
    }
    $template_uri = get_template_directory_uri();
    return $template_uri . '/src/dist/' . $path;
    // $manifest = json_decode(file_get_contents(get_theme_file_path('dist/.vite/manifest.json')), true);
    // return get_template_directory_uri() . $manifest[$path];
    // foreach (['app', 'editor'] as $entry) {
    //     $chunk = $manifest["src/js/$entry.js"];

    //     wp_enqueue_script($entry, get_theme_file_uri('dist/' . $chunk['file']), [], null, true);
    //     wp_enqueue_style($entry, get_theme_file_uri('dist/' . $chunk['css'][0]));
    // }
}