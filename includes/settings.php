<?php
if( !class_exists('TW_Weather_Two_Settings') ) {
	class TW_Weather_Two_Settings {

        const SLUG = 'tw_plugin_options';

		public function __construct($plugin)
		{
			// register actions
            add_action('init', array(&$this, 'init'));
            add_action('admin_menu', array(&$this, 'add_menu'));
            add_filter("plugin_action_links_$plugin", array(&$this, 'plugin_settings_link'));
            // register actions
            
            acf_add_options_page(array(
                'page_title' => __('TW Weather Header', 'tw_weather_header'),
                'menu_title' => __('TW Weather Header', 'tw_weather_header'),
                'menu_slug' => self::SLUG,
                'capability' => 'manage_options',
                'redirect' => false
            ));


		} // END public function __construct
		
        public function settings_section_wp_plugin_template()
        {
            // Think of this as help text for the section.
            echo 'These settings do things for the TW Weather Two.';
        }
        
        public function plugin_settings_link($links)
        { 
            $settings_link = sprintf('<a href="admin.php?page=%s">Settings</a>', self::SLUG); 
            array_unshift($links, $settings_link); 
            return $links; 
        } // END public function plugin_settings_link($links)
        
        public function add_menu()
        { 
            // Duplicate link into properties mgmt
            add_submenu_page(
                self::SLUG,
                __('Settings', 'tw_weather_header'),
                __('Settings', 'tw_weather_header'),
                'manage_options',
                self::SLUG,
                1
            );
        } // END public function add_menu()


        public function init()
        {
            if(function_exists('register_field_group'))
            {
                if( function_exists('acf_add_local_field_group') ):

                    acf_add_local_field_group(array (
                        'key' => 'group_58516a9c32f32',
                        'title' => 'TW Weather Header',
                        'fields' => array (
                            array (
                                'return_format' => 'url',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 1057,
                                'min_height' => 403,
                                'min_size' => '',
                                'max_width' => 1057,
                                'max_height' => 403,
                                'max_size' => '',
                                'mime_types' => '',
                                'key' => 'field_58516b213919f',
                                'label' => 'Default',
                                'name' => 'default',
                                'type' => 'image',
                                'instructions' => 'Upload an image that is exactly 1057px by 403px. This is the image that will appear if there is an error retrieving current weather conditions.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array (
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                            array (
                                'return_format' => 'url',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 1057,
                                'min_height' => 403,
                                'min_size' => '',
                                'max_width' => 1057,
                                'max_height' => 403,
                                'max_size' => '',
                                'mime_types' => '',
                                'key' => 'field_58516b6558ad9',
                                'label' => 'Rainy',
                                'name' => 'rainy',
                                'type' => 'image',
                                'instructions' => 'Upload an image that is exactly 1057px by 403px.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array (
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                            array (
                                'return_format' => 'url',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 1057,
                                'min_height' => 403,
                                'min_size' => '',
                                'max_width' => 1057,
                                'max_height' => 403,
                                'max_size' => '',
                                'mime_types' => '',
                                'key' => 'field_58516b8458ada',
                                'label' => 'Sunny',
                                'name' => 'sunny',
                                'type' => 'image',
                                'instructions' => 'Upload an image that is exactly 1057px by 403px.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array (
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                            array (
                                'return_format' => 'url',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 1057,
                                'min_height' => 403,
                                'min_size' => '',
                                'max_width' => 1057,
                                'max_height' => 403,
                                'max_size' => '',
                                'mime_types' => '',
                                'key' => 'field_58516b9158adb',
                                'label' => 'Windy',
                                'name' => 'windy',
                                'type' => 'image',
                                'instructions' => 'Upload an image that is exactly 1057px by 403px.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array (
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                            array (
                                'return_format' => 'url',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 1057,
                                'min_height' => 403,
                                'min_size' => '',
                                'max_width' => 1057,
                                'max_height' => 403,
                                'max_size' => '',
                                'mime_types' => '',
                                'key' => 'field_58516ba058adc',
                                'label' => 'Snowy',
                                'name' => 'snowy',
                                'type' => 'image',
                                'instructions' => 'Upload an image that is exactly 1057px by 403px.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array (
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                            array (
                                'return_format' => 'url',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 1057,
                                'min_height' => 403,
                                'min_size' => '',
                                'max_width' => 1057,
                                'max_height' => 403,
                                'max_size' => '',
                                'mime_types' => '',
                                'key' => 'field_58517308d220f',
                                'label' => 'Foggy or Hazy',
                                'name' => 'hazy',
                                'type' => 'image',
                                'instructions' => 'Upload an image that is exactly 1057px by 403px.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array (
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                            array (
                                'return_format' => 'url',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 1057,
                                'min_height' => 403,
                                'min_size' => '',
                                'max_width' => 1057,
                                'max_height' => 403,
                                'max_size' => '',
                                'mime_types' => '',
                                'key' => 'field_58517308d2288',
                                'label' => 'Cloudy',
                                'name' => 'cloudy',
                                'type' => 'image',
                                'instructions' => 'Upload an image that is exactly 1057px by 403px.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array (
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                        ),
                        'location' => array (
                            array (
                                array (
                                    'param' => 'options_page',
                                    'operator' => '==',
                                    'value' => 'tw_plugin_options',
                                ),
                            ),
                        ),
                        'menu_order' => 0,
                        'position' => 'acf_after_title',
                        'style' => 'default',
                        'label_placement' => 'top',
                        'instruction_placement' => 'label',
                        'hide_on_screen' => '',
                        'active' => 1,
                        'description' => '',
                    ));

                    endif;
            }
        }

    } // END class TW_Weather_Two_Settings
 } // END if(!class_exists('TW_Weather_Two_Settings'))
