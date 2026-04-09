<div class="newsletter__wrapper-main" style="background-image:url(<?php echo esc_url($settings['banner_bg']['url']);?>)">
    <div class="newsletter_box">
        <h2><?php echo wp_kses($settings['title'], true); ?></h2>
        <p><?php echo wp_kses($settings['description'], true); ?></p>
        <?php if( !empty($settings['shortcode_id']) ){ echo do_shortcode($settings['shortcode_id']);}?>
    </div>
</div>