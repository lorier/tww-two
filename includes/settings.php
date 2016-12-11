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
                        'key' => 'group_5845003950def',
                        'title' => 'TW Weather',
                        'fields' => array (
                            array (
                                'sub_fields' => array (
                                    array (
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'min_width' => 1057,
                                        'min_height' => 403,
                                        'min_size' => '',
                                        'max_width' => 1057,
                                        'max_height' => 403,
                                        'max_size' => '',
                                        'mime_types' => '',
                                        'key' => 'field_5845a0ae45ddb',
                                        'label' => 'Default Image',
                                        'name' => 'default_image',
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
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'min_width' => 1057,
                                        'min_height' => 403,
                                        'min_size' => '',
                                        'max_width' => 1057,
                                        'max_height' => 403,
                                        'max_size' => '',
                                        'mime_types' => '',
                                        'key' => 'field_5845a1261014a',
                                        'label' => 'Rainy Image',
                                        'name' => 'rainy_image',
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
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'min_width' => 1057,
                                        'min_height' => 403,
                                        'min_size' => '',
                                        'max_width' => 1057,
                                        'max_height' => 403,
                                        'max_size' => '',
                                        'mime_types' => '',
                                        'key' => 'field_5845a187b2581',
                                        'label' => 'Foggy Image',
                                        'name' => 'foggy_image',
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
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'min_width' => 1057,
                                        'min_height' => 403,
                                        'min_size' => '',
                                        'max_width' => 1057,
                                        'max_height' => 403,
                                        'max_size' => '',
                                        'mime_types' => '',
                                        'key' => 'field_5845a19bb2582',
                                        'label' => 'Sunny Image',
                                        'name' => 'sunny_image',
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
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'min_width' => 1057,
                                        'min_height' => 403,
                                        'min_size' => '',
                                        'max_width' => 1057,
                                        'max_height' => 403,
                                        'max_size' => '',
                                        'mime_types' => '',
                                        'key' => 'field_5845a1bfb2583',
                                        'label' => 'Windy Image',
                                        'name' => 'windy_image',
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
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'min_width' => 1057,
                                        'min_height' => 403,
                                        'min_size' => '',
                                        'max_width' => 1057,
                                        'max_height' => 403,
                                        'max_size' => '',
                                        'mime_types' => '',
                                        'key' => 'field_5845a1eeb2585',
                                        'label' => 'Snowy Image',
                                        'name' => 'snowy_image',
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
                                'min' => 0,
                                'max' => 0,
                                'layout' => 'table',
                                'button_label' => '',
                                'collapsed' => 'field_584500d224db2',
                                'key' => 'field_5845007d24db1',
                                'label' => 'TW Weather Header Images',
                                'name' => 'tw_weather_header_images',
                                'type' => 'repeater',
                                'instructions' => 'Add header images for Foggy, Rainy, Hazy, Cloudy and Sunny conditions',
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
        } //END public function init

        // public function init()
        // {
        //     if(function_exists('register_field_group'))
        //     {

        //         if( function_exists('acf_add_local_field_group') ){

        //             acf_add_local_field_group(array (
        //                 'key' => 'group_584c678e86570',
        //                 'title' => 'TW Weather (copy)',
        //                 'fields' => array (
        //                     array (
        //                         'return_format' => 'array',
        //                         'preview_size' => 'thumbnail',
        //                         'library' => 'all',
        //                         'min_width' => '',
        //                         'min_height' => '',
        //                         'min_size' => '',
        //                         'max_width' => '',
        //                         'max_height' => '',
        //                         'max_size' => '',
        //                         'mime_types' => '',
        //                         'key' => 'field_584c678e8c139',
        //                         'label' => 'TW Weather Header Single',
        //                         'name' => 'tw_weather_header',
        //                         'type' => 'image',
        //                         'instructions' => 'Add default header image',
        //                         'required' => 0,
        //                         'conditional_logic' => 0,
        //                         'wrapper' => array (
        //                             'width' => '',
        //                             'class' => '',
        //                             'id' => '',
        //                         ),
        //                     ),
        //                 ),
        //                 'location' => array (
        //                     array (
        //                         array (
        //                             'param' => 'options_page',
        //                             'operator' => '==',
        //                             'value' => 'tw_plugin_options',
        //                         ),
        //                     ),
        //                 ),
        //                 'menu_order' => 0,
        //                 'position' => 'acf_after_title',
        //                 'style' => 'default',
        //                 'label_placement' => 'top',
        //                 'instruction_placement' => 'label',
        //                 'hide_on_screen' => '',
        //                 'active' => 1,
        //                 'description' => '',
        //             ));
        //         }
        //     }
        // } //END public function init
    } // END class TW_Weather_Two_Settings
 } // END if(!class_exists('TW_Weather_Two_Settings'))
