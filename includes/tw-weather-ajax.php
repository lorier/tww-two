<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    tw_weather
 * @subpackage tw_weather/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    tw_weather
 * @subpackage tw_weather/includes
 * @author     Your Name <email@example.com>
 */
class TW_Weather_Ajax {

//from Wunderground_Ajax class

	private $cache = true;

	private $response;

	public $image_set = array('test');

	private $acf;

	// private $image_data = new stdClass();

	
	public function __construct(){
		// echo 'From Ajax construct: ';
	}

	public function lr_weather_data() {
		if(!isset($_REQUEST['_wpnonce']) || !wp_verify_nonce($_REQUEST['_wpnonce'], 'lr_wapp_nc')) {
			exit(0);
		}

		wp_create_nonce('lr_wapp_nc');

		$url = 'http://api.openweathermap.org/data/2.5/weather?id=5809844&APPID=b9c8b98edac6dbd2d1d24df4fbad6072&units=imperial' ;
		$response = $this->request_data( $url );
		if(!$this->isJson($response)){
			return;
		}else{
			$conditions = $this->parse_conditions( $response );
			print_r($conditions);	
			// get image data	
			$images = $this->get_images();
			print_r($images);
		}

		//attempted fix for dataTyep:"json" not working. didn't work
		// header( "Content-Type: application/json; charset=utf-8" );

		// exit($response);
		// exit($conditions);
		wp_die($response);
	}

	private function get_images(){
		////// THIS WORKS FOR BRINGING IN ACF DATA ////////////
		$acf = new TW_Weather_Acf;
		$image_set = $acf->tw_get_fields();
		return($image_set);
	}
	//get only the condition we want
	private function parse_conditions( $response = null) {
		$obj = json_decode($response);
		$cond = $obj->weather[0]->id;
	 	echo $cond;
	}

	/**
	 * Fetch a URL and use/store cached result
	 *
	 * - Cached results are stored as transients starting with `lru_`
	 * - Results are stored for twenty minutes.
	 * - The request array itself can be filtered by using the `wunderground_request_atts` filter
	 *
	 * @filter  wunderground_cache_time description
	 * @param  [type]  $url   [description]
	 * @param  boolean $cache [description]
	 * @return [type]         [description]
	 */

	private function request_data($url, $cache = true) {
		// Generate a cache key based on the result. Only get the first 44 characters because of
		// the transient key length limit.
		$cache_key = substr( 'lr_'.sha1($url) , 0, 44 );

		// for dev purposes - quickly remove transient rows from db
		// delete_transient( $cache_key );

		$response = get_transient( $cache_key );

		// for testing - display 'cached' at end of json in console 
		// if(!empty( $response )){
		// 	$response .= 'cached';
		// }

		// If there's no cached result or caching is disabled
		if( empty( $this->cache ) || empty( $response ) ) {		
			/**
			 * Modify the request array. By default, only sets timeout (10 seconds)
			 * @var array
			 */
			$atts = apply_filters( 'lr_wapp_request_atts', array(
				'timeout' => 10
			));
			$request = wp_remote_request( $url , $atts );
			if( is_wp_error( $request ) ) {
				$response = false;
				
			} else {
				$response = wp_remote_retrieve_body( $request );

				/**
				 * Modify the number of seconds to cache the request for.
				 *
				 * Default: cache the request ten minutes, since we're dealing with changing conditions
				 *
				 * @var int
				 */

				$cache_time = 10*MINUTE_IN_SECONDS;
				set_transient( $cache_key, $response, (int)$cache_time );
				
			}
		}
		// $this->display_url_contents($response);
		return stripslashes_deep( $response );
	}
	private function isJson($string) {
		 json_decode($string);
		 return (json_last_error() == JSON_ERROR_NONE);
	}
}
//instantiation not needed for ajax to show up - lr
// new TW_Weather_Ajax();