<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://phptutorialpoints.in
 * @since      1.0.0
 *
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 * @author     Umang Prajapati <umangapps48@gmail.com>
 */
class Disable_Css_Js_Cache_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Clean up .htaccess rules on deactivation
		self::remove_htaccess_rules();
	}

	/**
	 * Remove browser caching rules from .htaccess
	 */
	private static function remove_htaccess_rules() {
		$htaccess_path = ABSPATH . '.htaccess';
		
		if ( file_exists( $htaccess_path ) && is_writable( $htaccess_path ) ) {
			$htaccess_content = file_get_contents( $htaccess_path );
			
			if ( $htaccess_content !== false ) {
				// Remove our caching rules
				$htaccess_content = preg_replace('/# BEGIN Browser Caching Configuration.*?# END Browser Caching Configuration\s*/s', '', $htaccess_content);
				file_put_contents( $htaccess_path, $htaccess_content );
			}
		}
	}

}
