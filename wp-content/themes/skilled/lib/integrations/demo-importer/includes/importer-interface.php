<?php

interface Skilled_Importer_Interface {

	public function import();

	public function get_filename();

	public function set_filename( $filename );

}