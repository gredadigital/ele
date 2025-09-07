<?php
function ele_enqueue_assets() {
    $css_path = get_stylesheet_directory() . '/assets/css/tw.build.css';
    $css_uri  = get_stylesheet_directory_uri() . '/assets/css/tw.build.css';

    // Usa filemtime para hacer bust de caché en dev
    $ver = file_exists( $css_path ) ? filemtime( $css_path ) : null;

    wp_enqueue_style( 'ele-tailwind', $css_uri, [], $ver, 'all' );
}
add_action( 'wp_enqueue_scripts', 'ele_enqueue_assets' );

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

        // Nuestro inicializador (lo crearemos en el siguiente paso)
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
});
// Shortcode [gcal_button] para usar DESDE la plantilla (no editor)
add_shortcode('gcal_button', function ($atts) {
    $atts = shortcode_atts([
        'url'   => 'https://calendar.google.com/calendar/appointments/schedules/AcZssZ18rAPSDOo4f2nxVDn2Ps74qwyOCRGFNsZPFVj1fgEIfjPR8ORiPf0XBtogrOhlu6zisIFrUcru?gv=true',
        'label' => 'Haz una cita',
        'color' => '#000'
    ], $atts, 'gcal_button');

    $id = 'gcal-mount-' . wp_generate_uuid4();

    // Contenedor centrado + botón Tailwind visible + mount oculto
    return sprintf(
        '<div class="gcal-proxy flex justify-center mt-8">
        <button type="button"
                class="inline-flex items-center justify-center px-6 py-3 rounded-full
                       bg-black text-white hover:bg-black/90 transition
                       focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2
                       font-sans font-regular"
                data-gcal-mount="%1$s"
                data-url="%2$s"
                data-color="%4$s"
                data-label="%3$s">
          %3$s
        </button>
        <span id="%1$s" class="sr-only" aria-hidden="true"></span>
     </div>',
        esc_attr($id),
        esc_url($atts['url']),
        esc_html($atts['label']),
        esc_attr($atts['color'])
    );
});
