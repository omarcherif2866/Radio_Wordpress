<div class="swiper-container bytf__post-slider-two">
    <div class="post_slider_two__active">
        <div class="swiper-wrapper">
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
                
            ?>
            <div class="swiper-slide">
                <div class="post__slider_item-main" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full' );?>)">
                    <div class="container">
                        <div class="col-lg-12">
                            <div class="bytf__content">
                                <?php if('video' == get_post_format( $idd ) && $video_link ):?>
                                <div class="bytf__video">
                                    <a aria-label="name" class="bytf-video-popup" href="<?php echo esc_url($video_link);?>"><i class="fas fa-play"></i></a>
                                </div>
                                <?php endif;?>
                                <?php if(function_exists('empath_category_badge_three')){empath_category_badge_three();}?>
                                <h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>  
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
            </div>
            
            <?php } wp_reset_query(); } ?>  
        </div>
    </div>
</div>