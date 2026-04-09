<?php 
$this->add_render_attribute( 'title', 'class', 'bytf__title' );
?>
<div class="bytf__section-heading style__two style__three d-flex justify-content-between align-items-center">
    <div class="title__wrapper d-flex align-items-center">
        <?php printf('<%1$s %2$s>%3$s</%1$s>',
            tag_escape($settings['title_tag']),
            $this->get_render_attribute_string('title'),
            $settings['title']
        ); ?>
    </div>    
    <?php if($settings['hide_btn'] === 'yes'):?>
        <div class="btn_wraper">
            <a aria-label="name" <?php echo $this->get_render_attribute_string( 'website_link' ); ?>>
                <span><?php echo esc_html($settings['btn_label']);?></span>
                <i class="fal fa-arrow-right"></i>
            </a>
        </div>
    <?php endif;?>
</div>