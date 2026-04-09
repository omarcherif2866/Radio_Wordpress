<?php

function empath_body_class($classes){

        if (is_page()) {
            global $post;
            $pid = $post->ID;
            $meta = get_post_meta($pid, '_empath_meta', 'true');
            $style_class = isset($meta['style']) && $meta['style'] ? $meta['style'] : '';
            $classes[] = $style_class;
        } else {
            $classes[] = 'ori-inner-page';
        }
        return $classes;
}
add_filter('body_class', 'empath_body_class');

function ae_drop_posts($post_type){
  $args = array(
    'numberposts' => -1,
    'post_type'   => $post_type
  );

  $posts = get_posts( $args );        
  $list = array();
  foreach ($posts as $cpost){
  //  print_r($cform);
      $list[$cpost->ID] = $cpost->post_title;
  }
  return $list;
}

function get_wp_image($source){
  if (isset($source)){
      $image =  wp_get_attachment_image( $source['id'], 'full' );
  }
  return $image;

}

function king_menu_select_choices() {
  $menus = wp_get_nav_menus();
  $items = array();
  $i     = 0;
  foreach ( $menus as $menu ) {
      if ( $i == 0 ) {
          $default = $menu->slug;
          $i ++;
      }
      $items[ $menu->slug ] = $menu->name;
  }

  return $items;
}

function ae_drop_cat($tax) {

  $categories_obj = get_categories('taxonomy='.$tax.'');
  $categories = array();

  foreach ($categories_obj as $pn_cat) {
      $categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
  }
  return $categories;         
}

function client_ratings($count){
  $out = '';
  for ($i=0; $i<$count; $i++) {
      $out.= '<li><i class="fas fa-star"></i></li>';
  }
  return $out;
}

function get_that_link($link){

  $url = $link['url'] ? 'href='.esc_url($link['url']). '' : '';
  $ext = $link['is_external'] ? 'target= _blank' : '';
  $nofollow = $link['nofollow'] ? 'rel="nofollow"' : '';
  $link = $url.' '.$ext.' '.$nofollow;
  return $link;
}

function get_that_image($source){
  if ($source){
      $image = '<img src="'. esc_url( $source['url'] ).'" alt="'.get_bloginfo( 'name' ).'">';
  }
  return $image;
}


/**
 * Post Time Ago
 */
function empath_ready_time_ago(){
  return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) );
}

function empath_category_pl(){
  $catgorys = get_the_category();
  foreach( $catgorys as $key => $category):
      ?>
      <a class="cat" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
        <?php echo esc_html($category->cat_name); ?>
      </a>
  <?php endforeach;
}

/**
 * Post Time Ago
 */
function forcast_reading_time() {	
	global $post;	
	$content = get_post_field( 'post_content', $post->ID );
	$word_count = str_word_count( strip_tags( $content ) );
	$readingtime = ceil($word_count / 200);
	if ($readingtime == 1) {
	$timer = esc_html("Read");
	} else {
	    $timer = esc_html("Read ");
	}
	if ($readingtime == 1) {
	    $timerm = esc_html(" Mins");
	} else {
	    $timerm = esc_html(" Mins");
	}
	$totalreadingtime = $timer . $readingtime . $timerm;
	return $totalreadingtime;
}


/**
 * Post Social Share
 *
 * @return void
 */
function empath_post_share() {

  $permalink = get_permalink( get_the_ID() );
  $title     = get_the_title();
?>
<span class="title s"><?php esc_html_e( 'شارك هذه المقالة:', 'empath-tools' );?></span>
  <a class="fb" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>"><i class="fab fa-facebook-f"></i></a>

  <a class="tw" onClick="window.open('http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo esc_attr( $title ); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $title ); ?>">
<svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path opacity="1" fill="#1E3050" d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a>

  <a class="ln" onClick="window.open('https://www.linkedin.com/cws/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo esc_attr( $title ); ?>','Linkedin share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $title ); ?>"><i class="fab fa-linkedin-in"></i></a>

  <a class="pt" href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><i class="fab fa-pinterest-p"></i></a>
<?php 
}

/**
 * Get Menu List
 *
 * @return void
 */
function empath_get_nav_menu(){

  $menus = array(
      '' => esc_html__('Default', 'empath')
  );

  $obj_menus = wp_get_nav_menus();

  foreach ($obj_menus as $obj_menu){
      $menus[$obj_menu->term_id] = $obj_menu->name;
  }

  return $menus;
}


