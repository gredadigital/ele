<?php
/**
 * Encola Tailwind compilado
 */
function ele_enqueue_assets() {
    $css_path = get_stylesheet_directory() . '/assets/css/tw.build.css';
    $css_uri  = get_stylesheet_directory_uri() . '/assets/css/tw.build.css';

    // Usa filemtime para hacer bust de caché en dev
    $ver = file_exists( $css_path ) ? filemtime( $css_path ) : null;

    wp_enqueue_style( 'ele-tailwind', $css_uri, [], $ver, 'all' );
}
add_action( 'wp_enqueue_scripts', 'ele_enqueue_assets' );
