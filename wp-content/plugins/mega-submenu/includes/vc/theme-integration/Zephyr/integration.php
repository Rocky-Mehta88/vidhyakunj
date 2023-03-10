<?php

add_filter( 'msm_filter_menu_location', 'msm_integration_filter_menu_location' );
function msm_integration_filter_menu_location( $menu_location ) {
	return 'us_main_menu';

}

add_action( 'wp_enqueue_scripts', 'msm_integration_action_custom_script', 11 );

function msm_integration_action_custom_script() {

	$script = "
		jQuery(function ($) {
			customThemeMobileScript();

			$(window).resize(customThemeMobileScript);

			function customThemeMobileScript() {

				const \$body = $('body');
				const \$submenus = $('.msm-submenu');

				if  (\$body.outerWidth() < msm_mega_submenu.data.mobile_menu_trigger_click_bellow) {
					\$submenus.wrap('<ul class=\"w-nav-list level_2\"><li></li></ul>')
						.parents('.msm-top-level-item').addClass('msm-mobile');
				}
			}
		});
	";
	
	wp_add_inline_script( MSM_PLUGIN_SLUG, $script );
}
