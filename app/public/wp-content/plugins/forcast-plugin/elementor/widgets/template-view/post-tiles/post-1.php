<div class="bytf__tiels-post-wrapper">
    <div class="row">
        <?php
        if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
        $query->the_post();
            $barfiie_size = 'full';
            $title = wp_trim_words( get_the_title(), $settings['title_length'], '' );
        ?>
        <?php if(0 == $query->current_post):?>
        <div class="col-lg-7">
            <div class="grid__style-three post_tile_large">
                <div class="bytf__feature-image">
                    <a aria-label="name" href="<?php the_permalink();?>">
                        <?php the_post_thumbnail( 'full' );?>
                    </a>
                </div>
                <div class="bytf__content">
                    <?php 
                        if(function_exists('empath_category_badge_three') && $settings['cat_hide'] === 'yes'){
                            empath_category_badge_three();
                        }
                    ?>
                    <h3 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <div class="bytf__postmeta-info-wrapper">
                        <div class="bytf__postmeta meta__dark">
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
        <?php else:?>
        <?php if ( 1 ==  $query->current_post ): ?>
        <div class="col-lg-5">
            <div class="post_tile_list-wrapper">
            <?php endif;?>
                <div class="post_tile_large-sm d-flex align-items-center">
                    <div class="bytf__feature-image">
                        <a aria-label="name" href="<?php the_permalink();?>">
                            <?php the_post_thumbnail( 'full' );?>
                        </a>
                    </div>
                    <div class="bytf__content">
                        <h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>
                        <div class="bytf__postmeta-info-wrapper">
                            <div class="bytf__postmeta meta__dark">
                                <ul class="d-flex align-items-center">

                                    <?php if('yes' === $settings['date_hide']):?>
                                        <li><i class="fal fa-calendar"></i> <?php echo esc_html(get_the_time( get_option('date_format')));?></li>
                                    <?php endif;?>

                                </ul>
                            </div>
                            <?php if($settings['bookmark_hide'] === 'yes'):?>
                                <div class="bytf__bookmark bookmark__dark">
                                    <span class="bookmark-trigger"><i class="far fa-bookmark"></i></span>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php if (($query->current_post + 1) == ($query->post_count)):?>
            </div>
        </div>
        <?php endif; endif;?>
        <?php } wp_reset_query(); } ?>  
    </div>
    </div>