<div class="bytf__post-tab-wrapper style__two">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <?php $index = 0; foreach($settings['post_tabs'] as $item): $index++;
    ?>
        <li class="nav-item elementor-repeater-item-<?php echo esc_attr($item['_id']);?>" role="presentation">
            <button class="nav-link <?php if( 'yes' == $item['is_active'] ){echo esc_attr('active');}?>" id="barfii-tb<?php echo esc_attr($index);?>" data-bs-toggle="pill" data-bs-target="#barfii-tb-home<?php echo esc_attr($index);?>" type="button" role="tab" aria-controls="barfii-tb-home<?php echo esc_attr($index);?>" aria-selected="true"><?php echo esc_html($item['tab_title']);?></button>
        </li>
        <?php endforeach;?>
    </ul>
    <div class="tab-content" id="pills-tabContent">
    <?php $index = 0; foreach($settings['post_tabs'] as $item): $index++;
    ?>
        <div class="tab-pane animated fadeInUp <?php if( 'yes' == $item['is_active'] ){echo esc_attr('show active');}?>" id="barfii-tb-home<?php echo esc_attr($index);?>" role="tabpanel" aria-labelledby="barfii-tb<?php echo esc_attr($index);?>">
            <?php $args = array(
                'post_type'           => 'post',
                'posts_per_page'      => !empty( $item['pst_per_page'] ) ? $item['pst_per_page'] : 1,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'order'               => $item['postorder'],
                'orderby'             => $item['postorderby'],
                'post__not_in' 		  => $item['exclude_posts'],
                'post__in' 			  => $item['selected_posts'],
                'suppress_filters' => false
            );


            if(!empty($item['category'][0])) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'ids',
                        'terms'    => $item['category']
                    )
                );
            }

            if(!empty($item['exclude_cate'][0])) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'ids',
                        'terms'    => $item['exclude_cate'],
                        'operator' => 'NOT IN'
                    )
                );
            }


            if("yes" == $item['skip_post']){
                $args['offset'] = $item['skip_post_count'];
            }
            if(!empty($item['post_tags'][0])) {
                $args['tax_query'] = array(
                    array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'ids',
                    'terms'    => $item['post_tags']
                    )
                );
            }
            if( isset($item['post_format']) && is_array($item['post_format']) && count($item['post_format']) > 0  ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms'    => $item['post_format'],
                        'operator' => 'IN'
                    ) 
                );
            } 
            
            
            $query = new \WP_Query( $args );
            ?>
        <?php
            $ct = 0;
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
            $ct++;
            
        ?>
    <div class="bytf__post-tab-item-two d-flex align-items-center">
        <div class="bytf__feature-image">
            <a aria-label="name" href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full' );?>
            </a>
        </div>
        <div class="bytf__content">                   
            <h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>                
            <div class="bytf__postmeta-info-wrapper">
                <?php 
                    if(function_exists('empath_category_badge_six')){
                        empath_category_badge_six();
                    }
                ?>
                <div class="bytf__postmeta meta__dark">
                    <ul class="auth__meta-nsf">
                        <?php if('yes' === $settings['authore_hide']):?>
                            <li class="authore"><span><?php esc_html_e('by', 'forcast-plugin');?></span> <?php the_author_posts_link(); ?></li>
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
            </div>
        </div>   
    </div>
    <?php } wp_reset_query(); } ?> 
        </div>
        <?php endforeach;?>
    </div>
</div>