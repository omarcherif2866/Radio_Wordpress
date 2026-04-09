<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ═══ TOP BAR ═══ -->
<div class="tre-top-bar">
    <div class="tre-top-bar__left">
        <?php
        wp_nav_menu( [
            'theme_location' => 'topbar',
            'menu_class'     => '',
            'container'      => false,
            'fallback_cb'    => function() {
                echo '<a href="#">Espace Membres</a>';
                echo '<span class="tre-top-bar__sep">·</span>';
                echo '<a href="#">Espace Partenaires</a>';
                echo '<span class="tre-top-bar__sep">·</span>';
                echo '<a href="#">Espace Investisseurs</a>';
            },
            'items_wrap'     => '%3$s',
            'walker'         => new Walker_Nav_Menu(),
        ] );
        ?>
    </div>
    <div class="tre-top-bar__right">
        <a href="<?php echo esc_url( wp_login_url() ); ?>">Connexion</a>
        <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="btn-topbar-signup">Inscription gratuite</a>
    </div>
</div>

<!-- ═══ HEADER ═══ -->
<header class="tre-header">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tre-logo">
        <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="tre-logo__badge">
                <span>TRE</span>
            </div>
            <div class="tre-logo__text">
                <strong><?php bloginfo( 'name' ); ?></strong>
                <small><?php bloginfo( 'description' ); ?></small>
            </div>
        <?php endif; ?>
    </a>

    <div class="tre-header__cta">
        <a href="<?php echo esc_url( wp_login_url() ); ?>" class="btn-login">Connexion</a>
        <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="btn-signup">S'inscrire</a>
    </div>
</header>

<!-- ═══ NAVIGATION ONGLETS ═══ -->
<div class="tre-nav-wrapper">
    <?php
    wp_nav_menu( [
        'theme_location'  => 'primary',
        'menu_id'         => 'primary-menu',
        'container'       => 'nav',
        'container_class' => 'tre-nav-inner',
        'walker'          => new TRE_Nav_Walker(),
        'fallback_cb'     => 'tre_fallback_nav',
    ] );
    ?>
</div>

<?php
/**
 * Menu de fallback si aucun menu n'est assigné
 */
function tre_fallback_nav() {
    $rubriques = [
        [ 'icon' => '💼', 'label' => 'Travail &amp; Carrière',     'url' => '#' ],
        [ 'icon' => '📈', 'label' => 'Business',                   'url' => '#' ],
        [ 'icon' => '🏦', 'label' => 'Finance',                    'url' => '#' ],
        [ 'icon' => '🏠', 'label' => 'Immobilier',                 'url' => '#' ],
        [ 'icon' => '📋', 'label' => 'Démarches',                  'url' => '#' ],
        [ 'icon' => '🎓', 'label' => 'Études',                     'url' => '#' ],
        [ 'icon' => '🏥', 'label' => 'Santé',                      'url' => '#' ],
        [ 'icon' => '✈️', 'label' => 'Retour TN',                  'url' => '#' ],
        [ 'icon' => '🚗', 'label' => 'Mobilité',                   'url' => '#' ],
        [ 'icon' => '🤝', 'label' => 'Communauté',                 'url' => '#' ],
        [ 'icon' => '⭐', 'label' => 'Services',                   'url' => '#' ],
    ];
    echo '<nav class="tre-nav-inner"><ul style="display:flex;list-style:none;">';
    foreach ( $rubriques as $r ) {
        printf(
            '<li class="menu-item"><a href="%s"><span class="nav-icon">%s</span> %s</a></li>',
            esc_url( $r['url'] ),
            $r['icon'],
            $r['label']
        );
    }
    echo '</ul></nav>';
}
?>

<!-- ═══ BANNIÈRE PUB ═══ -->
<div class="tre-banner-pub">
    <div class="tre-banner-pub__inner">
        <?php if ( is_active_sidebar( 'banner-pub' ) ) : ?>
            <?php dynamic_sidebar( 'banner-pub' ); ?>
        <?php else : ?>
            <div class="tre-banner-pub__placeholder">Espace Publicitaire — 728 × 90</div>
        <?php endif; ?>
    </div>
</div>
