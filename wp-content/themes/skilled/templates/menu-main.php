<?php
global $post_id;

$theme_location = 'primary_navigation';
$use_custom_menu_location = skilled_get_rwmb_meta( 'use_custom_menu', $post_id );
if ( $use_custom_menu_location ) {
	$custom_menu_location = skilled_get_rwmb_meta( 'custom_menu_location', $post_id );
	if ( ! empty( $custom_menu_location ) ) {
		$theme_location = $custom_menu_location;
	}
}

$defaults = array(
	'theme_location'  => $theme_location,
	'menu_class'      => esc_attr( skilled_class( 'main-menu' ) ),
	'container_class' => esc_attr( skilled_class( 'main-menu-container' ) ),
	'depth'           => 4
);
?>
<div id="cbp-menu-main">
	<?php wp_nav_menu( $defaults ); ?>
</div>
