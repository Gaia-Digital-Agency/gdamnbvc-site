<?php

/* Template Name: Debug */

wp_head();

if(have_posts()) {
    while(have_posts()) {
        the_post();
        echo '<div class="bg-theme-black text-white h-screen" style="height: 100vh;">';
        do_action('page_theme_debugger');
        echo '</div>';
        the_content();
    }
}

wp_footer();