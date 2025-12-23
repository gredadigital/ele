<?php

// CPT Proyectos
add_action('init', 'ele_register_proyectos_cpt');

function ele_register_proyectos_cpt()
{
    $labels = [
        'name' => 'Proyectos',
        'singular_name' => 'Proyecto',
        'menu_name' => 'Proyectos',
        'name_admin_bar' => 'Proyecto',
        'add_new' => 'Añadir nuevo',
        'add_new_item' => 'Añadir nuevo proyecto',
        'edit_item' => 'Editar proyecto',
        'new_item' => 'Nuevo proyecto',
        'view_item' => 'Ver proyecto',
        'view_items' => 'Ver proyectos',
        'search_items' => 'Buscar proyectos',
        'not_found' => 'No se encontraron proyectos',
        'not_found_in_trash' => 'No hay proyectos en la papelera',
        'all_items' => 'Todos los proyectos',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,          // Compatible con editor de bloques
        'has_archive' => true,           // /proyectos/
        'rewrite' => ['slug' => 'proyectos'],
        'menu_position' => 20,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'hierarchical' => false,
    ];

    register_post_type('proyecto', $args);
}

// Taxonomía para Proyectos: Categorías (Cultura, Educación, etc.)
add_action('init', 'ele_register_proyecto_categorias');

function ele_register_proyecto_categorias()
{
    $labels = [
        'name'              => 'Categorías de proyectos',
        'singular_name'     => 'Categoría de proyecto',
        'search_items'      => 'Buscar categorías',
        'all_items'         => 'Todas las categorías',
        'parent_item'       => 'Categoría superior',
        'parent_item_colon' => 'Categoría superior:',
        'edit_item'         => 'Editar categoría',
        'update_item'       => 'Actualizar categoría',
        'add_new_item'      => 'Añadir nueva categoría',
        'new_item_name'     => 'Nombre de la nueva categoría',
        'menu_name'         => 'Categorías de proyectos',
    ];

    $args = [
        'hierarchical'      => true, // como las categorías de posts
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true, // visible en Gutenberg / REST
        'query_var'         => true,
        'rewrite'           => ['slug' => 'categoria-proyecto'],
    ];

    register_taxonomy('proyecto_categoria', ['proyecto'], $args);
}

// Crear categorías por defecto para Proyectos
add_action('init', 'ele_insert_default_proyecto_terms');

function ele_insert_default_proyecto_terms()
{
    $default_terms = ['Cultura', 'Educación', 'Negocios', 'Tecnología', 'Marca'];

    foreach ($default_terms as $term_name) {
        if (!term_exists($term_name, 'proyecto_categoria')) {
            wp_insert_term($term_name, 'proyecto_categoria');
        }
    }
}

/**
 * Enqueue de fuentes + Tailwind
 * (Incluye preconnect recomendado para Google Fonts)
 */
function ele_enqueue_assets()
{
    $css_path = get_stylesheet_directory() . '/assets/css/tw.build.css';
    $css_uri  = get_stylesheet_directory_uri() . '/assets/css/tw.build.css';

    $ver = file_exists($css_path) ? filemtime($css_path) : null;

    // Google Fonts como stylesheet (evita problemas típicos de @import en builds)
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500&family=EB+Garamond:ital,wght@0,600;0,700;1,700&display=swap',
        [],
        null
    );

    // Tailwind build (dependiente de google-fonts para garantizar orden)
    wp_enqueue_style('ele-tailwind', $css_uri, ['google-fonts'], $ver, 'all');
}
add_action('wp_enqueue_scripts', 'ele_enqueue_assets');

// Preconnect para Google Fonts (mejora performance y estabilidad de carga)
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}, 1);

add_action('wp_enqueue_scripts', function () {

    // Carga solo si la página actual usa la plantilla landing.php
    if (is_page_template('landing.php')) {

        // CSS del botón/modal de Google
        wp_enqueue_style(
            'gcal-scheduling-css',
            'https://calendar.google.com/calendar/scheduling-button-script.css',
            [],
            null
        );

        // Script de Google (async)
        wp_enqueue_script(
            'gcal-scheduling-js',
            'https://calendar.google.com/calendar/scheduling-button-script.js',
            [],
            null,
            true
        );
        wp_script_add_data('gcal-scheduling-js', 'async', true);

        // Nuestro inicializador
        $init_path = get_stylesheet_directory() . '/assets/js/gcal-init.js';
        $init_uri  = get_stylesheet_directory_uri() . '/assets/js/gcal-init.js';

        // Asegúrate de crear este archivo aunque sea vacío para evitar 404
        wp_enqueue_script(
            'gcal-scheduling-init',
            $init_uri,
            ['gcal-scheduling-js'],
            file_exists($init_path) ? filemtime($init_path) : null,
            true
        );
    }

    wp_enqueue_script(
        'ele-menu-mobile',
        get_template_directory_uri() . '/assets/js/menu-mobile.js',
        [], // dependencias (por ahora vacío)
        null,
        true // en footer
    );

    if (is_page_template('work.php') || is_tax('proyecto_categoria')) {
        wp_enqueue_script(
            'ele-modal-filter',
            get_template_directory_uri() . '/assets/js/modal_filter.js',
            [], // dependencias (añade 'jquery' si lo usas)
            '1.0',
            true // en el footer
        );
    }
});

