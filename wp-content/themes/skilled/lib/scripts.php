<?php
add_action( 'wp_enqueue_scripts', 'skilled_scripts', 100 );
add_action( 'wp_enqueue_scripts', 'skilled_add_compiled_style', 999 );

function skilled_scripts() {
	skilled_enqueue_third_party_styles();
	wp_enqueue_style( 'skilled-theme-icons', get_template_directory_uri() . '/assets/css/theme-icons.css', false );
	wp_enqueue_style( 'skilled-style', get_stylesheet_uri(), false );

	wp_add_inline_style( 'skilled-style', skilled_responsive_menu_scripts() );

	if ( function_exists( 'is_rtl' ) && is_rtl() ) {
		wp_enqueue_style( 'skilled_rtl', get_template_directory_uri() . '/assets/css/rtl.css', false );
	}

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	skilled_enqueue_third_party_scripts();
	wp_localize_script( 'jquery-migrate', 'wheels', skilled_set_js_global_var() );
	wp_enqueue_script( 'skilled-scripts', get_template_directory_uri() . '/assets/js/wheels-main.min.js', array( 'jquery' ), null, true );
}

if ( ! function_exists( 'skilled_add_compiled_style' ) ) {

	function skilled_add_compiled_style() {
		$opt_name   = SKILLED_THEME_OPTION_NAME;
		$upload_dir = wp_upload_dir();

		if ( class_exists( 'Redux' ) && file_exists( $upload_dir['basedir'] . '/' . $opt_name . '_style.css' ) ) {
			$upload_url = $upload_dir['baseurl'];
			if ( strpos( $upload_url, 'https' ) !== false ) {
				$upload_url = str_replace( 'https:', '', $upload_url );
			} else {
				$upload_url = str_replace( 'http:', '', $upload_url );
			}
			wp_enqueue_style( "{$opt_name}_style", "{$upload_url}/{$opt_name}_style.css", false );
		} else {
			skilled_enqueue_default_fonts();
		}

		wp_add_inline_style( $opt_name . '_style', skilled_custom_css() );

		if ( function_exists( 'skilled_get_layout_blocks_css' ) ) {
			wp_add_inline_style( $opt_name . '_style', skilled_get_layout_blocks_css() );
		}
		if ( function_exists( 'skilled_get_vc_default_post_css' ) ) {
			wp_add_inline_style( $opt_name . '_style', skilled_get_vc_default_post_css() );
		}
	}
}

function skilled_set_js_global_var() {
	return array(
		'siteName' => get_bloginfo( 'name', 'display' ),
		'data'     => array(
			'useScrollToTop'                    => filter_var( skilled_get_option( 'use-scroll-to-top', false ), FILTER_VALIDATE_BOOLEAN ),
			'useStickyMenu'                     => (bool) skilled_is_sticky_menu_enabled(),
			'scrollToTopText'                   => esc_html( skilled_get_option( 'scroll-to-top-text', '' ) ),
			'isAdminBarShowing'                 => is_admin_bar_showing() ? true : false,
			'initialWaypointScrollCompensation' => skilled_get_option( 'main-menu-initial-waypoint-compensation', 120 ),
			'preloaderSpinner'                  => (int) skilled_get_option( 'preloader', 0 ),
			'preloaderBgColor'                  => skilled_get_option( 'preloader-bg-color', '#304ffe' ),
		)
	);
}
