<?php if ( !empty( $cate_lists ) && !is_wp_error( $cate_lists ) ): ?>
<div class="row">
    <?php
        foreach ( $cate_lists as $cate ):
            $meta = get_term_meta($cate->term_id, 'empath_cate_meta', true);

            $catemeta = !empty( $meta['cate-color'] )? $meta['cate-color'] : '#3b60fe';
            $cate_img = !empty( $meta['cate_img_upload']['url'] )? $meta['cate_img_upload']['url'] : '';
            $cate_img_alt = !empty( $meta['cate_img_upload']['alt'] )? $meta['cate_img_upload']['alt'] : '';
        ?>
        <div class="col-lg-2 col-md-4">
            <div class="bytf__category-item-three">
                <div class="bytf__category-img">
                    <a aria-label="name"  href="<?php echo esc_url( get_term_link( $cate->term_id ) ) ?>">
                        <img src="<?php echo esc_url($cate_img); ?>" alt="<?php echo esc_attr($cate_img_alt)?>">
                    </a>
                </div>
                <div class="bytf__category-content-tthr">
                    <h4 class="cate-title">
                        <a aria-label="name" href="<?php echo esc_url( get_term_link( $cate->term_id ) ) ?>"> 
                            <?php echo esc_html( $cate->name ) ?> 
                        </a>
                        <?php if('yes' == $settings['hidenumber']):?>
                        <span class="cat-count">(<?php echo esc_attr( $cate->count ) ?> <?php if(!empty($settings['count_text'])){ echo esc_html($settings['count_text']);}?>)</span>
                    <?php endif;?>
                    </h4>                    
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
<?php endif;?>