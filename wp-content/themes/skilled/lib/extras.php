<?php

define( 'SKILLED_RWMB_META_PREFIX', 'wheels_' );

add_action( 'widgets_init', 'skilled_widgets_init' );
add_filter( 'skilled_icon_class', 'skilled_filter_icon_class' );
add_filter( 'skilled_registered_layout_blocks', 'skilled_filter_registered_layout_blocks' );

function skilled_filter_registered_layout_blocks( $layout_blocks ) {
	$layout_blocks[] = 'top-bar-layout-block';

	return $layout_blocks;
}

function skilled_add_image_sizes() {
	add_image_size( 'wh-big', 1140, 500, true );
	add_image_size( 'wh-featured-image', 848, 548, true );
	add_image_size( 'wh-medium', 768, 496, true );
	add_image_size( 'wh-square', 768, 768, true );
	add_image_size( 'wh-thumb-third', 296, 216, true );
	add_image_size( 'wh-thumb-fourth', 260, 190, true );
	add_image_size( 'wh-course-search-thumb', 260, 170, true );
}

function skilled_enqueue_third_party_styles() {
	wp_enqueue_style( 'groundwork-grid', get_template_directory_uri() . '/assets/css/groundwork-responsive.css', false );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false );
	wp_enqueue_style( 'js_composer_front' );
}

function skilled_enqueue_third_party_scripts() {
	wp_enqueue_style( 'iconsmind-line-icons', get_template_directory_uri() . '/assets/css/iconsmind-line-icons.css', false );
	wp_enqueue_style( 'linear-icons', get_template_directory_uri() . '/assets/css/linear-icons.css', false );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', array(), null, false );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/plugins/fitvids.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/assets/js/plugins/superfish.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'hoverintent', get_template_directory_uri() . '/assets/js/plugins/hoverintent.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'scrollup', get_template_directory_uri() . '/assets/js/plugins/scrollup.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/js/plugins/jquery.sticky.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'natural-width-height', get_template_directory_uri() . '/assets/js/plugins/natural-width-height.js', array( 'jquery' ), null, true );
}

function skilled_enqueue_default_fonts() {
	wp_enqueue_style( 'skilled-fonts', "//fonts.googleapis.com/css?family=Raleway:400,600,800", false );
	wp_enqueue_style( SKILLED_THEME_OPTION_NAME . '_style', get_template_directory_uri() . '/assets/css/wheels_options_style.css', false );
}

function skilled_filter_icon_class( $namespace ) {
	$map = array(
		'user'               => 'fa fa-user',
		'folder'             => 'fa fa-folder',
		'tag'                => 'theme-icon-star',
		'comments'           => 'fa fa-comment',
		'cart'               => 'fa fa-shopping-cart',
		'shopping_bag'       => 'icon-square-hand-bag',
		'calendar'           => 'fa fa-calendar',
		'post_list_calendar' => 'icon-Calendar-New',
		'bars'               => 'icon-skilledmenu',
		'close'              => 'icon-skilledcross-1',
		'previous_post_link' => 'icon-long-arrow-left',
		'next_post_link'     => 'icon-long-arrow-right',
		'facebook'           => 'fa fa-facebook',
		'twitter'            => 'fa fa-twitter',
		'google-plus'        => 'fa fa-google-plus',
		'pinterest'          => 'fa fa-pinterest',
		'linkedin'           => 'fa fa-linkedin',
		'check'              => 'theme-icon-checked',
		'search'             => 'icon-loupe-vert',
		'arrow_down'         => 'fa fa-angle-down',
	);
	if ( array_key_exists( $namespace, $map ) ) {
		return $map[$namespace];
	}
	return $namespace;
}

function skilled_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary', 'skilled' ),
		'id'            => 'wheels-sidebar-primary',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5><hr />',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'skilled' ),
		'id'            => 'wheels-sidebar-footer',
		'before_widget' => '<div class="widget %1$s %2$s ' . skilled_class( 'widget-footer' ) . '">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Courses', 'skilled' ),
		'id'            => 'wheels-sidebar-courses',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}

function skilled_register_nav_menus() {

	register_nav_menus( array(
		'primary_navigation' => esc_html__( 'Primary Navigation', 'skilled' ),
	) );
	register_nav_menus( array(
		'secondary_navigation' => esc_html__( 'Secondary Navigation', 'skilled' ),
	) );
	register_nav_menus( array(
		'top_navigation' => esc_html__( 'Top Navigation', 'skilled' ),
	) );
	register_nav_menus( array(
		'mobile_navigation' => esc_html__( 'Mobile Navigation', 'skilled' ),
	) );
	register_nav_menus( array(
		'quick_sidebar_navigation' => esc_html__( 'Quick Sidebar Navigation', 'skilled' ),
	) );
	register_nav_menus( array(
		'one_page_navigation_1' => esc_html__( 'One Page Navigation 1', 'skilled' ),
	) );
	register_nav_menus( array(
		'one_page_navigation_2' => esc_html__( 'One Page Navigation 2', 'skilled' ),
	) );
	register_nav_menus( array(
		'one_page_navigation_3' => esc_html__( 'One Page Navigation 3', 'skilled' ),
	) );
}
