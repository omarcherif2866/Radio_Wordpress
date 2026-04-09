<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Cta extends Widget_Base {

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
		return 'empath-cta';
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
		return esc_html__( 'Cta', 'empath-plugin' );
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
			'__cta_option__',
			[
				'label' => esc_html__( 'Cta', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'bg_img', [
				'label' => esc_html__( 'BG Image', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
			]
		);
        $this->add_control(
			'sub_title', [
				'label' => esc_html__( 'Sub Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
        
        $this->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
        
        $this->add_control(
			'authore', [
				'label' => esc_html__( 'Authore', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);

		$this->end_controls_section();
        $this->start_controls_section(
			'--sub-title-settings--',
			[
				'label' => esc_html__( 'Sub Title Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'sub-title-color',
			[
				'label' => esc_html__( 'Sub Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cta__main-content .sub_title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub-title__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .cta__main-content .sub_title',
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'--title-settings--',
			[
				'label' => esc_html__( 'Title Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title-color',
			[
				'label' => esc_html__( 'Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cta__main-content h2' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .cta__main-content h2',
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'--authore-settings--',
			[
				'label' => esc_html__( 'Authore Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'authore-color',
			[
				'label' => esc_html__( 'Authore Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cta__main-content .authore' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'authore__typography',
				'label' => esc_html__( 'Authore Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .cta__main-content .authore',
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
    ?>
        <div class="cta__main-wrapper">
            <img src="<?php echo esc_url($settings['bg_img']['url']);?>" alt="<?php if(!empty($settings['bg_img']['alt'])){ echo esc_attr($settings['bg_img']['alt']);}?>">
            <div class="cta__main-content">
                <span class="sub_title"><?php echo esc_html($settings['sub_title']);?></span>
                <h2><?php echo esc_html($settings['title']);?></h2>
                <span class="authore"><?php echo esc_html($settings['authore']);?></span>
            </div>
        </div>
    <?php
    }


}


Plugin::instance()->widgets_manager->register( new Empath_Cta() );