<?php
if ( ! function_exists( 'msm_is_built_with_elementor' ) ) {
	function msm_is_built_with_elementor( $mega_menu_id ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			return \Elementor\Plugin::instance()->db->is_built_with_elementor( $mega_menu_id );
		}
		return false;
	}
}

if ( ! function_exists( 'msm_elementor_print_menu' ) ) {
	function msm_elementor_print_menu( $mega_menu_id ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $mega_menu_id );
		}
	}
}
