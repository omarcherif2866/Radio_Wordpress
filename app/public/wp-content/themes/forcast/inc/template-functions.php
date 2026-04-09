<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package empath
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function empath_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'empath_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function empath_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'empath_pingback_header' );

function animated_line(){ 
if(get_post_meta(get_the_ID(), 'empath_inside_meta', true)) {
	$page_meta = get_post_meta(get_the_ID(), 'empath_inside_meta', true);
} else {
	$page_meta = array();
}

if( array_key_exists( 'page_line_style', $page_meta )) {
	$page_line_style = $page_meta['page_line_style'];
} else {
	$page_line_style = '1';
}
?>
	<div class="vertical-lines-wrapper <?php if($page_line_style != 1){ echo esc_attr('alternate');}?>">
        <div class="vertical-lines <?php if($page_line_style != 1){ echo esc_attr('light');}?>">
			<div class="vertical-effect"></div>
			<div class="vertical-effect"></div>
			<div class="vertical-effect"></div>
			<div class="vertical-effect"></div>
			<div class="vertical-effect"></div>
			<div class="vertical-effect"></div>
			<div class="vertical-effect"></div>
			<div class="vertical-effect"></div>
		</div>
	</div>
<?php
}


/**
 * Authore Avater
 */
function empath_main_author_avatars($size) {
    echo get_avatar(get_the_author_meta('email'), $size);
}
  
add_action('genesis_entry_header', 'empath_post_author_avatars');

/**
 * Search Widget
 */
function empath_search_widgets( $form ) {
    $form = '<div class="search-widget"><div class="widget-area"><form method="get" id="searchform" class="search-input position-relative" action="' . home_url( '/' ) . '" >
    <input class="form_control" placeholder="' .esc_attr__( 'Search...', 'forcast' ) . '" type="text"  value="' . get_search_query() . '" name="s" id="s" />
    <button type="submit"><span class="icon fa fa-search"></span></button>
    </form></div></div>';
    return $form;
}
add_filter( 'get_search_form', 'empath_search_widgets', 100 );

/**
 * Category Count Markup
 */
function empath_category_html( $links ) {
    $links = str_replace( '</a> (', '<span class="cat-number">(', $links );
	$links = str_replace( ')', '</span></a>', $links );
    return $links;
}
add_filter( 'wp_list_categories', 'empath_category_html' );

/**
 * empath Archive Customiz
 *
 * @param   [type]  $links  [$links description]
 *
 * @return  [type]          [return description]
 */
function empath_archive_html($links) {
    $links = str_replace('</a>&nbsp;(', '<span class="number">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}

add_filter('get_archives_link', 'empath_archive_html');

/**
 * pagination
 */
if ( !function_exists( 'empath_pagination' ) ) {

    function _empath_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function empath_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul class="styled-pagination text-center d-flex align-items-center justify-content-center mb-0 pl-0">';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _empath_pagi_callback( $pagi );
    }
}

/**
 * Comment List Modification
 */

 function empath_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;?>

	<li  <?php comment_class('comment comments-content');?> id="comment-<?php comment_ID()?>">
        <div class="empath-comment-item d-flex">
			<?php if ( get_avatar( $comment ) ) {?>
				<div class="empath-comment-img">
					<?php echo get_avatar( $comment, 60 ); ?>
				</div>
			<?php }?>

			<div class="comments-text">
				<div class="trsp-comment__int-text">
					<div class="author-name-date">
						<h4 class="cmt-name"><?php comment_author_link()?></h4>
						<span class="cmt-date"><?php echo esc_html(get_the_time( get_option('date_format')));?></span> 
					</div>
					<?php if ( $comment->comment_approved == '0' ): ?>
						<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'forcast' );?></em></p>
					<?php endif;?>
					<?php comment_text();?>
				</div>
				<div class="cmt-reply position-absolute text-capitalize">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => wp_kses('Reply', true) ) ) );?>
				</div>
			</div>
        </div>
	</li>


<?php
}


/**
 * Comment Message Box
 */
function empath_comment_reform( $arg ) {

	$arg['title_reply']   = esc_html__( 'Leave a comment', 'forcast' );
	$arg['comment_field'] = '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 form-group"><textarea id="comment" class="form_control" name="comment" cols="77" rows="3" placeholder="' . esc_attr__( "Comment", "forcast" ) . '" aria-required="true"></textarea></div></div>';

	return $arg;

}
add_filter( 'comment_form_defaults', 'empath_comment_reform' );


