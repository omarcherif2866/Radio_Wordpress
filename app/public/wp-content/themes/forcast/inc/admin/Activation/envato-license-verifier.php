<?php
/*
Plugin Name: Envato Purchase Verification
Description: Verifies Envato purchase codes before allowing plugin activation and demo import with single-site license activation.
Version: 1.4
Author: Raziul
*/

if (!defined('ABSPATH')) {
    exit;
}

class Envato_Purchase_Verification {

    private $product_id = 56461750; // Envato item ID
    private $option_name = 'envato_purchase_verified';
    private $purchase_code_option = 'envato_purchase_code';

    // Your server license activation/reset URLs
    private $license_server_activate_url = 'https://byteflows.net/api-active/activate.php';
    private $license_server_reset_url = 'https://byteflows.net/api-active/reset.php';

    public function __construct() {
        add_action('admin_init', array($this, 'check_license_status'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_ajax_verify_envato_purchase', array($this, 'verify_purchase_code_ajax'));
        add_action('wp_ajax_reset_envato_purchase', array($this, 'reset_purchase_code_ajax'));

        add_filter('tgmpa_load', array($this, 'check_license_before_tgmpa'), 10, 1);
        add_action('pt-ocdi/before_content_import', array($this, 'check_license_before_demo_import'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_ocdi_scripts'));
        add_action('admin_footer', array($this, 'add_ocdi_popup_html'));
        add_action('wp_ajax_envato_check_verification', array($this, 'handle_ajax_verification_check'));
        add_action('wp_footer', array($this, 'frontend_license_notice'));
    }

    public function enqueue_admin_scripts($hook) {
        if ($hook == 'toplevel_page_envato-verification') {
            wp_enqueue_style(
                'envato-verification-css',
                get_template_directory_uri() . '/inc/admin/Activation/assets/css/admin.css'
            );
            wp_enqueue_script(
                'envato-verification-js',
                get_template_directory_uri() . '/inc/admin/Activation/assets/js/admin.js',
                array('jquery'),
                '1.0',
                true
            );

            wp_localize_script('envato-verification-js', 'envato_verification_vars', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'verifying_text' => __('Verifying...', 'envato-verification'),
                'verify_text' => __('Verify Purchase Code', 'envato-verification'),
                'reset_confirm' => __('Are you sure you want to reset your license?', 'envato-verification')
            ));
        }
    }

    public function add_admin_menu() {
        add_menu_page(
            __('Envato Verification', 'envato-verification'),
            __('Envato Verification', 'envato-verification'),
            'manage_options',
            'envato-verification',
            array($this, 'admin_page_content'),
            'dashicons-lock',
            80
        );
    }

    public function admin_page_content() {
        $verified = get_option($this->option_name, false);
        $purchase_code = get_option($this->purchase_code_option, '');
        $client_data = get_option('envato_client_details', array());
        ?>
        <div class="wrap envato-verification-wrap">
            <h1><?php _e('Envato Purchase Verification', 'envato-verification'); ?></h1>

            <?php if ($verified): ?>
                <div class="notice notice-success">
                    <p><?php _e('Your purchase code has been verified successfully!', 'envato-verification'); ?></p>
                </div>

                <div class="client-details">
                    <h3><?php _e('Client Details', 'envato-verification'); ?></h3>
                    <table class="wp-list-table widefat fixed striped">
                        <tbody>
                            <tr>
                                <th><?php _e('License Status', 'envato-verification'); ?></th>
                                <td>
                                    <span style="display:inline-block;padding:4px 10px;background:#28a745;color:#fff;font-weight:bold;border-radius:4px;">
                                        <?php _e('Active', 'envato-verification'); ?>
                                    </span>
                                </td>
                            </tr>
                            <tr><th><?php _e('Envato Username', 'envato-verification'); ?></th><td><?php echo esc_html($client_data['username']); ?></td></tr>
                            <tr><th><?php _e('Product Name', 'envato-verification'); ?></th><td><?php echo esc_html($client_data['product']); ?></td></tr>
                            <tr><th><?php _e('Support Until', 'envato-verification'); ?></th><td><?php echo !empty($client_data['supported_until']) ? esc_html(date_i18n(get_option('date_format'), strtotime($client_data['supported_until']))) : __('No support information available', 'envato-verification'); ?></td></tr>
                            <tr><th><?php _e('Purchase Date', 'envato-verification'); ?></th><td><?php echo !empty($client_data['sold_at']) ? esc_html(date_i18n(get_option('date_format'), strtotime($client_data['sold_at']))) : ''; ?></td></tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <div class="envato-verification-form">
                <p><?php _e('Please enter your Envato purchase code to verify your license:', 'envato-verification'); ?></p>
                <input type="text" id="envato-purchase-code" class="regular-text" value="<?php echo esc_attr($purchase_code); ?>" placeholder="<?php esc_attr_e('Enter your purchase code', 'envato-verification'); ?>">
                <button id="verify-purchase-code" class="button button-primary"><?php _e('Verify Purchase Code', 'envato-verification'); ?></button>
                <?php if ($verified): ?>
                    <button id="reset-purchase-code" class="button button-secondary"><?php _e('Reset License', 'envato-verification'); ?></button>
                <?php endif; ?>
                <div id="verification-result"></div>
                <p class="description"><?php _e('You can find your purchase code by following', 'envato-verification'); ?> <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php _e('these instructions', 'envato-verification'); ?></a>.</p>
            </div>
        </div>
        <?php
    }

    private function get_envato_token() {
        $cached_token = get_transient('envato_api_token');
        if ($cached_token) return $cached_token;

        $response = wp_remote_post('https://byteflows.net/api-active/envato-api.php', [
            'timeout' => 10,
            'body' => [
                'key' => '2132132101225458'
            ]
        ]);

        if (is_wp_error($response)) return '';

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (!empty($body['token'])) {
            set_transient('envato_api_token', $body['token'], HOUR_IN_SECONDS);
            return $body['token'];
        }
        return '';
    }

    private function activate_license_on_server($purchase_code) {
        $domain = $_SERVER['HTTP_HOST'];

        $response = wp_remote_post($this->license_server_activate_url, [
            'timeout' => 10,
            'body' => [
                'purchase_code' => $purchase_code,
                'domain' => $domain,
            ]
        ]);

        if (is_wp_error($response)) {
            return ['success' => false, 'message' => __('Could not connect to license server.', 'envato-verification')];
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (!$body || !isset($body['success'])) {
            return ['success' => false, 'message' => __('Invalid response from license server.', 'envato-verification')];
        }

        return $body;
    }

    private function reset_license_on_server($purchase_code) {
        if (empty($purchase_code)) return;

        wp_remote_post($this->license_server_reset_url, [
            'timeout' => 10,
            'body' => [
                'purchase_code' => $purchase_code,
            ]
        ]);
    }

    public function verify_purchase_code_ajax() {
        if (empty($_POST['purchase_code'])) {
            wp_send_json_error(['message' => __('Please enter a purchase code', 'envato-verification')]);
        }

        $purchase_code = sanitize_text_field($_POST['purchase_code']);
        $verification = $this->verify_purchase_code($purchase_code);

        if ($verification['success']) {
            $activation = $this->activate_license_on_server($purchase_code);
            if (!$activation['success']) {
                wp_send_json_error(['message' => $activation['message'] ?? __('License activation failed on server.', 'envato-verification')]);
            }

            if ($activation['domain'] !== $_SERVER['HTTP_HOST']) {
                wp_send_json_error(['message' => __('This license is already activated on another website.', 'envato-verification')]);
            }

            update_option($this->option_name, true);
            update_option($this->purchase_code_option, $purchase_code);
            update_option('envato_client_details', $verification['data']);
            wp_send_json_success(['message' => __('Purchase code verified successfully!', 'envato-verification'), 'client_data' => $verification['data']]);
        } else {
            update_option($this->option_name, false);
            wp_send_json_error(['message' => $verification['message']]);
        }
    }

    public function reset_purchase_code_ajax() {
        $purchase_code = get_option($this->purchase_code_option, '');

        if (!empty($purchase_code)) {
            $this->reset_license_on_server($purchase_code);
        }

        delete_option($this->option_name);
        delete_option($this->purchase_code_option);
        delete_option('envato_client_details');
        delete_option('envato_license_last_checked');

        wp_send_json_success(['message' => __('License has been reset. Please enter your purchase code again.', 'envato-verification')]);
    }

    private function verify_purchase_code($purchase_code) {
        $token = $this->get_envato_token();
        if (empty($token)) {
            return ['success' => false, 'message' => __('API token could not be retrieved.', 'envato-verification')];
        }

        $response = wp_remote_get('https://api.envato.com/v3/market/author/sale?code=' . $purchase_code, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'User-Agent' => 'WordPress Envato Purchase Verification'
            ]
        ]);

        if (is_wp_error($response)) {
            return ['success' => false, 'message' => __('Error connecting to Envato API. Please try again later.', 'envato-verification')];
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($body['error'])) {
            return ['success' => false, 'message' => $body['description'] ?? __('Invalid purchase code or API token.', 'envato-verification')];
        }

        if (isset($body['item']['id']) && intval($body['item']['id']) === intval($this->product_id)) {
            return [
                'success' => true,
                'data' => [
                    'username' => $body['buyer'] ?? '',
                    'email' => $body['buyer_email'] ?? '',
                    'product' => $body['item']['name'] ?? '',
                    'supported_until' => $body['supported_until'] ?? '',
                    'purchase_count' => $body['purchase_count'] ?? 1,
                    'sold_at' => $body['sold_at'] ?? ''
                ]
            ];
        }

        return ['success' => false, 'message' => __('This purchase code is not valid for this product.', 'envato-verification')];
    }

    public function check_license_status() {
        $verified = get_option($this->option_name, false);
        $purchase_code = get_option($this->purchase_code_option, '');
        if ($verified && !empty($purchase_code)) {
            $last_checked = get_option('envato_license_last_checked', 0);
            if (time() - $last_checked > WEEK_IN_SECONDS) {
                $verification = $this->verify_purchase_code($purchase_code);
                if (!$verification['success']) update_option($this->option_name, false);
                update_option('envato_license_last_checked', time());
            }
        }
    }

    public function check_license_before_tgmpa($load) {
        if (!get_option($this->option_name, false) && $load) {
            add_action('admin_notices', array($this, 'show_tgmpa_license_notice'));
            return false;
        }
        return $load;
    }

    public function show_tgmpa_license_notice() {
        echo '<div class="notice notice-error" style="
            font-size: 18px; 
            background-color: #ffe5e5; 
            border-left: 6px solid #d63638; 
            padding: 20px; 
            color: #a00;
            font-weight: 700;
            line-height: 1.4;
            box-shadow: 0 2px 8px rgba(214, 54, 56, 0.2);
            border-radius: 4px;
            ">
            <p style="margin:0;">' 
                . __('Kindly verify your Envato purchase code to unlock essential plugin activation and demo content import.', 'envato-verification') 
                . ' <a href="' . admin_url('admin.php?page=envato-verification') . '" style="font-weight: 900; text-decoration: underline; color: #d63638;">' 
                . __('Verify now', 'envato-verification') 
                . '</a></p>
        </div>';
    }

    public function check_license_before_demo_import() {
        if (!get_option($this->option_name, false)) {
            wp_die('<h1>' . __('License Verification Required', 'envato-verification') . '</h1><p>' . __('Please verify your Envato purchase code before importing the demo content.', 'envato-verification') . '</p><p><a href="' . admin_url('admin.php?page=envato-verification') . '" class="button button-primary">' . __('Verify Purchase Code', 'envato-verification') . '</a></p>', __('License Verification Required', 'envato-verification'), ['response' => 403]);
        }
    }

    public function enqueue_ocdi_scripts($hook) {
        if ($hook === 'appearance_page_one-click-demo-import') {
            wp_enqueue_style(
                'envato-ocdi-popup',
                get_template_directory_uri() . '/inc/admin/Activation/assets/css/ocdi-popup.css'
            );
            wp_enqueue_script(
                'envato-ocdi-popup',
                get_template_directory_uri() . '/inc/admin/Activation/assets/js/ocdi-popup.js',
                ['jquery'],
                '1.0',
                true
            );
            wp_localize_script('envato-ocdi-popup', 'envatoVerification', [
                'verified' => get_option($this->option_name, false),
                'verificationUrl' => admin_url('admin.php?page=envato-verification'),
                'ajaxurl' => admin_url('admin-ajax.php')
            ]);
        }
    }

    public function handle_ajax_verification_check() {
        wp_send_json_success(['verified' => get_option($this->option_name, false)]);
    }

    public function add_ocdi_popup_html() {
        $screen = get_current_screen();
        if ($screen->id === 'appearance_page_one-click-demo-import') {
            ?>
            <div id="envato-ocdi-verification-popup" class="envato-ocdi-popup">
                <div class="envato-ocdi-popup-content">
                    <div class="envato-ocdi-popup-header"><h3><?php _e('License Verification Required', 'envato-verification'); ?></h3></div>
                    <div class="envato-ocdi-popup-body"><p><?php _e('To access the demo content, please verify your Envato purchase code.', 'envato-verification'); ?></p></div>
                    <div class="envato-ocdi-popup-footer">
                        <a href="<?php echo admin_url('admin.php?page=envato-verification'); ?>" class="button button-primary envato-ocdi-verify-btn"><?php _e('Verify Purchase Code', 'envato-verification'); ?></a>
                        <button class="button envato-ocdi-popup-close"><?php _e('Maybe Later', 'envato-verification'); ?></button>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public function frontend_license_notice() {
        if (is_admin()) return;

        $verified = get_option($this->option_name, false);

        if (!$verified) {
            echo '<div style="position:fixed;bottom:0;left:0;width:100%;background:#ffebe6;color:#d63638;padding:10px;text-align:center;font-weight:bold;z-index:9999;">
                Your license hasn’t been activated yet. <a href="' . esc_url(admin_url('admin.php?page=envato-verification')) . '" style="color:#d63638;text-decoration:underline;">Activate it now!</a>
            </div>';
        }
    }

}

new Envato_Purchase_Verification();
