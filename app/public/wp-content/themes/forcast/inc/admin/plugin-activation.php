<?php


add_action( 'tgmpa_register', 'empath_register_required_plugins' );

function empath_register_required_plugins() {

    $plugins = array(
        array(
			'name'               => esc_html__('Forcast Plugin', 'forcast'),
			'slug'               => 'forcast-plugin',
			'source'             => ( 'https://byteflows.net/wp/forcast/forcast-plugins/forcast-plugin.zip' ),
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
        array(
            'name'     => 'Elementor Website Builder',
            'slug'     => 'elementor',
            'required' => true,
        ),
        array(
			'name'               => esc_html__('Envato Market', 'forcast'),
			'slug'               => 'envato-market',
			'source'             => esc_url( 'https://goo.gl/pkJS33' ),
            'external_url'       => esc_url( 'https://goo.gl/pkJS33' ),
			'required'           => true,
		), 
        
        array(
            'name'     => esc_html__('Contact Form 7', 'forcast'),
            'slug'     => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('Rate My Post – Star Rating Plugin by FeedbackWP', 'forcast'),
            'slug'     => 'rate-my-post',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('MC4WP: Mailchimp for WordPress', 'forcast'),
            'slug'     => 'mailchimp-for-wp',
            'required' => false,
        ),

        array(
            'name'     => esc_html__( 'One Click Demo Import', 'forcast' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ),

        array(
            'name'     => esc_html__( 'User Profile Builder', 'forcast' ),
            'slug'     => 'profile-builder',
            'required' => false,
        )

    );

    $config = array(
		'id'           => 'forcast',
		'parent_slug'  => 'forcast',
		'menu'         => 'tgmpa-install-plugins',
		'dismissable'  => true,
        'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
		'default_path' => '',
	);

    tgmpa( $plugins, $config );
}
