<?php

class Skilled_Ultimate_Icons_Importer extends Skilled_File_Importer {

	protected $single_location     = true;

	public function import_db_settings() {

		// db
		$smile_fonts = get_option('smile_fonts');

		if (!isset($smile_fonts['iconsmind'])) {
			$smile_fonts['iconsmind'] = array(
				'include' => 'smile_fonts/iconsmind',
				'folder'  => 'smile_fonts/iconsmind',
				'style'   => 'iconsmind/iconsmind.css',
				'config'  => 'charmap.php',
			);
		}

		if (!isset($smile_fonts['linear'])) {
			$smile_fonts['linear'] = array(
				'include' => 'smile_fonts/linear',
				'folder'  => 'smile_fonts/linear',
				'style'   => 'linear/linear.css',
				'config'  => 'charmap.php',
			);
		}

		update_option('smile_fonts', $smile_fonts);

	}

	public function copy_folder() {

		WP_Filesystem();

		global $wp_filesystem;

		$upload_dir  = wp_upload_dir();
		$destination = $upload_dir['basedir'] . '/smile_fonts/';
		$temp_path   = $this->get_temp_path();

		if (!$temp_path) {
			return false;
		}

		$from = $temp_path . 'smile_fonts';

		$status = copy_dir( $from, $destination );
		if ( is_wp_error( $status ) && ! defined( 'FS_METHOD' ) ) {
			define( 'FS_METHOD', 'direct' ); //lets try direct.

			WP_Filesystem();  //WP_Filesystem() needs to be called again since now we use direct !

			$status = copy_dir( $from, $destination );
		}

		return $status;
	}

	public function cleanup() {
		// override parent
		// do nothing
	}

}
