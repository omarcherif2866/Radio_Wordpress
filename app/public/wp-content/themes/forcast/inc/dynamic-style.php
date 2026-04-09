<?php

// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

function empath_theme_options_style() {

    //
    // Enqueueing StyleSheet file
    //
    wp_enqueue_style( 'empath-theme-custom-style', get_template_directory_uri() . '/assets/css/custom-style.css' );
    $css_output = '';
    $theme_color_1 = cs_get_option('theme-color-1');


    if(!empty($theme_color_1)){
        $css_output .= '
        :root {
            --thm-primary: '.esc_attr($theme_color_1).'
        }
        ';
    }
    

    wp_add_inline_style( 'empath-theme-custom-style', $css_output );

}
add_action( 'wp_enqueue_scripts', 'empath_theme_options_style' );
