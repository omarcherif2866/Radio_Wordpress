<?php

/**
 *
 * Get empath Theme options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_option' ) ) {
    function cs_get_option( $option = '', $default = null ) {
        $options = get_option( 'empath_theme_options' ); // Attention: Set your unique id of the framework
        return ( isset( $options[$option] ) ) ? $options[$option] : $default;
    }
}

/**
 *
 * Get get switcher option
 *  for theme options
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if ( ! function_exists( 'cs_get_switcher_option' )) {

    function cs_get_switcher_option( $option = '', $default = null ) {
        $options = get_option( 'empath_theme_options' ); // Attention: Set your unique id of the framework
        $return_val =  ( isset( $options[$option] ) ) ? $options[$option] : $default;
        $return_val =  (is_null($return_val) || '1' == $return_val ) ? true : false;;
        return $return_val;
    }
}

if ( ! function_exists( 'cs_switcher_option' )) {

    function cs_switcher_option( $option = '', $default = null ) {
        $options = get_option( 'empath_theme_options' ); // Attention: Set your unique id of the framework
        $return_val =  ( isset( $options[$option] ) ) ? $options[$option] : $default;
        $return_val =  ( '1' == $return_val ) ? true : false;;
        return $return_val;
    }
}


/**
 * Function for get a metaboxes
 *
 * @param $prefix_key Required Meta unique slug
 * @param $meta_key Required Meta slug
 * @param $default Optional Set default value
 * @param $id Optional Set post id
 *
 * @return mixed
 */
function empath_get_meta( $prefix_key, $meta_key, $default = null, $id = '' ) {
    if ( !$id ) {
        $id = get_the_ID();
    }

    $meta_boxes = get_post_meta( $id, $prefix_key, true );
    return ( isset( $meta_boxes[$meta_key] ) ) ? $meta_boxes[$meta_key] : $default;
}


 /**
  * Site Logo
  */
function empath_default_logo(){ 
    $global_logo = cs_get_option('empath_logo');
    ?>
    <?php if(isset($global_logo['url']) && $global_logo['url']):?>
        <a aria-label="name" href="<?php echo esc_url( home_url( '/' ) ); ?>" >
        <img src="<?php echo esc_url($global_logo['url']);?>" alt="<?php echo esc_attr(get_bloginfo());?>">
        </a>
    <?php else:?>
        <?php 
            if(has_custom_logo()){
                the_custom_logo();
            }else{ ?>
            <a aria-label="name" href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo.png" alt="<?php esc_attr_e('Logo', 'forcast'); ?>">
            </a>
        <?php    }
        ?>
    <?php endif;?>
<?php }
