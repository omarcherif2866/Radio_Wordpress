<?php 

/**
 * Bookmark Ajax Call
 *
 * @return void
 */
function handle_bookmark() {
    check_ajax_referer('bookmark_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error('User not logged in');
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    $bookmarks = get_user_meta($user_id, 'user_bookmarks', true);

    if (!$bookmarks) {
        $bookmarks = array();
    }

    if (in_array($post_id, $bookmarks)) {
        $bookmarks = array_diff($bookmarks, array($post_id));
        update_user_meta($user_id, 'user_bookmarks', $bookmarks);
        wp_send_json_success('Bookmark removed');
    } else {
        $bookmarks[] = $post_id;
        update_user_meta($user_id, 'user_bookmarks', $bookmarks);
        wp_send_json_success('Bookmark added');
    }
    
}
add_action('wp_ajax_handle_bookmark', 'handle_bookmark');
add_action('wp_ajax_nopriv_handle_bookmark', 'handle_bookmark');



/**
 * Bookmark Trigger
 *
 * @return void
 */
function empath_bookmark_trigger(){
    $user_id = get_current_user_id();
    $bookmarks = get_user_meta($user_id, 'user_bookmarks', true);
    $bookmarked = is_array($bookmarks) && in_array(get_the_ID(), $bookmarks);
    ?>
    <div class="bytf__bookmark">
        <span class="bookmark-trigger bookmark-icon <?php echo esc_attr($bookmarked) ? 'bookmarked' : ''; ?>" data-post-id="<?php the_ID(); ?>"><i class="far fa-bookmark"></i></span>
    </div>
    <?php
}

/**
 * Bookmark Count Hendle
 *
 * @return void
 */
function get_bookmark_count() {
    check_ajax_referer('bookmark_nonce', 'nonce');

    $bookmarks = isset($_COOKIE['bookmarks']) ? json_decode(stripslashes($_COOKIE['bookmarks']), true) : array();
    $count = count($bookmarks);

    wp_send_json_success(array('count' => $count));
}

add_action('wp_ajax_get_bookmark_count', 'get_bookmark_count');
add_action('wp_ajax_nopriv_get_bookmark_count', 'get_bookmark_count');


