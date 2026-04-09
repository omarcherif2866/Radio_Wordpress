<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package empath
 */
$categories = get_the_category();  
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('empath__blog-item-main'); ?>>
	<?php if(has_post_thumbnail()){?>
		<div class="empath__blog-thumb">
				<a aria-label="name" href="<?php the_permalink();?>"><?php the_post_thumbnail( 'empath-img-size' )?></a>
		</div>
	<?php }?>
<div class="empath__blog-content">
	<?php if(function_exists('empath_category_badge')){empath_category_badge();}?>
	<h2><a aria-label="name" href="<?php the_permalink();?>"><?php the_title();?></a></h2>
	<p><?php the_excerpt();?></p>
	<div class="bytf__postmeta meta__dark">
		<ul class="d-flex align-items-center">
				<li class="authore"><?php if(function_exists('empath_post_author_avatars')){empath_post_author_avatars(25);} ?> <?php $username = get_userdata( $post->post_author ); ?>    
				<a aria-label="name" href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo esc_html($username->user_nicename); ?></a></li>
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
				<li class="ml-auto"><?php if(function_exists('empath_bookmark_trigger')){empath_bookmark_trigger();}?></li>
		</ul>
	</div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->

