<div class="byth__new-main-content-wrapper">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-9 dh-only-mob">
            <div class="breaking__news-wrapper">
                <?php if(!empty($settings['top_text'])):?>
                <span>
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.24384 1.343L3.29266 6.98988C3.18703 7.14019 3.27438 7.31244 3.45313 7.31244H5.07812C5.22031 7.31244 5.28125 7.36931 5.28125 7.51556V11.888C5.28125 12.1765 5.63063 12.3024 5.79719 12.0708L9.7045 6.85947C9.81419 6.70916 9.72562 6.49994 9.54687 6.49994H8.125C7.92187 6.49994 7.71875 6.29681 7.71875 6.09369V1.42181C7.71875 1.21869 7.41 1.10738 7.24384 1.343Z" fill="#FF184E"/>
                    </svg>
                    <?php echo esc_html($settings['top_text']); ?>
                </span>
                <?php endif;?>
                <div class="bytf_breaking_active">
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
                    <div class="post__breaking-item">
                        <h5 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h5>
                    </div>
                    <?php } wp_reset_query(); } ?>   
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="quick__tags-wrapper">
                <?php 
                    $tags  = "post_tag";

                    $cate_lists = get_terms( $tags, [
                        'orderby'    => 'slug',
                        'number'     => $settings['catehow'],
                        'order'      => $settings['cateorder'],
                        'hide_empty' => 'yes' === $settings['hideempty'] ? false : true,
                    ] );
                ?>
                <h5>Quick Links:</h5>
                <div class="quick__tags-item">
                    <?php
                    foreach ( $cate_lists as $cate ):
                    ?>
                    <a aria-label="name" href="<?php echo esc_url( get_term_link( $cate->term_id ) ) ?>"><?php echo esc_html( $cate->name ) ?> </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>