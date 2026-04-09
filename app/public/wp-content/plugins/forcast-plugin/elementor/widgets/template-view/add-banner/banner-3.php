<div class="bytf__add-banner-three-wrapper">
    <div class="bytf__add-banner-three">
        <img src="<?php echo esc_url($settings['banner_bg']['url']);?>" alt="">  
        <div class="banner__logo">
            <img src="<?php echo esc_url($settings['banner_logo']['url']);?>" alt="<?php if(!empty($settings['banner_logo']['alt'])){ echo esc_url($settings['banner_logo']['alt']);}?>">
        </div>      
        <div class="banner__content">
            <h3><?php echo wp_kses($settings['title'], true);?></h3>      
            <a <?php echo $this->get_render_attribute_string( 'website_link' ); ?> aria-label="name">
                <span><?php echo esc_html($settings['btn_label']);?></span>
            </a>
        </div>  
    </div>
</div>