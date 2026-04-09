<?php

/**
 * Elementor Single Widget
 * @package barfii Extension
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Category_Widget extends Widget_Base {

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
		return 'empath-cat-id';
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
		return esc_html__( 'Category', 'empath-plugin' );
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
			'print_cate_layout',
			[
				'label' => esc_html__( 'Category Layout', 'empath-plugin' ),
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

		$this->start_controls_section(
			'post_options',
			[
				'label' => esc_html__( 'Post Options', 'empath-plugin' ),
				'tab'   =>Controls_Manager::TAB_CONTENT,
			]
		);
	
		$this->add_control(
			'hideempty',
			[
				'label'        => esc_html__( 'Hide Empty', 'empath-plugin' ),
				'type'         =>Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'hidenumber',
			[
				'label'        => esc_html__( 'Hide Count', 'barfii-plugin' ),
				'type'         =>Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'postcustomorder',
			[
				'label'        => esc_html__( 'Custom Order', 'empath-plugin' ),
				'type'         =>Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'cateorder',
			[
				'label'     => esc_html__( 'Category Order', 'empath-plugin' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ASC',
				'options'   => [
					'ASC'  => esc_html__( 'Ascending', 'empath-plugin' ),
					'DESC' => esc_html__( 'Descending', 'empath-plugin' ),
				],
                'condition' => ['postcustomorder!' => 'yes'],
			]
		);
		$this->add_control(
            'catehow',
            [
                'label'   => __( 'How many Category You Want to show?', 'taffees' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 8,
            ]
        );
		$this->add_control(
            'count_text',
            [
                'label'   => __( 'Count Text', 'taffees' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
			'post_cat_style',
			[
				'label' => esc_html__( 'Category Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_control(
			'cate_color',
			[
				'label'     => esc_html__( 'Category Color', 'empath-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cate-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'category_typography',
				'label'     => esc_html__( 'Cate Typography', 'empath-plugin' ),
				'selector'  => '{{WRAPPER}} .cate-title',
			]
		);
		$this->add_control(
			'cate_count_color',
			[
				'label'     => esc_html__( 'Category Count Color', 'empath-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cat-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'category_count_typography',
				'label'     => esc_html__( 'Cate Typography', 'empath-plugin' ),
				'selector'  => '{{WRAPPER}} .cat-count',
			]
		);
        
		$this->end_controls_section();
	}


	
	protected function render() {
		$settings = $this->get_settings_for_display();

        $categorys  = "category";

        $cate_lists = get_terms( $categorys, [
            'orderby'    => 'slug',
            'number'     => $settings['catehow'],
            'order'      => $settings['cateorder'],
            'hide_empty' => 'yes' === $settings['hideempty'] ? false : true,
        ] );
		require __DIR__ . '/template-view/category/category-' . $settings['style'] . '.php';
    }
		
	
}


Plugin::instance()->widgets_manager->register( new Empath_Category_Widget() );