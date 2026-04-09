<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package empath
 */

get_header();
?>
<section class="internal__pading">
	<div class="container">
		<div class="bi-blog-feed-content-3">
			<div class="row">
				<div class="col-lg-12">
					<?php empath_page_loop();?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
