<?php 
/**
 * Header Template View 1
 */
if ( ! empty( $settings['ads_link']['url'] ) ) {
    $this->add_link_attributes( 'ads_link', $settings['ads_link'] );
}
if ( ! empty( $settings['bookmark_link']['url'] ) ) {
    $this->add_link_attributes( 'bookmark_link', $settings['bookmark_link'] );
}
?>
<header class="main-header main-header-three is-sticky">
    
    <div class="header__top-main-wrap bytf-sticky-header">
          <div class="container">
             <div class="header__top-main-wrap-inner d-flex justify-content-between align-items-center">
                <div class="logo__side d-flex align-items-center">
                    <div class="hamburger__menu toggle-hidden-bar">
                        <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="3.2" rx="1.6" fill="black"/>
                            <rect y="10.2" width="32" height="3.2" rx="1.6" fill="black"/>
                            <rect y="20.3999" width="20" height="3.2" rx="1.6" fill="black"/>
                        </svg>
                    </div>
                    <?php if(!empty($__rzlogo['url'])):?>
                        <div class="byteflows_logo">
                            <a aria-label="name" class="dark-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($__rzlogo['url']);?>" alt=""></a>
                            <a aria-label="name" class="light-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($_dark_rzlogo['url']);?>" alt=""></a>
                        </div>
                    <?php endif;?>
                </div>

                 <div class="byteflows_menu">
                    <?php
                        wp_nav_menu( 
                            array(
                                'menu' => !empty($settings['choose-menu']) ? $settings['choose-menu'] : 'menu-1',
                                'menu_id'        =>'byteflows-main-nav',
                                'menu_class'        =>'byteflows_menu-nav',
                                'container'=>false,
                                'fallback_cb'    => 'Navwalker_Class::fallback',
                                'walker'         => class_exists( 'Rs_Mega_Menu_Walker' ) ? new \Rs_Mega_Menu_Walker : '',
                            )
                        );
                    ?>
                </div>
                                
                <div class="byteflows_right_header d-flex align-items-center">    
                    <div class="header__control d-flex justify-content-between align-items-center">
                        <?php if($settings['enable_bookmark'] === 'yes'):?>
                            <div class="byt__bookmark">
                                <a aria-label="name" <?php echo $this->get_render_attribute_string( 'bookmark_link' ); ?>>
                                    <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.5556 21L8.77778 15.4444L1 21V3.22222C1 2.63285 1.23413 2.06762 1.65087 1.65087C2.06762 1.23413 2.63285 1 3.22222 1H14.3333C14.9227 1 15.4879 1.23413 15.9047 1.65087C16.3214 2.06762 16.5556 2.63285 16.5556 3.22222V21Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif;?>
                        <?php $this->empath_dark_mode(); ?>
                        <div class="search_popup search__open-btn d-none bytf-trigger-open d-xl-mc-none d-md-block">
                            <span>
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.75021 0.666992C6.62071 0.667088 5.5076 0.937296 4.50376 1.45507C3.49992 1.97285 2.63446 2.72317 1.97957 3.64345C1.32469 4.56373 0.899386 5.62728 0.739135 6.74536C0.578884 7.86344 0.688336 9.00363 1.05836 10.0708C1.42838 11.138 2.04825 12.1012 2.86624 12.8801C3.68423 13.659 4.67663 14.231 5.76064 14.5483C6.84465 14.8657 7.98883 14.9192 9.09773 14.7044C10.2066 14.4896 11.2481 14.0128 12.1352 13.3137L15.1785 16.357C15.3357 16.5088 15.5462 16.5928 15.7647 16.5909C15.9832 16.589 16.1922 16.5013 16.3467 16.3468C16.5012 16.1923 16.5889 15.9833 16.5908 15.7648C16.5927 15.5463 16.5087 15.3358 16.3569 15.1787L13.3135 12.1353C14.1369 11.0908 14.6495 9.83566 14.7928 8.51343C14.9361 7.1912 14.7042 5.85534 14.1237 4.65874C13.5433 3.46213 12.6376 2.45312 11.5105 1.74718C10.3833 1.04125 9.08018 0.666903 7.75021 0.666992ZM2.33354 7.75033C2.33354 6.31374 2.90423 4.93599 3.92005 3.92016C4.93587 2.90434 6.31362 2.33366 7.75021 2.33366C9.1868 2.33366 10.5646 2.90434 11.5804 3.92016C12.5962 4.93599 13.1669 6.31374 13.1669 7.75033C13.1669 9.18692 12.5962 10.5647 11.5804 11.5805C10.5646 12.5963 9.1868 13.167 7.75021 13.167C6.31362 13.167 4.93587 12.5963 3.92005 11.5805C2.90423 10.5647 2.33354 9.18692 2.33354 7.75033Z" fill="black"/>
                                </svg>
    </span>
                        </div>
                        <div class="hamburger_menu bytf__mobile-menu">
                            <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="32" height="3.2" rx="1.6" fill="black"/>
                                <rect y="10.2" width="32" height="3.2" rx="1.6" fill="black"/>
                                <rect y="20.3999" width="20" height="3.2" rx="1.6" fill="black"/>
                            </svg>
                        </div>
                    </div>      
                    <?php if(!empty($settings['btn_label'])):?>
                        <a aria-label="name" class="thm__btn d-none d-md-block" href="<?php echo esc_url($settings['btn_link']['url']);?>"><?php echo esc_html($settings['btn_label']);?></a>
                    <?php endif;?>
                </div>
             </div>
          </div>                      
    </div>
    <div class="header__menu-wrapper">
        <div class="container">
           <div class="header__category-maenu">
                
            <?php
                    wp_nav_menu( 
                        array(
                            'menu' => !empty($settings['choose-cate-menu']) ? $settings['choose-cate-menu'] : '',
                            'menu_id'        =>'byteflows-category-nav',
                            'menu_class'        =>'byteflows_category-nav',
                            'container'=>false,
                            'fallback_cb'    => 'Navwalker_Class::fallback',
                            'walker'         => class_exists( 'Rs_Mega_Menu_Walker' ) ? new \Rs_Mega_Menu_Walker : '',
                        )
                    );
                ?>
                
           </div>
        </div>
    </div>
</header>
<?php $this->offcanvas_menu(); $this->mobile_menu(); $this->___search_body();?>