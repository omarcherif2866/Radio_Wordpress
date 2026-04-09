<?php get_header(); ?>

<div class="tre-wrapper">
<main class="tre-main">

<?php
/* ═══════════════════════════════════════
   GRANDE UNE — article épinglé ou dernier
═══════════════════════════════════════ */
$hero_query = new WP_Query( [
    'posts_per_page' => 1,
    'post__in'       => get_option( 'sticky_posts' ) ?: [],
    'ignore_sticky_posts' => 0,
] );

// Si pas d'article épinglé, prend le dernier publié
if ( ! $hero_query->have_posts() ) {
    $hero_query = new WP_Query( [ 'posts_per_page' => 1 ] );
}

if ( $hero_query->have_posts() ) :
    $hero_query->the_post();
?>

<div class="section-label">
    <h2><?php _e( 'À la une', 'tre-radio' ); ?></h2>
    <span class="badge">TRE</span>
</div>

<article class="tre-hero">
    <div class="tre-hero__image">
        <?php tre_post_thumbnail( 'tre-hero' ); ?>
    </div>
    <div class="tre-hero__body">
        <?php tre_category_tag(); ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="tre-hero__excerpt"><?php the_excerpt(); ?></p>
        <div class="tre-hero__meta">
            <span class="date">📅 <?php echo get_the_date( 'd F Y' ); ?></span>
            <span>·</span>
            <?php tre_reading_time(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="read-more">
            <?php _e( 'Lire l\'article', 'tre-radio' ); ?>
        </a>
    </div>
</article>

<?php
    wp_reset_postdata();
endif;

/* ═══════════════════════════════════════
   GRILLE 3 — Derniers articles (hors UNE)
═══════════════════════════════════════ */
$exclude_id = get_option( 'sticky_posts' ) ?: [];

$grid_query = new WP_Query( [
    'posts_per_page'      => 3,
    'post__not_in'        => $exclude_id,
    'ignore_sticky_posts' => 1,
] );

if ( $grid_query->have_posts() ) :
?>
<div class="section-label">
    <h2><?php _e( 'Derniers articles', 'tre-radio' ); ?></h2>
</div>
<div class="tre-grid-3">
    <?php while ( $grid_query->have_posts() ) : $grid_query->the_post(); ?>
    <article class="article-card">
        <div class="card-image">
            <?php tre_post_thumbnail( 'tre-card' ); ?>
            <?php
            $cats = get_the_category();
            if ( $cats ) {
                printf(
                    '<a href="%s" class="card-tag">%s</a>',
                    esc_url( get_category_link( $cats[0]->term_id ) ),
                    esc_html( $cats[0]->name )
                );
            }
            ?>
        </div>
        <div class="card-body">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="card-excerpt"><?php the_excerpt(); ?></p>
            <div class="card-meta">
                <span class="date">📅 <?php echo get_the_date( 'd M Y' ); ?></span>
                <?php tre_reading_time(); ?>
            </div>
        </div>
    </article>
    <?php endwhile; wp_reset_postdata(); ?>
</div>
<?php endif; ?>

<?php
/* ═══════════════════════════════════════
   CATÉGORIES À LA UNE (par categorie)
   Affiche 1 section de 2 articles par catégorie
   Pour les 3 premières catégories
═══════════════════════════════════════ */
$featured_cats = get_categories( [
    'number'     => 3,
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
] );

foreach ( $featured_cats as $fcat ) :
    $cat_query = new WP_Query( [
        'cat'            => $fcat->term_id,
        'posts_per_page' => 2,
        'ignore_sticky_posts' => 1,
    ] );
    if ( ! $cat_query->have_posts() ) continue;
?>

<div class="section-label">
    <h2><?php echo esc_html( $fcat->name ); ?></h2>
    <a href="<?php echo esc_url( get_category_link( $fcat->term_id ) ); ?>"
       style="font-size:12px;color:var(--rouge);font-weight:600;flex-shrink:0;white-space:nowrap;">
        <?php _e( 'Voir tout', 'tre-radio' ); ?> →
    </a>
</div>

<div class="tre-grid-2">
    <?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
    <article class="article-horiz">
        <div class="horiz-image">
            <?php tre_post_thumbnail( 'tre-horiz' ); ?>
        </div>
        <div class="horiz-body">
            <?php tre_category_tag(); ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="card-excerpt"><?php the_excerpt(); ?></p>
            <div class="horiz-meta">
                <span>📅 <?php echo get_the_date( 'd M Y' ); ?></span>
                <span>·</span>
                <?php tre_reading_time(); ?>
            </div>
        </div>
    </article>
    <?php endwhile; wp_reset_postdata(); ?>
</div>

<?php endforeach; ?>

<!-- Pagination -->
<?php tre_pagination(); ?>

</main>

<?php get_sidebar(); ?>
</div><!-- /.tre-wrapper -->

<?php get_footer(); ?>
