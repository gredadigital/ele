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
		$loader_file = plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-disable-css-js-cache-loader.php';
		if ( file_exists( $loader_file ) ) {
			require_once $loader_file;
		}

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		$i18n_file = plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-disable-css-js-cache-i18n.php';
		if ( file_exists( $i18n_file ) ) {
			require_once $i18n_file;
		}

		if ( class_exists( 'Disable_Css_Js_Cache_Loader' ) ) {
			$this->loader = new Disable_Css_Js_Cache_Loader();
		}

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

		if ( class_exists( 'Disable_Css_Js_Cache_i18n' ) && $this->loader ) {
			$plugin_i18n = new Disable_Css_Js_Cache_i18n();
			$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
		}

	}



	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		if ( $this->loader ) {
			$this->loader->run();
		}
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
function disable_css_js_add_version_to_css_js_files( $src ) {
	// Only proceed if the option is enabled
	$disable_css_js_cache_radio = get_option( 'disable_css_js_cache_radio', '' );
	
	if ( $disable_css_js_cache_radio !== '1' ) {
		return $src;
	}
	
	// Don't modify admin scripts or external scripts
	if ( is_admin() || empty( $src ) || strpos( $src, home_url() ) === false ) {
		return $src;
	}
	
	// Add timestamp to prevent caching
	$timestamp = current_time( 'timestamp' );
	$src = add_query_arg( 'ver', $timestamp, $src );
	
	return $src;
}

add_filter( 'style_loader_src', 'disable_css_js_add_version_to_css_js_files', 10, 1 );
add_filter( 'script_loader_src', 'disable_css_js_add_version_to_css_js_files', 10, 1 );
/* End of Add dynamic version to prevent cache */

