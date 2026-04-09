<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package empath
 */

get_header();
$empathPostClass = '';
if(is_active_sidebar('sidebar-1')){
	$empathPostClass = 'col-lg-8 col-md-12 col-sm-12';
}else{
	$empathPostClass = 'col-lg-10 offset-lg-1';
}
?>
<section class="empath__blog-wrapper internal__pading">
	<div class="container">
		<div class="row">
			<!-- Content Side -->
			<div class="<?php echo esc_attr($empathPostClass);?>">
				<?php empath_post_loop();?>
			</div>
			<!-- Sidebar Side -->
			<div class="col-lg-4">
				<?php get_sidebar();?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
