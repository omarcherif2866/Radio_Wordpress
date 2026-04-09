<div class="newsletter__wrapper-two d-flex">
    <div class="newsletter_content">
        <h2><?php echo wp_kses($settings['title'], true); ?></h2>
        <p><?php echo wp_kses($settings['description'], true); ?></p>
    </div>
    <div class="ns_form">
        <?php if( !empty($settings['shortcode_id']) ){ echo do_shortcode($settings['shortcode_id']);}?>
        <?php if(!empty($settings['quote'])):?>
            <p><?php  echo esc_html($settings['quote']);?></p>
        <?php endif;?>
    </div>
</div>