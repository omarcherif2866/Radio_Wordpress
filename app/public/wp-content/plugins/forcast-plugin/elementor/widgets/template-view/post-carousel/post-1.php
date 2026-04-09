<div class="swiper-container bytf__post-slider-two">
    <div class="post_grid__active">
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
                <div class="bytf__post-overlay-item post-grid--carousl">
        <div class="bytf__feature-image">
            <a aria-label="name" href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full' );?>
            </a>
        </div>
        <div class="bytf__content">
            <?php 
                    if($settings['cat_hide'] === 'yes'){
                        if($settings['cate_style'] == 1){
                            if(function_exists('empath_category_badge')){
                                empath_category_badge_seven();
                            }
                        }elseif($settings['cate_style'] == 2){                            
                            if(function_exists('empath_category_badge_two')){
                                empath_category_badge_two();
                            }
                        }elseif($settings['cate_style'] == 4){                            
                            if(function_exists('empath_category_badge_two')){
                                empath_category_badge_four();
                            }
                        }elseif($settings['cate_style'] == 5){                            
                            if(function_exists('empath_category_badge_five')){
                                empath_category_badge_five();
                            }
                        }else {
                            if(function_exists('empath_category_badge_three')){
                                empath_category_badge_three();
                            }
                        }
                    }
                ?>
            <h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>
            <?php 
                if($settings['excerpt_hide'] === 'yes'){ ?>
            <p>
                <?php echo wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '' ); ?>
            </p>
            <?php } ?>
            <div class="bytf__postmeta-info-wrapper-two light__meta">
                <div class="bytf__postmeta-two">
                    <ul class="d-flex align-items-center">
                        <?php if('yes' === $settings['authore_hide']):?>
                            <li class="authore"><span><?php esc_html_e('by', 'forcast-plugin');?></span> <?php the_author_posts_link(); ?></li>
                        <?php endif;?>

                        <?php if('yes' === $settings['date_hide']):?>
                            <li>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M9.99984 15.8332C13.2215 15.8332 15.8332 13.2215 15.8332 9.99984C15.8332 6.77818 13.2215 4.1665 9.99984 4.1665C6.77818 4.1665 4.1665 6.77818 4.1665 9.99984C4.1665 13.2215 6.77818 15.8332 9.99984 15.8332Z" stroke="#BFBDBD" stroke-width="1.5"/>
    <path d="M4.97078 2.61328C4.40545 2.76469 3.88995 3.06227 3.47611 3.47611C3.06227 3.88995 2.76469 4.40545 2.61328 4.97078M15.0291 2.61328C15.5944 2.76469 16.1099 3.06227 16.5238 3.47611C16.9376 3.88995 17.2352 4.40545 17.3866 4.97078M9.99995 6.66662V9.79162C9.99995 9.90662 10.0933 9.99995 10.2083 9.99995H12.4999" stroke="#BFBDBD" stroke-width="1.5" stroke-linecap="round"/>
    </svg>
    <?php echo forcast_reading_time();?></li></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
            </div>
            
            <?php } wp_reset_query(); } ?>  
        </div>
    </div>
</div>