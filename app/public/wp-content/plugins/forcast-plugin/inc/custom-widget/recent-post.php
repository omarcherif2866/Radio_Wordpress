<?php 

//Recent Posts
class empath_Recent_Posts extends WP_Widget{
    /** constructor */
    public function __construct()
    {
        parent::__construct( /* Base ID */'empath_Recent_Posts', /* Name */esc_html__('empath Recent Posts', 'empath-tools'), array( 'description' => esc_html__('Show the Recent Posts', 'empath-tools')));
    }


    /** @see WP_Widget::widget */
    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);

        echo wp_kses_post($before_widget); ?>
		
		<div class="news-widget">
            <?php echo wp_kses_post($before_title.$title.$after_title); ?>
            <!-- Footer Column -->
                <?php $query_string = array('showposts'=>$instance['number']);
					if ($instance['cat']) {
						$query_string['tax_query'] = array(array('taxonomy' => 'category','field' => 'id','terms' => (array)$instance['cat']));
					}
					$this->posts($query_string); 
				?>
        </div>
        
        <?php echo wp_kses_post($after_widget);
    }


    /** @see WP_Widget::update */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['cat'] = $new_instance['cat'];

        return $instance;
    }

    /** @see WP_Widget::form */
    public function form($instance)
    {
        $title = ($instance) ? esc_attr($instance['title']) : esc_html__('Recent Post', 'empath-tools');
        $number = ($instance) ? esc_attr($instance['number']) : 3;
        $cat = ($instance) ? esc_attr($instance['cat']) : ''; ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'empath-tools'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'empath-tools'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Category', 'empath-tools'); ?></label>
            <?php wp_dropdown_categories(array('show_option_all'=>esc_html__('All Categories', 'empath-tools'), 'taxonomy' => 'category', 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat'))); ?>
        </p>

        <?php
    }

    public function posts($query_string){
        ?>

<div class="recent-post-widget">
    <div class="empath__recent-post-area">
            <!-- Title -->
            <?php
                $query = new WP_Query($query_string);
                if ($query->have_posts()):
                global $post;
                $iten_number = 0;
                while ($query->have_posts()): $query->the_post();
                $iten_number++;
                $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id); 
            ?>
            <div class="empath__recent-post d-flex align-items-center">
                <div class="empath__recent-img"><a aria-label="name" href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><img src="<?php echo esc_url($post_thumbnail_url); ?>" alt=""></a></div>
                <div class="empath__recent-ttx">
					<h4><a aria-label="name" href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><?php echo wp_trim_words( get_the_title(), 8, '.' );?></a></h4>
                    <div class="post__meta-w">
                        <span class="date"><svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.99984 14.8332C12.2215 14.8332 14.8332 12.2215 14.8332 8.99984C14.8332 5.77818 12.2215 3.1665 8.99984 3.1665C5.77818 3.1665 3.1665 5.77818 3.1665 8.99984C3.1665 12.2215 5.77818 14.8332 8.99984 14.8332Z" stroke="#585858" stroke-width="1.5"/>
<path d="M3.97078 1.61328C3.40545 1.76469 2.88995 2.06227 2.47611 2.47611C2.06227 2.88995 1.76469 3.40545 1.61328 3.97078M14.0291 1.61328C14.5944 1.76469 15.1099 2.06227 15.5238 2.47611C15.9376 2.88995 16.2352 3.40545 16.3866 3.97078M8.99995 5.66662V8.79162C8.99995 8.90662 9.09328 8.99995 9.20828 8.99995H11.4999" stroke="#585858" stroke-width="1.5" stroke-linecap="round"/>
</svg> <?php echo get_the_date(); ?></span>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php endif;
            wp_reset_postdata();?>  
    </div> 
</div> 
 <?php           
    }
}