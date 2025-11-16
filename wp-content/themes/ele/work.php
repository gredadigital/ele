<?php
/*Template Name: Work */
get_header();
?>

<?php

$proyectos_destacados = carbon_get_the_post_meta('ele_work_proyectos_destacados');
$equipo_img_id = carbon_get_the_post_meta('ele_work_equipo_imagen');

$equipo_img_url = $equipo_img_id
        ? wp_get_attachment_image_url($equipo_img_id, 'large')
        : get_template_directory_uri() . '/assets/images/placeholder_video.png';

// ALT: usamos un texto seguro
$equipo_alt = $equipo_img_id ? 'Equipo de trabajo' : 'Placeholder';

?>
<div class="card  mb-[600px] relative z-40 lg:mb-[800px]">
    <div class="card card bg-light text-gray-900 relative z-40 rounded-b-3xl flex flex-col gap-38 pt-[120px] pb-[100px]">
        <section class="hero px-[19px] py-[37px] md:py-[60px] lg:px-[30%] lg:py-[120px]">
            <h2 class="font-serif font-bold italic text-[22px] mb-[22px] text-center">Nuestro trabajo</h2>
            <p class="font-serif font-semibold text-[22px]/6 text-center lg:text-[32px]/9">Universos mágicos con identidades y mensajes encantadores.
                Explora el trabajo que crea emociones fuertes y resultados tangibles.</p>
        </section>
        <section class="gal">

            <?php if (!empty($proyectos_destacados)) : ?>
                <ul class="flex flex-col gap-[1px] md:grid md:grid-cols-2">
                    <?php foreach ($proyectos_destacados as $item) :

                        // 1) Obtener ID del proyecto desde la association
                        $proyecto_id = null;
                        if (!empty($item['proyecto']) && is_array($item['proyecto'])) {
                            $assoc = $item['proyecto'][0] ?? null;
                            if (!empty($assoc['id'])) {
                                $proyecto_id = (int) $assoc['id'];
                            }
                        }

                        // Si no hay proyecto asociado, saltar este item
                        if (!$proyecto_id) {
                            continue;
                        }

                        // 2) URL del single
                        $proyecto_url = get_permalink($proyecto_id);

                        // 3) Imagen representativa del proyecto (meta de ese post)
                        $imagen_id = carbon_get_post_meta($proyecto_id, 'ele_proyecto_imagen_representativa');
                        $imagen_url = $imagen_id
                                ? wp_get_attachment_image_url($imagen_id, 'large')
                                : get_template_directory_uri() . '/assets/images/placeholder_video.png';

                        // 4) Título y descripción
                        $titulo_proyecto = get_the_title($proyecto_id);

                        // Título visible: usa titulo_custom si existe, si no el título del proyecto
                        $titulo_custom   = $item['titulo_custom'] ?? '';
                        $titulo_visible  = $titulo_custom ?: $titulo_proyecto;

                        // Descripción: primero la del repeater, si no, la descripción larga del proyecto
                        $descripcion_item = $item['descripcion'] ?? '';
                        if (empty($descripcion_item)) {
                            $descripcion_item = carbon_get_post_meta($proyecto_id, 'ele_proyecto_descripcion');
                            // Opcional: limpiar etiquetas HTML si quieres que sea texto plano
                            $descripcion_item = wp_strip_all_tags((string) $descripcion_item);
                        }

                        // Texto para el <p> dentro de .txt
                        $txt_contenido = trim($descripcion_item) ?: $titulo_visible;
                        ?>

                        <li class="relative group aspect-[4/3] overflow-hidden">
                            <a href="<?php echo esc_url($proyecto_url); ?>">
                                <img
                                        class="w-full h-full object-cover"
                                        src="<?php echo esc_url($imagen_url); ?>"
                                        alt="<?php echo esc_attr($titulo_visible); ?>"
                                >
                            </a>
                            <div class="txt
                hidden md:flex      <!-- oculto en mobile, flex sólo en desktop -->
                pointer-events-none  <!-- no bloquea el click del enlace -->
                absolute inset-0 z-10
                items-center justify-center
                bg-primario
                opacity-0
                transition-opacity duration-200
                md:group-hover:opacity-100">
                                <p class="font-sans font-light text-[32px] leading-normal text-white text-center px-8
                  transform -translate-y-[40px]               <!-- POSICIÓN INICIAL ARRIBA -->
                  transition-transform duration-500 ease-out
                  md:group-hover:translate-y-0">
                                    <?php echo esc_html($txt_contenido); ?>
                                </p>
                            </div>
                        </li>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <button
                    id="open-project-filter"
                    type="button"
                    class="fixed z-[8888] bg-black flex justify-between
           bottom-[60px] left-1/2 -translate-x-1/2
           w-[110px] pl-[12px] pr-[6px] py-[6px] rounded-full content-center
           translate-y-8 opacity-0 pointer-events-none
           transition-all duration-300 ease-out"
            >
                <span class="text-light text-[14px]/9">Filtros</span>
                <span class="block h-[39px] w-[39px] bg-[url('../images/plus.svg')] bg-no-repeat bg-center bg-contain"></span>
            </button>

        </section>


    </div>

