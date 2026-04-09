<div class="social__icon-wrapper d-flex">
    <?php foreach($settings['socials'] as $item):?>
        <a aria-label="name" class="social__item" href="<?php echo esc_url($item['link']['url']);?>">
            <div class="social__item-inner d-flex align-items-center elementor-repeater-item-<?php echo esc_attr($item['_id']);?>">
                <div class="social_icon">
                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class="social_content">
                    <p><?php echo esc_html($item['title']);?></p>
                    <span><?php echo esc_html($item['count']); ?></span>
                </div>
            </div>
        </a>
    <?php endforeach;?>
</div>