/* Disable css js cache Setting page */
function disable_css_js_settings_page() {
	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	$disable_css_js_cache_radio = get_option('disable_css_js_cache_radio', '');
	$browser_caching_enabled = get_option('browser_caching_enabled', '');
	$browser_cache_duration = get_option('browser_cache_duration', 604800); // 7 days by default
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		
		<?php settings_errors(); ?>
		
		<form method="post" action="options.php">
			<?php 
			settings_fields( 'dcjc_options_group' ); 
			do_settings_sections( 'dcjc_options_group' );
			?>
			<table class="form-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row"><?php _e( 'Disable CSS JS Cache', 'disable-css-js-cache' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text">
									<span><?php _e( 'Disable CSS JS Cache', 'disable-css-js-cache' ); ?></span>
								</legend>
								<label for="disable_css_js_cache_radio">
									<input name="disable_css_js_cache_radio" type="checkbox" id="disable_css_js_cache_radio" value="1" <?php checked( $disable_css_js_cache_radio, '1' ); ?>>
									<?php _e( 'Disable CSS JS Cache', 'disable-css-js-cache' ); ?>
								</label>
								<p class="description"><?php _e( 'This will add a timestamp to CSS and JS files to prevent browser caching.', 'disable-css-js-cache' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th scope="row"><?php _e( 'Browser Caching Header for Static Assets', 'disable-css-js-cache' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text">
									<span><?php _e( 'Static Assets', 'disable-css-js-cache' ); ?></span>
								</legend>
								<label for="browser_caching_enabled">
									<input name="browser_caching_enabled" type="checkbox" id="browser_caching_enabled" value="1" <?php checked( $browser_caching_enabled, '1' ); ?>>
									<?php _e( 'Enable browser caching for static assets', 'disable-css-js-cache' ); ?>
								</label>
								<p class="description"><?php _e( 'This will add caching headers to your .htaccess file for images, CSS, and JS files.', 'disable-css-js-cache' ); ?></p>
							</fieldset>
						</td>
					</tr>
					
					<tr>
						<th scope="row"><?php _e( 'Caching Duration for Static Assets', 'disable-css-js-cache' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text">
									<span><?php _e( 'Static Assets', 'disable-css-js-cache' ); ?></span>
								</legend>
								<label for="browser_cache_duration">
									<input name="browser_cache_duration" type="number" id="browser_cache_duration" min="60" max="31536000" value="<?php echo esc_attr( $browser_cache_duration ); ?>">   
									<?php _e( '(Enter Value in Seconds. Default: 604800 = 1 Week)', 'disable-css-js-cache' ); ?>
								</label>
								<p class="description"><?php _e( 'Minimum: 60 seconds, Maximum: 31536000 seconds (1 year)', 'disable-css-js-cache' ); ?></p>
							</fieldset>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
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
	register_setting( 'dcjc_options_group', 'disable_css_js_cache_radio', 'disable_css_js_sanitize_checkbox' );
	add_option( 'browser_caching_enabled', '');
	register_setting( 'dcjc_options_group', 'browser_caching_enabled', 'disable_css_js_sanitize_checkbox' );
	add_option( 'browser_cache_duration', '');
	register_setting( 'dcjc_options_group', 'browser_cache_duration', 'disable_css_js_sanitize_duration' );
	add_option( 'browser_caching_settings_changed', '');
	register_setting( 'dcjc_options_group', 'browser_caching_settings_changed', 'disable_css_js_sanitize_checkbox' );
}

// Sanitization callback functions
function disable_css_js_sanitize_checkbox( $input ) {
	return ( $input == '1' ) ? '1' : '';
}

function disable_css_js_sanitize_duration( $input ) {
	$duration = absint( $input );
	// Ensure duration is between 60 seconds and 1 year
	if ( $duration < 60 ) {
		$duration = 60;
	} elseif ( $duration > 31536000 ) {
		$duration = 31536000;
	}
	return $duration;
}

 /* End of Disable css js cache Setting page */

/* Add plugin action links */
add_filter('plugin_action_links_' . plugin_basename(dirname(__DIR__) . '/disable-css-js-cache.php'), 'disable_css_js_settings_link' );
function disable_css_js_settings_link( $links ) {
	// Add the "Settings" link to the beginning of the existing links array
	$settings_link = '<a href="' . admin_url( 'options-general.php?page=disable-css-js-cache-settings' ) . '">' . __( 'Settings', 'disable-css-js-cache' ) . '</a>';
	array_unshift( $links, $settings_link );
	
	return $links;
}
/* End of Add plugin action links */

function disable_css_js_add_browser_caching_to_htaccess() {
    // Only run if we're in admin and user has proper capabilities
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $browser_caching_enabled = get_option('browser_caching_enabled', false);
    $cache_duration = absint(get_option('browser_cache_duration', 604800)); // 7 days by default

    // Validate cache duration
    if ($cache_duration < 60 || $cache_duration > 31536000) {
        $cache_duration = 604800; // Default to 7 days
    }

    $htaccess_path = ABSPATH . '.htaccess';

    // Check if .htaccess exists and is writable
    if (!file_exists($htaccess_path)) {
        return; // Silently fail if .htaccess doesn't exist
    }

    if (!is_writable($htaccess_path)) {
        add_settings_error('disable_css_js_cache', 'htaccess_not_writable', 'The .htaccess file is not writable. Please check file permissions.', 'error');
        return;
    }

    $htaccess_content = file_get_contents($htaccess_path);
    if ( $htaccess_content === false ) {
        add_settings_error('disable_css_js_cache', 'htaccess_read_error', 'Could not read .htaccess file.', 'error');
        return;
    }

    // Generate the new rules
    $new_rules = '';
    if ($browser_caching_enabled) {
        $new_rules = '
# BEGIN Browser Caching Configuration
<IfModule mod_headers.c>
    # Cache for image and video files
    <filesMatch "\.(flv|gif|ico|jpg|jpeg|mp4|mpeg|png|svg|swf|webp)$">
        Header set Cache-Control "max-age=' . $cache_duration . ', public"
    </filesMatch>

    # Cache for JavaScript and PDF files
    <filesMatch "\.(js|pdf)$">
        Header set Cache-Control "max-age=' . $cache_duration . ', public"
    </filesMatch>

    # Cache for CSS files
    <filesMatch "\.(css)$">
        Header set Cache-Control "max-age=' . $cache_duration . ', public"
    </filesMatch>
</IfModule>
# END Browser Caching Configuration
';
    }

    // Check if the new rules are already present
    $existing_rules = preg_match('/# BEGIN Browser Caching Configuration.*?# END Browser Caching Configuration/s', $htaccess_content, $matches) ? $matches[0] : '';

    if ($existing_rules !== $new_rules) {
        // Remove existing rules
        $htaccess_content = preg_replace('/# BEGIN Browser Caching Configuration.*?# END Browser Caching Configuration\s*/s', '', $htaccess_content);

        // Append new rules if caching is enabled
        if ($browser_caching_enabled && !empty($new_rules)) {
            $htaccess_content = rtrim($htaccess_content) . "\n" . $new_rules;
        }

        // Save the modified .htaccess file
        $result = file_put_contents($htaccess_path, $htaccess_content);
        
        if ( $result === false ) {
            add_settings_error('disable_css_js_cache', 'htaccess_write_error', 'Could not write to .htaccess file.', 'error');
        } else {
            add_settings_error('disable_css_js_cache', 'htaccess_updated', 'Browser caching rules have been updated in .htaccess.', 'updated');
        }
    }
}

// Hook the function to run only when relevant options are updated
add_action('update_option_browser_caching_enabled', 'disable_css_js_add_browser_caching_to_htaccess');
add_action('update_option_browser_cache_duration', 'disable_css_js_add_browser_caching_to_htaccess');

