<section class="empath__blog-wrapper internal__pading">
	<div class="container">
		<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>
            <div class="col-lg-3">
                <div class="bytf__post-grid-clm-item cat__style-two style__three">
                    <div class="bytf__feature-image">
                        <a aria-label="name" href="<?php the_permalink();?>">
                            <?php the_post_thumbnail( 'full' );?>
                        </a>
                    </div>
                    <div class="bytf__content">
                        <?php if(function_exists('empath_category_badge')){empath_category_badge();}?>
                        <h3 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <div class="bytf__postmeta-info-wrapper">
                            <div class="bytf__postmeta meta__dark">
                                <ul class="d-flex align-items-center">
                                    <li><i class="fal fa-calendar"></i> <?php echo esc_html(get_the_time( get_option('date_format')));?></li>
                                </ul>
                            </div>
                            <div class="bytf__bookmark bookmark__dark">
                                <?php if(function_exists('empath_bookmark_trigger')){empath_bookmark_trigger();}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php endwhile; ?> 
			<div class="empath-pagination">
                <?php
                empath_pagination( '
                <i class="fal fa-chevron-double-left"></i>',
                '<i class="fal fa-chevron-double-right"></i>',
                '',
                ['class' => ''] );
                ?>
            </div>
		</div>
	</div>
</section>