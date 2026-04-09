<?php 
$this->add_render_attribute( 'title', 'class', 'bytf__title' );
?>
<div class="bytf__section-heading style__two d-flex justify-content-between align-items-center">
    <div class="title__wrapper d-flex align-items-center">
        <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.32968 24.0905L20.9897 3.09054C21.8551 1.76007 20.9003 0 19.3132 0H12.5H2C0.895431 0 0 0.89543 0 2V23C0 24.1046 0.89543 25 2 25H5.65316C6.32987 25 6.96069 24.6578 7.32968 24.0905Z" fill="#C90301"/>
        </svg>
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