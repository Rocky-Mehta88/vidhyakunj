<?php

class MSM_Mobile_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 1.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		$plugin_url = MSM_PLUGIN_URL;
		$indent = str_repeat("\t", $depth);
		$output .= "\n<div class=\"respmenu-submenu-toggle cbp-respmenu-more\"><img src=\"{$plugin_url}public/img/angle-arrow-down.png\" alt=\"mobile menu toggle\"></div>\n";
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}
}