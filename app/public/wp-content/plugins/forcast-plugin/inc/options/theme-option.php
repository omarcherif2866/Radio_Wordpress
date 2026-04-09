<?php
/*
 * Theme Options
 * @package empath
 * @since 1.0.0
 * */

if ( !defined( 'ABSPATH' ) ) {
    exit(); // exit if access directly
}

if ( class_exists( 'CSF' ) ) {

    //
    // Set a unique slug-like ID
    $prefix = 'empath';

    //
    // Create options
    CSF::createOptions( $prefix . '_theme_options', array(
        'menu_title'         => 'Forcast Options',
        'menu_slug'          => 'empath-theme-option',
        'menu_type'          => 'menu',
        'enqueue_webfont'    => true,
        'show_in_customizer' => true,
        'menu_icon' => 'dashicons-category',
        'menu_position' => 50,
        'theme'                   => 'light',
        'framework_title'    => wp_kses_post( 'Forcast Options' ),
        'footer_text'    => wp_kses_post( 'The Theme will Created By byteflows ' ),
    ) );

    // Create a top-tab
    CSF::createSection( $prefix . '_theme_options', array(
        'id'    => 'header_opts', // Set a unique slug-like ID
        'title' => 'Header',
    ) );


    /*-------------------------------------------------------
     ** Logo Settings  Options
    --------------------------------------------------------*/

    /*-------------------------------------------------------
     ** Header  Options
    --------------------------------------------------------*/

    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => 'General Settings',
        'id'     => 'general_settings',
        'icon'   => 'fa fa-refresh',
        'fields' => array(

            array(
                'id'      => 'preloader_enable',
                'title'   => esc_html__( 'Enable Preloader', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Enable or Disable Preloader', 'empath-plugin' ),
                'default' => true,
            ),
            
            // default preloader bg color
            array(
                'id'      => 'empath_custom_preloader',
                'title'   => esc_html__( 'Upload Preloader', 'empath-plugin' ),
                'type'    => 'media',
                'dependency' => array( 'preloader_enable', '==', 'true' ),
            ),
            array(
                'id'      => 'preloader_bg',
                'title'   => esc_html__( 'Preloader BG Color', 'empath-plugin' ),
                'type'    => 'color',
                'output'  => array(
                    'background-color' => '#empathPreloader',
                ),
                'dependency' => array( 'preloader_enable', '==', 'true' ),
            ),
            
            array(
                'id'    => 'logo-1-width',
                'type'  => 'slider',
                'min'     => 0,
                'max'     => 5000,
                'step'    => 1,
                'unit'    => 'px',
                'title' => 'Preloader Size',
                'output'      => '#bytf__loader img',
                'output_mode' => 'max-width',
                'dependency' => array( 'preloader_enable', '==', 'true' ),
            ),
            array(
                'id'      => 'scroll_up_btn',
                'title'   => esc_html__( 'Enable Scroll Up', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Enable or Disable Scroll Up', 'empath-plugin' ),
                'default' => true,
            ),
            

        ),
    ) );

    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => esc_html__( 'Header', 'empath-plugin' ),
        'parent'     => 'header_opts',
        'icon'   => 'fa fa-header',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Header Layout', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'          => 'header_style',
                'type'        => 'select',
                'title'       => __('Select Header Style', 'empath-plugin' ),
                'options'     => Empath_Plugin_Helper::get_header_types(),
            ),
            array(
                'id'      => 'empath_logo',
                'title'   => esc_html__( 'Default Logo', 'empath-plugin' ),
                'type'    => 'media',
                'desc'    => esc_html__( 'Upload Logo', 'empath-plugin' ),
                'default' => true,
            ),
           

        ),
    ) );



   


    /*-------------------------------------
     ** Typography Options
    -------------------------------------*/
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => esc_html__( 'Typography', 'empath-plugin' ),
        'id'     => 'typography_options',
        'icon'   => 'fa fa-font',
        'fields' => array(

            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Body', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'     => 'body-typography',
                'type'   => 'typography',
                'output' => 'body',

            ),

            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Heading', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'     => 'heading-gl-typo',
                'type'   => 'typography',
                'output' => 'h1, h2, h3, h4, h5, h6, .main-header-six .byteflows_menu .byteflows_menu-nav li .sub-menu>li>a, .style__two .quick__tags-item a, blockquote p, .style__two .quick__tags-wrapper h5',
            ),

        ),
    ) );


    // blog optoins
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => esc_html__( 'Blog', 'empath-plugin' ),
        'id'     => 'blog_page',
        'icon'   => 'fa fa-rss-square',
        'fields' => array(

            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Blog Options', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'      => 'breadcrumb_bg_img',
                'type'    => 'media',
                'title'   => esc_html__('Breadcrumb BG', 'printox-tools'),
            ),

            array(
                'id'      => 'blog_btn_text',
                'type'    => 'text',
                'title'   => esc_html__( 'Blog Read More Button', 'empath-plugin' ),
                'default' => esc_html__( 'Explore More', 'empath-plugin' ),
                'desc'    => esc_html__( 'Type Blog Read More Button Text Here', 'empath-plugin' ),
            ),
        ),
    ) );

    // blog single optoins
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => esc_html__( 'Single', 'empath-plugin' ),
        'id'     => 'single_page',
        'icon'   => 'fa fa-pencil-square-o',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Single Post Layout', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'      => 'post_single_global_layout',
                'type'    => 'select',
                'title'   => esc_html__( 'Select Single Post Global Style', 'empath-plugin' ),
                'options'     => array(
                    'single-one'      => 'Style One',
                    'single-two'      => 'Style Two',
                    'single-three'    => 'Style Three',
                    'single-four'    => 'Style Four',
                    'single-five'    => 'Style Five',
                    'single-Six'    => 'Style Six',
                  ),
                'default' => 'single-one',
            ),
            
            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Single Post Option', 'empath-plugin' ) . '</h3>',
            ),
            array(
                'id'      => 'prev_title',
                'type'    => 'text',
                'title'   => esc_html__( 'Previous Article Text', 'empath-plugin' ),
                'default' => esc_html__( 'Previous Article', 'empath-plugin' ),
            ),
            array(
                'id'      => 'next_title',
                'type'    => 'text',
                'title'   => esc_html__( 'Next Article Text', 'empath-plugin' ),
                'default' => esc_html__( 'Next Article', 'empath-plugin' ),
            ),
            array(
                'id'      => 'related_title',
                'type'    => 'text',
                'title'   => esc_html__( 'Related Post Title', 'empath-plugin' ),
                'default' => esc_html__( 'You may also like', 'empath-plugin' ),
            ),
            array(
                'id'          => 'page-spacing-single',
                'type'        => 'spacing',
                'title'       => 'Single Blog Spacing',
                'output'      => '.bytf__single-post-wrapper',
                'output_mode' => 'padding', // or margin, relative
            ),

            array(
                'id'      => 'authore_show',
                'title'   => esc_html__( 'Show Authore', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Display Post Authore', 'empath-plugin' ),
                'default' => true,
            ),

            array(
                'id'      => 'bookmark_show',
                'title'   => esc_html__( 'Show Bookmark', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Display Post Bookmark', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'blog_nav',
                'title'   => esc_html__( 'Show Navigation', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Post Navigation', 'empath-plugin' ),
                'default' => true,
            ),

            array(
                'id'      => 'blog_tags',
                'title'   => esc_html__( 'Show Tags', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Show Post Tags', 'empath-plugin' ),
                'default' => true,
            ),

            array(
                'id'      => 'blog_share',
                'title'   => esc_html__( 'Show Share Option', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Show Post Share Icon', 'empath-plugin' ),
                'default' => true,
            ),

            array(
                'id'      => 'view_count_disable',
                'title'   => esc_html__( 'Post View Count Disable', 'empath-tools' ),
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'id'      => 'post_comment_disable',
                'title'   => esc_html__( 'Post Comment Disable', 'empath-tools' ),
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'id'      => 'post_date_disable',
                'title'   => esc_html__( 'Post Date Disable', 'empath-tools' ),
                'type'    => 'switcher',
                'default' => true,
            ),

            array(
                'id'      => 'authore_info_show',
                'title'   => esc_html__( 'Authore Info', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Display Post Authore Info In single post bottom', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'single_post_comment_disable',
                'title'   => esc_html__( 'Single Post Comment Disable', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'Disable or enable Single Post Comment', 'empath-plugin' ),
                'default' => true,
            ),
            
            array( //nav bar one start
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Social Share Options', 'empath-plugin') . '</h3>'
            ) ,
            
            array(
                'id'      => 'facebook_enable',
                'title'   => esc_html__( 'ON/OFF Facebook', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'You Can Turn ON or OFF Your Facebook Share', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'twitter_enable',
                'title'   => esc_html__( 'ON/OFF Twitter', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'You Can Turn ON or OFF Your Twitter Share', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'linkedin_enable',
                'title'   => esc_html__( 'ON/OFF Linkedin', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'You Can Turn ON or OFF Your Linkedin Share', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'pinterest_enable',
                'title'   => esc_html__( 'ON/OFF Pinterest', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'You Can Turn ON or OFF Your Pinterest Share', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'whatsapp_enable',
                'title'   => esc_html__( 'ON/OFF Whatsapp', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'You Can Turn ON or OFF Your Whatsapp Share', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'email_enable',
                'title'   => esc_html__( 'ON/OFF Email', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'You Can Turn ON or OFF Your Email Share', 'empath-plugin' ),
                'default' => true,
            ),
            array(
                'id'      => 'print_enable',
                'title'   => esc_html__( 'ON/OFF Print', 'empath-plugin' ),
                'type'    => 'switcher',
                'desc'    => esc_html__( 'You Can Turn ON or OFF Your Print Share', 'empath-plugin' ),
                'default' => true,
            ),

        ),
    ) );


    // blog optoins
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => esc_html__( 'Bookmark', 'empath-plugin' ),
        'id'     => 'bookmark_page',
        'icon'   => 'fa fa-bookmark',
        'fields' => array(

            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Bookmark Options', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'      => 'post_count_bk',
                'type'    => 'text',
                'title'   => esc_html__( 'Bookmark Post Count', 'empath-plugin' ),
                'default' => esc_html__( '9', 'empath-plugin' ),
                'desc'    => esc_html__( 'How many Post you want to disply on Bookmark Page', 'empath-plugin' ),
            ),
            array(
                'id'          => 'bk-order',
                'type'        => 'select',
                'title'       => 'Bookmark Post Order',
                'placeholder' => 'Bookmark Post Order',
                'options'     => array(
                  'ASC'  => esc_html__( 'Ascending', 'empath-plugin' ),
                  'DESC' => esc_html__( 'Descending', 'empath-plugin' ),
                ),
                'default'     => 'DESC'
              ),
        ),
    ) );


   // empath Color Setting
   CSF::createSection( $prefix . '_theme_options', array(
    'title'  => 'Color Control',
    'id'     => 'apix_color_control',
    'icon'   => 'fa fa-paint-brush',
    'fields' => array(


        array(  //nav bar one start
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Theme Primary Color', 'empath-plugin' ) . '</h3>',
        ),
        array(
            'id'    => 'theme-color-1',
            'type'  => 'color',
            'title' => 'Theme Primary Color',
            'default' => '#FF184E'
        ),
        

    ),
) );

    // Create a section
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => 'empath Social Icon',
        'id'     => 'empath_social_icons',
        'icon'   => 'fa fa-share-square-o',
        'fields' => array(


            array(  //nav bar one start
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( 'Social Icon Options', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'        => 'empath-social-global',
                'type'      => 'repeater',
                'title'     => 'empath Global Social',
                'subtitle'      => 'Add Social Icon And Icon Link Here',
                'fields'    => array(

                  array(
                    'id'    => 'social_icon',
                    'type'  => 'icon',
                    'title' => 'Choose Social Icon Here',
                  ),
                  array(
                    'id'    => 'social_title',
                    'type'  => 'text',
                    'title' => 'Social Title Here',
                  ),
                  array(
                    'id'    => 'social_follow_title',
                    'type'  => 'text',
                    'title' => 'Social Flow Title Here',
                  ),
                  array(
                    'id'    => 'social_link',
                    'type'  => 'text',
                    'title' => 'Social Profile Link Here',
                  ),

                ),
                'default'   => array(
                  array(
                    'social_icon' => 'fab fa-facebook-f',
                    'social_link' => '#',
                  ),
                  array(
                    'social_icon' => 'fab fa-twitter',
                    'social_link' => '#',
                  ),
                  array(
                    'social_icon' => 'fab fa-instagram',
                    'social_link' => '#',
                  ),
                  array(
                    'social_icon' => 'fab fa-youtube',
                    'social_link' => '#',
                  ),
                  array(
                    'social_icon' => 'fab fa-pinterest',
                    'social_link' => '#',
                  ),
                ),
            ),

        ),
    ) );


    // Create a section
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => 'Meta Description',
        'id'     => 'error_page',
        'icon'   => 'fa fa-exclamation-triangle',
        'fields' => array(

            array(
                'id'      => 'meta_desc',
                'type'    => 'textarea',
                'default'    => 'WordPress News Magazine Theme',
                'title'   => esc_html__( 'Meta Description', 'empath-plugin' ),
            ),


        ),
    ) );
    // Create a section
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => 'Error Page',
        'id'     => 'error_page',
        'icon'   => 'fa fa-exclamation-triangle',
        'fields' => array(


            array(  //nav bar one start
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__( '404 Page Options', 'empath-plugin' ) . '</h3>',
            ),

            array(
                'id'      => 'error_code',
                'type'    => 'media',
                'title'   => esc_html__( 'Error Code Image', 'empath-plugin' ),
            ),
            array(
                'id'      => 'error_title',
                'type'    => 'text',
                'title'   => esc_html__( '404 Title', 'empath-plugin' ),
                'default' => esc_html__( 'Oops! Page Not found.', 'empath-plugin' ),
            ),
            array(
                'id'      => 'error_text',
                'type'    => 'textarea',
                'title'   => esc_html__( '404 Text', 'empath-plugin' ),
                'default' => esc_html__( 'You’re either misspelling the URL or requesting a page thats no longer here.', 'empath-plugin' ),
            ),

            array(
                'id'      => 'error_button',
                'type'    => 'text',
                'title'   => esc_html__( '404 Button', 'empath-plugin' ),
                'default' => esc_html__( 'back to Home page ', 'empath-plugin' ),
            ),
            array(
                'id'      => 'br_custom_bg',
                'type'    => 'media',
                'title'   => esc_html__( '404 Breadcrumb BG Image', 'empath-plugin' ),
            ),
            array(
                'id'      => 'er_custom_title',
                'type'    => 'text',
                'title'   => esc_html__( '404 Breadcrumb Title', 'empath-plugin' ),
            ),


        ),
    ) );

    /*-------------------------------------------------------
     ** Footer  Options
    --------------------------------------------------------*/

    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => esc_html__( 'Footer Options', 'empath-plugin' ),
        'icon'   => 'fa fa-copyright',
        'fields' => array(

            array(
                'id'          => 'footer_style',
                'type'        => 'select',
                'title'       => __('Select Footer Style', 'empath-plugin' ),
                'options'     => Empath_Plugin_Helper::get_footer_types(),
            ),

        ),
    ) );

    // Backup section
    CSF::createSection( $prefix . '_theme_options', array(
        'title'  => esc_html__( 'Backup Export', 'empath-plugin' ),
        'id'     => 'backup_options',
        'icon'   => 'fa fa-window-restore',
        'fields' => array(
            array(
                'type' => 'backup',
            ),
        ),
    ) );




}