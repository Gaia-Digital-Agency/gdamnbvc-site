<?php
function register_block($block) {
    if(!$block) {
        return false;
    }
    $dir = get_template_directory();
    add_action('init', function() use($block, $dir) {
        register_block_type($dir . '/blocks/' . $block );
    }, 5);
    add_filter('allowed_block_types_all', function($allowed_blocks, $editor_context) use($block, $dir) {
        if(!is_array($allowed_blocks)) {
            // allow default block
            $allowed_blocks = ['core/spacer', 'core/shortcode'];
        }
        // if($allowed_blocks === true) {
        //     return $allowed_blocks;
        // }
        switch ($editor_context->post->post_type) {
            case 'page':
                array_push($allowed_blocks, 'acf/' . $block);
                break;
            default :
                $allowed_blocks = true;
                break;
        }

        return $allowed_blocks;
    }, 8, 2);
    
}

$blocksDir = __DIR__ . '/../blocks';
if (is_dir($blocksDir)) {
    $contents = scandir($blocksDir);
    $directories = array_filter($contents, function($item) use ($blocksDir) {
        return is_dir($blocksDir . '/' . $item) && !in_array($item, ['.', '..']);
    });
    foreach($directories as $dir) {
        register_block($dir);
    }
}