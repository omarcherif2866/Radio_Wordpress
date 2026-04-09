<?php 
$this->add_render_attribute( 'title', 'class', 'bytf__title' );
?>
<div class="bytf__section-heading style__two style__three d-flex justify-content-between align-items-center">
    <div class="title__wrapper d-flex align-items-center">
        
        <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5.28078 0H13C13.5523 0 14 0.447716 14 1V17C14 17.5523 13.5523 18 13 18H1.28078C0.630205 18 0.152848 17.3886 0.310634 16.7575L4.31063 0.757464C4.42193 0.312297 4.82191 0 5.28078 0Z" fill="#E90606"/>
        </svg>

        <?php printf('<%1$s %2$s>%3$s</%1$s>',
            tag_escape($settings['title_tag']),
            $this->get_render_attribute_string('title'),
            $settings['title']
        ); ?>
    </div>    
    <?php if($settings['hide_btn'] === 'yes'):?>
        <div class="btn_wraper">
            <a class="thm__btn" aria-label="name" <?php echo $this->get_render_attribute_string( 'website_link' ); ?>>
                <span><?php echo esc_html($settings['btn_label']);?></span>
            </a>
        </div>
    <?php endif;?>
</div>