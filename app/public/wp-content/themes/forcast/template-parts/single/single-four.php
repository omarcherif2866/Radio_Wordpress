<?php
/**
 * Template part for displaying single posts 1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package empath
 */

$authore_info_show = cs_get_option('authore_info_show');
$single_post_comment_disable = cs_get_option('single_post_comment_disable');
$related_post_disable = cs_get_option('related_post_disable');
$blog_tags = cs_get_option('blog_tags');
$blog_share = cs_get_option('blog_share');
$blog_nav = cs_get_option('blog_nav');
$authore_show = cs_get_option('authore_show');
$ajax_scroll_stop = cs_get_option('ajax_scroll_stop');

$view_count_disable = cs_get_option('view_count_disable');
$post_comment_disable = cs_get_option('post_comment_disable');
$post_date_disable = cs_get_option('post_date_disable');

$empathPostClass = '';
if(is_active_sidebar('sidebar-1')){
	$empathPostClass = 'col-xl-8';
}else{
	$empathPostClass = 'col-lg-10 offset-lg-1';
}
?>
<div class="bytf__single-post-wrapper">
    <div class="container">
        <div class="single__post-article">
            <div class="row">
                <div class="<?php echo esc_attr($empathPostClass);?>">
                <?php
                    while ( have_posts() ) :
                        the_post();?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="single__top-wrapper top__wrapper-four">
                                <div class="single__one_top">
                                    <div class="single_title">
                                        <?php if(function_exists('empath_category_badge_seven')){empath_category_badge_seven();}?>
                                        <h1><?php the_title();?></h1>
                                    </div>
                                    <div class="singe__post-meta">
                                        <div class="bytf__postmeta meta__dark">
                                            <ul class="d-flex align-items-center">
                                                    <li class="authore">
                                                        <?php if (function_exists('empath_post_author_avatars')) {
                                                            empath_post_author_avatars(25);
                                                        } ?>
                                                        <?php $username = get_userdata($post->post_author); ?>    
                                                        <a aria-label="name" href="<?php echo get_author_posts_url($post->post_author); ?>">
                                                            <?php echo esc_html($username->display_name); ?>
                                                        </a>
                                                    </li>

                                                    <li><i class="fal fa-calendar"></i> <?php echo esc_html(get_the_time( get_option('date_format')));?></li>
                                                    <li class="comment"><i class="far fa-comment"></i> 
                                                    <?php echo esc_attr(get_comments_number());?> <?php
                                                        if(get_comments_number() == 1 ){
                                                            esc_html_e( 'Comment', 'forcast' );
                                                        }else{
                                                            esc_html_e( 'Comments', 'forcast' );
                                                        }                                
                                                    ?>
                                                    </li>
                                                    <?php if(function_exists('empath_get_views')):?>
                                                    <li class="view-wrapper">
                                                        <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.99219 13V5.5" stroke="#585858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M8.98438 13V1" stroke="#585858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M1 13V10" stroke="#585858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    <span class="view-ct"><?php echo esc_html(empath_get_views());?> <?php esc_html_e('Views', 'forcast');?></span></li>
                                                    <?php endif;?>
                                                    <li><?php if(function_exists('empath_bookmark_trigger')){empath_bookmark_trigger();}?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="post_excerpt">
                                        <?php the_excerpt();?>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                get_template_part('template-parts/post-formats/content'); 
                            ?>
                            <div class="entry-content empath__single-content">
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
                            </div><!-- .entry-content -->
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                        <?php 

                    endwhile; // End of the loop.
                    ?>
                    <div class="single__footer-wrapper">
                        <?php if(function_exists('empath_entry_footer')):?>
                            <div class="post_tags">
                                <?php empath_entry_footer();?>
                            </div>
                        <?php endif;?>
                        <?php if(function_exists('empath_single_share')):?>
                            <div class="single__top-social">
                                <?php empath_single_share();?>
                            </div>
                        <?php endif;?>
                    </div>
                    <div class="single__navigation-wrapper">
                        <?php empath_single_post_pagination();?>
                    </div>
                    <?php 

                            // If comments are open or we have at least one comment, load up the comment template.
                            if($single_post_comment_disable == true ){                            
                            if ( comments_open() || get_comments_number()) :
                                comments_template();
                            endif; }?>
                </div>
                <div class="col-xl-4 col-lg-8 mx-auto">
                    <?php get_sidebar();?>
                </div>
            </div>
        </div>
    </div>
</div>