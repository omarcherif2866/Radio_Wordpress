<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package empath
 */
if(get_post_meta(get_the_ID(), 'empath_inside_meta', true)) {
	$header_meta = get_post_meta(get_the_ID(), 'empath_inside_meta', true);
} else {
	$header_meta = array();
}

if( array_key_exists( 'page_header_disable', $header_meta )) {
	$page_header_disable = $header_meta['page_header_disable'];
} else {
	$page_header_disable = false;
}
$preloader_enable = cs_get_option('preloader_enable');
$meta_desc = cs_get_option('meta_desc');

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php if(!empty($meta_desc)){echo empath_wp_kses($meta_desc);}?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
if (function_exists('empath_mouse_cursor')) {
    //empath_mouse_cursor();
}

if ( $preloader_enable == true && function_exists('bytf_preloader')) {
    print bytf_preloader();
}

if (function_exists('empath_scroll_up_btn')) {
    empath_scroll_up_btn();
}
?>

<?php
if($page_header_disable != true){
	Empath_Helper::empath_header_template();
}

do_action('empath_before_main_content');

?>
