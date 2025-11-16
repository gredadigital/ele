<?php
/*Template Name: Studio*/
get_header('negativo');
?>

<?php
$hero_tipo      = carbon_get_the_post_meta('ele_studio_hero_tipo');
$hero_imagen_id = carbon_get_the_post_meta('ele_studio_hero_imagen');
$hero_video_id  = carbon_get_the_post_meta('ele_studio_hero_video');

$hero_imagen_url = $hero_imagen_id
        ? wp_get_attachment_image_url($hero_imagen_id, 'full')
        : get_template_directory_uri() . '/assets/images/cholas.png';

// URL del video del hero (si existe)
$hero_video_url = $hero_video_id ? wp_get_attachment_url($hero_video_id) : '';
$servicios = carbon_get_the_post_meta('ele_studio_servicios');
$equipo = carbon_get_the_post_meta('ele_studio_equipo_miembros');
$galeria_equipo = carbon_get_the_post_meta('ele_studio_galeria_equipo');
$galeria_trabajos = carbon_get_the_post_meta('ele_studio_galeria_trabajos');



?>
<div class="card bg-secundario text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px] mb-[600px] pb-[100px] rounded-b-3xl">
    <div class="card bg-light text-gray-900 relative z-40 lg:mb-[100px]  md:mb-[100px]  rounded-b-3xl flex flex-col">



        <section class="hero studio h-[360px] md:h-[400px] lg:h-[870px] overflow-hidden">
            <?php if ($hero_tipo === 'video' && $hero_video_url) : ?>
                <video
                        class="w-full h-full object-cover"
                        autoplay
                        muted
                        loop
                        playsinline
                >
                    <source src="<?php echo esc_url($hero_video_url); ?>" type="video/mp4">
                    <!-- Fallback a imagen si el navegador no soporta video -->
                    <img src="<?php echo esc_url($hero_imagen_url); ?>" alt="">
                </video>
            <?php else : ?>
                <img
                        class="w-full h-full object-cover"
                        src="<?php echo esc_url($hero_imagen_url); ?>"
                        alt=""
                >
            <?php endif; ?>
        </section>
        <?php if (!empty($servicios)) : ?>
            <section class="especialidades bg-black rounded-3xl p-[15px] text-light relative -top-[20px] py-[60px] lg:px-[10%] lg-py-[60px]">
                <ul class="flex flex-col md:flex-row gap-[35px] lg:gap-[60px] justify-center">
                    <?php foreach ($servicios as $servicio) :

                        $imagen_id  = $servicio['imagen'] ?? null;
                        $titulo     = $servicio['titulo'] ?? '';
                        $texto      = $servicio['texto'] ?? '';

                        $imagen_url = $imagen_id
                                ? wp_get_attachment_image_url($imagen_id, 'medium')
                                : get_template_directory_uri() . '/assets/images/placeholder2.png';

                        $alt = $titulo ?: 'Servicio';
                        ?>
                        <li>
                            <img
                                    class="block mx-auto mb-[15px] md:w-full"
                                    src="<?php echo esc_url($imagen_url); ?>"
                                    alt="<?php echo esc_attr($alt); ?>"
                            >
                            <?php if ($titulo) : ?>
                                <h3 class="font-serif font-bold italic text-[18px] mb-[15px]">
                                    <?php echo esc_html($titulo); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($texto) : ?>
                                <p class="font-sans font-light text-[14px]/5">
                                    <?php echo esc_html($texto); ?>
                                </p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <section class="somos px-[30px] py-[60px] flex flex-col gap-[15px]">
            <div class="discurso px-[15px] pb-[65px] font-serif font-bold text-[18px]/6 text-center md:px-[120px] md:pb-[120px] lg:px-[30%] lg:py-[120px]">

                <p class="mb-[1em]">Somos exploradores creativos que piensan diferete, se rien de las reglas y disfrutan transformar problemas en ideas brillantes.</p>
                <p>Jugamos en serio con la magia del diseño para contar historias que empujan límites.</p>
            </div>
            <?php if (!empty($equipo)) : ?>
                <ul class="integrantes flex flex-col md:flex-row justify-center gap-[15px] flex-wrap">
                    <?php foreach ($equipo as $miembro) :

                        // Foto
                        $foto_id  = $miembro['foto'] ?? null;
                        $foto_url = $foto_id
                                ? wp_get_attachment_image_url($foto_id, 'large')
                                : get_template_directory_uri() . '/assets/images/placeholder2.png';

                        // Texto
                        $nombre = $miembro['nombre'] ?? '';
                        $cargo  = $miembro['cargo'] ?? '';

                        $alt = $nombre ?: 'Integrante del equipo';
                        ?>

                        <li>
                            <img
                                    class="block w-full mx-auto"
                                    src="<?php echo esc_url($foto_url); ?>"
                                    alt="<?php echo esc_attr($alt); ?>"
                            >

                            <?php if ($nombre) : ?>
                                <h3 class="font-serif font-bold text-[18px]">
                                    <?php echo esc_html($nombre); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($cargo) : ?>
                                <p class="font-serif font-bold italic text-[14px]">
                                    <?php echo esc_html($cargo); ?>
                                </p>
                            <?php endif; ?>
                        </li>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </section>
        <?php if (!empty($galeria_trabajos)) : ?>
            <section class="gal py-10 space-y-2">
                <!-- Fila 1: derecha → izquierda -->
                <div class="gal-wrapper">
                    <div class="gal-track gal-track-left">
                        <?php
                        // Bloque 1
                        foreach ($galeria_trabajos as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';

                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Trabajo del estudio';
                            ?>
                            <div class="gal-item">
                                <img
                                        src="<?php echo esc_url($imagen_url); ?>"
                                        alt="<?php echo esc_attr($alt); ?>"
                                >
                            </div>
                        <?php endforeach; ?>

                        <?php
                        // Bloque 2 (duplicado para cinta continua)
                        foreach ($galeria_trabajos as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';

                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Trabajo del estudio';
                            ?>
                            <div class="gal-item">
                                <img
                                        src="<?php echo esc_url($imagen_url); ?>"
                                        alt="<?php echo esc_attr($alt); ?>"
                                >
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Fila 2: izquierda → derecha -->
                <div class="gal-wrapper">
                    <div class="gal-track gal-track-right">
                        <?php
                        // Bloque 1
                        foreach ($galeria_trabajos as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';

                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Trabajo del estudio';
                            ?>
                            <div class="gal-item">
                                <img
                                        src="<?php echo esc_url($imagen_url); ?>"
                                        alt="<?php echo esc_attr($alt); ?>"
                                >
                            </div>
                        <?php endforeach; ?>

                        <?php
                        // Bloque 2 (duplicado para cinta continua)
                        foreach ($galeria_trabajos as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';

                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Trabajo del estudio';
                            ?>
                            <div class="gal-item">
                                <img
                                        src="<?php echo esc_url($imagen_url); ?>"
                                        alt="<?php echo esc_attr($alt); ?>"
                                >
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>


        <section class="tripo px-[30px]">
            <?php if (!empty($galeria_equipo)) : ?>
                <ul class="flex flex-col md:flex-row gap-[15px] mb-[100px] justify-center flex-wrap">
                    <?php foreach ($galeria_equipo as $item) :

                        $imagen_id  = $item['imagen'] ?? null;
                        $alt_text   = $item['alt'] ?? '';

                        $imagen_url = $imagen_id
                                ? wp_get_attachment_image_url($imagen_id, 'large')
                                : get_template_directory_uri() . '/assets/images/placeholder2.png';

                        $alt = $alt_text ?: 'Imagen de equipo / estudio';
                        ?>

                        <li>
                            <img
                                    class="block w-full mx-auto"
                                    src="<?php echo esc_url($imagen_url); ?>"
                                    alt="<?php echo esc_attr($alt); ?>"
                            >
                        </li>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </div>
</div>

<?php get_footer(); ?>
