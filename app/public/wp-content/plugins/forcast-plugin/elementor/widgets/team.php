<?php

/**
 * Elementor Single Widget
 * @package empath Extension
 * @since 1.0.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Empath_Team extends Widget_Base {

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
		return 'empath-team-widget';
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
		return esc_html__( 'Team', 'empath-plugin' );
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
			'post_options',
			[
				'label' => esc_html__( 'Post Options', 'empath-plugin' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'team_img',
			[
				'label' => esc_html__( 'Team Image', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'designation',
			[
				'label' => esc_html__( 'Designation', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Social Icon', 'empath-plugin' ),
				'type' => Controls_Manager::ICONS,
			]
		);
		
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'empath-plugin' ),
				'type' => Controls_Manager::URL,
			]
		);
		$repeater->add_control(
			'brand_color',
			[
				'label' => esc_html__( 'Color', 'empath-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'social_icons',
			[
				'label' => esc_html__( 'Add Icon List', 'empath-plugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		
    ?>
        <div class="empath_team_item">
            <img src="<?php echo esc_url($settings['team_img']['url']);?>" alt="">
            <div class="team__content d-flex justify-content-between align-items-center">
                <div class="info">
                    <h3><?php echo esc_html($settings['name']);?></h3>
                    <span class="tm_design"><?php echo esc_html($settings['designation']);?></span>
                    <span class="border_sep"></span>
                </div>
                <ul class="tm__social-item">
                    <?php foreach($settings['social_icons'] as $item):?>
                        <li class="elementor-repeater-item-<?php echo esc_attr($item['_id']);?>"><a aria-label="name" href="<?php echo esc_url($item['link']['url']);?>"><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    <?php 
    }
		
	
}


Plugin::instance()->widgets_manager->register( new Empath_Team() );