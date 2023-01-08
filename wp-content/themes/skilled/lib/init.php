<?php
add_action( 'after_setup_theme', 'skilled_setup' );

if ( ! function_exists( 'skilled_setup' ) ) {

	function skilled_setup() {

		add_filter( 'skilled_alt_buttons', 'skilled_add_to_alt_button_list' );

		load_theme_textdomain( 'skilled', get_template_directory() . '/languages' );

		skilled_register_nav_menus();

		set_post_thumbnail_size( 150, 150, false );

		skilled_add_image_sizes();

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		
	}
}

function skilled_add_to_alt_button_list( $alt_button_arr ) {
	$alt_button_arr[] = '.yith-wcwl-add-button a';
	return $alt_button_arr;
}