<section class="renovar px-[44px] py-[60px] text-light bg-black flex flex-col justify-center lg:py-[220px] lg:px-[30%] ">
    <p class="font-sans font-light text-[40px]/9 mb-[44px] text-center lg:text-[64px]/14 lg:mb-[120px]">¿Es momento de renovar tu marca?</p>
        <a href="" class="bg-secundario p-[6px] gap-[4px] w-[180px] rounded-full flex justify-center mx-auto"><span class="text-black">Averiguémoslo</span> <span class="block w-[20px] h-[20px] bg-[url('../images/flecha_negra.svg')]"></span></a>
</section>

    <div class="cont bg-orange rounded-3xl px-[58px] py-[100px] flex flex-col justify-center lg:px-[30%]">

        <img class="md:w-[300px] self-center"
                src="<?php echo esc_url($equipo_img_url); ?>"
                alt="<?php echo esc_attr($equipo_alt); ?>"
        >
        <p class="font-sans font-light text-[40px]/9 my-[50px] text-center lg:text-[64px]/16">Somos un equipo pequeño pero poderoso</p>
        <div>
            <a href="" class="bg-black p-[6px] flex gap-[4px] w-[160px] mx-auto rounded-full justify-center"><span class="text-light">Conócenos</span> <span class="block w-[20px] h-[20px] bg-[url('../images/flecha.svg')]"></span></a>
        </div>
    </div>
</div>

<div id="project-filter-modal" class="fixed inset-0 z-[9999] flex items-center justify-center hidden">
    <!-- Fondo transparente / semioscuro -->
    <div id="modal-overlay" class="absolute inset-0 bg-black/60"></div>

    <!-- Caja negra con categorías (la de tu screenshot) -->
    <div class="relative mx-4 max-w-sm w-full rounded-[32px] bg-black text-white p-8">
        <h2 class="text-lg font-sans font-medium mb-6">
            Elige una categoría
        </h2>

        <ul class="space-y-6">
            <?php
            // ajusta el slug de la taxonomía si usaste otro
            $terms = get_terms([
                    'taxonomy'   => 'proyecto_categoria',
                    'hide_empty' => false,
            ]);

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                foreach ( $terms as $term ) :
                    $term_link = get_term_link( $term );
                    ?>
                    <li>
                        <a
                                href="<?php echo esc_url( $term_link ); ?>"
                                class="block text-left text-xl font-sans font-light hover:underline"
                        >
                            <?php echo esc_html( $term->name ); ?>
                        </a>
                    </li>
                <?php
                endforeach;
            endif;
            ?>
        </ul>


    </div>
</div>


<?php
get_footer();
?>
