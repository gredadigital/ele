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
 * Version:           1.0.5
 * Author:            Umang Prajapati
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       disable-css-js-cache
 * Domain Path:       /languages
 */

 defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DISABLE_CSS_JS_CACHE_VERSION', '1.0.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-disable-css-js-cache-activator.php
 */
function activate_disable_css_js_cache() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-disable-css-js-cache-activator.php';
	Disable_Css_Js_Cache_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-disable-css-js-cache-deactivator.php
 */
function deactivate_disable_css_js_cache() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-disable-css-js-cache-deactivator.php';
	Disable_Css_Js_Cache_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_disable_css_js_cache' );
register_deactivation_hook( __FILE__, 'deactivate_disable_css_js_cache' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-disable-css-js-cache.php';

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

	$plugin = new Disable_Css_Js_Cache();
	$plugin->run();

}
run_disable_css_js_cache();
