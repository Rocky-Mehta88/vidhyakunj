<?php
define( 'SKILLED_THEME_OPTION_NAME', 'skilled_options' );
define( 'SKILLED_THEME_NAME', 'skilled' );
define( 'SKILLED_THEME_PLUGIN_NAME', 'skilled-plugin' );
define( 'SKILLED_THEME_PREFIX', 'skilled_' );

/**
 *  Length in words for excerpt_length filter (http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length)
 * This is just theme default value - it is overridden from theme options
 */ 
define( 'POST_EXCERPT_LENGTH', 40 );

add_theme_support( 'title-tag' );

if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

/**
 * Woocommerce Support Declaration
 */
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

/**
 * Force Visual Composer to initialize as "built into the theme". 
 * This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'skilled_vc_set_as_theme' );
function skilled_vc_set_as_theme() {
	vc_set_as_theme( true );
}

/**
 * Mega Menus
 */
add_action( 'msm_filter_use_redux', 'skilled_use_msm_redux' );
function skilled_use_msm_redux() {
	return false;
}
