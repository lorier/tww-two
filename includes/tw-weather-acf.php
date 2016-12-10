<?php

class TW_Weather_Acf {

	public function __construct(){
		# code...
		$this->tw_get_field();
	}
	public function tw_get_field(){
		// echo 'field called';
		// global $post;
		// $my_field = get_field_object('tw_weather_header', 'option');
		// echo $my_field;
		// print_r($my_field);
	}
	// private function tw_get_fields(){
	// 	global $post;
	// 	if( have_rows('tw_weather_header_images', 'option') ):
	// 		while( have_rows('tw_weather_header_images', 'option') ): the_row();
	// 		// echo('has rows');
	// 		// while( have_rows('tw_weather_header_images', 'option') ): the_row(); 		
	// 			$image = get_sub_field('image', 'option') ;
	// 	// 		echo $image;
	// 		endwhile;
	// 	endif; 
		
	// }
}