/**
 * Comment Form Field
 */
function empath_modify_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );

	$fields['author'] = '<div class="row"><div class="col-lg-6 col-md-6 col-sm-12 form-group"><input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( "Name", "forcast" ) . '" size="22" tabindex="1"' . ( $req ? 'aria-required="true"' : '' ) . ' class="form_control" /></div>';

	$fields['email'] = '<div class="col-lg-6 col-md-6 col-sm-12 form-group"><input type="email" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( "Email", "forcast" ) . '" size="22" tabindex="2"' . ( $req ? 'aria-required="true"' : '' ) . ' class="form_control"  /></div>';

	$fields['url'] = '<div class="col-lg-12 col-md-12 col-sm-12 form-group"><input type="url" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( "Website", "forcast" ) . '" size="22" tabindex="2"' . ( $req ? 'aria-required="false"' : '' ) . ' class="form_control"  /></div></div>';

	return $fields;
}
add_filter( 'comment_form_default_fields', 'empath_modify_comment_form_fields' );

// comment Move Field
function empath_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'empath_move_comment_field_to_bottom' );


/**
 * empath Single Post Nav
 */
function empath_single_post_pagination(){ 
    $empath_prev_post = get_previous_post();
    $empath_next_post = get_next_post();
    $prev_title = cs_get_option('prev_title');
    $next_title = cs_get_option('next_title');
?>

<div class="more-posts">
	<div class="d-flex justify-content-between align-items-center">
		<div class="prev-posts">
			<a aria-label="name" class="navi__post-main-item" href="<?php echo esc_url(get_the_permalink($empath_prev_post));?>">
				<div class="post-image">
					<img src="<?php echo esc_url(get_the_post_thumbnail_url($empath_prev_post, 'thumbnail'));?>" alt="<?php the_title_attribute();?>">
				</div>
				<div class="post__content">
					<span class="np-btn"><?php echo esc_html($prev_title)?></span>
					<h4><?php echo esc_html(wp_trim_words( get_the_title($empath_prev_post), 8, '...' ));?></h4>
				</div>
			</a>
			
		</div>
		<div class="next-posts">
			<a aria-label="name" class="navi__post-main-item" href="<?php echo esc_url(get_the_permalink($empath_next_post));?>">
				<div class="post__content">
					<span class="np-btn"><?php echo esc_html($next_title)?></span>
					<h4><?php echo esc_html(wp_trim_words( get_the_title($empath_next_post), 8, '...' ));?></h4>
				</div>
				<div class="post-image">
					<img src="<?php echo esc_url(get_the_post_thumbnail_url($empath_next_post, 'thumbnail'));?>" alt="<?php the_title_attribute();?>">
				</div>
			</a>
		</div>
	</div>
</div>
<?php 
}

/**
 * Product Per Page Count
 *
 * @param [type] $per_page
 * @return void
 */ 

 function empath_product_count( $cols ) {
	$product_count = cs_get_option('product_count');
  $cols = !empty($product_count) ? $product_count : '12';
  return $cols;
}
add_filter( 'loop_shop_per_page', 'empath_product_count', 20 );


