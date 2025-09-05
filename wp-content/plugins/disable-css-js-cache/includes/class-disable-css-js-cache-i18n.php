<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://phptutorialpoints.in
 * @since      1.0.0
 *
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 * @author     Umang Prajapati <umangapps48@gmail.com>
 */
class Disable_Css_Js_Cache_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'disable-css-js-cache',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
