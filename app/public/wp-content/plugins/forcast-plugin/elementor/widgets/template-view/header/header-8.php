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
<header class="main-header main-header-one main-header-eight is-sticky">
    <?php if($settings['enable_header_top'] === 'yes'):?>
    <div class="header__top-wraper">
        <div class="container">
            <div class="header__top-wraper-inner d-flex justify-content-between align-items-center">
                <div class="header__top-innrer-left d-flex justify-content-between align-items-center">  
                    <div class="date__crnt">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.857143 4.28571V11.1429H11.1429V1.71429H9.42857V2.14286C9.42857 2.25652 9.38342 2.36553 9.30305 2.4459C9.22267 2.52628 9.11366 2.57143 9 2.57143C8.88634 2.57143 8.77733 2.52628 8.69695 2.4459C8.61658 2.36553 8.57143 2.25652 8.57143 2.14286V1.71429H3.42857V2.14286C3.42857 2.25652 3.38342 2.36553 3.30305 2.4459C3.22267 2.52628 3.11366 2.57143 3 2.57143C2.88634 2.57143 2.77733 2.52628 2.69695 2.4459C2.61658 2.36553 2.57143 2.25652 2.57143 2.14286V1.71429H0.857143V3.42857H11.1429V4.28571H0.857143ZM3.42857 0.857143H8.57143V0.428571C8.57143 0.314907 8.61658 0.205898 8.69695 0.125526C8.77733 0.0451529 8.88634 0 9 0C9.11366 0 9.22267 0.0451529 9.30305 0.125526C9.38342 0.205898 9.42857 0.314907 9.42857 0.428571V0.857143H11.5714C11.6851 0.857143 11.7941 0.902296 11.8745 0.982669C11.9548 1.06304 12 1.17205 12 1.28571V11.5714C12 11.6851 11.9548 11.7941 11.8745 11.8745C11.7941 11.9548 11.6851 12 11.5714 12H0.428571C0.314907 12 0.205898 11.9548 0.125526 11.8745C0.0451529 11.7941 0 11.6851 0 11.5714V1.28571C0 1.17205 0.0451529 1.06304 0.125526 0.982669C0.205898 0.902296 0.314907 0.857143 0.428571 0.857143H2.57143V0.428571C2.57143 0.314907 2.61658 0.205898 2.69695 0.125526C2.77733 0.0451529 2.88634 0 3 0C3.11366 0 3.22267 0.0451529 3.30305 0.125526C3.38342 0.205898 3.42857 0.314907 3.42857 0.428571V0.857143ZM3 6H3.85714C3.97081 6 4.07982 6.04515 4.16019 6.12553C4.24056 6.2059 4.28571 6.31491 4.28571 6.42857C4.28571 6.54224 4.24056 6.65124 4.16019 6.73162C4.07982 6.81199 3.97081 6.85714 3.85714 6.85714H3C2.88634 6.85714 2.77733 6.81199 2.69695 6.73162C2.61658 6.65124 2.57143 6.54224 2.57143 6.42857C2.57143 6.31491 2.61658 6.2059 2.69695 6.12553C2.77733 6.04515 2.88634 6 3 6ZM3 8.57143H3.85714C3.97081 8.57143 4.07982 8.61658 4.16019 8.69695C4.24056 8.77733 4.28571 8.88634 4.28571 9C4.28571 9.11366 4.24056 9.22267 4.16019 9.30305C4.07982 9.38342 3.97081 9.42857 3.85714 9.42857H3C2.88634 9.42857 2.77733 9.38342 2.69695 9.30305C2.61658 9.22267 2.57143 9.11366 2.57143 9C2.57143 8.88634 2.61658 8.77733 2.69695 8.69695C2.77733 8.61658 2.88634 8.57143 3 8.57143ZM5.57143 6H6.42857C6.54224 6 6.65124 6.04515 6.73162 6.12553C6.81199 6.2059 6.85714 6.31491 6.85714 6.42857C6.85714 6.54224 6.81199 6.65124 6.73162 6.73162C6.65124 6.81199 6.54224 6.85714 6.42857 6.85714H5.57143C5.45776 6.85714 5.34876 6.81199 5.26838 6.73162C5.18801 6.65124 5.14286 6.54224 5.14286 6.42857C5.14286 6.31491 5.18801 6.2059 5.26838 6.12553C5.34876 6.04515 5.45776 6 5.57143 6ZM5.57143 8.57143H6.42857C6.54224 8.57143 6.65124 8.61658 6.73162 8.69695C6.81199 8.77733 6.85714 8.88634 6.85714 9C6.85714 9.11366 6.81199 9.22267 6.73162 9.30305C6.65124 9.38342 6.54224 9.42857 6.42857 9.42857H5.57143C5.45776 9.42857 5.34876 9.38342 5.26838 9.30305C5.18801 9.22267 5.14286 9.11366 5.14286 9C5.14286 8.88634 5.18801 8.77733 5.26838 8.69695C5.34876 8.61658 5.45776 8.57143 5.57143 8.57143ZM8.14286 6H9C9.11366 6 9.22267 6.04515 9.30305 6.12553C9.38342 6.2059 9.42857 6.31491 9.42857 6.42857C9.42857 6.54224 9.38342 6.65124 9.30305 6.73162C9.22267 6.81199 9.11366 6.85714 9 6.85714H8.14286C8.02919 6.85714 7.92018 6.81199 7.83981 6.73162C7.75944 6.65124 7.71429 6.54224 7.71429 6.42857C7.71429 6.31491 7.75944 6.2059 7.83981 6.12553C7.92018 6.04515 8.02919 6 8.14286 6ZM8.14286 8.57143H9C9.11366 8.57143 9.22267 8.61658 9.30305 8.69695C9.38342 8.77733 9.42857 8.88634 9.42857 9C9.42857 9.11366 9.38342 9.22267 9.30305 9.30305C9.22267 9.38342 9.11366 9.42857 9 9.42857H8.14286C8.02919 9.42857 7.92018 9.38342 7.83981 9.30305C7.75944 9.22267 7.71429 9.11366 7.71429 9C7.71429 8.88634 7.75944 8.77733 7.83981 8.69695C7.92018 8.61658 8.02919 8.57143 8.14286 8.57143Z" fill="#161616"/>
                    </svg>
                    <?php echo esc_html( date_i18n( 'l, j F Y' ) ); ?>

                    </div>                  
                    <div class="header__top-info htop__left-info">
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
    <div class="header__top-main-wrap">
          <div class="container">
             <div class="header__top-main-wrap-inner d-flex justify-content-between align-items-center">
                <?php if(!empty($__rzlogo['url']) || !empty($_dark_rzlogo['url'])):?>
                    <div class="byteflows_logo">
                        <a aria-label="name" class="dark-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($__rzlogo['url']);?>" alt=""></a>
                        <a aria-label="name" class="light-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($_dark_rzlogo['url']);?>" alt=""></a>
                    </div>
                 <?php endif;?>
                 <div class="header__adds">
                    <a aria-label="name" class="light" <?php echo $this->get_render_attribute_string( 'ads_link' ); ?>>
                        <img src="<?php echo esc_url($settings['ads_image']['url']);?>" alt="<?php if(!empty($settings['ads_image']['alt'])){ echo esc_attr($settings['ads_image']['alt']);}?>">
                    </a>
                    <a aria-label="name" class="dark" <?php echo $this->get_render_attribute_string( 'ads_link' ); ?>>
                        <img src="<?php echo esc_url($settings['ads_dark_image']['url']);?>" alt="<?php if(!empty($settings['ads_dark_image']['alt'])){ echo esc_attr($settings['ads_dark_image']['alt']);}?>">
                    </a>
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
    
    <div class="header__menu-wrapper bytf-sticky-header">
        <div class="container">
           <div class="header__maenu d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="hamburger__menu toggle-hidden-bar">
                    <span class="bar bar__1"></span>    
                    <span class="bar bar__2"></span> 
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
                <?php if($settings['enable_search'] === 'yes'):?>
                        <div class="search_popup  bytf-trigger-open d-xl-mc-none d-md-block">
                            <span>
                                
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.9999 20.9999L16.6499 16.6499" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            </span>
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
                </div>
           </div>
        </div>
    </div>
</header>
<?php $this->offcanvas_menu(); $this->mobile_menu(); $this->___search_body();?>