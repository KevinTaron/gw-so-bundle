<?php

/*
Widget Name: Clickbox Widget (Gutwerker)
Description: A awesome clickbox widget
Author: Kevin Taron
Author URI: https://gutwerker.de
Version: 1.0
*/

class GWSOB__Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'gwsob-clickbox',
            __('Accordion (GW)', 'gw-so-bundle'),
            array(
                'description' => __('A responsive clickbox widget.', 'gw-so-bundle'),
            ),
            array(

            ),
            false,
            plugin_dir_path(__FILE__)
        );
    }

     /**
     * Register all the frontend scripts and styles for the base slider.
     */
    function initialize() {
        $this->register_frontend_scripts(
            array(
                array(
                    'gwsob-clickbox-js',
                    plugin_dir_url(__FILE__) . 'js/accordion.js',
                    array('jquery'),
                    SOW_BUNDLE_VERSION
                )
            )
        );
    }


    function initialize_form() {
        return array(
            'frames' => array(
                'type' => 'repeater',
                'label' => __('Accordion Items', 'so-widgets-bundle'),
                'item_name' => __('Item', 'so-widgets-bundle'),
                'item_label' => array(
                    'selector' => "[id*='frames-url']",
                    'update_event' => 'change',
                    'value_method' => 'val'
                ),
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Title', 'so-widgets-bundle')
                    ),
                    'text' => array(
                        'type' => 'tinymce',
                        'label' => __('Text', 'so-widgets-bundle'),
                    ),
                ),
            ),
            'controls' => array(
                'type' => 'section',
                'label' => __('Controls', 'so-widgets-bundle'),
                'fields' => $this->control_form_fields()
            )
        );
    }

    /**
     * The control array required for the slider
     *
     * @return array
     */
    function control_form_fields(){
        return array(
            'open_first_element' => array(
                'type' => 'checkbox',
                'label' => __('Open first element', 'so-widgets-bundle'),
                'description' => __('Should the first element be open?', 'so-widgets-bundle'),
                'default' => true,
            ),
        );
    }

    function get_less_variables($instance) {
        $less = array();

        return $less;
    }


    function get_template_variables($instance, $args) {

    }

}

siteorigin_widget_register('gwsob-clickbox', __FILE__, 'GWSOB__Widget');