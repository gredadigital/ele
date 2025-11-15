<?php

get_header();
?>

<?php

$proyectos_destacados = carbon_get_the_post_meta('ele_work_proyectos_destacados');
$equipo_img_id = carbon_get_the_post_meta('ele_work_equipo_imagen');

$equipo_img_url = $equipo_img_id
    ? wp_get_attachment_image_url($equipo_img_id, 'large')
    : get_template_directory_uri() . '/assets/images/placeholder.png';

// ALT: usamos un texto seguro
$equipo_alt = $equipo_img_id ? 'Equipo de trabajo' : 'Placeholder';

?>
<div class="card  mb-[600px] relative z-40">
    <div class="card card bg-light text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px]  rounded-b-3xl flex flex-col gap-38 pt-[120px] pb-[100px]">
        <section class="hero px-[19px] py-[37px]">
            <h2 class="font-serif font-bold italic text-[22px] mb-[22px] text-center">Nuestro trabajo</h2>
            <p class="font-serif font-semibold text-[22px]/6 text-center">Universos mágicos con identidades y mensajes encantadores.
                Explora el trabajo que crea emociones fuertes y resultados tangibles.</p>
        </section>
        <section class="gal">

            <?php
            // Obtenemos el término actual de la taxonomía
            $term = get_queried_object();

            // Consulta de proyectos de esta categoría
            $args = [
                'post_type'      => 'proyecto',
                'posts_per_page' => -1,
                'tax_query'      => [
                    [
                        'taxonomy' => 'proyecto_categoria',
                        'field'    => 'term_id',          // también puede ser 'slug'
                        'terms'    => $term->term_id,
                    ],
                ],
            ];

            $proyectos_query = new WP_Query($args);
            ?>

            <?php if ($proyectos_query->have_posts()) : ?>
                <ul class="flex flex-col gap-[1px]">
                    <?php
                    while ($proyectos_query->have_posts()) :
                        $proyectos_query->the_post();

                        $proyecto_id  = get_the_ID();
                        $proyecto_url = get_permalink($proyecto_id);

                        // Imagen representativa del proyecto (meta de ese post)
                        $imagen_id = carbon_get_post_meta($proyecto_id, 'ele_proyecto_imagen_representativa');
                        $imagen_url = $imagen_id
                            ? wp_get_attachment_image_url($imagen_id, 'large')
                            : get_template_directory_uri() . '/assets/images/placeholder.png';

                        // Título
                        $titulo_visible = get_the_title($proyecto_id);

                        // Descripción: primero meta larga, si no, título
                        $descripcion_item = carbon_get_post_meta($proyecto_id, 'ele_proyecto_descripcion');
                        $descripcion_item = wp_strip_all_tags((string) $descripcion_item);
                        $txt_contenido    = trim($descripcion_item) ?: $titulo_visible;
                        ?>
                        <li>
                            <a href="<?php echo esc_url($proyecto_url); ?>">
                                <img
                                    class="w-full"
                                    src="<?php echo esc_url($imagen_url); ?>"
                                    alt="<?php echo esc_attr($titulo_visible); ?>"
                                >
                            </a>
                            <div class="txt hidden">
                                <p class="font-sans font-light text-[14px]/5">
                                    <?php echo esc_html($txt_contenido); ?>
                                </p>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="font-sans font-light text-[14px]/5 px-[19px] py-[20px]">
                    No hay proyectos en esta categoría todavía.
                </p>
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

    <section class="renovar px-[44px] py-[60px] text-light bg-black flex flex-col justify-center">
        <p class="font-sans font-light text-[40px]/9 mb-[44px] text-center ">¿Es momento de renovar tu marca?</p>
        <a href="" class="bg-secundario p-[6px] flex gap-[4px] w-[180px] rounded-full flex justify-center mx-auto"><span class="text-black">Averiguémoslo</span> <span class="block w-[20px] h-[20px] bg-[url('../images/flecha_negra.svg')]"></span></a>
    </section>

    <div class="cont bg-orange rounded-3xl px-[58px] py-[100px]">

        <img
            src="<?php echo esc_url($equipo_img_url); ?>"
            alt="<?php echo esc_attr($equipo_alt); ?>"
        >
        <p class="font-sans font-light text-[40px]/9 my-[50px] text-center">Somos un equipo pequeño pero poderoso</p>
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
