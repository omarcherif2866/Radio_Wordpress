<?php

//Support Form 
class Empath_Newsletter_Form extends WP_Widget{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Empath_Newsletter_Form', /* Name */esc_html__('Empath Newsletter Form','fastrans'), array( 'description' => esc_html__('Show the Support Form', 'fastrans' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget);?>
            <div class="newsletter__wrapper-main" style="background-image:url(<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Mask-group.webp)">
                <div class="newsletter_box">
                    <h2><?php echo wp_kses_post($instance['title']); ?></h2>
                    <p><?php echo wp_kses_post($instance['content']); ?></p>
                    <?php echo do_shortcode($instance['support_form_url']); ?>
                </div>
            </div>
              
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['content'] = $new_instance['content'];
		$instance['support_form_url'] = $new_instance['support_form_url'];
		
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ($instance) ? esc_attr($instance['title']) : '24/7 ONLINE SUPPORT';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$support_form_url = ($instance) ? esc_attr($instance['support_form_url']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter Title:', 'fastrans'); ?></label>
            <input placeholder="<?php esc_attr_e('Daily Newsletter', 'fastrans');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'fastrans'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('support_form_url')); ?>"><?php esc_html_e('Support Form Url:', 'fastrans'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('support_form_url')); ?>" name="<?php echo esc_attr($this->get_field_name('support_form_url')); ?>" ><?php echo wp_kses_post($support_form_url); ?></textarea>
        </p>    
                
		<?php 
	}
	
}