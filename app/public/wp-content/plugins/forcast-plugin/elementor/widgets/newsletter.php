<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Newsletter extends Widget_Base {

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
		return 'empath-newsletter';
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
		return esc_html__( 'Empath Newsletter', 'empath-plugin' );
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
			'print_header_layout',
			[
				'label' => esc_html__( 'Newsletter Layout', 'empath-plugin' ),
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
					'2'  => esc_html__( 'Style 2', 'empath-plugin' ),
					'3'  => esc_html__( 'Style 3', 'empath-plugin' )
				]
			]
		);
		$this->end_controls_section();


		//hader top
		$this->start_controls_section(
			'__posts_info',
			[
				'label' => esc_html__( 'Newsletter Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
        $this->add_control(
			'banner_bg', [
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
				'condition' => [
					'style' => ['3'],
				],
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
			'description', [
				'label' => esc_html__( 'Description', 'empath-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
				'condition' => [
					'style' => ['1', '2'],
				],
			]
		);
        $this->add_control(
			'quote', [
				'label' => esc_html__( 'Quote', 'empath-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
			]
		);
        $this->add_control(
			'shortcode_id', [
				'label' => esc_html__( 'Shortcode', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
		
		
		$this->end_controls_section();
		$this->start_controls_section(
			'--box-settings--',
			[
				'label' => esc_html__( 'Box Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'--vox-margin--',
			[
				'label' => esc_html__( 'Box Padding', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .newsletter_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box-color',
			[
				'label' => esc_html__( 'Box BG Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .newsletter__wrapper-main' => 'background-color: {{VALUE}}'
				],
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
					'{{WRAPPER}} .newsletter_content h2' => 'color: {{VALUE}}',
					'{{WRAPPER}} .newsletter_box h2' => 'color: {{VALUE}}'
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'label' => esc_html__( 'Authore Font', 'empath-plugin' ),
				'selector' => '
					{{WRAPPER}} .newsletter_content h2,
					{{WRAPPER}} .newsletter_box h2
				',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'--btn-settings--',
			[
				'label' => esc_html__( 'Btn Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'btn-color',
			[
				'label' => esc_html__( 'Btn Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .newsletter__wrapper-two .ns_form button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .newsletter_box button' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'btn-bg-color',
			[
				'label' => esc_html__( 'Btn BG Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .newsletter__wrapper-two .ns_form button' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .newsletter_box button' => 'background-color: {{VALUE}}'
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn__typography',
				'label' => esc_html__( 'Btn Font', 'empath-plugin' ),
				'selector' => '
				{{WRAPPER}} .newsletter__wrapper-two .ns_form button,
				{{WRAPPER}} .newsletter_box button
				',
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
        if ( ! empty( $settings['website_link']['url'] ) ) {
			$this->add_link_attributes( 'website_link', $settings['website_link'] );
		}

		require __DIR__ . '/template-view/newsletter/newsletter-' . $settings['style'] . '.php';
    }






}


Plugin::instance()->widgets_manager->register( new Empath_Newsletter() );