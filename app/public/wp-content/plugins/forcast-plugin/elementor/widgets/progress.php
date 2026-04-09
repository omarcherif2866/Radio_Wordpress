<?php

/**
 * Elementor Single Widget
 * @package empath Extension
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Progress extends Widget_Base {

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
		return 'empath-progress';
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
		return esc_html__( 'Empath Progress', 'empath-extension' );
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
		$this->start_controls_section(
			'post_section_content',
			[
				'label' => esc_html__( 'Section Title', 'empath-extension' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'progress_title',
			[
				'label' => esc_html__( 'Progress Title', 'empath-extension' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Your Progress TItle Here', 'empath-extension' ),
			]
		);
		$this->add_control(
			'progress_percent',
			[
				'label' => esc_html__( 'Progress Percent', 'empath-extension' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Your Progress Percent Here', 'empath-extension' ),
			]
		);
        $this->add_control(
			'bar_color',
			[
				'label' => esc_html__( 'Bar BG Color', 'empath-extension' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress-bar' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'bar_btm_color',
			[
				'label' => esc_html__( 'Bar Bottom Color', 'empath-extension' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress' => 'background-color: {{VALUE}}',
				],
			]
		);
        
		
		$this->end_controls_section();
		
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
    ?>
    <div class="empath__pergress_wrap">        
        <h4><?php echo wp_kses( $settings['progress_title'], true );?></h4>
        <div class="progress">
            <div class="wow fadeInLeft progress-bar" style="width:<?php echo esc_attr($settings['progress_percent']);?>%">
            <span></span></div>
        </div>	
    </div>	
    <?php 
    }
		
	
}


Plugin::instance()->widgets_manager->register( new Empath_Progress() );