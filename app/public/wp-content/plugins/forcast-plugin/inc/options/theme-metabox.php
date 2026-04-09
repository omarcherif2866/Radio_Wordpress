<?php
/*
 * Theme Metabox
 * @package empath-tools
 * @since 1.0.0
 * */

if ( !defined( 'ABSPATH' ) ) {
    exit(); // exit if access directly
}

if ( class_exists( 'CSF' ) ) {

    $prefix = 'empath';

    /*-------------------------------------
    Page Options
    -------------------------------------*/
    $post_metabox = 'empath_inside_meta';

    CSF::createMetabox( $post_metabox, array(
        'title'     => 'Page Options',
        'post_type' => array('page', 'post'),
    ) );

    // Header Section
    CSF::createSection( $post_metabox, array(
        'title'  => 'Header',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Header Option', 'empath-tools' ),
            ),

            array(
				'id'       => 'meta_header_type',
				'type'     => 'switcher',
				'title'    => __( 'Header Style', 'empath-plugin' ),
				'text_on'  => __( 'Yes', 'empath-plugin' ),
				'text_off' => __( 'No', 'empath-plugin' ),
				'default'  => false
			),
            array(
				'id'          => 'meta_header_style',
				'type'        => 'select',
				'title'       => __('Select Header Style', 'empath-plugin' ),
				'options'     => Empath_Plugin_Helper::get_header_types(),
                'dependency' => array( 'meta_header_type', '==', 'true' ),
			),
            array(
				'id'       => 'page_header_disable',
				'type'     => 'switcher',
				'title'    => __( 'DIsable This page Header?', 'empath-plugin' ),
				'text_on'  => __( 'Yes', 'empath-plugin' ),
				'text_off' => __( 'No', 'empath-plugin' ),
				'default'  => false
			),
        ),
    ) );

    // Breadcrumb Section
    CSF::createSection( $post_metabox, array(
        'title'  => 'Page Settings',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Page Color', 'empath-tools' ),
            ),
           
            array(
                'id'     => 'scroll-top-color',
                'type'   => 'color',
                'title'  => 'Scroll Up Button Color',
                'output' => '.back-top-btn, .hap-contact-form button, .hap-footer-widget .bi-footer-newslatter button',
                'output_mode' => 'background',
            ),
            array(
                'id'     => 'scroll-bar',
                'type'   => 'color',
                'title'  => 'Scroll Bar Color',
                'output'      => 'body::-webkit-scrollbar-thumb',
                'output_mode' => 'background',
            ),
            
        )
    ) );

    CSF::createSection( $post_metabox, array(
        'title'  => 'Page Breadcrumb',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Page Breadcrumb', 'empath-plugin' ),
            ),
            array(
				'id'       => 'enable_page_preadcrumb',
				'type'     => 'switcher',
				'title'    => __( 'Page Breadcrumb', 'empath-plugin' ),
				'text_on'  => __( 'Yes', 'empath-plugin' ),
				'text_off' => __( 'No', 'empath-plugin' ),
				'default'  => true
			),
            array(
				'id'       => 'hide_bg_img',
				'type'     => 'switcher',
				'title'    => __( 'Hide Breadcrumb Page Image', 'empath-plugin' ),
				'text_on'  => __( 'Yes', 'empath-plugin' ),
				'text_off' => __( 'No', 'empath-plugin' ),
				'default'  => true
			),
            array(
                'id'    => 'bg_img_from_page',
                'type'  => 'media',
                'title' => esc_html__( 'Page Breadcrumb Background Image', 'empath-tools' ),
                'dependency' => array( 'enable_page_preadcrumb', '==', 'true' ),
                
            ),
            array(
				'id'       => 'enable_custom_title',
				'type'     => 'switcher',
				'title'    => __( 'Enable Page Custom Title', 'empath-plugin' ),
				'text_on'  => __( 'Yes', 'empath-plugin' ),
				'text_off' => __( 'No', 'empath-plugin' ),
				'default'  => false
			),
            
            array(
                'id'    => 'page_custom_title',
                'type'  => 'text',
                'title' => esc_html__( 'Page Custom Title', 'empath-tools' ),
                'dependency' => array( 'enable_custom_title', '==', 'true' ),
            ),
            
        )
    ) );
    

    // Header Section
    CSF::createSection( $post_metabox, array(
        'title'  => 'Footer',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Footer Option', 'empath-tools' ),
            ),

            array(
				'id'       => 'meta_footer_type',
				'type'     => 'switcher',
				'title'    => __( 'Footer Style', 'empath-plugin' ),
				'text_on'  => __( 'Yes', 'empath-plugin' ),
				'text_off' => __( 'No', 'empath-plugin' ),
				'default'  => false
			),
            array(
				'id'          => 'meta_footer_style',
				'type'        => 'select',
				'title'       => __('Select Footer Style', 'empath-plugin' ),
				'options'     => Empath_Plugin_Helper::get_footer_types(),
                'dependency' => array( 'meta_footer_type', '==', 'true' ),
			),
            array(
				'id'       => 'page_footer_disable',
				'type'     => 'switcher',
				'title'    => __( 'DIsable This page Footer?', 'empath-plugin' ),
				'text_on'  => __( 'Yes', 'empath-plugin' ),
				'text_off' => __( 'No', 'empath-plugin' ),
				'default'  => false
			),

        ),
    ) );

    

   

    // Video Link
    CSF::createSection( $post_metabox, array(
        'title'  => 'Post Layout Settings',
        'fields' => array(
            array(
                'id'        => 'post__sidebar_position',
                'type'      => 'image_select',
                'title'     => 'Image Select',
                'options'   => array(
                  'ls' => QUBAR_PLUGIN_IMG_PATH . '/admin/left-sidebar.jpg',
                  'ns' => QUBAR_PLUGIN_IMG_PATH . '/admin/no-sidebar.jpg',
                  'ri' => QUBAR_PLUGIN_IMG_PATH . '/admin/right-sidebar.jpg',
                ),
                'default'   => 'ri'
              ),
            array(
                'id'          => 'post_single_layout',
                'type'        => 'select',
                'title'       => 'Select Post Layout',
                'placeholder' => 'Select Single Post Style',
                'options'     => array(
                  'single-one'      => 'Style One',
                  'single-two'      => 'Style Two',
                  'single-three'    => 'Style Three',
                  'single-four'     => 'Style Four',
                  'single-five'     => 'Style Five',
                  'single-six'     => 'Style Six',
                ),
                'default'     => 'single-one'
              ),
        ),
    ) );


    /*-------------------------------------
    Page Options
    -------------------------------------*/
    $empath_temp_meta = 'empath_temp_meta';

    CSF::createMetabox( $empath_temp_meta, array(
        'title'     => 'Template Type',
        'post_type' => array('empath_template'),
        'data_type' => 'unserialize'
    ) );

     // Header Section
     CSF::createSection( $empath_temp_meta, array(
        'fields' => array(
            array(
                'id'          => 'empath_template_type',
                'type'        => 'select',
                'title'       => 'Select Template Type',
                'placeholder' => 'Select Template Type',
                'options'     => array(
                  'tf_header_key'  => 'Header',
                  'tf_footer_key'  => 'Footer',
                ),
                'default'     => ''
            ),
        ),
    ) );


    /*-------------------------------------
    Categoey Options
    -------------------------------------*/
    $cate_metabox = 'empath_cate_meta';

    CSF::createTaxonomyOptions( $cate_metabox, array(
        'taxonomy'  => 'category',
        'data_type' => 'serialize',
    ) );

     // Header Section
     CSF::createSection( $cate_metabox, array(
        'title'  => 'Header',
        'fields' => array(
            array(
                'id'      => 'cate_img_upload',
                'type'    => 'media',
                'title'   => 'Media',
            ),
            array(
                'id'    => 'cate-color',
                'type'  => 'color',
                'title' => 'Color',
            ),
            array(
                'id' => 'empath_cat_layout',
                'type' => 'select',
                'title' => esc_html__('Choose Category Layout','empath-plugin'),
                'options' => array(
                    'cat-layout-one'   => 'Style One',
                    'cat-layout-two'   => 'Style Two',
                    'cat-layout-three' => 'Style Three',
                ),
                'default' => 'cat-layout-one'
            ),
        ),
    ) );


    /*-------------------------------------
    Post Format Options
    -------------------------------------*/
    $post_format_metabox = 'empath_post_format_meta';

    CSF::createMetabox( $post_format_metabox, array(
        'title'     => 'Post Video',
        'post_type' => 'post',
		'post_formats' => 'video',
		'data_type'          => 'serialize',
		'context'            => 'advanced',
		'priority'           => 'default',
    ) );

    // Video Link
    CSF::createSection( $post_format_metabox, array(
        'title'  => 'Post Settings Settings',
        'fields' => array(
            array(
                'id'      => 'video_link',
                'type'    => 'text',
                'title'   => esc_html__('Direct Video Link Link', 'empath-extension'),
                'desc'    => esc_html__('If you want to popup Video? Then Enter Video Link Here', 'empath-extension'),
            ),
        ),
    ) );

    $post_audio_metabox = 'post_audio_metabox';

    CSF::createMetabox( $post_audio_metabox, array(
        'title'     => 'Post Audio',
        'post_type' => 'post',
		'post_formats' => 'audio',
		'data_type'          => 'serialize',
		'context'            => 'advanced',
		'priority'           => 'default',
    ) );

    // Video Link
    CSF::createSection( $post_audio_metabox, array(
        'fields' => array(
            array(
                'id'      => 'audio_link',
                'type'    => 'text',
                'title'   => esc_html__('Audio Link', 'empath-extension'),
                'desc'    => esc_html__('Enter Audio Link Here', 'empath-extension'),
            ),
        ),
    ) );
    
    //Gallery
    $post_format_gall_metabox = 'empath_post_gall_meta';

    CSF::createMetabox( $post_format_gall_metabox, array(
        'title'     => 'Post Gallery',
        'post_type' => 'post',
		'post_formats' => 'gallery',
		'data_type'          => 'serialize',
		'context'            => 'advanced',
		'priority'           => 'default',
    ) );

    // Video Link
    
    CSF::createSection( $post_format_gall_metabox, array(
        'fields' => array(
            array(
                'id'          => 'post-gall-item',
                'type'        => 'gallery',
                'title'       => 'Gallery',
                'add_title'   => 'Add Images',
                'edit_title'  => 'Edit Images',
                'clear_title' => 'Remove Images',
              ),
          ),
    ) );

    /*-------------------------------------
    Post Format Options
    -------------------------------------*/


    
    

} //endif
