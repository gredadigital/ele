<?php
/**
 * Clase para registrar el CPT de Tomas de contacto y personalizar su listado en admin.
 */
if ( ! defined('ABSPATH') ) exit;

class ELE_CPT {

    /**
     * Bootstrap de hooks.
     */
    public static function init() {
        // CPT
        add_action('init', [__CLASS__, 'register_contact_cpt']);

        // Admin (columnas, filtros, orden)
        add_action('admin_init', [__CLASS__, 'setup_admin_list']);
        add_action('restrict_manage_posts', [__CLASS__, 'add_filters_ui']);
        add_action('pre_get_posts', [__CLASS__, 'apply_filters_query']);
    }

    /**
     * Registrar el Custom Post Type ele_contact.
     */
    public static function register_contact_cpt() {
        $labels = [
            'name'                  => 'Tomas de contacto',
            'singular_name'         => 'Toma de contacto',
            'menu_name'             => 'Tomas de contacto',
            'name_admin_bar'        => 'Toma de contacto',
            'add_new'               => 'Añadir nueva',
            'add_new_item'          => 'Añadir nueva toma de contacto',
            'new_item'              => 'Nueva toma de contacto',
            'edit_item'             => 'Editar toma de contacto',
            'view_item'             => 'Ver toma de contacto',
            'all_items'             => 'Todas las tomas',
            'search_items'          => 'Buscar tomas',
            'not_found'             => 'No se encontraron tomas',
            'not_found_in_trash'    => 'No hay tomas en la papelera',
        ];

        $args = [
            'labels'             => $labels,
            'public'             => false,        // No en el front
            'show_ui'            => true,         // Sí en el admin
            'show_in_menu'       => true,
            'menu_position'      => 26,
            'menu_icon'          => 'dashicons-email', // Icono de sobre
            'capability_type'    => 'post',
            'map_meta_cap'       => true,
            'hierarchical'       => false,
            'supports'           => ['title', 'editor'], // title = "Nombre (Email)"; editor = notas internas
            'has_archive'        => false,
            'rewrite'            => false,
            'query_var'          => false,
            'show_in_rest'       => false,        // Usamos endpoint propio
        ];

        register_post_type('ele_contact', $args);
    }

    /**
     * Hooks para columnas y ordenación en el listado admin.
     */
    public static function setup_admin_list() {
        // Columnas
        add_filter('manage_edit-ele_contact_columns', [__CLASS__, 'admin_columns']);
        add_action('manage_ele_contact_posts_custom_column', [__CLASS__, 'render_admin_column'], 10, 2);

        // Columnas ordenables
        add_filter('manage_edit-ele_contact_sortable_columns', [__CLASS__, 'make_sortable_columns']);
        add_action('pre_get_posts', [__CLASS__, 'orderby_meta_columns']);
    }

    /**
     * Definición de columnas personalizadas.
     */
    public static function admin_columns($columns) {
        $new = [];
        $new['cb']          = isset($columns['cb']) ? $columns['cb'] : '<input type="checkbox" />';
        $new['title']       = __('Contacto', 'ele');
        $new['email']       = __('Email', 'ele');
        $new['telefono']    = __('Teléfono', 'ele');
        $new['empresa']     = __('Empresa', 'ele');
        $new['interes']     = __('Interés', 'ele');
        $new['presupuesto'] = __('Presupuesto', 'ele');
        $new['referencia']  = __('Referencia', 'ele');
        $new['date']        = __('Fecha', 'ele');
        return $new;
    }

    /**
     * Render de cada celda de las columnas personalizadas.
     */
    public static function render_admin_column($column, $post_id) {
        switch ($column) {
            case 'email':
                $email = get_post_meta($post_id, '_ele_email', true);
                echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
                break;

            case 'telefono':
                $tel = get_post_meta($post_id, '_ele_telefono', true);
                echo $tel ? esc_html($tel) : '—';
                break;

            case 'empresa':
                $empresa = get_post_meta($post_id, '_ele_empresa', true);
                echo $empresa ? esc_html($empresa) : '—';
                break;

            case 'interes':
                $v = get_post_meta($post_id, '_ele_interes', true);
                echo $v ? esc_html($v) : '—';
                break;

            case 'presupuesto':
                $v = get_post_meta($post_id, '_ele_presupuesto', true);
                echo $v ? esc_html($v) : '—';
                break;

            case 'referencia':
                $v = get_post_meta($post_id, '_ele_referencia', true);
                echo $v ? esc_html($v) : '—';
                break;
        }
    }

