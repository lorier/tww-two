<?php
/*
Plugin Name: TW Weather Two
Plugin URI: https://github.com/fyaconiello/wp_plugin_template
Description: A simple wordpress plugin template
Version: 1.0
Author: Francis Yaconiello
Author URI: http://www.yaconiello.com
License: GPL2
*/
/*
Copyright 2012  Francis Yaconiello  (email : francis@yaconiello.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('TW_Weather_Two'))
{
	class TW_Weather_Two
	{
		/**
		 * Construct the plugin object
		 */
		public $tw_ajax;

		public function __construct()
		{

			$plugin = plugin_basename(__FILE__);

			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));

            // Set up ACF
            add_filter('acf/settings/path', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", dirname(__FILE__));
            });
            add_filter('acf/settings/dir', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", plugin_dir_url(__FILE__));
            });
            require_once(sprintf("%s/includes/advanced-custom-fields-pro/acf.php", dirname(__FILE__)));

            // Settings managed via ACF
            require_once(sprintf("%s/includes/settings.php", dirname(__FILE__)));
            $settings = new TW_Weather_Two_Settings($plugin);

            // Ajax 
            require_once(sprintf("%s/includes/tw-weather-ajax.php", dirname(__FILE__)));
            $tw_ajax = new TW_Weather_Ajax();

            // ACF 
            require_once(sprintf("%s/includes/tw-weather-acf.php", dirname(__FILE__)));
            $tw_acf = new TW_Weather_Acf();

            add_action( 'wp_enqueue_scripts', function() { TW_Weather_Two::add_scripts(); } );
			add_action( 'wp_enqueue_scripts', array(&$this, 'localize_scripts' ) );

			add_action( 'wp_ajax_lr_wapp',   array($tw_ajax, 'lr_weather_data')); //The wp_ajax_ hook follows the format "wp_ajax_$youraction", where $youraction is your AJAX request's 'action' property
			add_action( 'wp_ajax_nopriv_lr_wapp',   array($tw_ajax, 'lr_weather_data')); //The wp_ajax_ hook follows the format

		} // END public function __construct
		
		static function add_scripts(){
			wp_enqueue_script('tw-weather', plugin_dir_url( __FILE__) . 'assets/tw_weather.js', array( 'jquery'), true );
		}

		public static function localize_scripts(){
			wp_localize_script( 'tw-weather', 'Wapp', array(
				'_wpnonce' => wp_create_nonce('lr_wapp_nc'),
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'is_admin' => is_admin()
			));
		}
		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_plugin_template">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}
		

	} // END class TW_Weather_Two
} // END if(!class_exists('TW_Weather_Two'))

if(class_exists('TW_Weather_Two'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('TW_Weather_Two', 'activate'));
	register_deactivation_hook(__FILE__, array('TW_Weather_Two', 'deactivate'));

	// instantiate the plugin class
	$plugin = new TW_Weather_Two();

}
