<?php
/**
 * All Elementor widget init
 * @package empath
 * @since 1.0.0
 */

if ( !defined('ABSPATH') ){
	exit(); // exit if access directly
}

if ( !class_exists('Empath_Elementor_Widget_Init') ){

	class Empath_Elementor_Widget_Init{
		/*
		* $instance
		* @since 1.0.0
		* */
		private static $instance;
		/*
		* construct()
		* @since 1.0.0
		* */
		public function __construct() {
			add_action( 'elementor/elements/categories_registered', array($this,'_widget_categories') );
			//elementor widget registered
			add_action('elementor/widgets/register',array($this,'_widget_registered'));
			add_action('elementor/editor/after_enqueue_styles',array($this,'editor_style'));
			add_action('elementor/documents/register_controls',array($this,'register_empath_page_controls'));
		}

		
		/*
	   * getInstance()
	   * @since 1.0.0
	   * */
		public static function getInstance(){
			if ( null == self::$instance ){
				self::$instance = new self();
			}
			return self::$instance;
		}
		/**
		 * _widget_categories()
		 * @since 1.0.0
		 * */
		public function _widget_categories($elements_manager){
			$elements_manager->add_category(
				'empath_widgets',
				[
					'title' => __( 'Forcast', 'empath-plugin' ),
					'icon' => 'fa fa-plug'
				]
			);
		}
		

		/**
		 * _widget_registered()
		 * @since 1.0.0
		 * */
		public function _widget_registered(){
			if( !class_exists('Elementor\Widget_Base') ){
				return;
			}
			$elementor_widgets = array(	
				
				// empath Theme Widgets
				
				'header-template',
				'post-overlay',
				'post-grid-column',
				'post-grid',
				'post-rating',
				'post-ajax',
				'heading',
				'add-banner',
				'social-icon',
				'category',
				'newsletter',
				'testimonial',
				'post-slider',
				'post-tab',
				'post-tiles',
				'video-popup',
				'post-list',
				'post-list-column',
				'post-gallery',
				'cta',
				'breaking-news',
				'authore',
				'team',
				'progress',
				'post-slider-two',
				'post-hero',
				'post-moving',
				'quote',
				'post-carousal'
			);

		
			$elementor_widgets = apply_filters('empath_elementor_widget',$elementor_widgets);

			if ( is_array($elementor_widgets) && !empty($elementor_widgets) ) {
				foreach ( $elementor_widgets as $widget ){
					$widget_file = 'plugins/elementor/widget/'.$widget.'.php';
					$template_file = locate_template($widget_file);
					if ( !$template_file || !is_readable( $template_file ) ) {
						$template_file = QUBAR_DIR_PATH.'/elementor/widgets/'.$widget.'.php';
					}
					if ( $template_file && is_readable( $template_file ) ) {
						include_once $template_file;
					}
				}
			}

		}

		public function editor_style(){
			$cs_icon = plugins_url( 'icons-elem.svg', __FILE__ );
			wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .empath-custom-icon{content: url( '.$cs_icon.');width: 28px;}' );
		}

		/**
		 * Register additional document controls.
		 *
		 * @param \Elementor\Core\DocumentTypes\PageBase $document The PageBase document instance.
		 */
		public function register_empath_page_controls( $document ) {

			if ( ! $document instanceof \Elementor\Core\DocumentTypes\PageBase || ! $document::get_property( 'has_elements' ) ) {
				return;
			}

			$document->start_controls_section(
				'body_empath_style',
				[
					'label' => esc_html__( 'Body Style', 'empath-plugin' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$document->add_control(
				'body_color',
				[
					'label' => esc_html__( 'Body Color', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}' => 'color: {{VALUE}}',
					],
				]
			);
			$document->add_control(
				'heading_color',
				[
					'label' => esc_html__( 'heading Color', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} h1, h2, h3, h4, h5, h6' => 'color: {{VALUE}}',
					],
				]
			);

			$document->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Page Body Font', 'textdomain' ),
					'name' => 'page_body_font',
					'selector' => '{{WRAPPER}}',
				]
			);
			
			$document->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Page Heading', 'textdomain' ),
					'name' => 'page_heading_font',
					'selector' => '{{WRAPPER}} h1, h2, h3, h4, h5, h6',
				]
			);
			$document->add_control(
				'hd_p-margin',
				[
					'label' => esc_html__( 'Heading Margin', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} h1, h2, h3, h4, h5, h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$document->end_controls_section();

			$document->start_controls_section(
				'colm_spac_s',
				[
					'label' => esc_html__( 'Column Grid Space Style', 'empath-plugin' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$document->add_control(
				'row_sp',
				[
					'label' => esc_html__( 'Row Space', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '.6',
					'options' => [
						'.2' => esc_html__( '.2', 'textdomain' ),
						'.3' => esc_html__( '.3', 'textdomain' ),
						'.4' => esc_html__( '.4', 'textdomain' ),
						'.5' => esc_html__( '.5', 'textdomain' ),
						'.6' => esc_html__( '.6', 'textdomain' ),
						'.7' => esc_html__( '.7', 'textdomain' ),
						'.8' => esc_html__( '.8', 'textdomain' ),
					],
					'selectors' => [
						'{{WRAPPER}} .row' => 'margin-right: calc(-{{VALUE}}* var(--bs-gutter-x));
    margin-left: calc(-{{VALUE}}* var(--bs-gutter-x))',
					],
				]
			);
			$document->add_control(
				'clm_dd',
				[
					'label' => esc_html__( 'Column Space', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '.6',
					'options' => [
						'.2' => esc_html__( '.2', 'textdomain' ),
						'.3' => esc_html__( '.3', 'textdomain' ),
						'.4' => esc_html__( '.4', 'textdomain' ),
						'.5' => esc_html__( '.5', 'textdomain' ),
						'.6' => esc_html__( '.6', 'textdomain' ),
						'.7' => esc_html__( '.7', 'textdomain' ),
						'.8' => esc_html__( '.8', 'textdomain' ),
					],
					'selectors' => [
						'{{WRAPPER}} .row>*' => 'padding-right: calc(var(--bs-gutter-x)* {{VALUE}});
    padding-left: calc(var(--bs-gutter-x)* {{VALUE}});',
					],
				]
			);

			$document->end_controls_section();
		}


	}

	if ( class_exists('Empath_Elementor_Widget_Init') ){
		Empath_Elementor_Widget_Init::getInstance();
	}

}//end if