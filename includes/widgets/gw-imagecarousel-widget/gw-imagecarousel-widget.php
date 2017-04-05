<?php

/*
Widget Name: Imagecarousel Widget (Gutwerker)
Description: A Google style imagebox widget
Author: Kevin Taron
Author URI: https://gutwerker.de
Version: 1.0
*/

class GWSOB_Imagecarousel_Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'gwsob-imagecarousel',
            __('Image Carousel (GW)', 'gw-so-bundle'),
            array(
                'description' => __('A responsive carousel widget that supports images.', 'gw-so-bundle'),
                'panels_icon' => 'dashicons dashicons-minus',
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }

    function initialize() {

    }

    function get_style_hash($instance) {
        return substr( md5( serialize( $this->get_less_variables( $instance ) ) ), 0, 12 );
    }


    function initialize_form() {
        return array(
            'contentbox' => array(
                'type' => 'section',
                'label' => __('Contentbox', 'so-widgets-bundle'),
                'fields' => $this->contentbox_form_fields()
            ),

            'bgimage' => array(
                'type' => 'section',
                'label' => __('Image', 'so-widgets-bundle'),
                'fields' => $this->image_form_fields()
            ),

            'controls' => array(
                'type' => 'section',
                'label' => __('Controls', 'so-widgets-bundle'),
                'fields' => $this->control_form_fields()
            )
        );
    }

    function contentbox_form_fields() {
        return array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'so-widgets-bundle')
                ),
            'text' => array(
                'type' => 'tinymce',
                'label' => __('Text', 'so-widgets-bundle'),
                ),
            'boxposition' => array(
                'type' => 'select',
                'label' => __('Box Position', 'so-widgets-bundle'),
                'default' => 'leftbottom',
                'options' => array(
                    'leftbottom' => __('Links unten', 'so-widgets-bundle'),
                    'rightbottom' => __('Rechts unten', 'so-widgets-bundle'),
                    'righttop' => __('Rechts oben', 'so-widgets-bundle'),
                    'lefttop' => __('Links oben', 'so-widgets-bundle'),
                    'center' => __('Mitte', 'so-widgets-bundle'),
                ),
            ),
            'backgroundcolor' => array(
                'type' => 'color',
                'label' => __('Hintergrundfarbe', 'so-widgets-bundle'),
                ),
            'color' => array(
                'type' => 'color',
                'label' => __('Textfarbe', 'so-widgets-bundle'),
                )
            );
    }

    function image_form_fields(){
        return array(
            'image' => array(
                'type' => 'media',
                'label' => __('Image file', 'so-widgets-bundle'),
                'library' => 'image',
                'fallback' => true,
            ),

            'size' => array(
                'type' => 'image-size',
                'label' => __('Image size', 'so-widgets-bundle'),
            ),

            'align' => array(
                'type' => 'select',
                'label' => __('Image alignment', 'so-widgets-bundle'),
                'default' => 'default',
                'options' => array(
                    'default' => __('Default', 'so-widgets-bundle'),
                    'left' => __('Left', 'so-widgets-bundle'),
                    'right' => __('Right', 'so-widgets-bundle'),
                    'center' => __('Center', 'so-widgets-bundle'),
                ),
            ),

            'title' => array(
                'type' => 'text',
                'label' => __('Title text', 'so-widgets-bundle'),
            ),

            'title_position' => array(
                'type' => 'select',
                'label' => __('Title position', 'so-widgets-bundle'),
                'default' => 'hidden',
                'options' => array(
                    'hidden' => __( 'Hidden', 'so-widgets-bundle' ),
                    'above' => __( 'Above', 'so-widgets-bundle' ),
                    'below' => __( 'Below', 'so-widgets-bundle' ),
                ),
            ),

            'alt' => array(
                'type' => 'text',
                'label' => __('Alt text', 'so-widgets-bundle'),
            ),
            
            'bound' => array(
                'type' => 'checkbox',
                'default' => true,
                'label' => __('Bound', 'so-widgets-bundle'),
                'description' => __("Make sure the image doesn't extend beyond its container.", 'so-widgets-bundle'),
            ),

            'full_width' => array(
                'type' => 'checkbox',
                'default' => false,
                'label' => __('Full Width', 'so-widgets-bundle'),
                'description' => __("Resize image to fit its container.", 'so-widgets-bundle'),
            ),

        );
    }

    function control_form_fields(){
        return array(
            'url' => array(
                'type' => 'link',
                'label' => __('Destination URL', 'so-widgets-bundle'),
            ),
            'new_window' => array(
                'type' => 'checkbox',
                'default' => false,
                'label' => __('Open in new window', 'so-widgets-bundle'),
            ),
            'backgroundcolor' => array(
                'type' => 'color',
                'label' => __('Box Background', 'so-widgets-bundle'),
            ),
            'size_mobile' => array(
                'type' => 'number',
                'default' => '400',
                'label' => __('Mobile Size', 'so-widgets-bundle'),
            ),
            'break_point_mobile' => array(
                'type' => 'number',
                'lanel' => __( 'Break point Mobile', 'so-widgets-bundle' ),
                'default' => 768
            ),
            'size_tablet' => array(
                'type' => 'number',
                'default' => '400',
                'label' => __('Tablet Size', 'so-widgets-bundle'),
            ),
            'break_point_tablet' => array(
                'type' => 'number',
                'lanel' => __( 'Break point Tablet', 'so-widgets-bundle' ),
                'default' => 992
            ),
            'size_desktop' => array(
                'type' => 'number',
                'default' => '400',
                'label' => __('Desktop Size', 'so-widgets-bundle'),
            ),
        );
    }

    function get_less_variables($instance) {
        return array(
            'size_mobile' => intval($instance['controls']['size_mobile']) . 'px',
            'size_tablet' => intval($instance['controls']['size_tablet']) . 'px',
            'size_desktop' => intval($instance['controls']['size_desktop']) . 'px',
            'break_point_tablet' => intval($instance['controls']['break_point_tablet']) . 'px',
            'break_point_mobile' => intval($instance['controls']['break_point_mobile']) . 'px',
            'bgcolor-box' => $instance['contentbox']['backgroundcolor'],
            'backgroundcolor' => $instance['controls']['backgroundcolor'],
            'color-box' => $instance['contentbox']['color'],
        );
    }
}

siteorigin_widget_register('gwsob-imagecarousel', __FILE__, 'GWSOB_Imagecarousel_Widget');