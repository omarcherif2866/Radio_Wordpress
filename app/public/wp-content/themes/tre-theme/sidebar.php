<aside class="tre-sidebar">

    <!-- Widget Catégories / Rubriques -->
    <div class="sidebar-widget">
        <div class="widget-header">
            <span>🗂️</span>
            <strong><?php _e( 'Rubriques', 'tre-radio' ); ?></strong>
        </div>
        <div class="widget-body">
            <?php
            $cats = get_categories( [ 'orderby' => 'count', 'order' => 'DESC', 'number' => 10 ] );
            if ( $cats ) :
            ?>
            <ul class="widget-cats">
                <?php foreach ( $cats as $cat ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                        <span><?php echo esc_html( $cat->name ); ?></span>
                        <span class="cat-count"><?php echo esc_html( $cat->count ); ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
                <p style="font-size:13px;color:#999;">Aucune catégorie trouvée.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Widget Articles Populaires -->
    <div class="sidebar-widget">
        <div class="widget-header">
            <span>🔥</span>
            <strong><?php _e( 'Les plus lus', 'tre-radio' ); ?></strong>
        </div>
        <div class="widget-body">
            <?php
            $popular = new WP_Query( [
                'posts_per_page' => 4,
                'orderby'        => 'comment_count',
                'order'          => 'DESC',
                'post_status'    => 'publish',
            ] );
            if ( $popular->have_posts() ) :
                $i = 1;
            ?>
            <ul class="pop-list">
                <?php while ( $popular->have_posts() ) : $popular->the_post(); ?>
                <li class="pop-item">
                    <span class="pop-num"><?php echo $i; ?></span>
                    <div class="pop-content">
                        <?php tre_category_tag( 'pop-tag' ); ?>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <span class="pop-date">📅 <?php echo get_the_date( 'd M Y' ); ?></span>
                    </div>
                </li>
                <?php $i++; endwhile; wp_reset_postdata(); ?>
            </ul>
            <?php else : ?>
                <p style="font-size:13px;color:#999;">Aucun article pour l'instant.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Widget Newsletter -->
    <div class="sidebar-widget">
        <div class="widget-header">
            <span>📩</span>
            <strong><?php _e( 'Newsletter TRE', 'tre-radio' ); ?></strong>
        </div>
        <div class="widget-body newsletter-widget">
            <p>Recevez chaque semaine les meilleurs articles et actus pour les Tunisiens à l'étranger.</p>
            <?php if ( shortcode_exists( 'mailchimp' ) ) : ?>
                <?php echo do_shortcode( '[mailchimp]' ); ?>
            <?php else : ?>
            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="tre_newsletter_signup">
                <?php wp_nonce_field( 'tre_newsletter', 'tre_nl_nonce' ); ?>
                <input type="email" name="email" placeholder="votre@email.com" required>
                <button type="submit" class="submit-btn">
                    <?php _e( "S'abonner gratuitement", 'tre-radio' ); ?>
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Zone pub sidebar 300×250 -->
    <?php if ( is_active_sidebar( 'sidebar-pub' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-pub' ); ?>
    <?php else : ?>
    <div class="sidebar-pub">
        <span>Pub 300 × 250</span>
    </div>
    <?php endif; ?>

    <!-- Autres widgets sidebar (Apparence > Widgets) -->
    <?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-main' ); ?>
    <?php endif; ?>

</aside>
