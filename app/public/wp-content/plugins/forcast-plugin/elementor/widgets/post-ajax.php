<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Post_Ajax extends Widget_Base {

	protected function get_all_posts() {
        $posts = get_posts( array( 'post_type' => 'post', 'numberposts' => -1 ) );
        $post_options = array();
        foreach ( $posts as $post ) {
            $post_options[ $post->ID ] = $post->post_title;
        }
        return $post_options;
    }

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
		return 'empath-post-ajax';
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
		return esc_html__( 'Post Ajax', 'empath-plugin' );
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
			'postcustomorder',
			[
				'label'        => esc_html__( 'Custom Order', 'empath-plugin' ),
				'type'         =>Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'postorder',
			[
				'label'     => esc_html__( 'Post Order', 'empath-plugin' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ASC',
				'options'   => [
					'ASC'  => esc_html__( 'Ascending', 'empath-plugin' ),
					'DESC' => esc_html__( 'Descending', 'empath-plugin' ),
				],
			]
		);
		$this->add_control(
			'postorderby',
			[
				'label'     => esc_html__( 'Post Order By', 'empath-plugin' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => [
					'none'          => esc_html__( 'None', 'empath-plugin' ),
					'ID'            => esc_html__( 'ID', 'empath-plugin' ),
					'date'          => esc_html__( 'Date', 'empath-plugin' ),
					'name'          => esc_html__( 'Name', 'empath-plugin' ),
					'title'         => esc_html__( 'Title', 'empath-plugin' ),
					'comment_count' => esc_html__( 'Comment count', 'empath-plugin' ),
					'rand'          => esc_html__( 'Random', 'empath-plugin' ),
				],
				'condition' => ['postcustomorder' => 'yes'],
			]
		);
		$this->add_control(
			'pst_per_page',
			[
				'label'   => __( 'Posts Per Page', 'empath-plugin' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'default' => 1,
			]
		);
		$this->add_control(
			'skip_post',
			[
				'label'          => esc_html__( 'Skip Post Enable?', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'style_transfer' => true,
			]
		);
		
		$this->add_control(
			'skip_post_count',
			[
				'label'   => __( 'Skip Post Count', 'empath-plugin' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['skip_post' => 'yes'],
			]
		);
		$this->add_control(
			'category',
			array(
			  'label'       => esc_html__( 'Choose Categories', 'empath-plugin' ),
			  'type'        => \Elementor\Controls_Manager::SELECT2,
			  'multiple'    => true,
			  'options'     => array_flip(empath_get_category_lists( 'categories', array(
				'sort_order'  => 'ASC',
				'taxonomy'    => 'category',
				'hide_empty'  => true,
			  ) )),
			  'label_block' => true,
			)
		  );
		  $this->add_control(
			'exclude_cate',
			array(
			'label'       => esc_html__( 'Exclude Categories', 'empath-plugin' ),
			'description'       => esc_html__( 'Please Select Which Category Post you want to Exclude', 'empath-plugin' ),
			'type'        => \Elementor\Controls_Manager::SELECT2,
			'multiple'    => true,
			'options'     => array_flip(empath_get_category_lists( 'categories', array(
				'sort_order'  => 'ASC',
				'taxonomy'    => 'category',
				'hide_empty'  => false,
			) )),
			'label_block' => true,
			)
		);
		$this->add_control(
			'selected_posts',
			[
				'label' => __( 'Select Indivisual Post', 'empath-plugin' ),
				'description'       => esc_html__( 'You Can Selete your Favorite Post Here', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $this->get_all_posts(),
				'multiple' => true,
				'label_block' => true,
			]
		);
		$this->add_control(
			'exclude_posts',
			[
				'label' => __( 'Exclude Post', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $this->get_all_posts(),
				'multiple' => true,
				'label_block' => true,
			]
		);
		$this->add_control(
			'post_tags',
			[
				'type'        => Controls_Manager::SELECT2,
				'label'       => esc_html__( 'Select Tags', 'empath-plugin' ),
				'multiple'    => true,
                  'options'     => array_flip(empath_item_tag_lists( 'tags', array(
                    'sort_order'  => 'ASC',
                    'taxonomies'    => 'post_tag',
                    'hide_empty'  => false,
                ) )),
			]
		);
		$this->add_control(
			'post_format', [
			   
				'label'   => esc_html__('Select Post Format', 'empath-plugin'),
				'type'    => Controls_Manager::SELECT2,
				'options' => [
					
					'post-format-video' => esc_html__( 'Video', 'empath-plugin' ),
					'post-format-image' => esc_html__( 'Image', 'empath-plugin' ),
					'post-format-audio' => esc_html__( 'Audio', 'empath-plugin' ),
					'post-format-gallery' => esc_html__( 'Gallery', 'empath-plugin' ),
					'post-format-standard' => esc_html__( 'Standard', 'empath-plugin' ),
				],
				'default'     => [],
				'label_block' => true,
				'multiple'    => true,
			]
		);
		$this->add_control(
			'title_length',
			[
				'label'     => __( 'Title Length', 'empath-plugin' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => 1,
				'default'   => 20,
			]
		);
		$this->add_control(
			'excerpt_hide',
			[
				'label'          => esc_html__( 'Excerpt Hide/SHOW', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'no',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'excerpt_length',
			[
				'label'     => __( 'Excerpt Length', 'empath-plugin' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => 1,
				'default'   => 30,
				'condition' => ['excerpt_hide' => 'yes'],
			]
		);
        $this->add_control(
			'authore_hide',
			[
				'label'          => esc_html__( 'Authore Hide', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'cmnt_hide',
			[
				'label'          => esc_html__( 'Comment Hide', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'no',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'date_hide',
			[
				'label'          => esc_html__( 'Hide Date', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'cat_hide',
			[
				'label'          => esc_html__( 'Hide Category', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'cate_style',
			[
				'label' => esc_html__( 'Category Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'  => esc_html__( 'Style 1', 'empath-plugin' ),
					'2'  => esc_html__( 'Style 2', 'empath-plugin' ),
					'3'  => esc_html__( 'Style 3', 'empath-plugin' ),
					'4'  => esc_html__( 'Style 4', 'empath-plugin' ),
					'5'  => esc_html__( 'Style 5', 'empath-plugin' ),
				]
			]
		);
		$this->add_control(
			'show_video',
			[
				'label'          => esc_html__( 'Show Video', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'no',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'show_gllery',
			[
				'label'          => esc_html__( 'Show Gallery', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'no',
				'style_transfer' => true,
			]
		);
		
		
		
		$this->end_controls_section();

        
		$this->start_controls_section(
			'--image-settings--',
			[
				'label' => esc_html__( 'Image Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Image Width', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bytf__feature-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Image Height', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bytf__feature-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_box_width',
			[
				'label' => esc_html__( 'Image Box Width', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bytf__feature-image' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bytf__feature-image' => 'flex:0 0 {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'--img-margin--',
			[
				'label' => esc_html__( 'Image margin', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__feature-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'--content-settings--',
			[
				'label' => esc_html__( 'Content Box Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'con_padding',
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__post-overlay-item .bytf__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'title--color',
			[
				'label' => esc_html__( 'Title Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf_post_title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title-hover-color',
			[
				'label' => esc_html__( 'Title Hover Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf_post_title a' => 'background-image: linear-gradient({{VALUE}}, {{VALUE}})'
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .bytf_post_title',
			]
		);
		$this->add_responsive_control(
			'--title-margin--',
			[
				'label' => esc_html__( 'Title margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf_post_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'--excerpt-settings--',
			[
				'label' => esc_html__( 'Excerpt Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
        $this->add_control(
			'excerpt--color',
			[
				'label' => esc_html__( 'Excerpt Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__content p' => 'color: {{VALUE}}',
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt__typography',
				'label' => esc_html__( 'Excerpt Font', 'empath-plugin' ),
				'selector' => '{{WRAPPER}} .bytf__content p',
			]
		);
		$this->add_responsive_control(
			'--excerpt-margin--',
			[
				'label' => esc_html__( 'Excerpt margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'--metta-settings--',
			[
				'label' => esc_html__( 'Meta Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'meta--color',
			[
				'label' => esc_html__( 'Meta Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bytf__postmeta.meta__dark ul li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bytf__postmeta.meta__dark ul li a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'--meta-margin--',
			[
				'label' => esc_html__( 'Meta margin', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__postmeta-info-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
			'slider_button_one',
			[
				'label' => esc_html__( 'Button Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'm_b_typography',
				'selector' => '{{WRAPPER}} .ptx-btn-1 a, .ptx-btn-2 a, .ptx-btn-3 a, .ptx-btn-4 a, .ptx-btn-5 a, .ptx-btn-6 a',
			]
		);
        $this->add_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ptx-btn-1 a, .ptx-btn-2 a, .ptx-btn-3 a, .ptx-btn-4 a, .ptx-btn-5 a, .ptx-btn-6 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'b_round',
			[
				'label' => esc_html__( 'Border Radius', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ptx-btn-1 a, .ptx-btn-2 a, .ptx-btn-3 a, .ptx-btn-4 a, .ptx-btn-5 a, .ptx-btn-6 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Text Color', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ptx-btn-1 a, .ptx-btn-2 a, .ptx-btn-3 a, .ptx-btn-4 a, .ptx-btn-5 a, .ptx-btn-6 a' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'types' => [ 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .ptx-btn-1 a, .ptx-btn-2 a, .ptx-btn-3 a, .ptx-btn-4 a, .ptx-btn-5 a, .ptx-btn-6 a',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__( 'Button BG Color ', 'empath-plugin' ),
                        'description' => esc_html__( 'Choose background type and style.', 'empath-plugin' ),
                        'separator' => 'before',
                    ]
                ]
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

        if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else if ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}


		$args = array(
			'post_type'           => 'post',
			'posts_per_page'      => !empty( $settings['pst_per_page'] ) ? $settings['pst_per_page'] : 1,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
            'paged'				  => $paged,
			'order'               => $settings['postorder'],
			'orderby'             => $settings['postorderby'],
			'post__not_in' 		  => $settings['exclude_posts'],
			'post__in' 			  => $settings['selected_posts'],
			'suppress_filters' => false
		);


		if(!empty($settings['category'][0])) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'ids',
					'terms'    => $settings['category']
				)
			);
		}

		if(!empty($settings['exclude_cate'][0])) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'ids',
					'terms'    => $settings['exclude_cate'],
					'operator' => 'NOT IN'
				)
			);
		}


		if("yes" == $settings['skip_post']){
			$args['offset'] = $settings['skip_post_count'];
		}
		if(!empty($settings['post_tags'][0])) {
			$args['tax_query'] = array(
				array(
				'taxonomy' => 'post_tag',
				'field'    => 'ids',
				'terms'    => $settings['post_tags']
				)
			);
		}
		if( isset($settings['post_format']) && is_array($settings['post_format']) && count($settings['post_format']) > 0  ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => $settings['post_format'],
					'operator' => 'IN'
				) 
			);
		} 
		
		
		$query = new \WP_Query( $args );

        $ajax_json_data = [
			'order' => $settings['postorder'],
			'orderby' => $settings['postorderby'],
			'posts_per_page' => $settings['pst_per_page'],
			'skip_post' => $settings['skip_post'],
			'terms' => $settings['category'],
			'tags' => $settings['post_tags'],
			'postcustomorder' => $settings['postcustomorder'],
			'post_format' => $settings['post_format'],
			'title_length' => $settings['title_length'],
			'excerpt_length' => $settings['excerpt_length'],
			'skip_post_count' => $settings['skip_post_count'],
			'authore_hide' => $settings['authore_hide'],
			'excerpt_hide' => $settings['excerpt_hide'],
			'cmnt_hide' => $settings['cmnt_hide'],
			'date_hide' => $settings['date_hide'],
			'cat_hide' => $settings['cat_hide'],
			'cate_style' => $settings['cate_style'],
		];
		$ajax_json_data = json_encode($ajax_json_data);

		require __DIR__ . '/template-view/post-ajax/post-' . $settings['style'] . '.php';
    }






}


Plugin::instance()->widgets_manager->register( new Empath_Post_Ajax() );