<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://phptutorialpoints.in
 * @since      1.0.0
 *
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Disable_Css_Js_Cache
 * @subpackage Disable_Css_Js_Cache/includes
 * @author     Umang Prajapati <umangapps48@gmail.com>
 */
class Disable_Css_Js_Cache {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Disable_Css_Js_Cache_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'DISABLE_CSS_JS_CACHE_VERSION' ) ) {
			$this->version = DISABLE_CSS_JS_CACHE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'disable-css-js-cache';

		$this->load_dependencies();
		$this->set_locale();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Disable_Css_Js_Cache_Loader. Orchestrates the hooks of the plugin.
	 * - Disable_Css_Js_Cache_i18n. Defines internationalization functionality.
	 * - Disable_Css_Js_Cache_Admin. Defines all hooks for the admin area.
	 * - Disable_Css_Js_Cache_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-disable-css-js-cache-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-disable-css-js-cache-i18n.php';

		$this->loader = new Disable_Css_Js_Cache_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Disable_Css_Js_Cache_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Disable_Css_Js_Cache_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}



	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Disable_Css_Js_Cache_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	

}

/* Add dynamic version to prevent cache */
function disable_css_js_add_version_to_css_js_files($src) {
	$disable_css_js_cache_radio = get_option('disable_css_js_cache_radio');
    if($disable_css_js_cache_radio == '1' ) { 
	if ( !is_admin() ) {	
	 $src = add_query_arg( 'ver', date('YmdHis'), $src );
 
	}
	}
	return $src;
 }
 
 add_filter('style_loader_src', 'disable_css_js_add_version_to_css_js_files');
 add_filter('script_loader_src', 'disable_css_js_add_version_to_css_js_files');
/* End of Add dynamic version to prevent cache */

/* Disable css js cache Setting page */
function disable_css_js_settings_page() {
$disable_css_js_cache_radio = get_option('disable_css_js_cache_radio');
$browser_caching_enabled = get_option('browser_caching_enabled', true);
$browser_cache_duration = get_option('browser_cache_duration', 604800); // 7 days by default
?>
	<div class="wrap">
<h1>Disable CSS JS Cache Settings</h1>

<form method="post" action="options.php">
<?php settings_fields( 'dcjc_options_group' ); ?>
<table class="form-table" role="presentation">
<tbody><tr>
<th scope="row">Disable CSS JS Cache</th>
<td><fieldset><legend class="screen-reader-text"><span>
Disable CSS JS Cache</span></legend>
<label for="disable_css_js_cache_radio">
<input name="disable_css_js_cache_radio" type="checkbox" id="disable_css_js_cache_radio" value="1" <?php if($disable_css_js_cache_radio == '1' ) { echo 'checked'; } ?>>
Disable CSS JS Cache</label>
</fieldset></td>
</tr>

<tr>
<th scope="row">Browser Caching Header for Static Assets</th>
<td><fieldset><legend class="screen-reader-text"><span>
Static Assets</span></legend>
<label for="browser_caching_enabled">
<input name="browser_caching_enabled" type="checkbox" id="browser_caching_enabled" value="1" <?php if($browser_caching_enabled == '1' ) { echo 'checked'; } ?>>
Enable browser caching for static assets</label>
</fieldset></td>
</tr>
<tr>
<th scope="row">Caching Duration for Static Assets</th>
<td><fieldset><legend class="screen-reader-text"><span>
Static Assets</span></legend>
<label for="browser_cache_duration">
<input name="browser_cache_duration" type="number" id="browser_cache_duration" value="<?php echo esc_attr($browser_cache_duration); ?>">   
(Enter Value in Seconds. By default it set to  604800 = 1 Week)</label>
</fieldset></td>
</tr>
</tbody></table>
<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
</form>
</div>
	<?php
}

function disable_css_js_add_settings_menu() {
    add_options_page(
        'Disable CSS JS Cache Settings',
        'Disable CSS JS Cache',
        'manage_options',
        'disable-css-js-cache-settings',
        'disable_css_js_settings_page'
    );
}

