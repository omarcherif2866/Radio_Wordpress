<?php

/**
 * [empath_breadcrumb description]
 * @return [type] [description]
 */
function empath_breadcrumb() {

    $wpbreadcrumb_class = '';
    $breadcrumb_show = 1;

    $id = get_the_ID();

    if ( is_front_page() && is_home() ) {
        $title = get_the_title();
        $wpbreadcrumb_class = 'byts-home-page';
    } elseif ( is_front_page() ) {
        $title = get_the_title();
        $breadcrumb_show = 0;

    } elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $id = get_option( 'page_for_posts' );
            $title = get_the_title( get_option( 'page_for_posts' ) );
        }
    } elseif ( is_single() && 'post' == get_post_type() ) {
        $title = get_the_title();
    } elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'forcast' ) . get_search_query();
    } elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'forcast' );
    } elseif ( function_exists( 'is_woocommerce' ) && is_shop() ) {
        $title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
    } elseif ( function_exists( 'is_woocommerce' ) && is_product() ) {
        $title = __( 'Product Details', 'forcast' );
    } elseif ( function_exists( 'is_woocommerce' ) && is_product_tag() ) {
        $title = get_the_archive_title();
    } elseif ( function_exists( 'is_woocommerce' ) && is_product_category() ) {
        $title = get_the_archive_title();
    } elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }

    // from page meta
    if ( get_option( 'page_for_posts' ) ) {
        $page_for_posts = get_queried_object_id();
        $page_for_posts_meta = get_post_meta( $page_for_posts, 'empath_inside_meta', true ) ? get_post_meta( $page_for_posts, 'empath_inside_meta', true ) : [];
    } else {
        $page_meta = get_post_meta( $id, 'empath_inside_meta', true ) ? get_post_meta( $id, 'empath_inside_meta', true ) : [];
    }

    if ( get_option( 'page_for_posts' ) ) {
        $enable_page_preadcrumb = array_key_exists( 'enable_page_preadcrumb', $page_for_posts_meta ) ? $page_for_posts_meta['enable_page_preadcrumb'] : true;
    } else {
        $enable_page_preadcrumb = array_key_exists( 'enable_page_preadcrumb', $page_meta ) ? $page_meta['enable_page_preadcrumb'] : true;
    }

    if ( get_option( 'page_for_posts' ) ) {
        $enable_bg_image = array_key_exists( 'enable_bg_image', $page_for_posts_meta ) ? $page_for_posts_meta['enable_bg_image'] : true;
    } else {
        $enable_bg_image = array_key_exists( 'enable_bg_image', $page_meta ) ? $page_meta['enable_bg_image'] : true;
    }

    if ( $enable_page_preadcrumb == true && $breadcrumb_show == 1 ) {

        // from page meta
        if ( get_option( 'page_for_posts' ) ) {
            $bg_img_from_page = array_key_exists( 'bg_img_from_page', $page_for_posts_meta ) ? $page_for_posts_meta['bg_img_from_page'] : '';
            $enable_custom_title = array_key_exists( 'enable_custom_title', $page_for_posts_meta ) ? $page_for_posts_meta['enable_custom_title'] : false;
            $page_custom_title = array_key_exists( 'page_custom_title', $page_for_posts_meta ) ? $page_for_posts_meta['page_custom_title'] : '';
        } else {
            $bg_img_from_page = array_key_exists( 'bg_img_from_page', $page_meta ) ? $page_meta['bg_img_from_page'] : '';
            $enable_custom_title = array_key_exists( 'enable_custom_title', $page_meta ) ? $page_meta['enable_custom_title'] : false;
            $page_custom_title = array_key_exists( 'page_custom_title', $page_meta ) ? $page_meta['page_custom_title'] : '';
        }

        // from theme option
        $breadcrumb_bg = cs_get_option( 'breadcrumb_bg_img' );
        $shop_breadcrumb_bg = cs_get_option( 'shop_breadcrumb_bg' );
        $bg_img = !empty( $breadcrumb_bg ) ? $breadcrumb_bg['url'] : '';

        if ( $enable_bg_image == false ) {
            $bg_img = $bg_img;
        } else {
            $bg_img = !empty( $bg_img_from_page['url'] ) ? $bg_img_from_page['url'] : $bg_img;
        }

        $shop_details_breadcrumb = is_single() && 'product' == get_post_type() ? ' no-breadcrumb-ttile' : '';
        $bg_url = !empty($bg_img) ? $bg_img : get_template_directory_uri() . '/assets/img/breadcrumb-mask.webp';


        $title = $enable_custom_title == true ? $page_custom_title : $title;

        // check if front page
        if ( is_front_page() ) {
            $title = __('Blog', 'forcast');
        }elseif(is_post_type_archive('product') ){
             $shop_breadcrumb_title = cs_get_option('shop_breadcrumb_title');
             $title = $shop_breadcrumb_title ? $shop_breadcrumb_title : esc_html__('Shop', 'forcast');
        }elseif(is_singular('product') ){
             $shop_single_breadcrumb_title = cs_get_option('shop_single_breadcrumb_title');
             $title = $shop_single_breadcrumb_title ? $shop_single_breadcrumb_title : esc_html__('Product Details', 'forcast');
        }

        if ( has_nav_menu( 'main-menu' ) ) {
            $no_menu_class = '';
        } else {
            $no_menu_class = ' pt-200';
        }
        ?>
        <?php if(is_single()):?>
            <section class="empath__breadcrumb-single">
                <div class="container">
                    <div class="empath__bacrumb-inner">
                        <?php
                            echo empath_breadcrumb_callback();
                        ?>
                    </div>
                </div>
            </section>	
        <?php else:?>
            <section class="empath__breadcrumb-wrapper" style="background-image:url(<?php echo esc_url($bg_url); ?>)">
                <div class="container">
                    <div class="empath__bacrumb-inner">
                        <?php
                            if(!is_search()){
                                echo empath_breadcrumb_callback();
                            }
                        ?>  
                        <?php
                            if(is_search()){
                                get_search_form();
                            }
                        ?>
                    </div>
                    <div class="bar__title">
                        <h2><?php echo wp_kses_post( $title ); ?></h2>
                    </div>
                </div>
            </section>	
            <?php endif;?>
        <?php
    }
}
add_action( 'empath_before_main_content', 'empath_breadcrumb' );

