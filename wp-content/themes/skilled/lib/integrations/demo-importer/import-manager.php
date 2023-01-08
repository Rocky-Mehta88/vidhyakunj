<?php
require_once( get_template_directory() . '/lib/demo-importer/includes/importer-interface.php' );
require_once( get_template_directory() . '/lib/demo-importer/includes/file-importer.php' );
require_once( get_template_directory() . '/lib/demo-importer/includes/theme-options-importer.php' );
require_once( get_template_directory() . '/lib/demo-importer/includes/xml-importer.php' );
require_once( get_template_directory() . '/lib/demo-importer/includes/layer-slider-importer.php' );
require_once( get_template_directory() . '/lib/demo-importer/includes/menu-importer.php' );
require_once( get_template_directory() . '/lib/demo-importer/includes/widgets-importer.php' );

class Skilled_Import_Manager {

	protected $demo_files_path;

	public function __construct() {

		$this->set_demo_files_path( get_template_directory() . '/lib/demo-importer/demo-files/' );
	}

	public function import_xml( $filename ) {

		$filename = $this->get_full_path( $filename );

		$importer = new Skilled_XML_Importer();
		$importer->set_filename( $filename );
		$importer->import();
	}

	public function import_theme_options( $filename ) {

		$filename = $this->get_full_path( $filename );

		$importer = new Skilled_Theme_Options_Importer();
		$importer->set_filename( $filename );
		$importer->import();
	}

	public function import_layer_slider( $filename ) {

		$filename = $this->get_full_path( $filename );

		$importer = new Skilled_Layer_Slider_Importer();
		$importer->set_filename( $filename );
		$importer->import();
	}

	public function import_widgets( $filename, $delete_current_widgets ) {

		$filename = $this->get_full_path( $filename );

		$importer = new Skilled_Widgets_Importer();
		$importer->set_filename( $filename );
		$importer->set_delete_current_widgets( $delete_current_widgets );
		$importer->import();
	}

	public function import_menus( $menus = array() ) {

		$importer = new Skilled_Menu_Importer();
		$importer->set_menus( $menus );
		$importer->import();
	}

	public function get_full_path( $filename ) {
		return $this->get_demo_files_path() . $filename;
	}

	public function get_demo_files_path() {
		return $this->demo_files_path;
	}

	public function set_demo_files_path( $path ) {
		$this->demo_files_path = $path;
	}

}
