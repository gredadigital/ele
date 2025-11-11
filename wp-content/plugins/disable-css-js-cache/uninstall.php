<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://phptutorialpoints.in
 * @since      1.0.0
 *
 * @package    Disable_Css_Js_Cache
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Clean up plugin options
delete_option( 'disable_css_js_cache_radio' );
delete_option( 'browser_caching_enabled' );
delete_option( 'browser_cache_duration' );
delete_option( 'browser_caching_settings_changed' );

// Clean up .htaccess rules
$htaccess_path = ABSPATH . '.htaccess';
if ( file_exists( $htaccess_path ) && is_writable( $htaccess_path ) ) {
	$htaccess_content = file_get_contents( $htaccess_path );
	
	if ( $htaccess_content !== false ) {
		// Remove our caching rules
		$htaccess_content = preg_replace('/# BEGIN Browser Caching Configuration.*?# END Browser Caching Configuration\s*/s', '', $htaccess_content);
		file_put_contents( $htaccess_path, $htaccess_content );
	}
}

// For multisite installations
if ( is_multisite() ) {
	$sites = get_sites();
	foreach ( $sites as $site ) {
		switch_to_blog( $site->blog_id );
		
		delete_option( 'disable_css_js_cache_radio' );
		delete_option( 'browser_caching_enabled' );
		delete_option( 'browser_cache_duration' );
		delete_option( 'browser_caching_settings_changed' );
		
		restore_current_blog();
	}
}
