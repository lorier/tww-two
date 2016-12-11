<?php

class TW_Weather_Acf {

	private $image_set = array();

	public function __construct($plugin){
		# code...
		//single
		// add_action('init', array(&$this, 'tw_get_field') );

		//repeater
		add_action('init', array(&$this, 'tw_get_fields') );
	}

	//single image
	public function tw_get_field($plugin){

		global $wp_query;
		if(get_field('tw_weather_header', 'option')){
			$my_field = get_field('tw_weather_header','option');
			echo $my_field['url'];
		}else{ 
			return 'no url';
		}
	}
	//repeater
	public function tw_get_fields($plugin){
		global $post;
		$images = array();
		if( have_rows('tw_weather_header_images', 'option') ):
			while( have_rows('tw_weather_header_images', 'option') ): the_row();
				// echo('has rows');

				$row = get_row(true);
				// print_r($row);

				$key = key($row); //'default_image'
				// echo $key;

				$sub_field = $row[$key];
				// print_r( $val ); //key value pairs of each subfield

				$url = $sub_field['url']; // url of the image
				// echo $url;

				$image_set[$key] = $url;

			endwhile;
		endif; 
		print_r($image_set);
	}
	// private function get_acf_rows($row){
	// 	$image_obj = get_sub_field($row->name, true) ;
	// 	// print_r($image_obj);
	// 			$key = 'default_image';
	// 			$val = $image_obj['url'];
	// 			$images[$key] = $val;
	// }
}

//$data[$key] = $value;
