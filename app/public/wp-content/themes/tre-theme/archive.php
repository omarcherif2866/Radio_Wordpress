<?php get_header(); ?>

<div class="tre-wrapper">
<main class="tre-main">

<!-- En-tête archive -->
<div class="archive-header">
    <?php the_archive_title( '<h1>', '</h1>' ); ?>
    <?php the_archive_description( '<p>', '</p>' ); ?>
</div>

<?php if ( have_posts() ) : ?>

<!-- Grille articles de la catégorie -->
<div class="tre-grid-3">
<?php
while ( have_posts() ) :
    the_post();
?>
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
<?php endwhile; ?>
</div>

<?php tre_pagination(); ?>

<?php else : ?>
    <p style="font-size:15px;color:#999;padding:32px 0;">
        <?php _e( 'Aucun article trouvé dans cette catégorie.', 'tre-radio' ); ?>
    </p>
<?php endif; ?>

</main>

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
