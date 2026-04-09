<div class="bytf__post-list-wrapper again__post-lst">
    <?php
    if ( $query->have_posts() ) {
        $i = 0;
    while ( $query->have_posts() ) {
        $query->the_post();
        $idd = get_the_ID();
        $pfythumb_size = 'full';
        $title = wp_trim_words( get_the_title(), $settings['title_length'], '' );
        if(get_post_meta($idd, 'benqu_post_format_meta', true)) {
            $post_video_meta = get_post_meta($idd, 'benqu_post_format_meta', true);
        } else {
            $post_video_meta = array();
        }

        if( array_key_exists( 'video_link', $post_video_meta )) {
            $video_link = $post_video_meta['video_link'];
        } else {
            $video_link = '';
        }
        $i++;
        
    ?>
            <div class="bytf__post-list-item style_twelv d-flex align-items-center">
                <div class="bytf__content">
                    <?php 
                        if(function_exists('empath_category_badge_seven')){
                            empath_category_badge_seven();
                        }
                    ?>
                    <h3 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h3>
                    <?php
                        if($settings['excerpt_hide'] === 'yes'){ ?>
                    <p>
                    
                           <?php  echo wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '' );?>
                        
                    </p>
                    <?php 
                    }
                    ?>
                    <div class="bytf__postmeta-info-wrapper-two">
                        <div class="bytf__postmeta-two">
                            <ul class="d-flex align-items-center">
                                <?php if('yes' === $settings['authore_hide']):?>
                                    <li class="authore"><span><?php esc_html_e('by', 'forcast-plugin');?></span> <?php the_author_posts_link(); ?></li>
                                <?php endif;?>

                                <?php if('yes' === $settings['date_hide']):?>
                                    <li>
            
<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.99984 14.8332C12.2215 14.8332 14.8332 12.2215 14.8332 8.99984C14.8332 5.77818 12.2215 3.1665 8.99984 3.1665C5.77818 3.1665 3.1665 5.77818 3.1665 8.99984C3.1665 12.2215 5.77818 14.8332 8.99984 14.8332Z" stroke="#585858" stroke-width="1.5"/>
<path d="M3.97078 1.61328C3.40545 1.76469 2.88995 2.06227 2.47611 2.47611C2.06227 2.88995 1.76469 3.40545 1.61328 3.97078M14.0291 1.61328C14.5944 1.76469 15.1099 2.06227 15.5238 2.47611C15.9376 2.88995 16.2352 3.40545 16.3866 3.97078M8.99995 5.66662V8.79162C8.99995 8.90662 9.09328 8.99995 9.20828 8.99995H11.4999" stroke="#585858" stroke-width="1.5" stroke-linecap="round"/>
</svg>

            <?php echo forcast_reading_time();?></li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                </div>                
                <div class="bytf__feature-image">
                    <a aria-label="name" href="<?php the_permalink();?>">
                        <?php the_post_thumbnail( 'full' );?>
                    </a>
                </div>                                    
                <span class="count"><?php echo esc_html($i); ?></span>
            </div>
        <?php } wp_reset_query(); } ?>   
</div>