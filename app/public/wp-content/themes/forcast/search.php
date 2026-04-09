<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
	<div class="container-fluid">
		<div class="row">
			<?php empath_search_loop();?>
		</div>
	</div>
</section>

<?php
get_footer();
