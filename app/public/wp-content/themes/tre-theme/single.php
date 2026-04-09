<?php get_header(); ?>

<div class="single-wrapper">
<main class="single-main">

<?php
while ( have_posts() ) :
    the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
    <img
        src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'tre-hero' ) ); ?>"
        alt="<?php the_title_attribute(); ?>"
        class="single-featured"
        loading="eager"
    >
    <?php endif; ?>

    <div class="single-body">

        <?php tre_category_tag(); ?>

        <h1><?php the_title(); ?></h1>

        <div class="single-meta">
            <span>📅 <?php echo get_the_date( 'd F Y' ); ?></span>
            <span>·</span>
            <span>✍️ <?php the_author(); ?></span>
            <span>·</span>
            <?php tre_reading_time(); ?>
        </div>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <?php
        // Navigation article précédent / suivant
        the_post_navigation( [
            'prev_text' => '← %title',
            'next_text' => '%title →',
        ] );
        ?>

        <?php comments_template(); ?>

    </div>
</article>

<?php endwhile; ?>

</main>

<?php get_sidebar(); ?>
</div><!-- /.single-wrapper -->

<?php get_footer(); ?>
