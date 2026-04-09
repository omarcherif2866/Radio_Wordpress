<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package empath
 */
$categories = get_the_category();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single__post-main-content'); ?>>
    <div class="entry-content">
        <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'forcast' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'forcast' ),
                    'after'  => '</div>',
                )
            );
        ?>
    </div>
    <div class="empath__post-footer">
        <?php if(function_exists('empath_post_share')):?>
        <div class="empath__post-share">
            <?php empath_post_share();?>
        </div>
        <?php endif;?>
        <div class="empath__post-meta">
            <?php empath_entry_footer();?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
<?php 
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;

?>
