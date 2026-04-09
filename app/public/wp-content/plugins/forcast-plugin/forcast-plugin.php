<?php
/*
Plugin Name: Forcast Plugin
Plugin URI: https://themeforest.net/user/byteflows
Description: After install the Empath WordPress Theme, you must need to install this "empath-plugin" first to get all functions of empath WP Theme.
Author: byteflows
Author URI: http://byteflows.com/
Version: 1.0.5
Text Domain: forcast-plugin
*/
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define Core Path
 */
define( 'QUBAR_VERSION', '1.0.1' );
define( 'QUBAR_DIR_PATH',plugin_dir_path(__FILE__) );
define( 'QUBAR_DIR_URL',plugin_dir_url(__FILE__) );
define( 'QUBAR_INC_PATH', QUBAR_DIR_PATH . '/inc' );
define( 'QUBAR_PLUGIN_IMG_PATH', QUBAR_DIR_URL . '/assets/img' );

/**
 * Css Framework Load
 */
if ( file_exists(QUBAR_DIR_PATH.'/lib/codestar-framework/codestar-framework.php') ) {
    require_once  QUBAR_DIR_PATH.'/lib/codestar-framework/codestar-framework.php';
}



/**
 * Register Custom Widget
 *
 * @return void
 */
function empath_cw_wisget(){
    register_widget( 'empath_Recent_Posts' );
    register_widget( 'Empath_Newsletter_Form' );
}
add_action('widgets_init', 'empath_cw_wisget');


/**
 * Deregister Elementor Animation
 *
 * @return void
 */
function empath_de_reg() {
    wp_deregister_style( 'e-animations' );
}
add_action( 'wp_enqueue_scripts', 'empath_de_reg' );

/**
 * Enqueue admin styles
 */
function forcast_enqueue_admin_styles($hook) {
    wp_enqueue_style(
        'forcast-admin-style',
        QUBAR_DIR_URL . 'assets/css/admin-style.css',
        array(),
        QUBAR_VERSION
    );
}
add_action('admin_enqueue_scripts', 'forcast_enqueue_admin_styles');



/**
 * Dequeue Elemenotr Swiper Slider
 *
 * @return  [type]  [return description]
 */
function dequeue_wpml_styles(){
    wp_dequeue_style( 'swiper' );
    wp_deregister_style( 'swiper' );

    wp_dequeue_script( 'swiper' );
    wp_deregister_script( 'swiper' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_wpml_styles', 20 );



if (!class_exists('Bytf_MegaMenu_Register')) {
    require_once QUBAR_DIR_PATH . '/mega-menu/class-megamenu.php';
    Bytf_MegaMenu_Register::get_instance();
}


/**
 * Add Font Group to Elementor
 */
add_filter( 'elementor/fonts/groups', 'bytf_elementor_custom_fonts_group', 10, 1 );
function bytf_elementor_custom_fonts_group( $font_groups ) {

	$font_groups['NYTCheltenham'] = __( 'NYTCheltenham' );
	return $font_groups;
}
/**
 * Add Group Fonts to Elementor
 */
add_filter( 'elementor/fonts/additional_fonts', 'bytf_elementor_custom_fonts', 10, 1 );
function bytf_elementor_custom_fonts( $additional_fonts ) {
	// Key/value
	//Font name/font group
	$additional_fonts['NYTCheltenham'] = 'NYTCheltenham';
	return $additional_fonts;
}


/**
 * Custom Widget
 */
include_once QUBAR_INC_PATH . "/custom-widget/recent-post.php";
include_once QUBAR_INC_PATH . "/custom-widget/newsletter.php";

/**
 * Themeoption
 */
include_once QUBAR_INC_PATH . "/empath-plugin-helper.php";

function empath_afer_setup_fn(){
    /**
     * Custom Metabox
     */
    include_once QUBAR_INC_PATH . "/options/theme-metabox.php";

    /**
     * Themeoption
     */
    include_once QUBAR_INC_PATH . "/options/theme-option.php";
}
add_action( 'after_setup_theme', 'empath_afer_setup_fn' );



/**
 * Helper Function
 */
include_once QUBAR_INC_PATH . "/helper.php";


/**
 * Function
 */
include_once QUBAR_INC_PATH . "/functions.php";

/**
 * Custom Template CPT
 */
include_once QUBAR_INC_PATH . "/post-type/template.php";


/**
 * Elementor Configuration
 */
include_once QUBAR_DIR_PATH . "/elementor/elementor-init.php";


/**
 * Contact Form 7 Autop Remove
 */
add_filter('wpcf7_autop_or_not', '__return_false');


include( __DIR__ . '/lib/templates/import.php');
include( __DIR__ . '/lib/templates/init.php');
include( __DIR__ . '/lib/templates/load.php');
include( __DIR__ . '/lib/templates/api.php');

\ByteflowsTheme\Templates\Import::instance()->load();
\ByteflowsTheme\Templates\Load::instance()->load();
\ByteflowsTheme\Templates\Templates::instance()->init();

if (!defined('TEMPLATE_LOGO_SRC')){
	define('TEMPLATE_LOGO_SRC', plugin_dir_url( __FILE__ ) . '/lib/templates/assets/img/Icon.svg');
}
