<?php
/**
 * Plugin Name: ELE Custom
 * Description: Funcionalidades personalizadas para el proyecto ELE.
 * Version: 0.1.0
 * Author: Ernesto Montellano
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('init', function () {
    // Hook de prueba: deja huella en el log de debug cuando WordPress carga.
    if ( defined('WP_DEBUG') && WP_DEBUG ) {
        error_log('[ELE Custom] init ejecutado');
    }
});