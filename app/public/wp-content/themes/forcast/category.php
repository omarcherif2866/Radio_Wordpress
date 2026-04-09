<?php
/**
 * The template for displaying category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package empath
 */

get_header();
$empath_cat_st = get_term_meta( get_queried_object_id(), 'empath_cate_meta', true );
$empath_cat_template = !empty( $empath_cat_st['empath_cat_layout'] )? $empath_cat_st['empath_cat_layout'] : 'cat-layout-one';

?>
<?php if (have_posts() ): ?>
<?php 
    if( is_category() && !empty( $empath_cat_st  ) ) {
        get_template_part( 'template-parts/category-layout/'.$empath_cat_template.'' );
    }else{
        get_template_part( 'template-parts/category-layout/cat-layout', 'one' );
    }
?>
<?php  else: ?>
    
    <?php get_template_part( 'template-parts/content', 'none');?>
<?php endif; ?>
<?php
get_footer();