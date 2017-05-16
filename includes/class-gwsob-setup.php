<?php

if (!defined('ABSPATH')) {
    exit;
}

class GWSOB_Setup {

    public function __construct() {

        add_filter('siteorigin_widgets_widget_folders', array($this, 'add_widgets_collection'));

        add_filter('siteorigin_panels_widget_dialog_tabs', array($this, 'add_widget_tabs'), 20);

        add_filter('siteorigin_panels_widgets', array($this, 'add_bundle_groups'), 11);

    }

    /**
     * Get the single of this plugin
     *
     * @return SiteOrigin_Widgets_Bundle
     */
    static function single() {
        static $single;

        if( empty($single) ) {
            $single = new GWSOB_Setup();
        }

        return $single;
    }




    function add_widgets_collection($folders) {
        $folders[] = GWSOB_PLUGIN_DIR . 'includes/widgets/';
        return $folders;
    }


    // Placing all widgets under the 'SiteOrigin Widgets' Tab
    function add_widget_tabs($tabs) {
        $tabs[] = array(
            'title' => __('Gutwerker SiteOrigin Bundle', 'gw-so-bundle'),
            'filter' => array(
                'groups' => array('gw-so-bundle')
            )
        );
        return $tabs;
    }


    // Adding group for all Widgets
    function add_bundle_groups($widgets) {
        foreach ($widgets as $class => &$widget) {
            if (preg_match('/GWSO_(.*)_Widget/', $class, $matches)) {
                $widget['groups'] = array('gw-so-bundle');
            }
        }
        return $widgets;
    }

}


//new GWSOB_Setup();
GWSOB_Setup::single();