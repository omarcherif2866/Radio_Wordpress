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
<header class="main-header main-header-four is-sticky">
    <div class="header__top-main-wrap">
          <div class="container">
             <div class="header__top-main-wrap-inner d-flex justify-content-between align-items-center">
                <?php if(!empty($__rzlogo['url']) || !empty($_dark_rzlogo['url'])):?>
                    <div class="byteflows_logo">
                        <a aria-label="name" class="dark-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($__rzlogo['url']);?>" alt=""></a>
                        <a aria-label="name" class="light-logo" href="<?php echo esc_url($custom_link);?>"><img src="<?php echo esc_url($_dark_rzlogo['url']);?>" alt=""></a>
                    </div>
                 <?php endif;?>   
                <div class="byteflows_right_header d-flex align-items-center">    
                    <div class="header__social-icon">
                        <?php foreach($settings['hsocials'] as $item):?>
                        <a aria-label="name" data-toggle="tooltip" title="<?php echo esc_html($item['title'])?>" target="<?php echo esc_attr( $item['link']['is_external'] ? '_blank' : '_self' ); ?>" rel="<?php echo esc_attr( $item['link']['nofollow'] ? 'nofollow' : '' ); ?>" href="<?php echo $item['link']['url'] ? esc_url($item['link']['url']) : ''; ?>"><?php \Elementor\Icons_Manager::render_icon( $item['icons'], [ 'aria-hidden' => 'true' ] ); ?></a>
                        <?php endforeach;?>
                    </div>                
                    <div class="header__search-d">
                        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                            <div class="search__input">
                            <input class="search-input-field" type="text" placeholder="<?php esc_attr_e( 'Search ...', 'btourq' )?>" name="s" value="<?php the_search_query();?>">
                            <button type="submit">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg> 
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
          </div>                      
    </div>
    <div class="header__menu-wrapper bytf-sticky-header">
        <div class="container">
           <div class="header__maenu d-flex justify-content-between align-items-center">
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
                <div class="hamburger_menu bytf__mobile-menu">
                    <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="3.2" rx="1.6" fill="black"/>
                        <rect y="10.2" width="32" height="3.2" rx="1.6" fill="black"/>
                        <rect y="20.3999" width="20" height="3.2" rx="1.6" fill="black"/>
                    </svg>
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
                    <?php $this->empath_dark_mode(); ?>
                    <?php if(!empty($settings['btn_label'])):?>
                        <a aria-label="name" class="thm__btn d-none d-md-block" href="<?php echo esc_url($settings['btn_link']['url']);?>"><?php echo esc_html($settings['btn_label']);?></a>
                    <?php endif;?>
                </div>
           </div>
        </div>
    </div>
</header>
<?php $this->offcanvas_menu(); $this->mobile_menu(); $this->___search_body();?>