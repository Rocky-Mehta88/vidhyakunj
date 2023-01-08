<?php
if ( ! class_exists( 'Redux' ) ) {
	return;
}

// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
add_filter( 'redux/options/' . SKILLED_THEME_OPTION_NAME . '/compiler', 'skilled_compiler_action', 10, 3 );

function skilled_compiler_action( $options, $css, $changed_values ) {

	if ( isset( $changed_values['logo'] ) && function_exists( 'skilled_set_custom_logo_from_theme_options' ) ) {
		// changed array holds previous values
		// we need to use $options
		skilled_set_custom_logo_from_theme_options( $options['logo'] );
	}

	global $wp_filesystem;
    if ( ! $wp_filesystem ) {
        if ( ! WP_Filesystem() ) {
        	return;
        }
    }

	$upload_dir = wp_upload_dir();

	if ( ! is_writable( $upload_dir['basedir'] ) ) {
		wp_die( esc_html__( "It looks like your upload folder isn't writable, so PHP couldn't make any changes (CHMOD).", 'skilled' ), esc_html__( 'Cannot write to file', 'skilled' ), array( 'back_link' => true ) );
	}

	$filename   = $upload_dir['basedir'] . '/' . SKILLED_THEME_OPTION_NAME . '_style.css';
	$filename   = apply_filters( 'wheels_redux_compiler_filename', $filename );

	$filecontent = "/********* Compiled file/Do not edit *********/\n";
	$filecontent .= $css;

	// Global accent color
	$option_name = 'global-accent-color';
	if (isset($options[$option_name]) && isset($options[$option_name])) {
		$filecontent .= '.lin-vc-separator:before,';
		$filecontent .= '.social .scp-icon,';
		$filecontent .= '.lin-teacher-icons .scp-icon,';
		$filecontent .= '.single-course .modules-and-lessons h2:after';
		$filecontent .= '{background-color:' . $options[$option_name] . ';}';

		$filecontent .= '.scp-teachers .teacher .job-title,';
		$filecontent .= '.linp-featured-courses-carousel .course-title a:hover,';
		$filecontent .= '{color:' . $options[$option_name] . ';}';

		$filecontent .= '.lin-heading-separator .uvc-headings-line';
		$filecontent .= '{border-color:' . $options[$option_name] . ' !important;}';

		$filecontent .= '.wh-footer .widget ul li:before';
		$filecontent .= '{border-color:transparent transparent transparent ' . $options[$option_name] . '}';

		$filecontent .= '.vc_grid-pagination .vc_grid-pagination-list.vc_grid-pagination-color-orange>li>a, .vc_grid-pagination .vc_grid-pagination-list.vc_grid-pagination-color-orange>li>span';
		$filecontent .= '{';
		$filecontent .= 'background-color:' . $options[$option_name] . ' !important;';
		$filecontent .= 'border-color:' . $options[$option_name] . ' !important;';
		$filecontent .= '}';
	}

	// Comment hr color
	$option_name = 'content-hr';
	if (isset($options[$option_name]) && isset($options[$option_name]['border-color'])) {
		$filecontent .= '.comment-list .comment hr{border-top-color:' . $options[$option_name]['border-color'] . ';}';
	}

	// Blockquote border color
	$option_name = 'body-link-color';
	if (isset($options[$option_name]) && isset($options[$option_name]['regular'])) {
		$filecontent .= 'blockquote{border-left-color:' . $options[$option_name]['regular'] . ';}';
		$filecontent .= '.sf-menu.wh-menu-main .sub-menu{border-top:2px solid ' . $options[$option_name]['regular'] . ';}';
	}

	// Sensei Carousel Ribbon Border
	$option_name = 'linp-featured-courses-item-price-bg-color';
	if (isset($options[$option_name])) {
		$filecontent .= '.linp-featured-courses-carousel .owl-item .price .course-price:before{border-color: ' . $options[$option_name] . ' ' . $options[$option_name] . ' ' . $options[$option_name] . ' transparent;}';
		$filecontent .= '.course-container article.course .course-price:after{border-color: ' . $options[$option_name] . ' transparent ' . $options[$option_name] . ' ' .  $options[$option_name] . ';}';
	}
	// Sensei Carousel Ribbon Back Bg Color
	$option_name = 'linp-featured-courses-item-ribbon-back-bg-color';
	if (isset($options[$option_name])) {
		$filecontent .= '.linp-featured-courses-carousel .owl-item .price .course-price:after{border-color: ' . $options[$option_name] . ' transparent transparent' . $options[$option_name] . ';}';
		$filecontent .= '.course-container article.course .course-price:before{border-color: ' . $options[$option_name] . $options[$option_name] . ' transparent transparent;}';
	}
	// Sensei Carousel Item Border Color
	$option_name = 'linp-featured-courses-item-border-color';
	if (isset($options[$option_name])) {
		$filecontent .= '.linp-featured-courses-carousel .owl-item > div{border:1px solid ' . $options[$option_name] . ';}';
		$filecontent .= '.linp-featured-courses-carousel .owl-item .cbp-row{border-top:1px solid ' . $options[$option_name] . ';}';
	}
	
	// Other Settings Vars
	 $option_name = 'other-settings-vars';
	 if (isset($options[$option_name])) {
		$scssphp_filepath = WP_PLUGIN_DIR . '/' . SKILLED_THEME_PLUGIN_NAME .'/extensions/scssphp/scss.inc.php';
		
		 if (version_compare(phpversion(), '5.3.10', '>=') && file_exists( $scssphp_filepath ) ) {

			 $result = '';

			 $buffer = $wp_filesystem->get_contents( get_template_directory() . '/lib/integrations/redux/css/other-settings/vars.scss' );

			 $buffer = skilled_strip_comments( $buffer );
			 $lines = '';
			 if ( $buffer ) {
				 $lines  = explode( ';', $buffer );
			 }

			 $default_vars = array();
			 foreach ( $lines as $line ) {

				 $line = explode( ':', $line );
				 $key  = isset( $line[0] ) ? trim( str_replace( '$', '', $line[0] ) ) : false;

				 if ( $key ) {
					 $default_vars[ $key ] = trim( $line[1] );
				 }

			 }

			 require_once $scssphp_filepath;

			 try {
				 $scss = new Leafo\ScssPhp\Compiler();
				 $scss->setImportPaths(get_template_directory() . '/lib/integrations/redux/css');
				 // set default variables
				 $scss->setVariables($default_vars);
				 $scss->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
				 // new line is needed at the end of the string to properly remove single line comments
				 // because this is a string and not a file
				 $data = skilled_strip_comments( $options[$option_name] . "\n" );
				 $data .= '@import "other-settings/main.scss";';
				 $result =  $scss->compile($data);

			 } catch (Exception $e) {

				 // if it fails to compile with user settings
				 // try with default settings
				 try {
					 $scss = new Leafo\ScssPhp\Compiler();
					 $scss->setImportPaths(get_template_directory() . '/lib/integrations/redux/css');
					 $scss->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
					 $data = '@import "other-settings/vars.scss";';
					 $data .= '@import "other-settings/main.scss";';
					 $result =  $scss->compile($data);
				 } catch (Exception $e) {

				 }
			 }
			 $filecontent .= $result;
		 }
	 }

	$filecontent = apply_filters( 'skilled_filter_custom_css_content', $filecontent, $options );
	$wp_filesystem->put_contents( $filename, $filecontent );
}