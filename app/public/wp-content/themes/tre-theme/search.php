<?php get_header(); ?>

<div class="tre-wrapper">
<main class="tre-main">

<div class="archive-header">
    <h1>
        <?php
        printf(
            __( 'Résultats pour : "%s"', 'tre-radio' ),
            '<em>' . get_search_query() . '</em>'
        );
        ?>
    </h1>
    <p><?php printf( __( '%d article(s) trouvé(s)', 'tre-radio' ), $wp_query->found_posts ); ?></p>
</div>

<?php if ( have_posts() ) : ?>
<div class="tre-grid-3">
<?php while ( have_posts() ) : the_post(); ?>
    <article class="article-card">
        <div class="card-image">
            <?php tre_post_thumbnail( 'tre-card' ); ?>
            <?php
            $cats = get_the_category();
            if ( $cats ) {
                printf( '<a href="%s" class="card-tag">%s</a>',
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
                <span>📅 <?php echo get_the_date( 'd M Y' ); ?></span>
                <?php tre_reading_time(); ?>
            </div>
        </div>
    </article>
<?php endwhile; ?>
</div>
<?php tre_pagination(); ?>
<?php else : ?>
<p style="padding:40px 0;color:#999;font-size:15px;">Aucun résultat. Essayez d'autres mots-clés.</p>
<?php endif; ?>

</main>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