if (!function_exists('ele_sanitize_tw_classes')) {
    /**
     * Permite únicamente caracteres seguros para clases Tailwind:
     * letras, números, guiones, dos puntos, slash, corchetes, porcentaje y espacios.
     */
    function ele_sanitize_tw_classes($value)
    {
        $value = wp_strip_all_tags((string)$value);
        return preg_replace('/[^a-zA-Z0-9\-\:\/\[\]\%\s]/', '', $value);
    }
}

// Shortcode [gcal_button] para usar DESDE la plantilla (no editor)
add_shortcode('gcal_button', function ($atts) {
    $atts = shortcode_atts([
        'url'   => 'https://calendar.google.com/calendar/appointments/schedules/AcZssZ18rAPSDOo4f2nxVDn2Ps74qwyOCRGFNsZPFVj1fgEIfjPR8ORiPf0XBtogrOhlu6zisIFrUcru?gv=true',
        'label' => 'Haz una cita',
        'color' => '#000',                 // color para el modal de Google
        'bg'    => 'bg-black',             // clase Tailwind de fondo
        'text'  => 'text-white',           // clase Tailwind de texto
        'font'  => 'font-sans font-regular' // clases Tailwind de tipografía
    ], $atts, 'gcal_button');

    // Sanitizar clases Tailwind y color
    $atts['bg']   = ele_sanitize_tw_classes($atts['bg']);
    $atts['text'] = ele_sanitize_tw_classes($atts['text']);
    $atts['font'] = ele_sanitize_tw_classes($atts['font']);

    // Color del modal: usa el helper nativo de WP y haz fallback a #000
    $atts['color'] = sanitize_hex_color($atts['color']);
    if (!$atts['color']) {
        $atts['color'] = '#000';
    }

    $id = 'gcal-mount-' . wp_generate_uuid4();

    return sprintf(
        '<div class="gcal-proxy flex justify-center mt-4">
        <button type="button"
                class="inline-flex items-center justify-center px-6 py-3 rounded-full
                       transition hover:opacity-90
                       focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2
                       %4$s %5$s %6$s"
                data-gcal-mount="%1$s"
                data-url="%2$s"
                data-color="%7$s"
                data-label="%3$s">
          %3$s
        </button>
        <span id="%1$s" class="sr-only" aria-hidden="true"></span>
     </div>',
        esc_attr($id),
        esc_url($atts['url']),
        esc_html($atts['label']),
        esc_attr($atts['bg']),
        esc_attr($atts['text']),
        esc_attr($atts['font']),
        esc_attr($atts['color'])
    );
});

// Registrar ubicaciones de menú
add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary' => __('Menú principal', 'ele'),
        'footer'  => __('Menú de pie', 'ele'),
    ]);
});

// Añadir clases a los enlaces del menú (sin walker), sólo para 'primary'
add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {
    if (isset($args->theme_location) && $args->theme_location === 'primary') {
        $link_classes = 'px-3 py-2 rounded-full transition hover:opacity-80 focus:outline-none';
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' ' . $link_classes : $link_classes;
    }
    return $atts;
}, 10, 3);

/**
 * Oculta Entradas y Comentarios del menú de administración
 */
add_action('admin_menu', 'ele_ocultar_posts_y_comentarios');
function ele_ocultar_posts_y_comentarios()
{
    // Oculta "Entradas"
    remove_menu_page('edit.php');

    // Oculta "Comentarios"
    remove_menu_page('edit-comments.php');
}

/**
 * Opcional: también oculta Comentarios de la barra superior de administración
 */
add_action('admin_bar_menu', 'ele_ocultar_comentarios_admin_bar', 999);
function ele_ocultar_comentarios_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('comments');
}

/**
 * Desactivar Gutenberg para Páginas y Proyectos
 */
add_filter('use_block_editor_for_post_type', 'ele_disable_gutenberg_for_post_types', 10, 2);
function ele_disable_gutenberg_for_post_types($can_edit, $post_type)
{
    $disabled_post_types = ['page', 'proyecto', 'proyectos']; // uso ambos por si tu CPT tiene uno u otro slug

    if (in_array($post_type, $disabled_post_types, true)) {
        return false;
    }

    return $can_edit;
}

/**
 * Eliminar soporte del editor clásico para Páginas y Proyectos
 * (esto oculta completamente la caja del editor)
 */
add_action('init', 'ele_remove_editor_support_from_post_types', 100);
function ele_remove_editor_support_from_post_types()
{
    $post_types = ['page', 'proyecto', 'proyectos'];

    foreach ($post_types as $pt) {
        if (post_type_exists($pt)) {
            remove_post_type_support($pt, 'editor');
        }
    }
}
