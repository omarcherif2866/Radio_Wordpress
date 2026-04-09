<?php get_header(); ?>

<div class="single-wrapper">
<main class="single-main">

<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
    <img
        src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'tre-hero' ) ); ?>"
        alt="<?php the_title_attribute(); ?>"
        class="single-featured"
    >
    <?php endif; ?>
    <div class="single-body">
        <h1 style="font-family:'Playfair Display',serif;font-size:32px;margin-bottom:24px;"><?php the_title(); ?></h1>
        <div class="entry-content"><?php the_content(); ?></div>
    </div>
</article>
<?php endwhile; ?>

</main>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
