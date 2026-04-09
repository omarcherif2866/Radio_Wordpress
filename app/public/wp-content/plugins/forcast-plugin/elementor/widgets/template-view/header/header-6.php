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
<header class="main-header main-header-one main-header-six is-sticky">
    <?php if($settings['enable_header_top'] === 'yes'):?>
    <div class="header__top-wraper">
        <div class="container">
            <div class="header__top-wraper-inner d-flex justify-content-between align-items-center">
                <div class="header__top-innrer-left">
                    <div class="header__top-info htop__left-info">
                    <?php if(!empty($settings['quick_text'])):?>
                            <span class="quick-link"><?php echo esc_html__($settings['quick_text'], 'empath-plugin'); ?></span>
                        <?php endif;?>
                        <ul>
                            <?php foreach($settings['links'] as $item):?>
                                <li>
                                    <a aria-label="name" target="<?php echo esc_attr( $item['link']['is_external'] ? '_blank' : '_self' ); ?>" rel="<?php echo esc_attr( $item['link']['nofollow'] ? 'nofollow' : '' ); ?>" href="<?php echo $item['link']['url'] ? esc_url($item['link']['url']) : ''; ?>" ><?php echo esc_html($item['title']);?></a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <div class="header__top-innrer-right d-flex justify-content-between align-items-center">
                    
                    <div class="date_h">
                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.785714 3.92857V10.2143H10.2143V1.57143H8.64286V1.96429C8.64286 2.06848 8.60147 2.1684 8.52779 2.24208C8.45412 2.31575 8.35419 2.35714 8.25 2.35714C8.14581 2.35714 8.04588 2.31575 7.97221 2.24208C7.89853 2.1684 7.85714 2.06848 7.85714 1.96429V1.57143H3.14286V1.96429C3.14286 2.06848 3.10147 2.1684 3.02779 2.24208C2.95412 2.31575 2.85419 2.35714 2.75 2.35714C2.64581 2.35714 2.54588 2.31575 2.47221 2.24208C2.39853 2.1684 2.35714 2.06848 2.35714 1.96429V1.57143H0.785714V3.14286H10.2143V3.92857H0.785714ZM3.14286 0.785714H7.85714V0.392857C7.85714 0.288665 7.89853 0.18874 7.97221 0.115065C8.04588 0.0413902 8.14581 0 8.25 0C8.35419 0 8.45412 0.0413902 8.52779 0.115065C8.60147 0.18874 8.64286 0.288665 8.64286 0.392857V0.785714H10.6071C10.7113 0.785714 10.8113 0.827105 10.8849 0.90078C10.9586 0.974455 11 1.07438 11 1.17857V10.6071C11 10.7113 10.9586 10.8113 10.8849 10.8849C10.8113 10.9586 10.7113 11 10.6071 11H0.392857C0.288665 11 0.18874 10.9586 0.115065 10.8849C0.0413902 10.8113 0 10.7113 0 10.6071V1.17857C0 1.07438 0.0413902 0.974455 0.115065 0.90078C0.18874 0.827105 0.288665 0.785714 0.392857 0.785714H2.35714V0.392857C2.35714 0.288665 2.39853 0.18874 2.47221 0.115065C2.54588 0.0413902 2.64581 0 2.75 0C2.85419 0 2.95412 0.0413902 3.02779 0.115065C3.10147 0.18874 3.14286 0.288665 3.14286 0.392857V0.785714ZM2.75 5.5H3.53571C3.63991 5.5 3.73983 5.54139 3.81351 5.61506C3.88718 5.68874 3.92857 5.78866 3.92857 5.89286C3.92857 5.99705 3.88718 6.09697 3.81351 6.17065C3.73983 6.24432 3.63991 6.28571 3.53571 6.28571H2.75C2.64581 6.28571 2.54588 6.24432 2.47221 6.17065C2.39853 6.09697 2.35714 5.99705 2.35714 5.89286C2.35714 5.78866 2.39853 5.68874 2.47221 5.61506C2.54588 5.54139 2.64581 5.5 2.75 5.5ZM2.75 7.85714H3.53571C3.63991 7.85714 3.73983 7.89853 3.81351 7.97221C3.88718 8.04588 3.92857 8.14581 3.92857 8.25C3.92857 8.35419 3.88718 8.45412 3.81351 8.52779C3.73983 8.60147 3.63991 8.64286 3.53571 8.64286H2.75C2.64581 8.64286 2.54588 8.60147 2.47221 8.52779C2.39853 8.45412 2.35714 8.35419 2.35714 8.25C2.35714 8.14581 2.39853 8.04588 2.47221 7.97221C2.54588 7.89853 2.64581 7.85714 2.75 7.85714ZM5.10714 5.5H5.89286C5.99705 5.5 6.09697 5.54139 6.17065 5.61506C6.24432 5.68874 6.28571 5.78866 6.28571 5.89286C6.28571 5.99705 6.24432 6.09697 6.17065 6.17065C6.09697 6.24432 5.99705 6.28571 5.89286 6.28571H5.10714C5.00295 6.28571 4.90303 6.24432 4.82935 6.17065C4.75568 6.09697 4.71429 5.99705 4.71429 5.89286C4.71429 5.78866 4.75568 5.68874 4.82935 5.61506C4.90303 5.54139 5.00295 5.5 5.10714 5.5ZM5.10714 7.85714H5.89286C5.99705 7.85714 6.09697 7.89853 6.17065 7.97221C6.24432 8.04588 6.28571 8.14581 6.28571 8.25C6.28571 8.35419 6.24432 8.45412 6.17065 8.52779C6.09697 8.60147 5.99705 8.64286 5.89286 8.64286H5.10714C5.00295 8.64286 4.90303 8.60147 4.82935 8.52779C4.75568 8.45412 4.71429 8.35419 4.71429 8.25C4.71429 8.14581 4.75568 8.04588 4.82935 7.97221C4.90303 7.89853 5.00295 7.85714 5.10714 7.85714ZM7.46429 5.5H8.25C8.35419 5.5 8.45412 5.54139 8.52779 5.61506C8.60147 5.68874 8.64286 5.78866 8.64286 5.89286C8.64286 5.99705 8.60147 6.09697 8.52779 6.17065C8.45412 6.24432 8.35419 6.28571 8.25 6.28571H7.46429C7.36009 6.28571 7.26017 6.24432 7.18649 6.17065C7.11282 6.09697 7.07143 5.99705 7.07143 5.89286C7.07143 5.78866 7.11282 5.68874 7.18649 5.61506C7.26017 5.54139 7.36009 5.5 7.46429 5.5ZM7.46429 7.85714H8.25C8.35419 7.85714 8.45412 7.89853 8.52779 7.97221C8.60147 8.04588 8.64286 8.14581 8.64286 8.25C8.64286 8.35419 8.60147 8.45412 8.52779 8.52779C8.45412 8.60147 8.35419 8.64286 8.25 8.64286H7.46429C7.36009 8.64286 7.26017 8.60147 7.18649 8.52779C7.11282 8.45412 7.07143 8.35419 7.07143 8.25C7.07143 8.14581 7.11282 8.04588 7.18649 7.97221C7.26017 7.89853 7.36009 7.85714 7.46429 7.85714Z" fill="white"/>
                </svg>
                <?php echo esc_html( date_i18n( 'l, j F Y' ) ); ?>
                    </div>
                    <div class="header__social-icon">
                        <?php foreach($settings['hsocials'] as $item):?>
                        <a aria-label="name" class="elementor-repeater-item-<?php echo esc_attr($item['_id']);?>"  data-toggle="tooltip" title="<?php echo esc_html($item['title'])?>" target="<?php echo esc_attr( $item['link']['is_external'] ? '_blank' : '_self' ); ?>" rel="<?php echo esc_attr( $item['link']['nofollow'] ? 'nofollow' : '' ); ?>" href="<?php echo $item['link']['url'] ? esc_url($item['link']['url']) : ''; ?>"><?php \Elementor\Icons_Manager::render_icon( $item['icons'], [ 'aria-hidden' => 'true' ] ); ?></a>
                        <?php endforeach;?>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    
    <div class="header__menu-wrapper bytf-sticky-header">
        <div class="container">
           <div class="header__maenu d-flex justify-content-between align-items-center">
                <?php if(!empty($__rzlogo['url']) || !empty($_dark_rzlogo['url'])):?>
                <div class="byteflows_logo">
                    <a aria-label="name" class="dark-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($__rzlogo['url']);?>" alt=""></a>
                    <a aria-label="name" class="light-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($_dark_rzlogo['url']);?>" alt=""></a>
                </div>
                <?php endif;?>
                
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
                    <?php 
                        if($settings['enable_dark_s'] === 'yes'){
                            $this->empath_dark_mode(); 
                        }                    
                    ?>
                    <?php if($settings['enable_search'] === 'yes'):?>
                        <div class="search_popup search__open-btn d-none bytf-trigger-open d-xl-mc-none d-md-block">
                            <span>
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.75021 0.666992C6.62071 0.667088 5.5076 0.937296 4.50376 1.45507C3.49992 1.97285 2.63446 2.72317 1.97957 3.64345C1.32469 4.56373 0.899386 5.62728 0.739135 6.74536C0.578884 7.86344 0.688336 9.00363 1.05836 10.0708C1.42838 11.138 2.04825 12.1012 2.86624 12.8801C3.68423 13.659 4.67663 14.231 5.76064 14.5483C6.84465 14.8657 7.98883 14.9192 9.09773 14.7044C10.2066 14.4896 11.2481 14.0128 12.1352 13.3137L15.1785 16.357C15.3357 16.5088 15.5462 16.5928 15.7647 16.5909C15.9832 16.589 16.1922 16.5013 16.3467 16.3468C16.5012 16.1923 16.5889 15.9833 16.5908 15.7648C16.5927 15.5463 16.5087 15.3358 16.3569 15.1787L13.3135 12.1353C14.1369 11.0908 14.6495 9.83566 14.7928 8.51343C14.9361 7.1912 14.7042 5.85534 14.1237 4.65874C13.5433 3.46213 12.6376 2.45312 11.5105 1.74718C10.3833 1.04125 9.08018 0.666903 7.75021 0.666992ZM2.33354 7.75033C2.33354 6.31374 2.90423 4.93599 3.92005 3.92016C4.93587 2.90434 6.31362 2.33366 7.75021 2.33366C9.1868 2.33366 10.5646 2.90434 11.5804 3.92016C12.5962 4.93599 13.1669 6.31374 13.1669 7.75033C13.1669 9.18692 12.5962 10.5647 11.5804 11.5805C10.5646 12.5963 9.1868 13.167 7.75021 13.167C6.31362 13.167 4.93587 12.5963 3.92005 11.5805C2.90423 10.5647 2.33354 9.18692 2.33354 7.75033Z" fill="black"/>
                                </svg>
                            </span>
                        </div>
                    <?php endif;?>
                    <div class="hamburger__menu toggle-hidden-bar">
                        <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="3.2" rx="1.6" fill="black"/>
                            <rect y="10.2" width="32" height="3.2" rx="1.6" fill="black"/>
                            <rect y="20.3999" width="20" height="3.2" rx="1.6" fill="black"/>
                        </svg>
                    </div>
                    <div class="hamburger_menu bytf__mobile-menu">
                        <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="3.2" rx="1.6" fill="black"/>
                            <rect y="10.2" width="32" height="3.2" rx="1.6" fill="black"/>
                            <rect y="20.3999" width="20" height="3.2" rx="1.6" fill="black"/>
                        </svg>
                    </div>
                </div>
           </div>
        </div>
    </div>
</header>
<?php $this->offcanvas_menu(); $this->mobile_menu(); $this->___search_body();?>