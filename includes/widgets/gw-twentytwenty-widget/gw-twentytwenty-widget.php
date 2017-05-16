<?php

/*
Widget Name: TwentyTwenty Widget (Gutwerker)
Description: A visuell diff tool widget based on twentytwenty.js. 
Author: Kevin Taron
Author URI: https://gutwerker.de
Version: 1.0
*/

class GWSOB_TwentyTwenty_Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'gwsob-twenty-twenty',
            __('TwentyTwenty (GW)', 'gw-so-bundle'),
            array(
                'description' => __('A visuell diff tool widget.', 'gw-so-bundle'),
                'panels_icon' => 'dashicons dashicons-format-gallery',
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }

    function initialize() {

        $this->register_frontend_scripts(array(
                array(
                    'gwsob-event-move',
                    plugin_dir_url(__FILE__) . 'js/jquery.event.move.js',
                    array('jquery')
                )
            )
        );

        $this->register_frontend_scripts(array(
                array(
                    'gwsob-twenty-twenty',
                    plugin_dir_url(__FILE__) . 'js/jquery.twentytwenty.js',
                    array('jquery')
                )
            )
        );

        $this->register_frontend_scripts(array(
                array(
                    'gwsob-twenty-custom',
                    plugin_dir_url(__FILE__) . 'js/twenty-custom.js',
                    array('jquery')
                )
            )
        );
    }

    function get_style_hash($instance) {
        return substr( md5( serialize( $this->get_less_variables( $instance ) ) ), 0, 12 );
    }


    function initialize_form() {
        return array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title text', 'so-widgets-bundle'),
            ),
            'image-first' => array(
                'type' => 'media',
                'label' => __('First Image file', 'so-widgets-bundle'),
                'library' => 'image',
                'fallback' => true,
            ),
            'image-second' => array(
                'type' => 'media',
                'label' => __('Second Image file', 'so-widgets-bundle'),
                'library' => 'image',
                'fallback' => true,
            ),
            'before' => array(
                'type' => 'text',
                'label' => __('Vorher text', 'so-widgets-bundle'),
            ),
            'after' => array(
                'type' => 'text',
                'label' => __('Nachher text', 'so-widgets-bundle'),
            ),
        );
    }

    function get_less_variables($instance) {
        return array(
            'before_text' => '"' . $instance['before'] . '"',
            'after_text' => '"' . $instance['after'] . '"',
            );
    }
}

siteorigin_widget_register('gwsob-twenty-twenty', __FILE__, 'GWSOB_TwentyTwenty_Widget');