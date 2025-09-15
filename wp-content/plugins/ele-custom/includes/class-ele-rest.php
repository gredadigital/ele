<?php
/**
 * Clase REST para recepción de leads del formulario de landing.
 */
if ( ! defined('ABSPATH') ) exit;

class ELE_REST {

    public static function init() {
        add_action('rest_api_init', [__CLASS__, 'register_routes']);
    }

    public static function register_routes() {
        register_rest_route('ele/v1', '/leads', [
            'methods'             => 'POST',
            'callback'            => [__CLASS__, 'handle_lead'],
            'permission_callback' => '__return_true', // control interno en handle_lead()
            'args'                => [],
        ]);
    }

    public static function handle_lead( WP_REST_Request $request ) {

        // ------------------------------------------------------------------
        // 0) Rate limiting simple por IP (20 envíos / 15 min)
        // ------------------------------------------------------------------
        $ip   = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $key  = 'ele_rate_' . md5($ip);
        $hits = (int) get_transient($key);
        if ( $hits > 20 ) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Demasiados envíos. Intenta más tarde.',
            ], 429);
        }
        set_transient($key, $hits + 1, 15 * MINUTE_IN_SECONDS);

        // ------------------------------------------------------------------
        // 1) Seguridad: nonce si logged-in, same-origin si público + honeypot
        // ------------------------------------------------------------------
        $nonce  = isset($_POST['ele_contact_nonce']) ? sanitize_text_field($_POST['ele_contact_nonce']) : '';
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? sanitize_text_field($_SERVER['HTTP_ORIGIN']) : '';
        $site   = get_site_url();

        if ( is_user_logged_in() ) {
            if ( ! wp_verify_nonce( $nonce, 'ele_contact_form' ) ) {
                return new WP_REST_Response([
                    'success' => false,
                    'message' => 'Nonce inválido (logged-in).',
                ], 403);
            }
        } else {
            if ( $origin && parse_url($origin, PHP_URL_HOST) !== parse_url($site, PHP_URL_HOST) ) {
                return new WP_REST_Response([
                    'success' => false,
                    'message' => 'Origen no permitido.',
                ], 403);
            }
            // Honeypot 1: campo "website" debe venir vacío
            if ( ! empty($_POST['website']) ) {
                return new WP_REST_Response([
                    'success' => false,
                    'message' => 'Detección anti-bot.',
                ], 403);
            }
        }

        // ------------------------------------------------------------------
        // 2) Recoger y sanear campos
        // ------------------------------------------------------------------
        $fields = [
            'interes'     => isset($_POST['interes'])     ? sanitize_text_field($_POST['interes'])     : '',
            'nombre'      => isset($_POST['nombre'])      ? sanitize_text_field($_POST['nombre'])      : '',
            'telefono'    => isset($_POST['telefono'])    ? sanitize_text_field($_POST['telefono'])    : '',
            'email'       => isset($_POST['email'])       ? sanitize_email($_POST['email'])            : '',
            'empresa'     => isset($_POST['empresa'])     ? sanitize_text_field($_POST['empresa'])     : '',
            'presupuesto' => isset($_POST['presupuesto']) ? sanitize_text_field($_POST['presupuesto']) : '',
            'descripcion' => isset($_POST['descripcion']) ? wp_kses_post($_POST['descripcion'])        : '',
            'referencia'  => isset($_POST['referencia'])  ? sanitize_text_field($_POST['referencia'])  : '',
        ];

        // ------------------------------------------------------------------
        // 3) Whitelists para radios
        // ------------------------------------------------------------------
        $allow_interes     = ['branding','ilustracion','rebranding','packaging-editorial'];
        $allow_presupuesto = ['>500','500-1000','1000-2000','<2000'];
        $allow_referencia  = ['instagram','linkedin','facebook','otro'];

        if ( ! in_array($fields['interes'], $allow_interes, true) )         $fields['interes']     = '';
        if ( ! in_array($fields['presupuesto'], $allow_presupuesto, true) ) $fields['presupuesto'] = '';
        if ( ! in_array($fields['referencia'], $allow_referencia, true) )   $fields['referencia']  = '';

        // ------------------------------------------------------------------
        // 4) Validaciones estrictas (longitudes, regex, tiempo mínimo)
        // ------------------------------------------------------------------
        $errors = [];

        // Tiempo mínimo de llenado (Honeypot 2)
        $started = isset($_POST['started_at']) ? (int) $_POST['started_at'] : 0;
        if ( $started && ( time() - $started ) < 3 ) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Sospecha de bot.',
            ], 403);
        }

        // Normalización de longitudes
        $fields['nombre']      = mb_substr($fields['nombre'], 0, 140);
        $fields['empresa']     = mb_substr($fields['empresa'], 0, 140);
        $fields['email']       = mb_substr($fields['email'], 0, 254);
        $fields['telefono']    = mb_substr($fields['telefono'], 0, 25);
        $fields['descripcion'] = mb_substr( wp_strip_all_tags($fields['descripcion']), 0, 4000 );

        // Requeridos
        if ( empty($fields['interes']) )                          $errors['interes']     = 'Selecciona una opción.';
        if ( empty($fields['nombre']) )                           $errors['nombre']      = 'Campo requerido.';
        if ( empty($fields['telefono']) )                         $errors['telefono']    = 'Campo requerido.';
        if ( empty($fields['email']) || ! is_email($fields['email']) )
            $errors['email']       = 'Email inválido.';
        if ( empty($fields['empresa']) )                          $errors['empresa']     = 'Campo requerido.';
        if ( empty($fields['presupuesto']) )                      $errors['presupuesto'] = 'Selecciona una opción.';
        if ( empty($fields['descripcion']) )                      $errors['descripcion'] = 'Campo requerido.';
        if ( empty($fields['referencia']) )                       $errors['referencia']  = 'Selecciona una opción.';

        // Teléfono simple: dígitos y símbolos comunes, 6–25 chars
        if ( ! empty($fields['telefono']) && ! preg_match('/^[0-9 +()\-]{6,25}$/', $fields['telefono']) ) {
            $errors['telefono'] = 'Teléfono inválido.';
        }

        if ( ! empty($errors) ) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Validación fallida.',
                'errors'  => $errors,
            ], 422);
        }

        // ------------------------------------------------------------------
        // 5) Crear el post del CPT
        // ------------------------------------------------------------------
        $title   = sprintf('%s (%s)', $fields['nombre'], $fields['email']);
        $content = $fields['descripcion']; // ya strippeado arriba

        $post_id = wp_insert_post([
            'post_type'   => 'ele_contact',
            'post_title'  => $title,
            'post_status' => 'publish', // o 'private'
            'post_content'=> $content,
        ], true);

        if ( is_wp_error($post_id) ) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'No se pudo crear el registro.',
            ], 500);
        }

        // ------------------------------------------------------------------
        // 6) Guardar meta (excepto descripcion que va en content)
        // ------------------------------------------------------------------
        foreach ($fields as $key => $val) {
            if ( $key === 'descripcion' ) continue;
            update_post_meta($post_id, "_ele_{$key}", $val);
        }

        // ------------------------------------------------------------------
        // 7) Respuesta OK
        // ------------------------------------------------------------------
        return new WP_REST_Response([
            'success' => true,
            'post_id' => $post_id,
            'message' => 'Lead guardado',
        ], 200);
    }
}
