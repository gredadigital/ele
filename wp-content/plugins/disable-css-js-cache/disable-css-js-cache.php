<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://phptutorialpoints.in
 * @since             1.0.0
 * @package           Disable_Css_Js_Cache
 *
 * @wordpress-plugin
 * Plugin Name:       Disable CSS JS Cache
 * Plugin URI:        https://phptutorialpoints.in
 * Description:       This plugin helps prevent browser caching of CSS and JS files from theme in WordPress.
 * Version:           1.0.8
 * Author:            Umang Prajapati
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       disable-css-js-cache
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}



/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DISABLE_CSS_JS_CACHE_VERSION', '1.0.8' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-disable-css-js-cache-activator.php
 */
function activate_disable_css_js_cache() {
    $activator_file = plugin_dir_path( __FILE__ ) . 'includes/class-disable-css-js-cache-activator.php';
    if ( file_exists( $activator_file ) ) {
        $real_activator_path = realpath( $activator_file );
        $plugin_dir = realpath( plugin_dir_path( __FILE__ ) );
        
        if ( $real_activator_path && $plugin_dir && strpos( $real_activator_path, $plugin_dir ) === 0 ) {
            require_once $activator_file;
            if ( class_exists( 'Disable_Css_Js_Cache_Activator' ) ) {
                Disable_Css_Js_Cache_Activator::activate();
            }
        }
    }
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-disable-css-js-cache-deactivator.php
 */
function deactivate_disable_css_js_cache() {
    $deactivator_file = plugin_dir_path( __FILE__ ) . 'includes/class-disable-css-js-cache-deactivator.php';
    if ( file_exists( $deactivator_file ) ) {
        $real_deactivator_path = realpath( $deactivator_file );
        $plugin_dir = realpath( plugin_dir_path( __FILE__ ) );
        
        if ( $real_deactivator_path && $plugin_dir && strpos( $real_deactivator_path, $plugin_dir ) === 0 ) {
            require_once $deactivator_file;
            if ( class_exists( 'Disable_Css_Js_Cache_Deactivator' ) ) {
                Disable_Css_Js_Cache_Deactivator::deactivate();
            }
        }
    }
}

register_activation_hook( __FILE__, 'activate_disable_css_js_cache' );
register_deactivation_hook( __FILE__, 'deactivate_disable_css_js_cache' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
$main_class_file = plugin_dir_path( __FILE__ ) . 'includes/class-disable-css-js-cache.php';
if ( file_exists( $main_class_file ) ) {
    $real_main_path = realpath( $main_class_file );
    $plugin_dir = realpath( plugin_dir_path( __FILE__ ) );
    
    if ( $real_main_path && $plugin_dir && strpos( $real_main_path, $plugin_dir ) === 0 ) {
        require $main_class_file;
    }
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_disable_css_js_cache() {
    if ( class_exists( 'Disable_Css_Js_Cache' ) ) {
        $plugin = new Disable_Css_Js_Cache();
        $plugin->run();
    }
}
run_disable_css_js_cache();

