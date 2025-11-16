<?php
/*Template Name: Home*/
get_header();

if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
    $trabajos = carbon_get_the_post_meta('ele_home_trabajos_seleccionados');
    $galeria = carbon_get_the_post_meta('ele_home_galeria');

    ?>


<div class="card bg-primario text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px] mb-[600px] pb-[100px] rounded-b-3xl">
    <div class="card bg-light text-gray-900 relative z-40 lg:mb-[100px]  md:mb-[600px]  rounded-b-3xl flex flex-col gap-38 pt-[100px]">
        <section class="hero py-28 md:px-[80px] md:py-[38px] lg:px-[20%]"><h2 class="text-32/9 text-center font-sans font-light lg:text-[64px]/14">
                <span class="block lg:inline">Bienvenido</span>
                <span class="block lg:inline">al mundo donde</span>
                <span class="block lg:inline">se crean marcas</span>
                <span class="block lg:inline">con magia.</span></h2>
        </section>
        <section class="separador bg-otrogris h-186"></section>
        <section class="pretitulo_seleccionados px-63 py-38 md:px-[180px] lg:px-[30%] lg:py-[160px]">
            <h3 class="text-center font-serif italic font-bold text-16 lg:text-[22px]">Trabajos seleccionados</h3>
            <p class="text-center font-sans text-22/7 lg:text-[32px]/9 font-light">Marcas que conectan con las personas a través de historias inolvidables</p>
        </section>
        <?php if (!empty($trabajos)) : ?>
            <section class="trabajos_seleccionados px-[30px] py-[9px] flex flex-col gap-[34px]">
                <?php foreach ($trabajos as $trabajo) :

                    // Imagen
                    $imagen_id  = $trabajo['imagen'] ?? null;
                    $imagen_url = $imagen_id
                            ? wp_get_attachment_image_url($imagen_id, 'large')
                            : get_template_directory_uri() . '/assets/images/placeholder_video.png';

                    // Asociación al proyecto (association)
                    $proyecto_id = null;
                    if (!empty($trabajo['proyecto']) && is_array($trabajo['proyecto'])) {
                        $assoc = $trabajo['proyecto'][0] ?? null;
                        if (!empty($assoc['id'])) {
                            $proyecto_id = (int) $assoc['id'];
                        }
                    }

                    $proyecto_url   = $proyecto_id ? get_permalink($proyecto_id) : '#';
                    $proyecto_title = $proyecto_id ? get_the_title($proyecto_id) : '';

                    // Título visible: primero el título del campo, si no, el del proyecto
                    $titulo = !empty($trabajo['titulo'])
                            ? $trabajo['titulo']
                            : $proyecto_title;

                    // Descripción
                    $descripcion = $trabajo['descripcion'] ?? '';

                    // ALT de la imagen: usa el título como fallback
                    $alt = $titulo ?: $proyecto_title ?: 'Trabajo seleccionado';
                    ?>

                    <div class="seleccionado flex flex-col gap-[7px] md:even:self-end md:odd:self-start md:w-[470px] lg:w-[742px] xl:w-[900px] 2xl:w-[900px] lg:px-[10%]">

                        <a href="<?php echo esc_url($proyecto_url); ?>">
                            <img
                                    class="object-cover"
                                    src="<?php echo esc_url($imagen_url); ?>"
                                    alt="<?php echo esc_attr($alt); ?>"
                            >
                        </a>

                        <div class="txt">
                            <?php if ($titulo) : ?>
                                <h3 class="font-serif font-bold italic text-[18px]">
                                    <?php echo esc_html($titulo); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($descripcion) : ?>
                                <p class="font-sans font-light text-[16px]/5">
                                    <?php echo esc_html($descripcion); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            </section>
        <?php endif; ?>


        <section class="negocios px-[80px] py-[69px] md:px-[240px]">
            <h3 class="font-serif font-bold italic text-center text-[24px]/6">Negocios que ayudamos a crear emociones intensas.</h3>
        </section>
        <section class="logos px-[30px] md:px-[180px]">
            <ul class="logos flex flex-wrap justify-center align-middle items-center gap-x-[65px] gap-y-[34px]">
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/typica.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bcp.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/lfwbi.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/fundaciongastonugalde.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/master_blends.svg" alt=""></li>
            </ul>
        </section>
        <section class="reunion px-[100px] py-[83px] flex justify-center">
            <a href="#" class="inline-flex items-center justify-between gap-3 rounded-full bg-black text-white
          pl-5 pr-2 py-2">
                <span class="text-sm font-medium">
                Agenda una reunión
                </span>
                <!-- Círculo blanco con el ícono -->
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white">
    <span class="block h-[39px] w-[39px] bg-[url('../images/mail.svg')] bg-no-repeat bg-center bg-contain"></span>
  </span>
            </a>
        </section>
        <?php if (!empty($galeria)) : ?>
            <section class="gal py-10 space-y-2">
                <!-- Fila 1: derecha → izquierda -->
                <div class="gal-wrapper">
                    <div class="gal-track gal-track-left">
                        <?php
                        // Bloque 1
                        foreach ($galeria as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';
                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Imagen de galería';
                            ?>
                            <div class="gal-item">
                                <img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($alt); ?>">
                            </div>
                        <?php endforeach; ?>

                        <?php
                        // Bloque 2 (duplicado para cinta continua)
                        foreach ($galeria as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';
                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Imagen de galería';
                            ?>
                            <div class="gal-item">
                                <img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($alt); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Fila 2: izquierda → derecha -->
                <div class="gal-wrapper">
                    <div class="gal-track gal-track-right">
                        <?php
                        // Bloque 1
                        foreach ($galeria as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';
                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Imagen de galería';
                            ?>
                            <div class="gal-item">
                                <img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($alt); ?>">
                            </div>
                        <?php endforeach; ?>

                        <?php
                        // Bloque 2 (duplicado para cinta continua)
                        foreach ($galeria as $item) :
                            $imagen_id  = $item['imagen'] ?? null;
                            $alt_text   = $item['alt'] ?? '';
                            $imagen_url = $imagen_id
                                    ? wp_get_attachment_image_url($imagen_id, 'large')
                                    : get_template_directory_uri() . '/assets/images/placeholder.png';

                            $alt = $alt_text ?: 'Imagen de galería';
                            ?>
                            <div class="gal-item">
                                <img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($alt); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>



        <section class="cierre px-[100px] py-[44px] text-[40px]/9 text-center flex flex-col gap-[52px] justify-center lg:px-[30%]">
            <h3 class="font-sans font-light lg:text-[64px]/14">¿Listo para una nueva aventura?</h3>
            <div class="anim text-center self-center">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/GifCaballero1.png" alt="">
            </div>
        </section>
    </div>
    <section class="callto px-[60px] py-[80px] flex flex-col gap-[52px] justify-center items-center">
        <p class="font-sans font-light text-[40px]/9 text-center">Trabajemos juntos en algo mágico</p>
        <a href="#"
           class="inline-flex items-center justify-between gap-4
          bg-black text-white rounded-full
          pl-6 pr-3 py-2 w-[140px]">

            <span class="text-sm font-medium">Háblanos</span>

            <span class="flex items-center justify-center
                 w-7 h-7 rounded-full">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/flecha.svg" alt="" class="w-3 h-3">
    </span>
        </a>

    </section>
</div>

<?php


endwhile;
endif;
get_footer(); ?>
