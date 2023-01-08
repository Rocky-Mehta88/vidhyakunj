<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'envato_setup_logo_image', 'skilled_envato_setup_logo_image' );
function skilled_envato_setup_logo_image( $old_image_url ) {
	return get_parent_theme_file_uri( '/lib/integrations/envato_setup/images/aislin.png' );
}

// Will be called from envato_setup.php
function envato_theme_setup_wizard() {

	if ( ! class_exists( 'Envato_Theme_Setup_Wizard' ) ) {
		return;
	}

	class Skilled_Envato_Theme_Setup_Wizard extends Envato_Theme_Setup_Wizard {

		private static $instance = null;

		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

	}

	Skilled_Envato_Theme_Setup_Wizard::get_instance();
}
