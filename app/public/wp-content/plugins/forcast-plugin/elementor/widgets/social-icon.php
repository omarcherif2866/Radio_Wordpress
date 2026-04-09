<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Social_Icon extends Widget_Base {

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
		return 'empath-social-icon';
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
		return esc_html__( 'Social Counter', 'empath-plugin' );
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
				'label' => esc_html__( 'Social Layout', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Social Style', 'empath-plugin' ),
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
			'__header_top_info',
			[
				'label' => esc_html__( 'Social Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'condition' => [
					'style' => [ '2' ],
				],
			]
		);
		$this->add_control(
			'description', [
				'label' => esc_html__( 'Description', 'empath-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
				'condition' => [
					'style' => [ '2' ],
				],
			]
		);
		$repeater = new \Elementor\Repeater();

        
        $repeater->add_control(
			'icon', [
				'label' => esc_html__( 'Icon', 'empath-plugin' ),
				'type' => Controls_Manager::ICONS,
                'label_block' => true,
			]
		);
        
        $repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
        $repeater->add_control(
			'count', [
				'label' => esc_html__( 'Count', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
        $repeater->add_control(
			'link', [
				'label' => esc_html__( 'Link', 'empath-plugin' ),
				'type' => Controls_Manager::URL,
                'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'icon_bgc_color',
			[
				'label' => esc_html__( 'Icon BG Color', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .social_icon i' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .social_icon i' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Hover BG Color', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
				],
			]
		);
		

        $this->add_control(
			'socials',
			[
				'label' => esc_html__( 'Add Top Links', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
				'fields' => $repeater->get_controls(),
			]
		);
		
		$this->end_controls_section();
		$this->start_controls_section(
			'--social-settings--',
			[
				'label' => esc_html__( 'Social Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
        $this->add_control(
			's_main_title--color',
			[
				'label' => esc_html__( 'Social Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social__item .social_content p' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 's_main_title__typography',
				'label' => esc_html__( 'Social Title Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .social__item .social_content p',
			]
		);
		

		$this->end_controls_section();
		$this->start_controls_section(
			'--excerpt-settings--',
			[
				'label' => esc_html__( 'Social Contnt Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
        $this->add_control(
			'stitle--color',
			[
				'label' => esc_html__( 'Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social__info h2' => 'color: {{VALUE}}',
					'{{WRAPPER}} .social__item .social_content span' => 'color: {{VALUE}}'
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 's_title__typography',
				'label' => esc_html__( 'Social Title Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .social__info h2',
			]
		);
		$this->add_responsive_control(
			'--s-title-margin--',
			[
				'label' => esc_html__( 'Social Title margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .social__info h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'desc--color',
			[
				'label' => esc_html__( 'Description Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social__info p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .social__icon-wrapper .social__item-inner p' => 'color: {{VALUE}}'
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '
				{{WRAPPER}} .social__info p,
				{{WRAPPER}} .social__icon-wrapper .social__item-inner p
				',
			]
		);
		$this->add_responsive_control(
			'--desc-margin--',
			[
				'label' => esc_html__( 'Description margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .social__info p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		extract( $settings );


		require __DIR__ . '/template-view/social/social-' . $style . '.php';
    }


}


Plugin::instance()->widgets_manager->register( new Empath_Social_Icon() );