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
        <div class="bytf__post-list-item-two style__7 d-flex align-items-center">               
                <div class="bytf__feature-image">
                    <a aria-label="name" href="<?php the_permalink();?>">
                        <?php the_post_thumbnail( 'full' );?>
                    </a>
                    <?php if('yes' === $settings['date_hide']):?>
                        <span class="date">
                            <strong><?php echo get_the_date('d'); ?></strong>
                            <?php echo get_the_date('M Y'); ?>
                        </span>
                    <?php endif;?>
                </div>
                <div class="bytf__content">
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
                            }else {
                                if(function_exists('empath_category_badge_three')){
                                    empath_category_badge_three();
                                }
                            }
                        }
                        
                        
                    ?>
                    <h5 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h5>
                    <?php
                        if($settings['excerpt_hide'] === 'yes'){ ?>
                    <p>
                    
                           <?php  echo wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '' );?>
                        
                    </p>
                    <?php 
                    }
                    ?>
                    <div class="bytf__postmeta-info-wrapper">
                        <div class="bytf__postmeta meta__dark">
                            <ul class="d-flex align-items-center">
                                <?php if('yes' === $settings['authore_hide']):?>
                                    <li class="authore"><?php empath_post_author_avatars(25); the_author_posts_link(); ?></li>
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
        <?php } wp_reset_query(); } ?> 
</div>