function empath_category_badge(){
    $catgorys = get_the_category();
    foreach( $catgorys as $key => $category):

		$meta = get_term_meta($category->term_id, 'empath_cate_meta', true);

		$catemeta = !empty( $meta['cate-color'] )? $meta['cate-color'] : 'var(--thm-primary)';
        ?>
        <a aria-label="name" class="elementor-common-cate empath-cate-badge" href="<?php echo esc_url(get_category_link($category->term_id)); ?>" style="background-color:<?php echo esc_attr($catemeta);?>;">
        	<span><?php echo esc_html($category->cat_name); ?></span> 
        </a>
    <?php endforeach;
}
function empath_category_badge_five(){
    $catgorys = get_the_category();
    foreach( $catgorys as $key => $category):

		$meta = get_term_meta($category->term_id, 'empath_cate_meta', true);

		$catemeta = !empty( $meta['cate-color'] )? $meta['cate-color'] : 'var(--thm-primary)';
        ?>
        <a aria-label="name" class="elementor-common-cate empath-cate-badge-4" href="<?php echo esc_url(get_category_link($category->term_id)); ?>" style="background-color:<?php echo esc_attr($catemeta);?>;">
        	<span><?php echo esc_html($category->cat_name); ?></span> 
            <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path  d="M9.77924 0H1.07518C0.106704 0 -0.296235 1.2391 0.48701 1.80873L11.9764 10.1646C12.7631 10.7368 13.8209 9.96258 13.5132 9.03967L10.7279 0.683772C10.5918 0.27543 10.2097 0 9.77924 0Z" fill="<?php echo esc_attr($catemeta);?>"/>
            </svg>

        </a>
    <?php endforeach;
}
function empath_category_badge_two(){
    $catgorys = get_the_category();
    foreach( $catgorys as $key => $category):

        ?>
        <a aria-label="name" class="empath-cate-badge-two elementor-common-cate" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
        	<span><?php echo esc_html($category->cat_name); ?></span> 
        </a>
    <?php endforeach;
}

function empath_category_badge_three(){
    $catgorys = get_the_category();
    foreach( $catgorys as $key => $category):

		$meta = get_term_meta($category->term_id, 'empath_cate_meta', true);

		$catemeta = !empty( $meta['cate-color'] )? $meta['cate-color'] : 'var(--thm-primary)';
        ?>
        <a aria-label="name" class="empath-cate-badge-three elementor-common-cate" href="<?php echo esc_url(get_category_link($category->term_id)); ?>" style="background-color:<?php echo esc_attr($catemeta);?>;">
        	<span><?php echo esc_html($category->cat_name); ?></span> 
        </a>
    <?php endforeach;
}
/**
 * Style Four
 *
 * @return void
 */
function empath_category_badge_four(){
    $catgorys = get_the_category();
    foreach( $catgorys as $key => $category):

		$meta = get_term_meta($category->term_id, 'empath_cate_meta', true);
        ?>
        <a aria-label="name" class="empath-cate-badge-four elementor-common-cate" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
        	<span><?php echo esc_html($category->cat_name); ?></span> 
        </a>
    <?php endforeach;
}
/**
 * Style Six
 *
 * @return void
 */
function empath_category_badge_six(){
    $catgorys = get_the_category();
    foreach( $catgorys as $key => $category):

		$meta = get_term_meta($category->term_id, 'empath_cate_meta', true);
        ?>
        <a aria-label="name" class="empath-cate-badge-six elementor-common-cate" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
        	<span><?php echo esc_html($category->cat_name); ?></span> 
        </a>
    <?php endforeach;
}

function empath_category_badge_seven(){
    $catgorys = get_the_category();
    foreach( $catgorys as $key => $category):

		$meta = get_term_meta($category->term_id, 'empath_cate_meta', true);

		$catemeta = !empty( $meta['cate-color'] )? $meta['cate-color'] : 'var(--thm-primary)';
        ?>
        <a aria-label="name" class="empath-cate-badge-seven elementor-common-cate" href="<?php echo esc_url(get_category_link($category->term_id)); ?>" style="background-color:<?php echo esc_attr($catemeta);?>;">
        	<span>- <?php echo esc_html($category->cat_name); ?></span> 
        </a>
    <?php endforeach;
}

/**
 * Authore Post
 */
