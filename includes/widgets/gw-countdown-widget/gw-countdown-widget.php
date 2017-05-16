<?php

/*
Widget Name: Countdown Widget (Gutwerker)
Description: A responsive countdown widget.
Author: Kevin Taron
Author URI: https://gutwerker.de
Version: 1.0
*/

class GWSOB_Countdown_Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'gwsob-countdown',
            __('Countdown (GW)', 'gw-so-bundle'),
            array(
                'description' => __('A responsive countdown widget.', 'gw-so-bundle'),
                'panels_icon' => 'dashicons dashicons-backup',
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }

    function initialize() {

        $this->register_frontend_scripts(array(
                array(
                    'gwsob-countdown-flipclock',
                    plugin_dir_url(__FILE__) . 'js/flipclock' . GWSOB_JS_SUFFIX . '.js',
                    array('jquery')
                )
            )
        );


        $this->register_frontend_scripts(array(
                array(
                    'gwsob-countdown-flipclock-custom',
                    plugin_dir_url(__FILE__) . 'js/flipclock-custom.js',
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
            'date' => array(
                'type' => 'text',
                'label' => __('Date', 'so-widgets-bundle'),
                'description' => __('Please enter Date in Formate MM/DD/YY HH:MM:SS', 'so-widgets-bundle'),
            ),
            'alignment' => array(
                'type' => 'select',
                'label' => __('Position', 'so-widgets-bundle'),
                'default' => 'left',
                'options' => array(
                    'left' => __('Links', 'so-widgets-bundle'),
                    'center' => __('Mitte', 'so-widgets-bundle'),
                    'right' => __('Rechts ', 'so-widgets-bundle'),
                ),
            )
        );
    }

    function get_less_variables($instance) {
        return array();
    }
}

siteorigin_widget_register('gwsob-countdown', __FILE__, 'GWSOB_Countdown_Widget');