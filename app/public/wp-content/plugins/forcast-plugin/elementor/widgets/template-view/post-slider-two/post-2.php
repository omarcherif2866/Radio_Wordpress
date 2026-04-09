
<script>
    jQuery(function(){
        jQuery(".video__pl_act").YTPlayer();
    });
</script>
<div class="bytf-single-slider-wrapper-tr">
    <div class="slider-for">
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
            
                <div class="bytf__post-overlay-item style__four">
                    <div class="bytf__feature-image">
                        <a aria-label="name" href="<?php the_permalink();?>">
                            <?php the_post_thumbnail( 'full' );?>
                        </a>
                        <div  class="player video__plys video__pl_act" data-property="{videoURL:'<?php echo esc_url($video_link)?>',containment:'self',autoPlay:true, mute:true, opacity:1, loop:true, stopMovieOnBlur: true, showControls:false, addRaster:true, quality:'default', optimizeDisplay:true}"></div>
                        
                    </div>
                    <div class="bytf__content text-center">
                        <h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>
                        
                        <div class="bytf__postmeta-info-wrapper-two light__meta justify-content-center">
                            <?php 
                                if($settings['cat_hide'] === 'yes'){
                                    if($settings['cate_style'] == 1){
                                        if(function_exists('empath_category_badge')){
                                            empath_category_badge();
                                        }
                                    }elseif($settings['cate_style'] == 2){                            
                                        if(function_exists('empath_category_badge_two')){
                                            empath_category_badge_two();
                                        }
                                    }elseif($settings['cate_style'] == 4){                            
                                        if(function_exists('empath_category_badge_four')){
                                            empath_category_badge_four();
                                        }
                                    }elseif($settings['cate_style'] == 5){                            
                                        if(function_exists('empath_category_badge_five')){
                                            empath_category_badge_five();
                                        }
                                    }elseif($settings['cate_style'] == 6){                            
                                        if(function_exists('empath_category_badge_six')){
                                            empath_category_badge_six();
                                        }
                                    }else {
                                        if(function_exists('empath_category_badge_three')){
                                            empath_category_badge_three();
                                        }
                                    }
                                }
                                
                                
                            ?>
                            <div class="bytf__postmeta-two">
                                <ul class="d-flex align-items-center">
                                    <?php if('yes' === $settings['authore_hide']):?>
                                        <li class="authore"><span><?php esc_html_e('by', 'forcast-plugin');?></span> <?php the_author_posts_link(); ?></li>
                                    <?php endif;?>

                                    <?php if('yes' === $settings['date_hide']):?>
                                        <li><?php echo esc_html(get_the_time( get_option('date_format')));?></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } wp_reset_query(); } ?>
    </div>
    <div class="slider-nav">
    <?php
    if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $idd = get_the_ID();
        $pfythumb_size = 'full';
        $title = wp_trim_words( get_the_title(), $settings['title2_length'], '' );
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
    <div class="bytf__post-list-item-two style__two list__8 d-flex align-items-center">               
            <div class="bytf__feature-image">
                <?php the_post_thumbnail( 'full' );?>
                <?php if('video' == get_post_format( $idd ) ):?>
                    <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_10177_1232)">
                        <path d="M28.3984 8.33604C28.2499 7.7428 27.9475 7.19925 27.5217 6.76029C27.0959 6.32134 26.5618 6.00252 25.9734 5.83604C23.8234 5.31104 15.2234 5.31104 15.2234 5.31104C15.2234 5.31104 6.62337 5.31104 4.47337 5.88604C3.88493 6.05252 3.35084 6.37134 2.92505 6.81029C2.49927 7.24925 2.19686 7.7928 2.04837 8.38604C1.65489 10.568 1.46242 12.7814 1.47337 14.9985C1.45934 17.2323 1.65183 19.4627 2.04837 21.661C2.21207 22.2358 2.52125 22.7587 2.94605 23.1791C3.37085 23.5996 3.8969 23.9033 4.47337 24.061C6.62337 24.636 15.2234 24.636 15.2234 24.636C15.2234 24.636 23.8234 24.636 25.9734 24.061C26.5618 23.8946 27.0959 23.5757 27.5217 23.1368C27.9475 22.6978 28.2499 22.1543 28.3984 21.561C28.7888 19.3955 28.9813 17.199 28.9734 14.9985C28.9874 12.7647 28.7949 10.5344 28.3984 8.33604Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.4102 19.0861L19.5977 14.9986L12.4102 10.9111V19.0861Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_10177_1232">
                        <rect width="30" height="30" fill="white" transform="translate(0.222656 0.311035)"/>
                        </clipPath>
                        </defs>
                    </svg>
                    <?php endif;?>
                    <span class="playing"><?php esc_html_e('now playing', 'forcast');?></span>
            </div>
            <div class="bytf__content">                    
                <h5 class="bytf_post_title-sm"><?php echo esc_html($title);?></h5>
                
                <div class="bytf__postmeta-info-wrapper-two light__meta">
                <?php 
                    if($settings['cat_hide'] === 'yes'){
                        if($settings['cate_style'] == 1){
                            if(function_exists('empath_category_badge')){
                                empath_category_badge();
                            }
                        }elseif($settings['cate_style'] == 2){                            
                            if(function_exists('empath_category_badge_two')){
                                empath_category_badge_two();
                            }
                        }elseif($settings['cate_style'] == 4){                            
                            if(function_exists('empath_category_badge_four')){
                                empath_category_badge_four();
                            }
                        }elseif($settings['cate_style'] == 5){                            
                            if(function_exists('empath_category_badge_five')){
                                empath_category_badge_five();
                            }
                        }elseif($settings['cate_style'] == 6){                            
                            if(function_exists('empath_category_badge_six')){
                                empath_category_badge_six();
                            }
                        }else {
                            if(function_exists('empath_category_badge_three')){
                                empath_category_badge_three();
                            }
                        }
                    }
                    
                    
                ?>
                    <div class="bytf__postmeta-two">
                        <ul class="d-flex align-items-center">
                            <?php if('yes' === $settings['authore_hide']):?>
                                <li class="authore"><span><?php esc_html_e('by', 'forcast-plugin');?></span> <?php the_author_posts_link(); ?></li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div> 
    </div>
    <?php } wp_reset_query(); } ?> 
    </div>
</div>