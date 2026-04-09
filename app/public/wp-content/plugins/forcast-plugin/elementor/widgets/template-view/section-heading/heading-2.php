<?php 
$this->add_render_attribute( 'title', 'class', 'transpi__heading-title spilit__enable split-in-right' );
?>
<div class="transpi__section-heading heading-2 transpialigh">
    <?php if(!empty($settings['subtitle'])):?>
    <div class="transpi__sub-heaind">
        <span class="shape shape-left"><svg xmlns="http://www.w3.org/2000/svg" width="59" height="5" viewBox="0 0 59 5" fill="none">
        <rect width="50" height="5" rx="2.5" fill="#FF131D"/>
        <circle cx="56.5" cy="2.5" r="2.5" fill="#FF131D"/>
        </svg></span>
            <span><?php echo wp_kses($settings['subtitle'], true)?></span>
            <span class="shape shape-right"><svg xmlns="http://www.w3.org/2000/svg" width="59" height="5" viewBox="0 0 59 5" fill="none">
  <rect width="50" height="5" rx="2.5" transform="matrix(-1 0 0 1 59 0)" fill="#FF131D"/>
  <circle cx="2.5" cy="2.5" r="2.5" transform="matrix(-1 0 0 1 5 0)" fill="#FF131D"/>
</svg></span>
    </div>
    <?php endif;?>
    <?php printf('<%1$s %2$s>%3$s</%1$s>',
        tag_escape($settings['title_tag']),
        $this->get_render_attribute_string('title'),
        $settings['title']
    ); ?>
    <?php if(!empty($settings['description'])):?>
        <p><?php echo wp_kses($settings['description'], true);?></p>
    <?php endif;?>
</div>