function byteflows_theme_author_page() {

    global $post;

    $theme_author_markup = '';
    // Get author's display name
    $display_name = get_the_author_meta( 'display_name', $post->post_author );

    // If display name is not available then use nickname as display name
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );

    // Get author's biographical information or description
    $user_description   = get_the_author_meta( 'user_description', $post->post_author );
    
    $user_facebook      = get_the_author_meta('facebook', $post->post_author);
    $user_twitter       = get_the_author_meta('twitter', $post->post_author);
    $user_linkedin      = get_the_author_meta('linkedin', $post->post_author);
    $user_instagram     = get_the_author_meta('instagram', $post->post_author);
	$user_pinterest     = get_the_author_meta('pinterest', $post->post_author);
	$user_youtube       = get_the_author_meta('youtube', $post->post_author);

    // Get link to the author archive page
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
    if ( ! empty( $display_name ) )
    // Author avatar - - the number 90 is the px size of the image.
    $theme_author_markup .= '<div class="author-thumb">' . get_avatar( get_the_author_meta('ID') , 106 ) . '</div>';
    $theme_author_markup .= '<div class="theme_author_Info">';    
    $theme_author_markup .= '<h4 class="theme_author__Name">' . $display_name . '</h4>';
    $theme_author_markup .= '<p class="theme_author__Description">' . get_the_author_meta( 'description' ). '</p>';
    $theme_author_markup .= '<div class="theme_author_socials_icon">';


	// Check if author has Twitter in their profile
	
    if ( ! empty( $user_facebook ) ) {
        $theme_author_markup .= ' <a aria-label="name" href="' . $user_facebook .'" target="_blank" rel="nofollow" class="fb_aut" title="Facebook"><i class="fab fa-facebook-f"></i> </a>';
    }
	
	    
    if ( ! empty( $user_twitter ) ) {
        $theme_author_markup .= ' <a aria-label="name" href="' . $user_twitter .'" target="_blank" rel="nofollow" class="twi_aut" title="Twitter"><i class="fab fa-twitter"></i> </a>';
    }
	
	if ( ! empty( $user_instagram ) ) {
        $theme_author_markup .= ' <a aria-label="name" href="' . $user_instagram .'" target="_blank" rel="nofollow" class="inst_aut" title="Instagram"><i class="fab fa-instagram"></i> </a>';
    }
	
	if ( ! empty( $user_pinterest ) ) {
        $theme_author_markup .= ' <a aria-label="name" href="' . $user_pinterest .'" target="_blank" rel="nofollow" class="pint_aut" title="Pinterest"><i class="fab fa-pinterest-p"></i> </a>';
    }

    if ( ! empty( $user_youtube ) ) {
        $theme_author_markup .= ' <a aria-label="name" href="' . $user_youtube .'" target="_blank" rel="nofollow" class="you_aut" title="Youtube"><i class="fab fa-youtube"></i> </a>';
    }

    if ( ! empty( $user_linkedin ) ) {
        $theme_author_markup .= ' <a aria-label="name" href="' . $user_linkedin .'" target="_blank" rel="nofollow" class="link_aut" title="linkedin"><i class="fab fa-linkedin-in"></i> </a>';
    }

    $theme_author_markup .= '</div></div><div class="auth__total_post text-center"><div class="auth__total_post-inner"><h2>'.count_user_posts( get_the_author_meta('ID') ).'</h2><p>'.esc_html__( 'Articles', 'forcast' ).'</p></div></div>';

    // Pass all this info to post content 
    echo '<div class="empath__author_bio__Wrapper" >' . $theme_author_markup . '</div>';
}

function empath_wp_kses( $val ) {
    return wp_kses( $val, array(

        'p'      => array(
            'class' => array(),
            'style' => array(),
        ),

        'img'    => array(
            'src'   => array(),
            'alt'   => array(),
            'class' => array(),
            'style' => array(),
        ),
        'span'   => array(
            'class' => array(),
            'style' => array(),
        ),
        'small'  => array(),
        'div'    => array(
            'style' => array(),
        ),
        'strong' => array(
            'style' => array(),
        ),
        'b'      => array(
            'style' => array(),
        ),
        'br'     => array(),
        'h1'     => array(
            'style' => array(),
        ),
        'i'      => array(
            'class' => array(),
            'style' => array(),
        ),
        'ul'     => array(
            'class' => array(),
            'style' => array(),
        ),
        'ul'     => array(
            'id' => array(),
        ),
        'li'     => array(
            'class' => array(),
            'style' => array(),
        ),
        'li'     => array(
            'id' => array(),
        ),
        'h1'     => array(
            'style' => array(),
        ),
        'h2'     => array(),
        'h3'     => array(
            'style' => array(),
        ),
        'h4'     => array(
            'style' => array(),
        ),
        'h5'     => array(
            'style' => array(),
        ),
        'h6'     => array(
            'style' => array(),
        ),
        'a'      => array( 
            'href' => array(), 
            'target' => array(),
            'style' => array(),
        ),
        'iframe' => array( 'src' => array(), 'height' => array(), 'width' => array() ),

    ), '' );
}