    /**
     * Declarar columnas ordenables.
     */
    public static function make_sortable_columns($columns) {
        $columns['email']       = 'email';
        $columns['telefono']    = 'telefono';
        $columns['empresa']     = 'empresa';
        $columns['interes']     = 'interes';
        $columns['presupuesto'] = 'presupuesto';
        $columns['referencia']  = 'referencia';
        return $columns;
    }

    /**
     * Implementar el orden por meta_value según la columna seleccionada.
     */
    public static function orderby_meta_columns($query) {
        if ( ! is_admin() || ! $query->is_main_query() ) return;
        if ( $query->get('post_type') !== 'ele_contact' ) return;

        $orderby = $query->get('orderby');
        $map = [
            'email'       => '_ele_email',
            'telefono'    => '_ele_telefono',
            'empresa'     => '_ele_empresa',
            'interes'     => '_ele_interes',
            'presupuesto' => '_ele_presupuesto',
            'referencia'  => '_ele_referencia',
        ];

        if ( isset($map[$orderby]) ) {
            $query->set('meta_key', $map[$orderby]);
            $query->set('orderby', 'meta_value'); // alfabético
        }
    }

    /**
     * Opciones válidas para filtros.
     */
    public static function get_allowed_options() {
        return [
            'interes' => ['ilustracion','branding','packaging','editorial'],
            'presupuesto' => ['>500','500-1000','1000-2000','<2000'],
        ];
    }

    /**
     * UI de filtros (dropdowns) encima de la tabla.
     */
    public static function add_filters_ui() {
        global $typenow;
        if ( $typenow !== 'ele_contact' ) return;

        $allowed = self::get_allowed_options();

        // Interés
        $current_interes = isset($_GET['ele_interes']) ? sanitize_text_field($_GET['ele_interes']) : '';
        echo '<select name="ele_interes" id="ele_interes" class="postform">';
        echo '<option value="">' . esc_html__('Todos los intereses', 'ele') . '</option>';
        foreach ($allowed['interes'] as $opt) {
            printf(
                '<option value="%1$s"%2$s>%1$s</option>',
                esc_attr($opt),
                selected($current_interes, $opt, false)
            );
        }
        echo '</select>';

        // Presupuesto
        $current_pres = isset($_GET['ele_presupuesto']) ? sanitize_text_field($_GET['ele_presupuesto']) : '';
        echo '<select name="ele_presupuesto" id="ele_presupuesto" class="postform">';
        echo '<option value="">' . esc_html__('Todos los presupuestos', 'ele') . '</option>';
        foreach ($allowed['presupuesto'] as $opt) {
            printf(
                '<option value="%1$s"%2$s>%1$s</option>',
                esc_attr($opt),
                selected($current_pres, $opt, false)
            );
        }
        echo '</select>';
    }

    /**
     * Aplicar filtros a la query principal del listado.
     */
    public static function apply_filters_query($query) {
        if ( ! is_admin() || ! $query->is_main_query() ) return;
        if ( $query->get('post_type') !== 'ele_contact' ) return;

        $allowed = self::get_allowed_options();
        $meta_query = (array) $query->get('meta_query');

        // Filtro por interés
        if ( isset($_GET['ele_interes']) && in_array($_GET['ele_interes'], $allowed['interes'], true) ) {
            $meta_query[] = [
                'key'   => '_ele_interes',
                'value' => sanitize_text_field($_GET['ele_interes']),
            ];
        }

        // Filtro por presupuesto
        if ( isset($_GET['ele_presupuesto']) && in_array($_GET['ele_presupuesto'], $allowed['presupuesto'], true) ) {
            $meta_query[] = [
                'key'   => '_ele_presupuesto',
                'value' => sanitize_text_field($_GET['ele_presupuesto']),
            ];
        }

        if ( ! empty($meta_query) ) {
            $query->set('meta_query', $meta_query);
        }
    }
}
