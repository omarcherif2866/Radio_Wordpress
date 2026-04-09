<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Add_Banner extends Widget_Base {

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
		return 'empath-add-banner';
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
		return esc_html__( 'Empath Add Banner', 'empath-plugin' );
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
				'label' => esc_html__( 'Header Layout', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Post Style', 'empath-plugin' ),
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
				'label' => esc_html__( 'Posts Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
        $this->add_control(
			'banner_bg', [
				'label' => esc_html__( 'Banner BG', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
			]
		);
        $this->add_control(
			'banner_logo', [
				'label' => esc_html__( 'Banner Logo', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
			]
		);
        $this->add_control(
			'banner_img', [
				'label' => esc_html__( 'Banner Image', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
				'condition' => [
					'style' => '1',
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
					'style!' => '31',
				],
			]
		);
        $this->add_control(
			'add_title', [
				'label' => esc_html__( 'Add Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'condition' => [
					'style' => '2',
				],
			]
		);
        $this->add_control(
			'btn_label', [
				'label' => esc_html__( 'Button Label', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
        $this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
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
			'title--color',
			[
				'label' => esc_html__( 'Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__add-banner-two h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bytf__add-banner-three h3' => 'color: {{VALUE}}'
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '
				{{WRAPPER}} .bytf__add-banner-two h3,
				{{WRAPPER}} .bytf__add-banner-three h3
				',
			]
		);
		$this->add_responsive_control(
			'--title-margin--',
			[
				'label' => esc_html__( 'Title margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__add-banner-two h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .bytf__add-banner-three h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'--dsc-settings--',
			[
				'label' => esc_html__( 'desc Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
        $this->add_control(
			'excerpt--color',
			[
				'label' => esc_html__( 'Excerpt Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__add-banner-two p' => 'color: {{VALUE}}',
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt__typography',
				'label' => esc_html__( 'Excerpt Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .bytf__add-banner-two p',
			]
		);
		$this->add_responsive_control(
			'--excerpt-margin--',
			[
				'label' => esc_html__( 'Excerpt margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__add-banner-two p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'--add-settings--',
			[
				'label' => esc_html__( 'Add Title Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
        $this->add_control(
			'add-title-color',
			[
				'label' => esc_html__( 'Add Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .add__title' => 'color: {{VALUE}}',
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'add_title_typography',
				'label' => esc_html__( 'Excerpt Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .add__title',
			]
		);
		$this->add_responsive_control(
			'--add-title-margin--',
			[
				'label' => esc_html__( 'Add Title margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .add__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        if ( ! empty( $settings['website_link']['url'] ) ) {
			$this->add_link_attributes( 'website_link', $settings['website_link'] );
		}

		require __DIR__ . '/template-view/add-banner/banner-' . $settings['style'] . '.php';
    }






}


Plugin::instance()->widgets_manager->register( new Empath_Add_Banner() );