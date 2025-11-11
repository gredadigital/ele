<?php

/**
 * Fired during plugin activation
 *
 * @link       https://phptutorialpoints.in
 * @since      1.0.0
 *
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 * @author     Umang Prajapati <umangapps48@gmail.com>
 */
class Disable_Css_Js_Cache_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	
		update_option('disable_css_js_cache_radio', '1');
	}

}
