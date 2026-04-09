<div class="bytf__add-banner-two-wrapper">
    <div class="bytf__add-banner-two" style="background-image:url(<?php echo esc_url($settings['banner_bg']['url']);?>)">        
        <div class="banner__content">
            <div class="banner__logo">
                <img src="<?php echo esc_url($settings['banner_logo']['url']);?>" alt="<?php if(!empty($settings['banner_logo']['alt'])){ echo esc_url($settings['banner_logo']['alt']);}?>">
            </div>
            <h3><?php echo wp_kses($settings['title'], true);?></h3>

            <?php if(!empty($settings['description'])):?>
                <p><?php echo empath_wp_kses($settings['description']);?></p>
            <?php endif;?>

        </div>        
        <a <?php echo $this->get_render_attribute_string( 'website_link' ); ?> aria-label="name">
            <span><?php echo esc_html($settings['btn_label']);?></span>
        </a>
    </div>
    <?php if(!empty($settings['add_title'])):?>
        <span class="add__title"><?php echo empath_wp_kses($settings['add_title']);?></span>
    <?php endif;?>
</div>