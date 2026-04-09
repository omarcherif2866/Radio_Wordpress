<?php

/**
 * [Empath_Admin description]
 */
if(!class_exists( 'Empath_Admin' )){
    class Empath_Admin{

        private static $instance = null;

        public static function init() {
            if( is_null( self::$instance ) ) {
              self::$instance = new self();
            }
            return self::$instance;
          }
        public function __construct(){
            add_action( 'init', [$this, 'empath_tgm_dashboard'], 1);
            add_action( 'admin_menu', [$this, 'empath_admin_dashboard'], 1);
            add_action( 'admin_menu', [$this, 'empath_template_dashboard'], 20);
            add_action( 'admin_menu', [$this, 'empath_megamenu_dashboard'], 21);
            add_action( 'ocdi/plugin_page_setup', [$this, 'empath_import_dsb'], 20);
            add_action( 'admin_enqueue_scripts', array( $this, 'empath_admin_enqueue_scripts' ) );
        }
    
    
        public function empath_admin_dashboard(){
            add_menu_page(
                esc_html__('Forcast', 'forcast'), 
                esc_html__('Forcast', 'forcast'), 
                'manage_options', 
                'forcast', 
                [$this, 'display_empath_admin_dashboard'], 
                get_template_directory_uri() . '/inc/admin/assets/img/dashboard.png', 
                2
            );

            
        }

        /**
         * Header & Footer Elementor Template
         *
         * @return  [type]  [return description]
         */
        public function empath_template_dashboard(){
            if (post_type_exists('empath_template')) {
                add_submenu_page(
                    'forcast',
                    esc_html__('Templates', 'forcast'),
                    esc_html__('Templates', 'forcast'),
                    'manage_options',
                    'edit.php?post_type=empath_template',
                    false
                );
            }

        }

        /**
         * Megamenu Elementor Template
         *
         * @return  [type]  [return description]
         */
        public function empath_megamenu_dashboard(){
            if (post_type_exists('th-mega-menu')) {
                add_submenu_page(
                    'forcast',
                    esc_html__( 'Mega Menu', 'forcast' ),
                    esc_html__( 'Mega Menu', 'forcast' ),
                    'manage_options',
                    'edit.php?post_type=th-mega-menu',
                    false
                );
            }
            
        }

        /**
         * Admin Core Page
         */

        public function display_empath_admin_dashboard(){
            require_once QUBAR_INC_DRI . 'admin/admin-page.php';
        }

        /**
         * TGM Activation
         *
         * @return  [type]  [return description]
         */
        public function empath_tgm_dashboard(){
            require_once QUBAR_INC_DRI . 'admin/class-tgm-plugin-activation.php';
            require_once QUBAR_INC_DRI . 'admin/plugin-activation.php';
        }

        /**
         * OCDI Functions
         *
         * @param   [type]  $default  [$default description]
         *
         * @return  [type]            [return description]
         */
        public function empath_import_dsb($default){
            $default['parent_slug'] = 'forcast';
            $default['page_title']  = esc_html__( 'One Click Demo Import' , 'forcast' );
            $default['menu_title']  = esc_html__( 'Import Demo Data' , 'forcast' );
            $default['capability']  = 'import';
            $default['menu_slug']   = 'one-click-demo-import';
            
            return $default;
        }

        /**
         * Admin Style
         *
         * @return  [type]  [return description]
         */
        public function empath_admin_enqueue_scripts() {
            wp_enqueue_style( 'empath-admin', get_theme_file_uri( 'inc/admin/assets/css/admin.css' ), array(), null, 'all' );
        }
    }
    Empath_Admin::init();
}
