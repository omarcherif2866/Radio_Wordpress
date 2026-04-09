<?php get_header(); ?>
<div class="tre-wrapper">
<main class="tre-main" style="text-align:center;padding:80px 20px;">
    <div style="font-size:80px;margin-bottom:16px;">🌍</div>
    <h1 style="font-family:'Playfair Display',serif;font-size:48px;color:var(--rouge);margin-bottom:12px;">404</h1>
    <p style="font-size:18px;color:#666;margin-bottom:28px;">
        <?php _e( 'Cette page est introuvable. Elle a peut-être été déplacée ou supprimée.', 'tre-radio' ); ?>
    </p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
       style="display:inline-block;background:var(--rouge);color:#fff;padding:12px 28px;border-radius:6px;font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px;letter-spacing:1px;text-transform:uppercase;text-decoration:none;">
        ← <?php _e( 'Retour à l\'accueil', 'tre-radio' ); ?>
    </a>
</main>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
