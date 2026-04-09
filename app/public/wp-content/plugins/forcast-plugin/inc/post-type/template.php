<?php
if(!function_exists('qubar_page_template_type')  ){
    function qubar_page_template_type(){
		register_post_type( 'empath_template',
		array(
			  'labels' => array(
				'name' => __( 'Template','qubar-addon' ),
				'singular_name' => __( 'Template','qubar-addon' )
			  ),
			'public' => true,
			'publicly_queryable' => true,
			'show_in_menu'      => false,
			'show_in_nav_menus'   => false,
			'supports' => ['title', 'elementor']
		)
		);
	}
	add_action( 'init','qubar_page_template_type',2 );
}
