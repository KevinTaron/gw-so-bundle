<?php
/**
 * Plugin Name: Gutwerker SiteOrigin Bundle
 * Plugin URI: https://gutwerker.de/siteorigin-widgets
 * Description: A bundle of awesome widget for SiteOrigin Pagebuilder. SiteOrigin Widgets Bundle is required.
 * Author: Kevin Taron
 * Author URI: https://gutwerker.de/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Version: 1.0
 * Text Domain: gw-so-bundle
 * Domain Path: languages
 *
 * Gutwerker SiteOrigin Bundle is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Gutwerker SiteOrigin Bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Gutwerker SiteOrigin Bundle. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if (!class_exists('GW_SiteOrigin_Bundle')) :

    /**
     * Main GW_SiteOrigin_Bundle Class
     *
     */
    final class GW_SiteOrigin_Bundle {

        /** Singleton *************************************************************/

        private static $instance;

        /**
         * Main GW_SiteOrigin_Bundle Instance
         *
         * Insures that only one instance of GW_SiteOrigin_Bundle exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance() {
            if (!isset(self::$instance) && !(self::$instance instanceof GW_SiteOrigin_Bundle)) {
                self::$instance = new GW_SiteOrigin_Bundle;
                self::$instance->setup_constants();

                add_action('plugins_loaded', array(self::$instance, 'load_plugin_textdomain'));

                self::$instance->includes();

                self::$instance->hooks();


            }
            return self::$instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('That is not working.', 'gw-so-bundle'), '1.0');
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('That is not working.', 'gw-so-bundle'), '1.0');
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants() {

            // Plugin version
            if (!defined('GWSOB_VERSION')) {
                define('GWSOB_VERSION', '1.0');
            }

            // Plugin Folder Path
            if (!defined('GWSOB_PLUGIN_DIR')) {
                define('GWSOB_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            // Plugin Folder URL
            if (!defined('GWSOB_PLUGIN_URL')) {
                define('GWSOB_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            // Plugin Root File
            if (!defined('GWSOB_PLUGIN_FILE')) {
                define('GWSOB_PLUGIN_FILE', __FILE__);
            }

            $this->setup_debug_constants();
        }

        private function setup_debug_constants() {

            $enable_debug = false;

            $settings = get_option('gwsob_settings');

            if ($settings && isset($settings['gwsob_enable_debug']) && $settings['gwsob_enable_debug'] == "true")
                $enable_debug = true;

            // Enable script debugging
            if (!defined('GWSOB_SCRIPT_DEBUG')) {
                define('GWSOB_SCRIPT_DEBUG', $enable_debug);
            }

            // Minified JS file name suffix
            if (!defined('GWSOB_JS_SUFFIX')) {
                if ($enable_debug)
                    define('GWSOB_JS_SUFFIX', '');
                else
                    define('GWSOB_JS_SUFFIX', '.min');
            }
        }

        /**
         * Include required files
         *
         */
        private function includes() {

            require_once GWSOB_PLUGIN_DIR . 'includes/class-gwsob-setup.php';
            require_once GWSOB_PLUGIN_DIR . 'includes/helper-functions.php';

            if (is_admin()) {
                // require_once GWSOB_PLUGIN_DIR . 'admin/admin-init.php';
            }

        }

        /**
         * Load Plugin Text Domain
         *
         * Looks for the plugin translation files in certain directories and loads
         * them to allow the plugin to be localised
         */
        public function load_plugin_textdomain() {

            $lang_dir = apply_filters('gwsob_so_widgets_lang_dir', trailingslashit(GWSOB_PLUGIN_DIR . 'languages'));

            // Traditional WordPress plugin locale filter
            $locale = apply_filters('plugin_locale', get_locale(), 'gw-so-bundle');
            $mofile = sprintf('%1$s-%2$s.mo', 'gw-so-bundle', $locale);

            // Setup paths to current locale file
            $mofile_local = $lang_dir . $mofile;

            if (file_exists($mofile_local)) {
                // Look in the /wp-content/plugins/gw-so-bundle/languages/ folder
                load_textdomain('gw-so-bundle', $mofile_local);
            }
            else {
                // Load the default language files
                load_plugin_textdomain('gw-so-bundle', false, $lang_dir);
            }

            return false;
        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks() {

            add_action('wp_enqueue_scripts', array($this, 'load_frontend_scripts'), 10);
        }

        /**
         * Load Frontend Scripts/Styles
         *
         */
        public function load_frontend_scripts() {



        }


    }

endif; // End if class_exists check


/**
 * The main function responsible for returning the one true GW_SiteOrigin_Bundle
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $gwsob = GWSOB(); ?>
 */
function GWSOB() {
    return GW_SiteOrigin_Bundle::instance();
}

// Get GWSOB Running
GWSOB();