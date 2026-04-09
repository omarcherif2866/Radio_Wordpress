<?php
include_once( get_template_directory() . '/inc/admin/demo-import/codestar.php');
function empath_ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => 'Main Demo',
			'categories'                   => array( 'News' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/main/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/main/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/main/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/main/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.png',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://themeunique.com/wp/empath',
		),
		array(
			'import_file_name'             => 'Modern Minimal',
			'categories'                   => array( 'Magazines' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/minimal-magazine/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/minimal-magazine/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/minimal-magazine/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/minimal-magazine/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/magazine-minimal.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast/magazine/',
		),
		array(
			'import_file_name'             => 'Modern Magazines',
			'categories'                   => array( 'Magazines' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/modern-magazine/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/modern-magazine/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/modern-magazine/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/modern-magazine/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/magazine-demo.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/',
		),
		array(
			'import_file_name'             => 'Newspaper Classic',
			'categories'                   => array( 'News' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-classic/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-classic/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-classic/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-classic/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/newspaper.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/newspaper/',
		),
		array(
			'import_file_name'             => 'Fashion,Travel Magazine',
			'categories'                   => array( 'Magazine' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/magazine-26/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/magazine-26/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/magazine-26/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/magazine-26/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/fashion.png',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/magazine-26/',
		),
		array(
			'import_file_name'             => 'Sports',
			'categories'                   => array( 'Sports' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/sports.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/sports/',
		),
		array(
			'import_file_name'             => 'Movies',
			'categories'                   => array( 'Movie' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/movies/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/movies/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/movies/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/movies/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/movie.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/movie/',
		),
		array(
			'import_file_name'             => 'Helth',
			'categories'                   => array( 'Helth' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/helth/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/helth/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/helth/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/helth/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/helth.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/helth/',
		),
		array(
			'import_file_name'             => 'Magazines Classic',
			'categories'                   => array( 'Magazines' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/classic-magazine/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/classic-magazine/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/classic-magazine/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/classic-magazine/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/default-demo.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/',
		),
		array(
			'import_file_name'             => 'News Main RTL',
			'categories'                   => array( 'RTL' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-main-rtl/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-main-rtl/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-main-rtl/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-main-rtl/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/nmain-rtl.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/news-main-rtl/',
		),
		array(
			'import_file_name'             => 'Magazines RTL',
			'categories'                   => array( 'RTL' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/mz-rtl/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/mz-rtl/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/mz-rtl/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/mz-rtl/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/main-rtl.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/magazine-rtl/',
		),
		array(
			'import_file_name'             => 'News RTL',
			'categories'                   => array( 'RTL' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-rtl/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-rtl/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-rtl/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/news-rtl/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/news-rtl.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/news-rtl/',
		),
		array(
			'import_file_name'             => 'Sports RTL',
			'categories'                   => array( 'RTL' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports-rtl/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports-rtl/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports-rtl/customizer.dat',
			'local_import_json'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/demo-import/demo-content/sports-rtl/codestar.json',
					'option_name' => 'forcast',
				),
			),
			'import_preview_image_url'     => 'https://byteflows.net/wp/forcast-demo/assets/img/landing/intro/landings/sports-rtl.jpg',
			'import_notice'                => esc_html__( 'Import process may take 3-10 minutes. If you facing any issues please contact our support.After Import Succesfuly go to Appearance->Menu And Set your Menu', 'forcast' ),
			'preview_url'                  => 'https://byteflows.net/wp/forcast-main/wp/sports-rtl/',
		)
		
	);
}
add_filter( 'pt-ocdi/import_files', 'empath_ocdi_import_files' );

function empath_ocdi_after_import( $selected_import ) {

	// Assign empath menus to their locations where will be display.
    $primary  = get_term_by( 'name', 'Primary', 'nav_menu' );

    set_theme_mod( 
        'nav_menu_locations', 
        array( 
            'menu-1' => $primary->term_id,
        ) 
    );
	// empath Assign front page and posts page Set
	$front_page_id	= get_page_by_title( 'Home' );

	$blog_page_id	= get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
	update_option('elementor_experiment-e_font_icon_svg' , 'inactive');
}
add_action( 'pt-ocdi/after_import', 'empath_ocdi_after_import' );

function empath_ocdi_before_content_import() {
    add_filter( 'wp_import_post_data_processed', 'empath_ocdi_wp_import_post_data_processed', 99, 2 );
}
add_action( 'pt-ocdi/before_content_import', 'empath_ocdi_before_content_import', 99 );

function empath_ocdi_wp_import_post_data_processed( $postdata, $data ) {
    return wp_slash( $postdata );
}

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


function ocdi_plugin_intro_text( $default_text ) {

	function xriver_let_to_num( $size ) {
		$l = substr( $size, -1 );
		$ret = substr( $size, 0, -1 );
		switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
		}
		return $ret;
	}
	$ssl_check = 'https' === substr( get_home_url(), 0, 5 );
	$green_mark = '<mark class="green"><span class="dashicons dashicons-yes"></span></mark>';

	$tatheme = wp_get_theme();

	$plugins_counts = (array) get_option( 'active_plugins', [] );

	if ( is_multisite() ) {
		$network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', [] ) );
		$plugins_counts = array_merge( $plugins_counts, $network_activated_plugins );
	}

	$default_text = '';

	$default_text .= '
	<div class="demo__ip-notice">
<table class="system-status-table">
	<h1>'.esc_html__('Attention: Prior to proceeding with the demo import, verify that your server satisfies all the required conditions (highlighted in green) needed for theme installation.', 'forcast').'</h1>
	<p class="error">'.esc_html__('If any of the option is under red mark, please contact your hosting provider and ask them to change it as recommended.', 'forcast').'</p>
	<tbody>
	<tr>
	<td>' . esc_html__("WP Version", "forcast") . '</td>
	<td>
	' . esc_html($GLOBALS['wp_version']) . '
	<mark class="green">- We recommend using WordPress version 5.1 or above for greater performance and security.</mark></td>
	</tr>
	<tr>
	<td>' . esc_html__("Language", "forcast") . '</td>
	<td>' . get_locale() . '</td>
	</tr>
	<tr>
	<td>' . esc_html__("WP Memory Limit", "forcast") . '</td>
	<td>';

		$memory = xriver_let_to_num(WP_MEMORY_LIMIT);
		if ($memory < 100663296) {
			$default_text .= '
			<mark class="error">' . sprintf(esc_html__('%s - We recommend setting memory to at least 96MB. %s.', "forcast"), size_format($memory), '
				<a href="' . esc_url('//www.wpbeginner.com/wp-tutorials/fix-wordpress-memory-exhausted-error-increase-php-memory/') . '" target="_blank">' . esc_html__('More info', "forcast") . '</a>') . '
			</mark>';
		} else {
			$default_text .= '
			<mark class="green">' . size_format($memory) . '</mark>';
		}

		$default_text .= '
			</td>
		</tr>
		<tr>
			<td>' . esc_html__('PHP Max Input Vars', "forcast") . '</td>
			<td>';

		$max_input = ini_get('max_input_vars');
		if ($max_input < 3000) {
			$default_text .= '
			<mark class="error">' . sprintf(wp_kses(__( '%s - We recommend setting PHP max_input_vars to at least 3000. See:
				<a href="%s" target="_blank">Increasing the PHP max vars limit</a>', "forcast"), ['a' => ['href' => [], 'target' => []]]), $max_input, 'https://jannah.helpscoutdocs.com/article/7-how-to-increase-the-php-max-input-vars') . '
			</mark>';
		} else {
			$default_text .= '
			<mark class="green">' . $max_input . '</mark>';
		}

		$default_text .= ' </td>
		</tr>
		<tr>
			<td>' . esc_html__('PHP Version', "forcast") . ' </td>
			<td>';

		$mayo_php = phpversion();
		if (version_compare($mayo_php, '7.2', '<')) {
			$default_text .= sprintf('
			<mark class="error"> %s </mark> - We recommend using PHP version 7.2 or above for greater performance and security.', esc_html($mayo_php), '');
		} else {
			$default_text .= '
			<mark class="green">' . esc_html($mayo_php) . '</mark>';
		}

		$default_text .= ' </td>
		</tr>
		<tr>
			<td>' . esc_html__('Secure Connection(HTTPS)', "forcast") . ' </td>
			<td>' . (esc_attr($ssl_check) ? $green_mark : '<mark class="error">Your site is not using a secure connection (HTTPS).</mark>') . '</td>
		</tr>
		</tbody>
	</table>
	</div> ';

	return $default_text;

}
add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );