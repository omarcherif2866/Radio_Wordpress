<?php
   
   if(get_post_meta(get_the_ID(), 'empath_post_format_meta', true)) {
        $post_video_meta = get_post_meta(get_the_ID(), 'empath_post_format_meta', true);
    } else {
        $post_video_meta = array();
    }

    if( array_key_exists( 'video_link', $post_video_meta )) {
        $video_link = $post_video_meta['video_link'];
    } else {
        $video_link = '';
    } 

    $params = array(
        'width' => '870',
        'height' => '520'
    );
?>
<div class="post__thumb-single">
    <?php echo wp_oembed_get($video_link, $params);?>       
</div>