<?php

function bytf_preloader(){ 
    $preloader_enable = cs_get_option('preloader_enable');
    $empath_custom_preloader = cs_get_option('empath_custom_preloader');
    if ($preloader_enable == true) {    
?>
    <div id="bytf__loader">
        <img src="<?php if(!empty($empath_custom_preloader['url'])){ echo esc_url($empath_custom_preloader['url']);}?>" alt="">
    </div>
<?php 
    }
}

/**
 * Back To Top
 *
 * @return void
 */
function empath_back_to_top(){ ?>

    <div class="back-top-btn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 8.5L5 13L12 8L19 13V8.5L12 3.5L5 8.5Z" fill="white"/>
            <path d="M5 15.5L5 20L12 15L19 20V15.5L12 10.5L5 15.5Z" fill="white"/>
        </svg>
    </div>

 <?php
}

/**
 * Main Menu
 *
 * @return  [type]  [return description]
 */
function empath_main_menu(){
    if (has_nav_menu('menu-1')) {
        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'], wp_nav_menu( array(
            'echo'           => false,
            'theme_location' => 'menu-1',
            'menu_id'        =>'main-nav',
            'menu_class'        =>'nav navbar-nav clearfix',
            'container'=>false,
            'fallback_cb'    => 'Qubar_Bootstrap_Navwalker::fallback',
            'walker' => class_exists( 'Rs_Mega_Menu_Walker' ) ? new Rs_Mega_Menu_Walker : '',
        )) );
    } else {
       echo '';
    }

}


/**
 * [empath Mobile]
 *
 * @return  [type]  [return description]
 */
function empath_mobile_menu(){
    $socials = cs_get_option('header-socials');
    $enable_mobile_search = cs_get_option('enable_mobile_search');
?>
    <div class="mobile_menu position-relative">
        <div class="mobile_menu_button open_mobile_menu">
            <i class="fal fa-bars"></i>
        </div>
        <div class="mobile_menu_wrap">
            <div class="mobile_menu_overlay open_mobile_menu"></div>
            <div class="mobile_menu_content">
                <div class="mobile_menu_close open_mobile_menu">
                    <i class="fal fa-times"></i>
                </div>
                <div class="m-brand-logo">
                    <?php empath_default_logo();?>
                </div>
                <?php if($enable_mobile_search == true):?>
                <div class="mobile-search-bar position-relative">
                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" name="s" placeholder="<?php esc_attr_e( 'Search Here', 'forcast' );?>" value="<?php the_search_query();?>">
                        <button><i class="fal fa-search"></i></button>
                    </form>
                </div>
                <?php endif;?>
                <nav class="mobile-main-navigation  clearfix ul-li">
                    <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'], wp_nav_menu( array(
                            'echo'           => false,
                            'theme_location' => 'menu-1',
                            'menu_id'        =>'m-main-nav',
                            'menu_class'        =>'navbar-nav text-capitalize clearfix',
                            'container'=>false,
                            'fallback_cb'    => 'Qubar_Bootstrap_Navwalker::fallback',
                            'walker' => class_exists( 'Rs_Mega_Menu_Walker' ) ? new Rs_Mega_Menu_Walker : '',
                        )) );
                    ?>
                </nav>
                <?php if(!empty($socials)):?>
                <div class="bi-mobile-header-social text-center">
                    <?php foreach($socials as $item):?>
						<a aria-label="name" href="<?php echo esc_url($item['social_link']);?>"> <i class="<?php echo esc_attr($item['social_icon']);?>"></i></a>
					<?php endforeach;?>
                </div>
                <?php endif;?>
            </div>
        </div>
        <!-- /Mobile-Menu -->
    </div>
<?php
}


/**
 * empath Post Loop
 *
 * @return  [type]  [return description]
 */
function empath_post_loop(){
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;?>
            <div class="empath-pagination">
                <?php
                empath_pagination( '
                <i class="fal fa-chevron-double-left"></i>',
                '<i class="fal fa-chevron-double-right"></i>',
                '',
                ['class' => ''] );
                ?>
            </div>


		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
}

/**
 * Single Post Loop
 *
 * @return  [type]  [return description]
 */
function empath_single_post_loop(){
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );
		endwhile; // End of the loop.
}

/**
 * Archive Loop
 *
 * @return  [type]  [return description]
 */
function empath_post_archive_loop(){
    if ( have_posts() ) :
        /* Start the Loop */
        while ( have_posts() ) :
            the_post();

            /*
             * Include the Post-Type-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
             */
            get_template_part( 'template-parts/content', get_post_type() );

        endwhile;?>

            <div class="empath-pagination">
                <?php
                empath_pagination( '
                <i class="fal fa-chevron-double-left"></i>',
                '<i class="fal fa-chevron-double-right"></i>',
                '',
                ['class' => ''] );
                ?>
            </div>

    <?php else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
}

/**
 * Search Loop
 *
 * @return  [type]  [return description]
 */
function empath_search_loop(){
    if ( have_posts() ) :

        /* Start the Loop */
        while ( have_posts() ) :
            the_post();

            /**
             * Run the loop for the search to output the results.
             * If you want to overload this in a child theme then include a file
             * called content-search.php and that will be used instead.
             */
            get_template_part( 'template-parts/content', 'search' );

        endwhile;?>

<div class="empath-pagination">
                <?php
                empath_pagination( '
                <i class="fal fa-chevron-double-left"></i>',
                '<i class="fal fa-chevron-double-right"></i>',
                '',
                ['class' => ''] );
                ?>
            </div>

   <?php else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
}

/**
 * Page Loop
 *
 * @return  [type]  [return description]
 */
function empath_page_loop(){
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
}


/**
 * Single Page Layout
 *
 * @return void
 */
function empath_single_post_layout(){
    $single_post_global = cs_get_option( 'post_single_global_layout' );	
	$single_post_local = get_post_meta( get_the_ID(),'empath_inside_meta', true );

	$post_single_meta = isset($single_post_local['post_single_layout']) && !empty($single_post_local['post_single_layout']) ? $single_post_local['post_single_layout'] : '';

    if( !empty( $single_post_local  ) ) {	 
		get_template_part( 'template-parts/single/'.$post_single_meta.'' ); 	
	} elseif ( class_exists( 'CSF' ) && !empty( $single_post_global ) ) {		
		get_template_part( 'template-parts/single/'.$single_post_global.'' );  		
	} else {		
		get_template_part( 'template-parts/single/single-one' );  
	}
}