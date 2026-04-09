<?php 
$this->add_render_attribute( 'title', 'class', 'transpi__heading-title spilit__enable split-in-right' );
?>
<div class="transpi__section-heading transpialigh">
    <?php if(!empty($settings['subtitle'])):?>
    <div class="transpi__sub-heaind">
        <span><?php echo wp_kses($settings['subtitle'], true)?></span>
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