<?php
/**
 * Plugin Name: ELE Custom
 * Description: Funcionalidades personalizadas para el proyecto ELE.
 * Version: 0.1.0
 * Author: Ernesto Montellano
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('init', function () {
    if ( defined('WP_DEBUG') && WP_DEBUG ) {
        error_log('[ELE Custom] init ejecutado');
    }
});

// Cargar archivos de includes
add_action('plugins_loaded', function () {
    $base = plugin_dir_path(__FILE__);
    $cpt  = $base . 'includes/class-ele-cpt.php';

    if ( file_exists($cpt) && is_readable($cpt) ) {
        require_once $cpt;
        if ( class_exists('ELE_CPT') ) {
            ELE_CPT::init();
        } else {
            error_log('[ELE Custom] Clase ELE_CPT no encontrada tras require.');
        }
    } else {
        error_log('[ELE Custom] No se pudo cargar includes/class-ele-cpt.php');
    }
});

// JS del formulario (solo en la plantilla landing.php)
add_action('wp_enqueue_scripts', function () {
    if ( ! is_page_template('landing.php') ) return;

    $base_url = plugin_dir_url(__FILE__);

    // Encola el JS (usa fetch nativo; sin dependencias de WP)
    wp_enqueue_script(
        'ele-contact',
        $base_url . 'assets/js/ele-contact.js',
        [],
        '0.1.0',
        true
    );

    // Pasamos datos al script (URL del endpoint y algunos textos)
    wp_localize_script('ele-contact', 'ELE_CONTACT', [
        'restUrl' => esc_url_raw( rest_url('ele/v1/leads') ),
        'okText'  => '¡Gracias! Guardamos tus datos.',
        'errText' => 'No pudimos enviar el formulario. Intenta de nuevo.',
    ]);
});
add_action('plugins_loaded', function () {
    $base = plugin_dir_path(__FILE__);

    // CPT
    $cpt = $base . 'includes/class-ele-cpt.php';
    if ( file_exists($cpt) ) { require_once $cpt; ELE_CPT::init(); }

    // REST
    $rest = $base . 'includes/class-ele-rest.php';
    if ( file_exists($rest) ) { require_once $rest; ELE_REST::init(); }
});
