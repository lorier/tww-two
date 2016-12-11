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

	// private $image_data = new stdClass();

	
	public function __construct(){
		// add_action( 'wp_ajax_lr_wapp', array(&$this, 'lr_weather_data') ); //The wp_ajax_ hook follows the format "wp_ajax_$youraction", where $youraction is your AJAX request's 'action' property
		// add_action( 'wp_ajax_nopriv_lr_wapp', array(&$this, 'lr_weather_data') ); //handle AJAX requests on the front-end for unauthenticated users

	}

	public function lr_weather_data() {
		if(!isset($_REQUEST['_wpnonce']) || !wp_verify_nonce($_REQUEST['_wpnonce'], 'lr_wapp_nc')) {
			exit(0);
		}

		wp_create_nonce('lr_wapp_nc');

		
		//local for testing
		// $url = add_query_arg( array(
		// 	'query' => urlencode( stripslashes_deep( $_REQUEST['query'] ) ),
		// ), 'http://localhost:3000/weather' );
		// $image_data->"cloudy" = "cloudy url";
		$url = 'http://api.openweathermap.org/data/2.5/weather?id=5809844&APPID=b9c8b98edac6dbd2d1d24df4fbad6072&units=imperial' ;
		// $response = 'bypass the url function';
		$response = $this->request_data( $url );

		$conditions = $this->parse_conditions( $response );
		//attempted fix for dataTyep:"json" not working. didn't work
		// header( "Content-Type: application/json; charset=utf-8" );

		 // exit($response);
		// exit($conditions);
		wp_die($response);
	}

	//get only the condition we want
	private function parse_conditions( $response = null) {
		$obj = json_decode($response);
		$cond = $obj->weather[0]->id;
	 	return $cond;
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
		delete_transient( $cache_key );

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
}

new TW_Weather_Ajax;