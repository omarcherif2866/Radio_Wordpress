<?php
/**
 * TRE Radio — functions.php
 * Fonctions principales du thème
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TRE_VERSION', '1.0.0' );
define( 'TRE_DIR', get_template_directory() );
define( 'TRE_URI', get_template_directory_uri() );

/* ─────────────────────────────────────
   1. SUPPORT DU THÈME
───────────────────────────────────── */
function tre_theme_setup() {
    // Traductions
    load_theme_textdomain( 'tre-radio', TRE_DIR . '/languages' );

    // Titre dans <head>
    add_theme_support( 'title-tag' );

    // Images mises en avant
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'tre-hero',    900, 480, true );
    add_image_size( 'tre-card',    600, 360, true );
    add_image_size( 'tre-horiz',   260, 200, true );
    add_image_size( 'tre-sidebar', 150, 120, true );

    // HTML5
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );

    // Fil Atom / RSS
    add_theme_support( 'automatic-feed-links' );

    // Logo personnalisé
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // Menus
    register_nav_menus( [
        'primary'  => __( 'Menu Principal (Onglets)', 'tre-radio' ),
        'topbar'   => __( 'Barre Supérieure', 'tre-radio' ),
        'footer'   => __( 'Menu Footer', 'tre-radio' ),
    ] );
}
add_action( 'after_setup_theme', 'tre_theme_setup' );

/* ─────────────────────────────────────
   2. SCRIPTS & STYLES
───────────────────────────────────── */
function tre_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'tre-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Barlow:wght@300;400;500;600;700&family=Barlow+Condensed:wght@600;700;800&display=swap',
        [],
        null
    );

    // Thème principal
    wp_enqueue_style( 'tre-style', get_stylesheet_uri(), [ 'tre-fonts' ], TRE_VERSION );

    // JS principal
    wp_enqueue_script( 'tre-main', TRE_URI . '/assets/js/main.js', [], TRE_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'tre_enqueue_assets' );

/* ─────────────────────────────────────
   3. ZONES DE WIDGETS
───────────────────────────────────── */
function tre_register_sidebars() {
    $args_base = [
        'before_widget' => '<div class="sidebar-widget" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-header"><strong>',
        'after_title'   => '</strong></div><div class="widget-body">',
    ];

    register_sidebar( array_merge( $args_base, [
        'name'          => __( 'Sidebar Principale', 'tre-radio' ),
        'id'            => 'sidebar-main',
        'description'   => __( 'Sidebar droite — pages et homepage', 'tre-radio' ),
        'after_widget'  => '</div></div>',
    ] ) );

    register_sidebar( array_merge( $args_base, [
        'name'          => __( 'Bannière Pub (728×90)', 'tre-radio' ),
        'id'            => 'banner-pub',
        'description'   => __( 'Zone sous la navigation, pour une pub 728×90', 'tre-radio' ),
        'after_widget'  => '</div></div>',
    ] ) );

    register_sidebar( array_merge( $args_base, [
        'name'          => __( 'Sidebar Pub (300×250)', 'tre-radio' ),
        'id'            => 'sidebar-pub',
        'description'   => __( 'Zone pub sidebar droite 300×250', 'tre-radio' ),
        'after_widget'  => '</div></div>',
    ] ) );

    register_sidebar( array_merge( $args_base, [
        'name'          => __( 'Footer Col 1 – À propos', 'tre-radio' ),
        'id'            => 'footer-1',
        'description'   => __( 'Première colonne du footer', 'tre-radio' ),
        'after_widget'  => '</div></div>',
    ] ) );
    register_sidebar( array_merge( $args_base, [
        'name'          => __( 'Footer Col 2 – Légal', 'tre-radio' ),
        'id'            => 'footer-2',
        'after_widget'  => '</div></div>',
    ] ) );
    register_sidebar( array_merge( $args_base, [
        'name'          => __( 'Footer Col 3 – Réseaux', 'tre-radio' ),
        'id'            => 'footer-3',
        'after_widget'  => '</div></div>',
    ] ) );
}
add_action( 'widgets_init', 'tre_register_sidebars' );

/* ─────────────────────────────────────
   4. HELPER : IMAGE DE FALLBACK
───────────────────────────────────── */
function tre_post_thumbnail( $size = 'tre-card', $class = '' ) {
    if ( has_post_thumbnail() ) {
        the_post_thumbnail( $size, [ 'class' => $class, 'loading' => 'lazy' ] );
    } else {
        echo '<div class="img-placeholder" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#b01020,#ff5a6a);font-size:40px;">🌍</div>';
    }
}

/* ─────────────────────────────────────
   5. HELPER : TAG RUBRIQUE (1re catégorie)
───────────────────────────────────── */
function tre_category_tag( $classes = '' ) {
    $cats = get_the_category();
    if ( ! empty( $cats ) ) {
        $cat = $cats[0];
        printf(
            '<a href="%s" class="rubrique-tag %s">%s</a>',
            esc_url( get_category_link( $cat->term_id ) ),
            esc_attr( $classes ),
            esc_html( $cat->name )
        );
    }
}

/* ─────────────────────────────────────
   6. HELPER : TEMPS DE LECTURE
───────────────────────────────────── */
function tre_reading_time() {
    $content    = get_the_content();
    $word_count = str_word_count( strip_tags( $content ) );
    $minutes    = max( 1, (int) ceil( $word_count / 200 ) );
    printf( '<span class="reading-time">%d min</span>', $minutes );
}

/* ─────────────────────────────────────
   7. EXCERPT PERSONNALISÉ
───────────────────────────────────── */
function tre_excerpt_length( $length ) { return 25; }
add_filter( 'excerpt_length', 'tre_excerpt_length' );

function tre_excerpt_more( $more ) { return '…'; }
add_filter( 'excerpt_more', 'tre_excerpt_more' );

/* ─────────────────────────────────────
   8. WALKER MENU : ajoute icône depuis description de menu
───────────────────────────────────── */
class TRE_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $atts            = [];
        $atts['href']    = ! empty( $item->url )    ? $item->url    : '#';
        $atts['title']   = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target']  = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']     = ! empty( $item->xfn )    ? $item->xfn    : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( $value ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $item_output = isset( $args->before ) ? $args->before : '';

        // Icône depuis la description de l'item de menu (emoji dans la description WP)
        $icon = '';
        if ( ! empty( $item->description ) && $depth === 0 ) {
            $icon = '<span class="nav-icon">' . esc_html( $item->description ) . '</span> ';
        }

        // Flèche pour les parents de niveau 0
        $arrow = '';
        if ( $depth === 0 && in_array( 'menu-item-has-children', $classes ) ) {
            $arrow = ' <span class="tab-arrow">▾</span>';
        }

        $item_output .= '<a' . $attributes . '>';
        $item_output .= $icon;
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $arrow;
        $item_output .= '</a>';

        $item_output .= isset( $args->after ) ? $args->after : '';
        $output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/* ─────────────────────────────────────
   9. PAGINATION
───────────────────────────────────── */
function tre_pagination() {
    $pages = paginate_links( [
        'type'      => 'array',
        'prev_text' => '‹',
        'next_text' => '›',
    ] );
    if ( $pages ) {
        echo '<div class="tre-pagination">';
        foreach ( $pages as $page ) echo $page;
        echo '</div>';
    }
}