/**
 * Add Contact Method User
 */
function empath_user_social_link( $methode ) {
    $methode['facebook']  = esc_html__( 'Facebook', 'empath-tools' );
    $methode['twitter']   = esc_html__( 'Twitter', 'empath-tools' );
    $methode['linkedin']  = esc_html__( 'Linkedin', 'empath-tools' );
    $methode['instagram'] = esc_html__( 'Instagram', 'empath-tools' );
    $methode['pinterest'] = esc_html__( 'Pinterest', 'empath-tools' );
    $methode['youtube']   = esc_html__( 'YouTube', 'empath-tools' );
  return $methode;
}
add_filter('user_contactmethods', 'empath_user_social_link');


/**
 * Authore
 */
function empath_authore_info() {
  
  global $post;
  if(is_object($post)):

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
  $theme_author_markup .= '<div class="inner-img">' . get_avatar( get_the_author_meta('ID') , 160 ) . '</div>';
  $theme_author_markup .= '<div class="inner-text headline pera-content">';
  $theme_author_markup .= '<h4>' . $display_name . '</h4>';
  $theme_author_markup .= '<p>' . get_the_author_meta( 'description' ). '</p>';
  $theme_author_markup .= '<div class="inner-social">';


// Check if author has Twitter in their profile

  if ( ! empty( $user_facebook ) ) {
      $theme_author_markup .= ' <a href="' . $user_facebook .'" target="_blank" rel="nofollow" class="fb_aut" title="Facebook"><i class="fab fa-facebook-f"></i> </a>';
  }

    
  if ( ! empty( $user_twitter ) ) {
      $theme_author_markup .= ' <a href="' . $user_twitter .'" target="_blank" rel="nofollow" class="twi_aut" title="Twitter"><i class="fab fa-twitter"></i> </a>';
  }

if ( ! empty( $user_instagram ) ) {
      $theme_author_markup .= ' <a href="' . $user_instagram .'" target="_blank" rel="nofollow" class="inst_aut" title="Instagram"><i class="fab fa-instagram"></i> </a>';
  }

if ( ! empty( $user_pinterest ) ) {
      $theme_author_markup .= ' <a href="' . $user_pinterest .'" target="_blank" rel="nofollow" class="pint_aut" title="Pinterest"><i class="fab fa-pinterest-p"></i> </a>';
  }

  if ( ! empty( $user_youtube ) ) {
      $theme_author_markup .= ' <a href="' . $user_youtube .'" target="_blank" rel="nofollow" class="you_aut" title="Youtube"><i class="fab fa-youtube"></i> </a>';
  }

  if ( ! empty( $user_linkedin ) ) {
      $theme_author_markup .= ' <a href="' . $user_linkedin .'" target="_blank" rel="nofollow" class="link_aut" title="linkedin"><i class="fab fa-linkedin-in"></i> </a>';
  }

  $theme_author_markup .= '</div>';
  $theme_author_markup .= '</div>';

  // Pass all this info to post content 
  echo '<div class="bi-blog-details-author flex-wrap d-flex align-items-center">' . $theme_author_markup . '</div>';
endif;
}


/**
 * Authore Avater
 */
function empath_post_author_avatars($size) {
  echo get_avatar(get_the_author_meta('email'), $size);
}

add_action('genesis_entry_header', 'empath_post_author_avatars');


function empath_menu_selector() {
  $menus = wp_get_nav_menus();
  $items = array();
  $i     = 0;
  foreach ( $menus as $menu ) {
      if ( $i == 0 ) {
          $default = $menu->slug;
          $i ++;
      }
      $items[ $menu->slug ] = $menu->name;
  }
  return $items;
}
function empath_portfolio_category(){
  $terms = get_terms( array(
    'taxonomy'    => 'portfolio_cat',
    'hide_empty'  => true,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
  $cat_list[$post->slug]  = [$post->name];
  }
  return $cat_list;
}
function empath_careero_category(){
  $terms = get_terms( array(
    'taxonomy'    => 'career_cat',
    'hide_empty'  => true,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
  $cat_list[$post->slug]  = [$post->name];
  }
  return $cat_list;
}

if ( ! function_exists( 'empath_item_tag_lists' ) ) {
  function empath_item_tag_lists(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;

      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->ID);
        }
      }
      break;

      case 'tags':
      case 'tag':

      if (isset($query_args['taxonomies']) && taxonomy_exists($query_args['taxonomies'])) {
        $tags = get_terms( $query_args['taxonomies'] );
          if ( !is_wp_error($tags) && !empty($tags) ) {
            foreach ( $tags as $tag ) {
              $options[$tag->name] = $tag->term_id;
          }
        }
      }
      break;
    }

    return $options;

  }
}

