<div class="bytf__post-list-wrapper">
    <?php
    if ( $query->have_posts() ) {
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
        
    ?>
    <div class="bytf__post-list-nine d-flex align-items-center">
        <div class="bytf__content">
           
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
        <div class="bytf__feature-image">
            <a aria-label="name" href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full' );?>
            </a>
        </div>
    </div>
<?php } wp_reset_query(); } ?>
</div>