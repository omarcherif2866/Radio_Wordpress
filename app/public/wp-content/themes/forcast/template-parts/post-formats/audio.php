<?php
   
   if(get_post_meta(get_the_ID(), 'post_audio_metabox', true)) {
        $post_video_meta = get_post_meta(get_the_ID(), 'post_audio_metabox', true);
    } else {
        $post_video_meta = array();
    }

    if( array_key_exists( 'audio_link', $post_video_meta )) {
        $audio_link = $post_video_meta['audio_link'];
    } else {
        $audio_link = '';
    } 

    $params = array(
        'width' => '870',
        'height' => '400'
    ); 
?>
<div class="post__thumb-single">
    <?php echo wp_oembed_get($audio_link, $params);?>       
</div>