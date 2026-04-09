<div class="bytf__post-wrapper">
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
    <div class="bytf__post-overlay-item-two">
        <div class="bytf__feature-image">
            <a aria-label="name" href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full' );?>
            </a>
        </div>
        <div class="bytf__content">
            <?php if('video' == get_post_format( $idd ) && $video_link ):?>
            <div class="bytf__video">
                <a aria-label="name" class="bytf-video-popup" href="<?php echo esc_url($video_link);?>"><i class="fas fa-play"></i></a>
            </div>
            <?php endif;?>
            <h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>            
        </div>
    </div>
    <?php } wp_reset_query(); } ?>   
</div>