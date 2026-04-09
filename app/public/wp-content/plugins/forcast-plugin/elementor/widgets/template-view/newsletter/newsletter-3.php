<div class="newsletter__wrapper-three d-flex align-items-center">
    <div class="newsletter_content d-flex align-items-center">
        <span class="icon">
            <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_12087_199)">
                <path d="M5.6 64.8999C5.5 64.8999 5.4 64.8999 5.3 64.7999C4.9 64.6999 4.7 64.2999 4.6 63.8999L0 1.0999C0 0.699901 0.2 0.299901 0.6 0.0999014C1 -0.100099 1.4 -9.85563e-05 1.7 0.299901L33.6 34.6999C34 35.0999 34 35.6999 33.6 36.0999L6.3 64.5999C6.1 64.7999 5.8 64.8999 5.6 64.8999ZM2.2 3.7999L6.4 61.5999L31.5 35.4999L2.2 3.7999Z" fill="#D1D1D1"/>
                <path d="M32.9001 36.4C32.6001 36.4 32.4001 36.3 32.2001 36.1L0.30006 1.7C5.97239e-05 1.3 -0.0999403 0.8 0.20006 0.4C0.50006 0 1.00006 -0.1 1.40006 0.1L63.5001 30.4C63.9001 30.6 64.1001 31 64.0001 31.5C63.9001 31.9 63.6001 32.3 63.1001 32.3L33.0001 36.4H32.9001ZM5.40006 4.2L33.3001 34.3L59.7001 30.7L5.40006 4.2Z" fill="#D1D1D1"/>
                <path d="M33.4 54.8C33 54.8 32.7 54.6 32.5 54.2L26.6 41.4C26.4 40.9 26.6 40.3 27.1 40.1C27.6 39.9 28.2 40.1 28.4 40.6L32.3 49L31.9 35.5C31.9 34.9 32.3 34.5 32.9 34.5C33.5 34.5 33.9 34.9 33.9 35.5L34.4 53.9C34.4 54.4 34.1 54.8 33.6 54.9C33.6 54.8 33.5 54.8 33.4 54.8Z" fill="#D1D1D1"/>
                </g>
                <defs>
                <clipPath id="clip0_12087_199">
                <rect width="69" height="69" fill="white"/>
                </clipPath>
                </defs>
            </svg>
        </span>
        <div class="content">
            <span class="subtitle"><?php echo wp_kses($settings['sub_title'], true); ?></span>
            <h2><?php echo wp_kses($settings['title'], true); ?></h2>
        </div>
    </div>
    <div class="ns_form">
        <?php if( !empty($settings['shortcode_id']) ){ echo do_shortcode($settings['shortcode_id']);}?>
        <?php if(!empty($settings['quote'])):?>
            <p><?php  echo empath_wp_kses($settings['quote']);?></p>
        <?php endif;?>
    </div>
    <div class="bg-img wow fadeInDown" data-wow-delay="400ms" data-wow-duration="1000ms">
        <img src="<?php echo esc_url($settings['banner_bg']['url']);?>" alt="">
    </div>
</div>