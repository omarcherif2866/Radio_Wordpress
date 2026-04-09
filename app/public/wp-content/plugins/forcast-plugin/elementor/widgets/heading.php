<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Heading extends Widget_Base {

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
		return 'empath-heading';
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
		return esc_html__( 'Empath Section Heading', 'empath-plugin' );
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
					'3'  => esc_html__( 'Style 3', 'empath-plugin' ),
					'4'  => esc_html__( 'Style 4', 'empath-plugin' ),
					'5'  => esc_html__( 'Style 5', 'empath-plugin' ),
					'6'  => esc_html__( 'Style 6', 'empath-plugin' )
				]
			]
		);
		$this->end_controls_section();


		//hader top
		$this->start_controls_section(
			'__posts_info',
			[
				'label' => esc_html__( 'Heading Content Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
			]
		);
        $this->add_control(
            'title_tag',
            [
                'label'   => __( 'Title HTML Tag', 'empath-plugin' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __( 'H1', 'empath-plugin' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => __( 'H2', 'empath-plugin' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => __( 'H3', 'empath-plugin' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => __( 'H4', 'empath-plugin' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => __( 'H5', 'empath-plugin' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => __( 'H6', 'empath-plugin' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'h2',
                'toggle'  => false,
            ]
        );
		$this->add_control(
			'description', [
				'label' => esc_html__( 'Description', 'empath-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
				'condition' => [
					'style' => '5',
				],
			]
		);
		$this->add_control(
			'hide_btn',
			[
				'label' => esc_html__( 'Hide Button', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'empath-plugin' ),
				'label_off' => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'btn_label', [
				'label' => esc_html__( 'Button Label', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'condition' => [
					'hide_btn' => 'yes',
				],
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
				'condition' => [
					'hide_btn' => 'yes',
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
			'title--shape-color',
			[
				'label' => esc_html__( 'Title Shape Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title__wrapper svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'style' => '2',
				],
			]
		);
        $this->add_control(
			'title--color',
			[
				'label' => esc_html__( 'Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'border--color',
			[
				'label' => esc_html__( 'Title Border Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__section-heading' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .bytf__section-heading.heading__four:after' => 'background: {{VALUE}}'
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .bytf__title',
			]
		);
		$this->add_responsive_control(
			'--title-margin--',
			[
				'label' => esc_html__( 'Title margin', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'--title-padding--',
			[
				'label' => esc_html__( 'Title Padding', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__section-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'desc--color',
			[
				'label' => esc_html__( 'Description Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__heading-five p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn--color',
			[
				'label' => esc_html__( 'Button Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__section-heading .btn_wraper a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bytf__heading-five .btn_wraper a' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'btn-arrow-color',
			[
				'label' => esc_html__( 'Button Arrow Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__section-heading .btn_wraper a i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn-bg-color',
			[
				'label' => esc_html__( 'Button Arrow BG Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__section-heading .btn_wraper a i' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn-bg-h-color',
			[
				'label' => esc_html__( 'Button Arrow Hover BG Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__section-heading .btn_wraper a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bytf__section-heading .btn_wraper a:hover i' => 'background: {{VALUE}}'
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .bytf__section-heading .btn_wraper a',
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

		require __DIR__ . '/template-view/heading/heading-' . $settings['style'] . '.php';
    }






}


Plugin::instance()->widgets_manager->register( new Empath_Heading() );