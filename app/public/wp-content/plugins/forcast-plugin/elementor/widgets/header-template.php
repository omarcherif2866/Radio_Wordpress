<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Header_Template extends Widget_Base {

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
		return 'empath-header-temp';
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
		return esc_html__( 'Empath Header', 'empath-plugin' );
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
				'label' => esc_html__( 'Header Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'  => esc_html__( 'Header 1', 'empath-plugin' ),
					'2'  => esc_html__( 'Header 2', 'empath-plugin' ),
					'3'  => esc_html__( 'Header 3', 'empath-plugin' ),
					'4'  => esc_html__( 'Header 4', 'empath-plugin' ),
					'5'  => esc_html__( 'Header 5', 'empath-plugin' ),
					'6'  => esc_html__( 'Header 6', 'empath-plugin' ),
					'7'  => esc_html__( 'Header 7', 'empath-plugin' ),
					'8'  => esc_html__( 'Header 8', 'empath-plugin' )
				]
			]
		);
		$this->end_controls_section();


		//hader top
		$this->start_controls_section(
			'__header_top_info',
			[
				'label' => esc_html__( 'Header Top Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'enable_header_top',
			[
				'label' => esc_html__( 'Enable Header Top', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'empath-plugin' ),
				'label_off' => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'quick_text', [
				'label' => esc_html__( 'Quick Text Change', 'empath-plugin' ),
				'default' => esc_html__( 'Quick Links:', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
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
			'link', [
				'label' => esc_html__( 'Link', 'empath-plugin' ),
				'type' => Controls_Manager::URL,
                'label_block' => true,
			]
		);

        $this->add_control(
			'links',
			[
				'label' => esc_html__( 'Add Top Links', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'default' => [
					[
						'link' => esc_url( '#' ),
						'title' => esc_html__('About Us', 'empath-plugin'),
					],
					[
						'link' => esc_url( '#' ),
						'title' => esc_html__('Contact Us', 'empath-plugin'),
					],
					[
						'link' => esc_url( '#' ),
						'title' => esc_html__('Latest News', 'empath-plugin'),
					],
				],
				'fields' => $repeater->get_controls(),
				'condition' => [
					'enable_header_top' => 'yes',
					'style' => ['1', '2', '6', '7', '8'],
				],
			]
		);
		
		$this->end_controls_section();

		
		//Header Button
		$this->start_controls_section(
			'__header_gen_btn',
			[
				'label' => esc_html__( 'Header General', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'enable_search',
            [
                'label'        => __( 'Enable Search', 'empath-plugin' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'empath-plugin' ),
                'label_off'    => __( 'No', 'empath-plugin' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control(
			'template',
			[
				'label' => esc_html__( 'Elementor Template', 'empath-plugin' ),
				'description' => esc_html__( 'If you want to edit searvice content then go to Dashboard Templates->Save Templates->Services', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => empath_load_elementor_template(),
			]
		);
		$this->add_control(
            'enable_dark_s',
            [
                'label'        => __( 'Enable Switch', 'empath-plugin' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'empath-plugin' ),
                'label_off'    => __( 'No', 'empath-plugin' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control(
            'enable_bookmark',
            [
                'label'        => __( 'Enable Bookmark', 'empath-plugin' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'empath-plugin' ),
                'label_off'    => __( 'No', 'empath-plugin' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control(
			'bookmark_link', [
				'label' => esc_html__( 'Bookmark Link', 'empath-plugin' ),
				'type' => Controls_Manager::URL,
                'label_block' => true,
				'condition' => [
					'enable_bookmark' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_label', [
				'label' => esc_html__( 'Button Label', 'empath-plugin' ),
				'default' => esc_html__( 'Sign In', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'condition' => [
					'style' => ['1', '2', '4', '5', '7', '8'],
				],
			]
		);
		$this->add_control(
			'btn_link', [
				'label' => esc_html__( 'Button Link', 'empath-plugin' ),
				'type' => Controls_Manager::URL,
                'label_block' => true,
				'condition' => [
					'style' => ['1', '2', '4', '5', '7', '8'],
				],
			]
		);
		$this->add_control(
            'enable_login',
            [
                'label'        => __( 'Enable Login', 'empath-plugin' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'empath-plugin' ),
                'label_off'    => __( 'No', 'empath-plugin' ),
                'return_value' => 'yes',
                'default'      => 'yes',
				'condition' => [
					'style' => ['7', '8'],
				],
            ]
        );
		$this->add_control(
			'l_link', [
				'label' => esc_html__( 'Login Link', 'empath-plugin' ),
				'type' => Controls_Manager::URL,
                'label_block' => true,
				'condition' => [
					'style' => ['7', '8'],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'__header_ads_btn',
			[
				'label' => esc_html__( 'Header Ads', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'ads_image',
			[
				'label' => esc_html__( 'Ads Image', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'ads_dark_image',
			[
				'label' => esc_html__( 'Ads Dark Image', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'include' => [],
				'default' => 'large',
			]
		);
		$this->add_control(
			'ads_link',
			[
				'label' => esc_html__( 'Ads Link', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();

		// logo
        $this->start_controls_section(
			'__header_logs',
			[
				'label' => esc_html__( 'Header Logo Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'__rzlogo', [
				'label' => esc_html__( 'Logo', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
				'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		$this->add_control(
			'_dark_rzlogo', [
				'label' => esc_html__( 'Light Logo', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
				'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		
		$this->add_responsive_control(
			'__rzlogo_size',
			[
				'label' => esc_html__( 'Max Width', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
					]
				],

				'selectors' => [
					'{{WRAPPER}} .byteflows_logo img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'__rzlogo_mobile', [
				'label' => esc_html__( 'Mobile Logo', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
				'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		
		$this->add_control(
            'enable_custom_link',
            [
                'label'        => __( 'Enable Custom Link', 'empath-plugin' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'empath-plugin' ),
                'label_off'    => __( 'No', 'empath-plugin' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // custom link
        $this->add_control(
            'custom_link',
            [
                'label'       => __( 'Custom Link', 'empath-plugin' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'empath-plugin' ),
                'show_label'  => false,
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'enable_m_custom_link' => 'yes',
                ],
            ]
        );

		$this->end_controls_section();


		//menu setting
        $this->start_controls_section(
			'menu_select',
			[
				'label' => esc_html__( 'Menu Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'choose-menu',
			[
				'label' => esc_html__( 'Choose menu', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => empath_menu_selector(),
				'multiple' => false
			]
		);
		$this->add_control(
			'choose-cate-menu',
			[
				'label' => esc_html__( 'Choose Category menu', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => empath_menu_selector(),
				'multiple' => false,
				'condition'   => [
                    'style' => '2',
                ],
			]
		);
		
		
		$this->end_controls_section();


		//social icon
		$this->start_controls_section(
			'__header_social',
			[
				'label' => esc_html__( 'Header Social Icon', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'icons', [
				'label' => esc_html__( 'Icon', 'empath-plugin' ),
				'type' => Controls_Manager::ICONS,
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
			'title', [
				'label' => esc_html__( 'Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
		$repeater->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'hsocials',
			[
				'label' => esc_html__( 'Add Social Item', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'default' => [
					[
						'icons' => [
							'value'   => 'fab fa-facebook-f',
                    		'library' => 'solid',
						],
						'link' => esc_html__( 'https://facebook.com', 'empath-plugin' ),
						'title' => esc_html__( 'Facebook', 'empath-plugin' ),
					],
					[
						'icons' => [
							'value'   => 'fab fa-instagram',
                    		'library' => 'solid',
						],
						'link' => esc_html__( 'https://instagram.com', 'empath-plugin' ),
						'title' => esc_html__( 'Instagram', 'empath-plugin' ),
					],
					[
						'icons' => [
							'value'   => 'fab fa-youtube',
                    		'library' => 'solid',
						],
						'link' => esc_html__( 'https://youtube.com', 'empath-plugin' ),
						'title' => esc_html__( 'Youtube', 'empath-plugin' ),
					],
				],
				'fields' => $repeater->get_controls(),
				'condition' => [
					'enable_header_top' => 'yes',
					'style' => ['1', '2', '4', '5', '6', '7', '8'],
				],
			]
		);
		$this->end_controls_section();

		
		// logo
        $this->start_controls_section(
			'__offcanvash_logs',
			[
				'label' => esc_html__( 'Off Canvash Menu', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'__ofclogo', [
				'label' => esc_html__( 'Logo', 'empath-plugin' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
				'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		
		$this->add_responsive_control(
			'__ofclogo_size',
			[
				'label' => esc_html__( 'Max Width', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
					]
				],

				'selectors' => [
					'{{WRAPPER}} .empath_logo img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'o_contact_title', [
				'label' => esc_html__( 'Info Title', 'empath-plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
			]
		);
		$repeater = new \Elementor\Repeater();

        
        $repeater->add_control(
			'infos', [
				'label' => esc_html__( 'Title', 'empath-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
			]
		);

        $this->add_control(
			'c_infos',
			[
				'label' => esc_html__( 'Contact Infos', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
			'bookmark_hide',
			[
				'label'          => esc_html__( 'Bookmark Hide', 'empath-plugin' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'empath-plugin' ),
				'label_off'      => esc_html__( 'Hide', 'empath-plugin' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'style_transfer' => true,
			]
		);
		
		
		$this->end_controls_section();
        
		$this->start_controls_section(
			'h_con_w',
			[
				'label' => esc_html__( 'Menu Top Bar Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'c_width',
			[
				'label' => esc_html__( 'Container Width', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
        
		$this->start_controls_section(
			'menu_bar_style',
			[
				'label' => esc_html__( 'Menu Top Bar Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'meni--styl',
			[
				'label' => esc_html__( 'Header Top BG Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_top_bar_bg',
				'types' => [ 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '
				{{WRAPPER}} .ptx-header-top-section,
				{{WRAPPER}} .ptx-header-section.type_four .header-top-content .top-cta .inner-icon i,
				{{WRAPPER}} .ptx-header-section.type_four .ptx-header-menu-social-area
				',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__( 'Header Top Bar BG', 'empath-plugin' ),
                        'description' => esc_html__( 'Choose background type and style.', 'empath-plugin' ),
                        'separator' => 'before',
                    ]
                ]
			]
		);
		$this->add_control(
			'top-txt-styl',
			[
				'label' => esc_html__( 'Header Top Text Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
        $this->add_control(
			'top-text-c',
			[
				'label' => esc_html__( 'Text Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ptx-header-top-section li' => 'color: {{VALUE}}',
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'top_text_typography',
				'selector' => '{{WRAPPER}} .ptx-header-top-section li',
			]
		);
		$this->add_control(
			'store--styl',
			[
				'label' => esc_html__( 'Store Location Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
        $this->add_control(
			'top-str-c',
			[
				'label' => esc_html__( 'Store Location Text Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .top-location' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'str_typography',
				'selector' => '{{WRAPPER}} .top-location',
			]
		);
		$this->add_control(
			'store-social-styl',
			[
				'label' => esc_html__( 'Social Icon Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['2'],
				],
			]
		);
		$this->add_control(
			'top-social-c',
			[
				'label' => esc_html__( 'Social Icon Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ptx-header-top-section li' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => ['2'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'menu_info_style',
			[
				'label' => esc_html__( 'Menu Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'main-mennu--styl',
			[
				'label' => esc_html__( 'Main Menu Style', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		
        $this->add_control(
			'menu-text-c',
			[
				'label' => esc_html__( 'Menu Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .byteflows_menu .byteflows_menu-nav>li>a' => 'color: {{VALUE}}'
				],
			]
		);
        $this->add_control(
			'menu-hover-c',
			[
				'label' => esc_html__( 'Menu Hover Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .byteflows_menu .byteflows_menu-nav>li>a:hover' => 'color: {{VALUE}} !important'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_font_typography',
				'selector' => '{{WRAPPER}} .byteflows_menu .byteflows_menu-nav>li>a',
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
		$this->add_responsive_control(
			'img-round',
			[
				'label' => esc_html__( 'Image Round', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__feature-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'--grid-settings--',
			[
				'label' => esc_html__( 'Grid Box Style', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'--box-pding--',
			[
				'label' => esc_html__( 'Box Padding', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__post-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'--box-dound--',
			[
				'label' => esc_html__( 'Box Round', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__post-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bytf__post-grid-item',
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
				'label' => esc_html__( 'Padding', 'empath-plugin' ),
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
					'{{WRAPPER}} .bytf__content h4' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bytf_post_title' => 'color: {{VALUE}}',
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'label' => esc_html__( 'Title Font', 'empath-plugin' ),
				'selector' => '
				{{WRAPPER}} .bytf__content h4,
				{{WRAPPER}} .bytf_post_title
				'
			]
		);
		$this->add_responsive_control(
			'--title-margin--',
			[
				'label' => esc_html__( 'Title margin', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bytf__content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .bytf_post_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
				'label' => esc_html__( 'Excerpt margin', 'empath-plugin' ),
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



	}


	/**
	 * Main Contetn
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings );

		$enable_custom_link = $enable_custom_link;

		if($enable_custom_link == 'yes') {
			$custom_link = $custom_link['url'];
		} else {
			$custom_link = home_url( '/' );
		}

		require __DIR__ . '/template-view/header/header-' . $style . '.php';
    }

	/**
	 * Search Body Display
	 *
	 * @return void
	 */
	protected function ___search_body(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		?>
		<div class="bytf__search-wrapper ">
         <div class="bytf__search-wrapper-innner p-relative">
            <div class="bytf__search-close">
               <button aria-label="name" class="bytf__search-close-btn">
                  <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path class="path-1" d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                     <path class="path-2" d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
               </button>
            </div>
            <div class="container">
               <div class="row">
                  <div class="bytf__search-content-wrapper">
                     <div class="col-lg-9">
                        <div class="bytf__search-content">
                           <div class="search__fw">
						   <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
							  <input type="text" placeholder="<?php esc_attr_e( 'What are you looking for?', 'empath' )?>" name="s" value="<?php the_search_query();?>">
                              <button aria-label="name" class="bytf-search-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M13.3989 13.4001L16.9989 17.0001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.3999 8.2001C15.3999 4.22366 12.1764 1.00012 8.19997 1.00012C4.22354 1.00012 1 4.22366 1 8.2001C1 12.1765 4.22354 15.4001 8.19997 15.4001C12.1764 15.4001 15.3999 12.1765 15.3999 8.2001Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                 </svg>
                              </button>
							</form>
                           </div>
                           <div class="tp-search-course-wrap">
						   <?php echo empath_elemento_display()->frontend->get_builder_content_for_display( $settings['template'] );?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  <div class="bytf__body-overlay"></div>
<?php 
	}



	/**
	 * Mobile Menu Display
	 *
	 * @return void
	 */
	protected function __mobile_menu(){ 
		$settings = $this->get_settings_for_display();
		$enable_m_custom_link = $settings['enable_m_custom_link'];
		$m_custom_link = '';
		if($enable_m_custom_link == 'yes') {
			$m_custom_link = $settings['m_custom_link']['url'];
		} else {
			$m_custom_link = home_url( '/' );
		}	
	?>

	<?php }

	/**
	 * Mobile Menu
	 *
	 * @return void
	 */
	protected function mobile_menu(){ 
		$settings = $this->get_settings_for_display();	
	?>
		<div class="slide-bar">
			<div class="close-mobile-menu">
				<a aria-label="name" href="#"><i class="fal fa-times"></i></a>
			</div>
			<nav class="side-mobile-menu">
				<?php if(!empty($settings['__rzlogo_mobile']['url'])):?>
					<div class="empath_logo">
						<a aria-label="name" href="<?php echo esc_url(home_url( '/' ));?>"><img src="<?php echo esc_url($settings['__rzlogo_mobile']['url']);?>" alt=""></a>
					</div>
				<?php endif;?>
				<div class="header-mobile-search">
					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
						<input type="search" name="s" id="search-id" value="<?php the_search_query();?>" placeholder="<?php esc_attr_e( 'Search Here', 'empath' )?>">
						<button aria-label="search" type="submit"><i class="ti-search"></i></button>
					</form>
				</div>
				<?php
					echo str_replace(['menu-item-has-children'], ['dropdown'], wp_nav_menu( array(
						'echo'           => false,
						'menu' => !empty($settings['choose-menu']) ? $settings['choose-menu'] : 'menu-1',
						'menu_id'        =>'empath-mobile-menu',
						'menu_class'        =>'empath-mobile-menu',
						'container'=>false,
						'fallback_cb'    => 'Navwalker_Class::fallback',
						'walker'         => class_exists( 'Rs_Mega_Menu_Walker' ) ? new \Rs_Mega_Menu_Walker : '',
					)) );
				?>
			</nav>
		</div>
	<?php
	}


	protected function offcanvas_menu(){ 
		$settings = $this->get_settings_for_display();		
	?>

		<section class="hidden-bar">
			<div class="inner-box">
				<div class="upper-box">
				<?php if(!empty($settings['__ofclogo']['url'])):?>
					<div class="nav-logo">
						<a aria-label="name" href="<?php echo esc_url(home_url());?>"><img src="<?php echo esc_url($settings['__ofclogo']['url']);?>" alt=""></a>
					</div>
                 <?php endif;?>	
					<div class="close-btn"><i class="icon fa fa-times"></i></div>
				</div>
				<div class="post__box-wrapper-of">
					<div class="bytf__post-wrapper">
						<?php

							$args = array(
								'post_type'           => 'post',
								'posts_per_page'      => !empty( $settings['pst_per_page'] ) ? $settings['pst_per_page'] : 1,
								'post_status'         => 'publish',
								'ignore_sticky_posts' => 1,
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
						if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							$idd = get_the_ID();
							$pfythumb_size = 'full';
							$title = wp_trim_words( get_the_title(), $settings['title_length'], '' );
							if(get_post_meta($idd, 'benqu_post_format_meta', true)) {
								$post_video_meta = get_post_meta($idd, 'benqu_post_format_meta', true);
							} else {
								$post_video_meta = array();
							}

							if( array_key_exists( 'video_link', $post_video_meta )) {
								$video_link = $post_video_meta['video_link'];
							} else {
								$video_link = '';
							}
							
						?>
						<div class="bytf__post-grid-item grid__style-two d-flex align-items-center">
							<div class="bytf__feature-image">
								<a aria-label="name" href="<?php the_permalink();?>">
									<?php the_post_thumbnail( 'full' );?>
								</a>
							</div>
							<div class="bytf__content">
								<?php 
									if(function_exists('empath_category_badge') && $settings['cat_hide'] === 'yes'){
										empath_category_badge();
									}
								?>
								<h4 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php echo esc_html($title);?></a></h4>
								<div class="bytf__postmeta-info-wrapper">
									<div class="bytf__postmeta meta__dark">
										<ul class="d-flex align-items-center">
											<?php if('yes' === $settings['authore_hide']):?>
												<li class="authore"><?php empath_post_author_avatars(25); the_author_posts_link(); ?></li>
											<?php endif;?>

											<?php if('yes' === $settings['date_hide']):?>
												<li><i class="fal fa-calendar"></i> <?php echo esc_html(get_the_time( get_option('date_format')));?></li>
											<?php endif;?>

											<?php if('yes' === $settings['cmnt_hide']):?>
												<li class="comment"><i class="far fa-comment"></i> 
												<?php echo esc_attr(get_comments_number());?> <?php
													if(get_comments_number() == 1 ){
														esc_html_e( 'Comment', 'barfii-plugin' );
													}else{
														esc_html_e( 'Comments', 'barfii-plugin' );
													}                                
												?>
												</li>
											<?php endif;?>
										</ul>
									</div>
									<div class="bytf__bookmark bookmark__dark">
										<?php if(function_exists('empath_bookmark_trigger')){empath_bookmark_trigger();}?>
									</div>
								</div>
							</div>
						</div>
					<?php } wp_reset_query(); } ?>   
					</div>
				</div>
				<div class="lowr__box">
					<h3><?php echo esc_html($settings['o_contact_title']);?></h3>
					<div class="ct__info-wrapper">
						<ul>
							<?php foreach($settings['c_infos'] as $item):?>
							<li><?php echo wp_kses($item['infos'], true);?></li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
			</div>
		</section>

	<?php 
	}

	protected function empath_dark_mode(){ ?>
		<div class="dark__switch">			
		<input type="checkbox" class="empath-switch-box__input" id="dark-mode-toggle">
		<label for="dark-mode-toggle" class="toggle-label">
			<div class="icon sun">
				
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.9999 12.79C20.8426 14.4922 20.2038 16.1144 19.1581 17.4668C18.1125 18.8192 16.7034 19.8458 15.0956 20.4265C13.4878 21.0073 11.7479 21.1181 10.0794 20.7461C8.41092 20.3741 6.8829 19.5345 5.67413 18.3258C4.46536 17.117 3.62584 15.589 3.25381 13.9205C2.88178 12.252 2.99262 10.5121 3.57336 8.9043C4.15411 7.29651 5.18073 5.88737 6.53311 4.84175C7.8855 3.79614 9.5077 3.15731 11.2099 3C10.2133 4.34827 9.73375 6.00945 9.85843 7.68141C9.98312 9.35338 10.7038 10.9251 11.8893 12.1106C13.0748 13.2961 14.6465 14.0168 16.3185 14.1415C17.9905 14.2662 19.6516 13.7866 20.9999 12.79Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

</div>
			<div class="icon moon">
			
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg></div>
		</label>
		</div>
	<?php 
	}


}


Plugin::instance()->widgets_manager->register( new Empath_Header_Template() );