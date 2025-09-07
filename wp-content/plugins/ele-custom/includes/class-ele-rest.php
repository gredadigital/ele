<?php
/**
 * Clase REST para recepción de leads del formulario de landing.
 */
if ( ! defined('ABSPATH') ) exit;

class ELE_REST {

    /**
     * Boot: engancha el registro de rutas.
     */
    public static function init() {
        add_action('rest_api_init', [__CLASS__, 'register_routes']);
    }

    /**
     * Registra la ruta POST /wp-json/ele/v1/leads
     */
    public static function register_routes() {
        register_rest_route('ele/v1', '/leads', [
            'methods'             => 'POST',
            'callback'            => [__CLASS__, 'handle_lead'],
            'permission_callback' => '__return_true', // Seguridad interna en handle_lead()
            'args'                => [],
        ]);
    }

    /**
     * Callback del endpoint: valida, sanea y guarda el lead en el CPT ele_contact.
     */
    public static function handle_lead( WP_REST_Request $request ) {

        // -----------------------------
        // 1) Seguridad: nonce si logged-in, same-origin si público + honeypot
        // -----------------------------
        $nonce  = isset($_POST['ele_contact_nonce']) ? sanitize_text_field($_POST['ele_contact_nonce']) : '';
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? sanitize_text_field($_SERVER['HTTP_ORIGIN']) : '';
        $site   = get_site_url();

        if ( is_user_logged_in() ) {
            // Usuarios logueados deben pasar nonce válido
            if ( ! wp_verify_nonce( $nonce, 'ele_contact_form' ) ) {
                return new WP_REST_Response([
                    'success' => false,
                    'message' => 'Nonce inválido (logged-in).',
                ], 403);
            }
        } else {
            // Visitantes: comprobación de mismo origen (mitiga CSRF básico)
            if ( $origin && parse_url($origin, PHP_URL_HOST) !== parse_url($site, PHP_URL_HOST) ) {
                return new WP_REST_Response([
                    'success' => false,
                    'message' => 'Origen no permitido.',
                ], 403);
            }
            // Honeypot anti-bot (campo oculto "website" debe venir vacío)
            if ( ! empty($_POST['website']) ) {
                return new WP_REST_Response([
                    'success' => false,
                    'message' => 'Detección anti-bot.',
                ], 403);
            }
        }

        // -----------------------------
        // 2) Recoger y sanear campos del formulario (multipart/form-data)
        // -----------------------------
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

        // -----------------------------
        // 3) Whitelists para radios/sets
        // -----------------------------
        $allow_interes     = ['branding','ilustracion','rebranding','packaging-editorial'];
        $allow_presupuesto = ['>500','500-1000','1000-2000','<2000'];
        $allow_referencia  = ['instagram','linkedin','facebook','otro'];

        if ( ! in_array($fields['interes'], $allow_interes, true) )         $fields['interes']     = '';
        if ( ! in_array($fields['presupuesto'], $allow_presupuesto, true) ) $fields['presupuesto'] = '';
        if ( ! in_array($fields['referencia'], $allow_referencia, true) )   $fields['referencia']  = '';

        // -----------------------------
        // 4) Validaciones mínimas
        // -----------------------------
        $errors = [];

        if ( empty($fields['interes']) )                          $errors['interes']     = 'Selecciona una opción.';
        if ( empty($fields['nombre']) )                           $errors['nombre']      = 'Campo requerido.';
        if ( empty($fields['telefono']) )                         $errors['telefono']    = 'Campo requerido.';
        if ( empty($fields['email']) || ! is_email($fields['email']) )
            $errors['email']       = 'Email inválido.';
        if ( empty($fields['empresa']) )                          $errors['empresa']     = 'Campo requerido.';
        if ( empty($fields['presupuesto']) )                      $errors['presupuesto'] = 'Selecciona una opción.';
        if ( empty($fields['descripcion']) )                      $errors['descripcion'] = 'Campo requerido.';
        if ( empty($fields['referencia']) )                       $errors['referencia']  = 'Selecciona una opción.';

        if ( ! empty($errors) ) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Validación fallida.',
                'errors'  => $errors,
            ], 422);
        }

        // -----------------------------
        // 5) Crear el post del CPT (ele_contact)
        // -----------------------------
        $title   = sprintf('%s (%s)', $fields['nombre'], $fields['email']);
        $content = wp_strip_all_tags($fields['descripcion']);

        $post_id = wp_insert_post([
            'post_type'   => 'ele_contact',
            'post_title'  => $title,
            'post_status' => 'publish', // puedes usar 'private' si prefieres
            'post_content'=> $content,
        ], true);

        if ( is_wp_error($post_id) ) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'No se pudo crear el registro.',
            ], 500);
        }

        // -----------------------------
        // 6) Guardar meta (excepto descripcion ya en content)
        // -----------------------------
        foreach ($fields as $key => $val) {
            if ( $key === 'descripcion' ) continue;
            update_post_meta($post_id, "_ele_{$key}", $val);
        }

        // (Opcional) Notificación por email al admin:
        // $admin_email = get_option('admin_email');
        // wp_mail($admin_email, '[ELE] Nuevo lead', print_r($fields, true));

        // -----------------------------
        // 7) Respuesta OK
        // -----------------------------
        return new WP_REST_Response([
            'success' => true,
            'post_id' => $post_id,
            'message' => 'Lead guardado',
        ], 200);
    }
}
