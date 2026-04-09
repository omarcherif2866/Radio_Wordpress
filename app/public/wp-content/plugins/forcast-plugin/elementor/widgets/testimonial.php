<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Testimonial extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Elementor widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'empath-testimonial';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Elementor widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Testimonial', 'empath-plugin' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Elementor widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'empath-custom-icon';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Elementor widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'empath_widgets' ];
	}


	protected function register_controls() {

		//social icon
		$this->start_controls_section(
			'__header_social',
			[
				'label' => esc_html__( 'Testimonial', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'  => esc_html__( 'Style 1', 'empath-plugin' ),
					'2'  => esc_html__( 'Style 2', 'empath-plugin' )
				]
			]
		);
		$repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
        $repeater->add_control(
			'quote_icon', [
				'label' => esc_html__( 'Quote Icon', 'empath-plugin' ),
				'type' => Controls_Manager::ICONS,
                'label_block' => true,
			]
		);
        $repeater->add_control(
			'feedback', [
				'label' => esc_html__( 'Feedback', 'empath-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
			]
		);
        $repeater->add_control(
			'name', [
				'label' => esc_html__( 'Name', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);

        $this->add_control(
			'testimonials',
			[
				'label' => esc_html__( 'Add Item', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();



	}


	/**
	 * Main Contetn
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$cs_style = '';
		if($settings['style'] == '1'){
			$cs_style = 'style__one';
		}else{
			$cs_style = 'style__two';
		}
    ?>
    <div class="swiper-container  testimonial__main-wrapper <?php echo esc_attr($cs_style);?>">
        <div class="testimonial__active">
			<div class="swiper-wrapper">
				<?php foreach($settings['testimonials'] as $item):?>
				<div class="swiper-slide">
					<div class="testimonial__item">
						<h3><?php echo wp_kses($item['title'], true);?></h3>
						<span class="quote"><?php \Elementor\Icons_Manager::render_icon( $item['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
						<p><?php echo wp_kses($item['feedback'], true);?></p>
						<span class="name"><?php echo wp_kses($item['name'], true);?></span>
					</div>
				</div>
				<?php endforeach;?>				
			</div>
        </div>
		<div class="testimonial__nav-control">
			<div class="test-slider-arrow testi-sl-prev"> <i class="fas fa-arrow-left"></i></div>
			<div class="test-slider-arrow testi-sl-nxt"> <i class="fas fa-arrow-right"></i></div>
		</div>
    </div>
    <?php
    }


}


Plugin::instance()->widgets_manager->register( new Empath_Testimonial() );