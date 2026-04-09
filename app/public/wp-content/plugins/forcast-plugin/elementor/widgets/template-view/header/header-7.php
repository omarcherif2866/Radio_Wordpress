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
<header class="main-header main-header-one main-header-seven is-sticky">
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
                <?php if(!empty($__rzlogo['url']) || !empty($_dark_rzlogo['url'])):?>
                <div class="byteflows_logo">
                    <a aria-label="name" class="dark-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($__rzlogo['url']);?>" alt=""></a>
                    <a aria-label="name" class="light-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($_dark_rzlogo['url']);?>" alt=""></a>
                </div>
                <?php endif;?>
                <div class="header__top-innrer-right d-flex justify-content-between align-items-center">
                    
                    <div class="date_h">
                        
<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.785714 3.87164V10.0663H10.2143V1.54865H8.64286V1.93582C8.64286 2.0385 8.60147 2.13698 8.52779 2.20958C8.45412 2.28219 8.35419 2.32298 8.25 2.32298C8.14581 2.32298 8.04588 2.28219 7.97221 2.20958C7.89853 2.13698 7.85714 2.0385 7.85714 1.93582V1.54865H3.14286V1.93582C3.14286 2.0385 3.10147 2.13698 3.02779 2.20958C2.95412 2.28219 2.85419 2.32298 2.75 2.32298C2.64581 2.32298 2.54588 2.28219 2.47221 2.20958C2.39853 2.13698 2.35714 2.0385 2.35714 1.93582V1.54865H0.785714V3.09731H10.2143V3.87164H0.785714ZM3.14286 0.774327H7.85714V0.387164C7.85714 0.284481 7.89853 0.186005 7.97221 0.113398C8.04588 0.0407903 8.14581 0 8.25 0C8.35419 0 8.45412 0.0407903 8.52779 0.113398C8.60147 0.186005 8.64286 0.284481 8.64286 0.387164V0.774327H10.6071C10.7113 0.774327 10.8113 0.815118 10.8849 0.887725C10.9586 0.960332 11 1.05881 11 1.16149V10.4534C11 10.5561 10.9586 10.6546 10.8849 10.7272C10.8113 10.7998 10.7113 10.8406 10.6071 10.8406H0.392857C0.288665 10.8406 0.18874 10.7998 0.115065 10.7272C0.0413902 10.6546 0 10.5561 0 10.4534V1.16149C0 1.05881 0.0413902 0.960332 0.115065 0.887725C0.18874 0.815118 0.288665 0.774327 0.392857 0.774327H2.35714V0.387164C2.35714 0.284481 2.39853 0.186005 2.47221 0.113398C2.54588 0.0407903 2.64581 0 2.75 0C2.85419 0 2.95412 0.0407903 3.02779 0.113398C3.10147 0.186005 3.14286 0.284481 3.14286 0.387164V0.774327ZM2.75 5.42029H3.53571C3.63991 5.42029 3.73983 5.46108 3.81351 5.53369C3.88718 5.60629 3.92857 5.70477 3.92857 5.80745C3.92857 5.91014 3.88718 6.00861 3.81351 6.08122C3.73983 6.15383 3.63991 6.19462 3.53571 6.19462H2.75C2.64581 6.19462 2.54588 6.15383 2.47221 6.08122C2.39853 6.00861 2.35714 5.91014 2.35714 5.80745C2.35714 5.70477 2.39853 5.60629 2.47221 5.53369C2.54588 5.46108 2.64581 5.42029 2.75 5.42029ZM2.75 7.74327H3.53571C3.63991 7.74327 3.73983 7.78406 3.81351 7.85667C3.88718 7.92928 3.92857 8.02775 3.92857 8.13043C3.92857 8.23312 3.88718 8.33159 3.81351 8.4042C3.73983 8.47681 3.63991 8.5176 3.53571 8.5176H2.75C2.64581 8.5176 2.54588 8.47681 2.47221 8.4042C2.39853 8.33159 2.35714 8.23312 2.35714 8.13043C2.35714 8.02775 2.39853 7.92928 2.47221 7.85667C2.54588 7.78406 2.64581 7.74327 2.75 7.74327ZM5.10714 5.42029H5.89286C5.99705 5.42029 6.09697 5.46108 6.17065 5.53369C6.24432 5.60629 6.28571 5.70477 6.28571 5.80745C6.28571 5.91014 6.24432 6.00861 6.17065 6.08122C6.09697 6.15383 5.99705 6.19462 5.89286 6.19462H5.10714C5.00295 6.19462 4.90303 6.15383 4.82935 6.08122C4.75568 6.00861 4.71429 5.91014 4.71429 5.80745C4.71429 5.70477 4.75568 5.60629 4.82935 5.53369C4.90303 5.46108 5.00295 5.42029 5.10714 5.42029ZM5.10714 7.74327H5.89286C5.99705 7.74327 6.09697 7.78406 6.17065 7.85667C6.24432 7.92928 6.28571 8.02775 6.28571 8.13043C6.28571 8.23312 6.24432 8.33159 6.17065 8.4042C6.09697 8.47681 5.99705 8.5176 5.89286 8.5176H5.10714C5.00295 8.5176 4.90303 8.47681 4.82935 8.4042C4.75568 8.33159 4.71429 8.23312 4.71429 8.13043C4.71429 8.02775 4.75568 7.92928 4.82935 7.85667C4.90303 7.78406 5.00295 7.74327 5.10714 7.74327ZM7.46429 5.42029H8.25C8.35419 5.42029 8.45412 5.46108 8.52779 5.53369C8.60147 5.60629 8.64286 5.70477 8.64286 5.80745C8.64286 5.91014 8.60147 6.00861 8.52779 6.08122C8.45412 6.15383 8.35419 6.19462 8.25 6.19462H7.46429C7.36009 6.19462 7.26017 6.15383 7.18649 6.08122C7.11282 6.00861 7.07143 5.91014 7.07143 5.80745C7.07143 5.70477 7.11282 5.60629 7.18649 5.53369C7.26017 5.46108 7.36009 5.42029 7.46429 5.42029ZM7.46429 7.74327H8.25C8.35419 7.74327 8.45412 7.78406 8.52779 7.85667C8.60147 7.92928 8.64286 8.02775 8.64286 8.13043C8.64286 8.23312 8.60147 8.33159 8.52779 8.4042C8.45412 8.47681 8.35419 8.5176 8.25 8.5176H7.46429C7.36009 8.5176 7.26017 8.47681 7.18649 8.4042C7.11282 8.33159 7.07143 8.23312 7.07143 8.13043C7.07143 8.02775 7.11282 7.92928 7.18649 7.85667C7.26017 7.78406 7.36009 7.74327 7.46429 7.74327Z" fill="#161616"/>
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
            <div class="d-flex justify-content-between align-items-center">
                <div class="hamburger__menu toggle-hidden-bar">
                    <span class="bar bar__1"></span>    
                    <span class="bar bar__2"></span> 
                </div>
            <?php if($settings['enable_search'] === 'yes'):?>
                <div class="search_popup search__open-btn d-none bytf-trigger-open d-xl-mc-none d-md-block">
                    <span>
                        
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4286 19C15.8469 19 19.4286 15.4183 19.4286 11C19.4286 6.58172 15.8469 3 11.4286 3C7.01031 3 3.42859 6.58172 3.42859 11C3.42859 15.4183 7.01031 19 11.4286 19Z" stroke="#161616" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21.4286 20.9999L17.0786 16.6499" stroke="#161616" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    </span>
                </div>
            <?php endif;?>
            <div class="byteflows_logo">
                <a aria-label="name" class="dark-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($__rzlogo['url']);?>" alt=""></a>
                <a aria-label="name" class="light-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($_dark_rzlogo['url']);?>" alt=""></a>
            </div>
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
                <div class="header__control d-flex justify-content-between align-items-center">
                    <?php if($settings['enable_login'] === 'yes'):?>
                    <div class="login__user">
                        <a href="<?php echo esc_url($settings['l_link']['url']);?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.7269 20.447C19.2719 19.171 18.267 18.044 16.87 17.24C15.473 16.436 13.7609 16 11.9999 16C10.2389 16 8.52695 16.436 7.12995 17.24C5.73295 18.044 4.72795 19.171 4.27295 20.447" stroke="#161616" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="#161616" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>
                    <?php endif;?>
                    <?php 
                        if($settings['enable_dark_s'] === 'yes'){
                            $this->empath_dark_mode(); 
                        }                    
                    ?>
                    <?php if(!empty($settings['btn_label'])):?>
                        <a aria-label="name" class="thm__btn d-none d-md-block" href="<?php echo esc_url($settings['btn_link']['url']);?>"><?php echo esc_html($settings['btn_label']);?></a>
                    <?php endif;?>
                    
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