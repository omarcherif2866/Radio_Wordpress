<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package empath
 */

get_header();
$error_bg = cs_get_option('error_bg');
$error_code = cs_get_option('error_code');
$error_title = cs_get_option('error_title');
$error_text = cs_get_option('error_text');
$error_button = cs_get_option('error_button');
?>

<section class="empath__error-page internal__pading">
	<div class="container">
		<div class="error-img text-center">
			<img src="<?php if(!empty($error_code['url'])){ echo esc_url($error_code['url']);}else{echo esc_url(get_template_directory_uri() . '/assets/img/404.svg');}?>" alt="<?php esc_attr_e( '404', 'forcast' );?>" />
		</div>
		<div class="error-text-btn text-center headline">
			<h2><?php if(!empty($error_title)){echo esc_html($error_title);}else{ esc_html_e( 'Oops! Page Not found.', 'forcast' );}?></h2>
			<p><?php if(!empty($error_text)){echo esc_html($error_text);}else{ esc_html_e( 'You’re either misspelling the URL or requesting a page thats no longer here.', 'forcast' );}?></p>
			<div class="error_btn">
				<a aria-label="name" class="thm__btn" href="<?php echo esc_url(home_url( '/' ));?>"> <?php if(!empty($error_button)){echo esc_html($error_button);}else{ esc_html_e( 'Go Back Home', 'forcast' );}?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
