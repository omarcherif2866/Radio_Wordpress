<?php 
    if(get_post_meta(get_the_ID(), 'empath_post_gall_meta', true)) {
        $post_gall_meta = get_post_meta(get_the_ID(), 'empath_post_gall_meta', true);
    } else {
        $post_gall_meta = array();
    }

    if( array_key_exists( 'post-gall-item', $post_gall_meta )) {
        $gallerys = $post_gall_meta['post-gall-item'];
    } else {
        $gallerys = '';
    } 
    $gallery_ids = explode( ',', $gallerys );
?>
<div class="post__single-gallery-wrapper">
    <?php foreach($gallery_ids as $gall):?>
        <a aria-label="name" class="post__gall-item" href="<?php echo esc_url(wp_get_attachment_url($gall));?>">
            <img src="<?php echo esc_url(wp_get_attachment_url($gall));?>" alt="">
        </a>
    <?php endforeach;?>
</div>