function empath_breadcrumb_callback() {
    global $wp_query;
	$queried_object = get_queried_object();
	$breadcrumb     = '<ul>';
	$delimiter      = '';
	$before         = '<li>';
	$after          = '</li>';
	if ( ! is_front_page() ) {
		$breadcrumb .= $before . '<a aria-label="name" href="' . home_url( '/' ) . '">' . esc_html__( 'Home', 'forcast' ) . ' &nbsp;</a>' . $after;
		/** If category or single post */
		if ( is_category() ) {
			$cat_obj       = $wp_query->get_queried_object();
			$this_category = get_category( $cat_obj->term_id );
			if ( $this_category->parent != 0 ) {
				$parent_category = get_category( $this_category->parent );
				$breadcrumb      .= get_category_parents( $parent_category, true, $delimiter );
			}
			$breadcrumb .= $before . '<a aria-label="name" href="' . get_category_link( get_query_var( 'cat' ) ) . '">' . single_cat_title( '', false ) . '</a>' . $after;
		} elseif ( $wp_query->is_posts_page ) {
			$breadcrumb .= $before . $queried_object->post_title . $after;
		} elseif ( is_tax() ) {
			$breadcrumb .= $before . '<a aria-label="name" href="' . get_term_link( $queried_object ) . '">' . $queried_object->name . '</a>' . $after;
		} elseif ( is_page() ) /** If WP pages */ {
			global $post;
			if ( $post->post_parent ) {
				$anc = get_post_ancestors( $post->ID );
				foreach ( $anc as $ancestor ) {
					$breadcrumb .= $before . '<a aria-label="name" href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . ' &nbsp;</a>' . $after;
				}
				$breadcrumb .= $before . '' . get_the_title( $post->ID ) . '' . $after ;
			} else {
				$breadcrumb .= $before . get_the_title() . $after ;
			}
		} elseif ( is_singular() ) {
			if ( $category = wp_get_object_terms( get_the_ID(), array( 'category', 'location', 'tax_feature' ) ) ) {
				if ( ! is_wp_error( $category ) ) {
					$breadcrumb .= $before . '<a aria-label="name" href="' . get_term_link( binsro_set( $category, '0' ) ) . '">' . binsro_set( binsro_set( $category, '0' ), 'name' ) . '&nbsp;</a>' . $after;
					$breadcrumb .= $before . get_the_title() . $after ;
				} else {
					$breadcrumb .= $before . get_the_title() . $after ;
				}
			} else {
				$breadcrumb .= $before . get_the_title() . $after ;
			}
		} elseif ( is_tag() ) {
			$breadcrumb .= $before . '<a aria-label="name" href="' . get_term_link( $queried_object ) . '">' . single_tag_title( '', false ) . '</a>' . $after;
		} /**If tag template*/
		elseif ( is_day() ) {
			$breadcrumb .= $before . '<a aria-label="name" href="#">' . esc_html__( 'Archive for ', 'forcast' ) . get_the_time( 'F jS, Y' ) . '</a>' . $after;
		} /** If daily Archives */
		elseif ( is_month() ) {
			$breadcrumb .= $before . '<a aria-label="name" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . __( 'Archive for ', 'forcast' ) . get_the_time( 'F, Y' ) . '</a>' . $after;
		} /** If montly Archives */
		elseif ( is_year() ) {
			$breadcrumb .= $before . '<a aria-label="name" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . __( 'Archive for ', 'forcast' ) . get_the_time( 'Y' ) . '</a>' . $after;
		} /** If year Archives */
		elseif ( is_author() ) {
			$breadcrumb .= $before . '<a aria-label="name" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '">' . __( 'Archive for ', 'forcast' ) . get_the_author() . '</a>' . $after;
		} /** If author Archives */
		elseif ( is_search() ) {
			$breadcrumb .= $before . '' . esc_html__( 'Search Results for ', 'forcast' ) . get_search_query() . '' . $after ;
		} /** if search template */
		elseif ( is_404() ) {
			$breadcrumb .= $before . '' . esc_html__( '404 - Not Found', 'forcast' ) . '' . $after ;
			/** if search template */
		} elseif ( is_post_type_archive( 'product' ) ) {
			$shop_page_id = wc_get_page_id( 'shop' );
			if ( get_option( 'page_on_front' ) !== $shop_page_id ) {
				$shop_page = get_post( $shop_page_id );
				$_name     = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
				if ( ! $_name ) {
					$product_post_type = get_post_type_object( 'product' );
					$_name             = $product_post_type->labels->singular_name;
				}
				if ( is_search() ) {
					$breadcrumb .= $before . '<a aria-label="name"  href="' . get_post_type_archive_link( 'product' ) . '">' . $_name . '</a>' . $delimiter . esc_html__( 'Search results for &ldquo;', 'forcast' ) . get_search_query() . '&rdquo;' . $after;
				} elseif ( is_paged() ) {
					$breadcrumb .= $before . '<a aria-label="name" href="' . get_post_type_archive_link( 'product' ) . '">' . $_name . '</a>' . $after;
				} else {
					$breadcrumb .= $before . $_name . $after ;
				}
			}
		} else {
			$breadcrumb .= $before . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . $after;
		}
		/** Default value */
	}

	return $breadcrumb;
}