if ( ! function_exists( 'empath_get_category_lists' ) ) {
  function empath_get_category_lists(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;

      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->ID);
        }
      }
      break;

      case 'tags':
      case 'tag':

      if (isset($query_args['taxonomies']) && taxonomy_exists($query_args['taxonomies'])) {
        $tags = get_terms( $query_args['taxonomies'] );
          if ( !is_wp_error($tags) && !empty($tags) ) {
            foreach ( $tags as $tag ) {
              $options[$tag->name] = $tag->term_id;
          }
        }
      }
      break;

      case 'categories':
      case 'category':

      if (isset($query_args['taxonomy']) && taxonomy_exists($query_args['taxonomy'])) {
        $categories = get_categories( $query_args );
          if ( !empty($categories) && is_array($categories) ) {

            foreach ( $categories as $category ) {
               $options[$category->name] = $category->term_id;
            }
          }
      }
      break;

    }

    return $options;

  }
}

/**
 * Post get View Count
 */
function empath_get_views( $id = false ) {
  if ( !$id ) {
      $id = get_the_ID();
  }

  $number = get_post_meta( $id, '_empath_views_count', true );
  $precision = 2;
  if ( empty( $number ) ) {
      $number = 0;
  }

  if ( $number >= 1000 && $number < 1000000 ) {
      $formatted = number_format( $number / 1000, $precision ) . 'K';
  } else if ( $number >= 1000000 && $number < 1000000000 ) {
      $formatted = number_format( $number / 1000000, $precision ) . 'M';
  } else if ( $number >= 1000000000 ) {
      $formatted = number_format( $number / 1000000000, $precision ) . 'B';
  } else {
      $formatted = $number;
  }
  $formatted = str_replace( '.00', '', $formatted );

  return $formatted;
}

/**
* Post Update View Count
*/
function empath_update_views() {
  if ( !is_single() || !is_singular( 'post' ) ) {
      return;
  }

  $id = get_the_ID();

  $number = get_post_meta( $id, '_empath_views_count', true );
  if ( empty( $number ) ) {
      $number = 1;
      add_post_meta( $id, '_empath_views_count', $number );
  } else {
      $number++;
      update_post_meta( $id, '_empath_views_count', $number );
  }
}
add_action( 'wp', 'empath_update_views' );

/**
 * Load Template
 *
 * @return void
 */
function empath_load_elementor_template(){
	$page_templates = get_posts( [
		'post_type'         => 'elementor_library',
		'posts_per_page'    => -1
	] );

	$options = [];

	if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
		foreach ( $page_templates as $template ) {
			$options[ $template->ID ] = $template->post_title;
		}
	}
	return $options;
}


/**
 * Display Elementor Template
 *
 * @return void
 */
function empath_elemento_display() {
	return \Elementor\Plugin::instance();
}


// Enable SVG uploads
function bytf_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'bytf_mime_types');

// Sanitize SVG files
function bytf_sanitize_svg($file) {
  if ($file['type'] == 'image/svg+xml') {
    $svg = simplexml_load_file($file['tmp_name']);

    if ($svg === false) {
      $file['error'] = 'Invalid SVG file';
      return $file;
    }

    // Remove any potentially dangerous elements or attributes
    $sanitized_svg = bytf_sanitize_svg_content($svg);

    // Save the sanitized SVG back to the file
    file_put_contents($file['tmp_name'], $sanitized_svg->asXML());
  }

  return $file;
}
add_filter('wp_handle_upload_prefilter', 'bytf_sanitize_svg');

// Sanitize SVG content
function bytf_sanitize_svg_content($svg) {
  $dangerous_elements = ['script', 'iframe', 'object', 'embed'];
  foreach ($dangerous_elements as $element) {
    foreach ($svg->xpath('//' . $element) as $dangerous) {
      unset($dangerous[0]);
    }
  }

  return $svg;
}