<?php

class TW_Weather_Acf {

	// public $acf_images = array('test');

	public function __construct(){
		// get repeater
		// add_action('init', array(&$this, 'tw_get_fields') );
		// echo 'TW_Weather_Acf is run';
		// $this->acf_images = $this->tw_get_fields();
	}

	//repeater
	public function tw_get_fields(){
		
		$image_set = array();
		
		$images = array();
		
		if( have_rows('tw_weather_header_images', 'option') ):
			while( have_rows('tw_weather_header_images', 'option') ): the_row();
				// echo('has rows');

				$row = get_row(true);
				// print_r($row);

				$key = key($row); //'default_image'
				echo $key;

				$sub_field = $row[$key];
				// print_r( $val ); //key value pairs of each subfield

				$url = $sub_field['url']; // url of the image
				// echo $url;

				$image_set[$key] = $url;

			endwhile;
		endif; 
		return $image_set;
	}
}