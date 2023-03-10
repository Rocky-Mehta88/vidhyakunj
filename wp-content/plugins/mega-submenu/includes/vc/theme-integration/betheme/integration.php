<?php
add_action( 'wp_enqueue_scripts', 'msm_integration_style', 11 );

function msm_integration_style() {

	$style = '
	@media (max-width: 900px) {
		.msm-menu-item .msm-submenu {
			width: 100% !important;
		}
		.msm-menu-item > a {
			padding-left: 30px !important;
		}

		.msm-menu-item > a::before {
			content: "+";
			display: block;
			position: absolute;
			right: 15px;
			top: 0;
			width: 44px;
			height: 44px;
			line-height: 44px;
			font-size: 30px;
			font-weight: 300;
			text-align: center;
			cursor: pointer;
			color: #444;
			opacity: 0.33;
		}

		.msm-menu-item.open > a::before {
			content: "-";
		}

	    #msm-mobile-menu .msm-menu-item > a {
		    padding-left: 0 !important;
	    }

		#msm-mobile-menu .msm-menu-item > a::before,
		#msm-mobile-menu .msm-menu-item.open > a::before {
			content: "";
		}
	}';

	wp_add_inline_style( MSM_PLUGIN_SLUG, $style );

}
