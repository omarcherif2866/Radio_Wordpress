<!-- ═══ FOOTER ═══ -->
<footer class="tre-footer">
    <div class="tre-footer__grid">

        <!-- Brand -->
        <div class="tre-footer__brand">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tre-logo" style="text-decoration:none;">
                <div class="tre-logo__badge"><span>TRE</span></div>
                <div class="tre-logo__text">
                    <strong style="color:#fff;"><?php bloginfo( 'name' ); ?></strong>
                    <small style="color:rgba(255,255,255,.4);"><?php bloginfo( 'description' ); ?></small>
                </div>
            </a>
            <p>La plateforme de référence pour les Tunisiens résidant à l'étranger.<br>Information, démarches, investissement et communauté.</p>
        </div>

        <!-- Col 1 -->
        <div class="tre-footer__col">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php else : ?>
                <h4>À propos</h4>
                <ul>
                    <li><a href="#">Qui sommes-nous</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Devenir partenaire</a></li>
                    <li><a href="#">Publicité</a></li>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Col 2 -->
        <div class="tre-footer__col">
            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <?php dynamic_sidebar( 'footer-2' ); ?>
            <?php else : ?>
                <h4>Légal</h4>
                <ul>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">CGU</a></li>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Col 3 -->
        <div class="tre-footer__col">
            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <?php dynamic_sidebar( 'footer-3' ); ?>
            <?php else : ?>
                <h4>Suivez-nous</h4>
                <ul>
                    <li><a href="#">Newsletter</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">YouTube</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            <?php endif; ?>
        </div>

    </div>

    <div class="tre-footer__bottom">
        <span>© <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> — Tous droits réservés</span>
        <span>Thème WordPress TRE Radio</span>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
