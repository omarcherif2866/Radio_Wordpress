<section class="post__slider-main-wrapper">
    <?php
        if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $idd = get_the_ID();
            $pfythumb_size = 'full';
            $title = wp_trim_words( get_the_title(), $settings['title_length'], '' );
            if(get_post_meta($idd, 'empath_post_format_meta', true)) {
                $post_video_meta = get_post_meta($idd, 'empath_post_format_meta', true);
            } else {
                $post_video_meta = array();
            }

            if( array_key_exists( 'video_link', $post_video_meta )) {
                $video_link = $post_video_meta['video_link'];
            } else {
                $video_link = '';
            }

            $video_custom = '';

            if($settings['type'] === 'ex_url'){
                $video_custom = $settings['add_video_url']['url'];
            }else{
                $video_custom = $settings['upload_video']['url'];
            }
            
        ?>
        <div class="post__slider_item-wrapper" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full' );?>)">
            <div class="post__video__thumb">
                <?php if( !empty($video_custom) ):?>
                    <video autoplay muted loop poster="<?php echo esc_url(get_the_post_thumbnail_url( $idd, 'full' ))?>">
                        <source src="<?php echo esc_url($video_custom)?>" type="video/mp4">
                        <source src="<?php echo esc_url($video_custom)?>" type="video/ogg">
                    </video>
                <?php endif;?>
            </div>
            <div class="container">
                <div class="col-lg-7">
                    <div class="post__slider-content">
                        <?php if('video' == get_post_format( $idd ) && $video_link ):?>
                        <div class="bytf__video">
                            <a aria-label="name" class="bytf-video-popup" href="<?php echo esc_url($video_link);?>"><i class="fas fa-play"></i></a>
                        </div>
                        <?php endif;?>
                        <?php if(function_exists('empath_category_badge')){empath_category_badge();}?>
                        <h2 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html(get_the_title());?></a></h2>  
                        <div class="bytf__postmeta-info-wrapper">
                            <div class="bytf__postmeta">
                                <ul class="d-flex align-items-center">
                                    <?php if('yes' === $settings['authore_hide']):?>
                                        <li class="authore"><?php empath_post_author_avatars(25); the_author_posts_link(); ?></li>
                                    <?php endif;?>

                                    <?php if('yes' === $settings['date_hide']):?>
                                        <li><i class="fal fa-calendar"></i> <?php echo esc_html(get_the_time( get_option('date_format')));?></li>
                                    <?php endif;?>

                                    <?php if('yes' === $settings['cmnt_hide']):?>
                                        <li class="comment"><i class="far fa-comment"></i> 
                                        <?php echo esc_attr(get_comments_number());?> <?php
                                            if(get_comments_number() == 1 ){
                                                esc_html_e( 'Comment', 'barfii-plugin' );
                                            }else{
                                                esc_html_e( 'Comments', 'barfii-plugin' );
                                            }                                
                                        ?>
                                        </li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="bytf__bookmark bookmark__dark">
                                <?php if(function_exists('empath_bookmark_trigger')){empath_bookmark_trigger();}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } wp_reset_query(); } ?>  

    <div class="slider__thumbs">
            <?php
                $args2 = array(
                    'post_type'           => 'post',
                    'posts_per_page'      => !empty( $settings['pst_per_page_th'] ) ? $settings['pst_per_page_th'] : 1,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => 1,
                    'order'               => $settings['postorder_th'],
                    'orderby'             => $settings['postorderby_th'],
                    'post__not_in' 		  => $settings['exclude_posts_th'],
                    'post__in' 			  => $settings['selected_posts_th'],
                    'suppress_filters' => false
                );
        
        
                if(!empty($settings['category_th'][0])) {
                    $args2['tax_query'] = array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'ids',
                            'terms'    => $settings['category_th']
                        )
                    );
                }
        
                if(!empty($settings['exclude_cate_th'][0])) {
                    $args2['tax_query'] = array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'ids',
                            'terms'    => $settings['exclude_cate_th'],
                            'operator' => 'NOT IN'
                        )
                    );
                }
        
        
                if("yes" == $settings['skip_post_th']){
                    $args2['offset'] = $settings['skip_post_count_th'];
                }
                if(!empty($settings['post_tags_th'][0])) {
                    $args2['tax_query'] = array(
                        array(
                        'taxonomy' => 'post_tag',
                        'field'    => 'ids',
                        'terms'    => $settings['post_tags_th']
                        )
                    );
                }
                if( isset($settings['post_format_th']) && is_array($settings['post_format_th']) && count($settings['post_format_th']) > 0  ) {
                    $args2['tax_query'] = array(
                        array(
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => $settings['post_format_th'],
                            'operator' => 'IN'
                        ) 
                    );
                } 
                
                
                $query2 = new \WP_Query( $args2 );
                
                if ( $query2->have_posts() ) {
                while ( $query2->have_posts() ) {
                    $query2->the_post();
                    $idd = get_the_ID();
                    $pfythumb_size = 'full';
                    $title = wp_trim_words( get_the_title(), $settings['title_length_th'], '' );
                    if(get_post_meta($idd, 'empath_post_format_meta', true)) {
                        $post_video_meta = get_post_meta($idd, 'empath_post_format_meta', true);
                    } else {
                        $post_video_meta = array();
                    }

                    if( array_key_exists( 'video_link', $post_video_meta )) {
                        $video_link = $post_video_meta['video_link'];
                    } else {
                        $video_link = '';
                    }
                    
                ?>
                
                <div class="bytf__post-fo-thumb-item d-flex align-items-center">
                    <div class="bytf__feature-image">
                        <a aria-label="name" href="<?php the_permalink();?>"><?php the_post_thumbnail( 'full' );?></a>
                    </div>
                    <div class="bytf__content">
                        <?php if(function_exists('empath_category_badge_two')){empath_category_badge_two();}?>
                        <h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>
                        <div class="bytf__postmeta-info-wrapper">
                            <div class="bytf__postmeta">
                                <ul class="d-flex align-items-center">

                                    <?php if('yes' === $settings['date_hide_th']):?>
                                        <li><i class="fal fa-calendar"></i> <?php echo esc_html(get_the_time( get_option('date_format')));?></li>
                                    <?php endif;?>

                                </ul>
                            </div>
                            <div class="bytf__bookmark bookmark__dark">
                                <span class="bookmark-trigger"><i class="far fa-bookmark"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } wp_reset_query(); } ?> 
    </div>
</section>