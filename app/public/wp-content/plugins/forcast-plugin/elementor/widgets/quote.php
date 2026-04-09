<?php

/**
 * Elementor Single Widget
 * @package empath Tools
 * @since 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Quote extends Widget_Base {

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
		return 'empath-quote';
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
		return esc_html__( 'Empath Quote', 'empath-plugin' );
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



		//hader top
		$this->start_controls_section(
			'__posts_info',
			[
				'label' => esc_html__( 'Quote Option', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'icon', [
				'label' => esc_html__( 'Quote Icon', 'empath-plugin' ),
				'type' => Controls_Manager::ICONS,
                'label_block' => true,
			]
		);
        
        $repeater->add_control(
			'description', [
				'label' => esc_html__( 'Description', 'empath-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
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
        
		$this->add_control(
			'quotes',
			[
				'label' => esc_html__( 'Add Quotes', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
				'fields' => $repeater->get_controls(),
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
		}?>
		<div class="bytf__quote_wrapper swiper-container text-center quoteslide__active">
			<div class="swiper-wrapper">
				<?php foreach($settings['quotes'] as $item):?>
					<div class="swiper-slide">
						<span class="quote-icon"><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
						<p><?php echo empath_wp_kses($item['description']);?></p>
						<span class="quote-authore"><?php echo empath_wp_kses($item['title']);?></span>
					</div>
				<?php endforeach;?>
			</div>
			
		</div>
	<?php
    }






}


Plugin::instance()->widgets_manager->register( new Empath_Quote() );