add_action( 'admin_menu', 'disable_css_js_add_settings_menu' );

add_action( 'admin_init', 'disable_css_js_register_settings');			
function disable_css_js_register_settings() {
	add_option( 'disable_css_js_cache_radio', '');
	register_setting( 'dcjc_options_group', 'disable_css_js_cache_radio', 'dcjc_callback' );
	add_option( 'browser_caching_enabled', '');
	register_setting( 'dcjc_options_group', 'browser_caching_enabled', 'dcjc_callback' );
	add_option( 'browser_cache_duration', '');
	register_setting( 'dcjc_options_group', 'browser_cache_duration', 'dcjc_callback' );
	add_option( 'browser_caching_settings_changed', '');
	register_setting( 'dcjc_options_group', 'browser_caching_settings_changed', 'dcjc_callback' );
	
 }

 /* End of Disable css js cache Setting page */

/* Add plugin action links */
add_filter('plugin_action_links_disable-css-js-cache/disable-css-js-cache.php', 'disable_css_js_settings_link' );
function disable_css_js_settings_link( $links ) {

	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=disable-css-js-cache-settings' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}
/* End of Add plugin action links */

// Add cache control directives to .htaccess based on plugin settings
function disable_css_js_add_browser_caching_to_htaccess() {
    $browser_caching_enabled = get_option('browser_caching_enabled', true);
    $cache_duration = get_option('browser_cache_duration', 604800); // 7 days by default

    if ($browser_caching_enabled) {
        // Custom comment to mark the beginning of cache control directives
        $htaccess_rules = '
# BEGIN Browser Caching Configuration
<IfModule mod_headers.c> 
    # One year for image and video files
    <filesMatch ".(flv|gif|ico|jpg|jpeg|mp4|mpeg|png|svg|swf|webp)$">
        Header set Cache-Control "max-age=' . $cache_duration . ', public"
    </filesMatch>

    # One month for JavaScript and PDF files
    <filesMatch ".(js|pdf)$">
        Header set Cache-Control "max-age=' . $cache_duration . ', public"
    </filesMatch>

    # One week for CSS files
    <filesMatch ".(css)$">
        Header set Cache-Control "max-age=' . $cache_duration . ', public"
    </filesMatch>
</IfModule>
# END Browser Caching Configuration
';

        // Add or update the rules in .htaccess
        $htaccess_path = ABSPATH . '.htaccess';

        if (file_exists($htaccess_path) && is_writable($htaccess_path)) {
            $htaccess_content = file_get_contents($htaccess_path);

            // Remove existing cache control directives
            $htaccess_content = preg_replace('/# BEGIN Browser Caching Configuration.*?# END Browser Caching Configuration/s', '', $htaccess_content);

            // Append the new cache control directives
            $htaccess_content .= $htaccess_rules;

            // Remove leading and trailing blank lines
            $htaccess_content = trim($htaccess_content);

            // Save the modified .htaccess file
            file_put_contents($htaccess_path, $htaccess_content);
        } else {
            // Output a warning if .htaccess is not writable
            error_log("Browser Caching Configuration: Unable to modify .htaccess. Please ensure it is writable.");
        }
    } else {
        // If caching is not enabled, remove the rules
        $htaccess_path = ABSPATH . '.htaccess';

        if (file_exists($htaccess_path) && is_writable($htaccess_path)) {
            $htaccess_content = file_get_contents($htaccess_path);
            
            // Remove existing cache control directives
            $htaccess_content = preg_replace('/# BEGIN Browser Caching Configuration.*?# END Browser Caching Configuration/s', '', $htaccess_content);

            // Remove leading and trailing blank lines
            $htaccess_content = trim($htaccess_content);

            // Save the modified .htaccess file
            file_put_contents($htaccess_path, $htaccess_content);
        } else {
            // Output a warning if .htaccess is not writable
            error_log("Browser Caching Configuration: Unable to modify .htaccess. Please ensure it is writable.");
        }
    }
}

// Hook the function to a suitable action, such as 'admin_init' for settings changes
add_action('admin_init', 'disable_css_js_add_browser_caching_to_htaccess');

