<?php
get_header('negativo');
?>
<?php
// ID del proyecto actual
$proyecto_id = get_the_ID();

// Campos de Carbon Fields
$hero_id         = carbon_get_the_post_meta('ele_proyecto_imagen_hero');
$rep_id          = carbon_get_the_post_meta('ele_proyecto_imagen_representativa');
$slug_desc       = carbon_get_the_post_meta('ele_proyecto_slug_descriptivo');
$descripcion_proj = carbon_get_the_post_meta('ele_proyecto_descripcion');
$slug_desc        = carbon_get_the_post_meta('ele_proyecto_slug_descriptivo');
$descripcion_proj = carbon_get_the_post_meta('ele_proyecto_descripcion');
// Hero: usa hero, si no hay, usa representativa, si no, placeholder
$hero_url = $hero_id
        ? wp_get_attachment_image_url($hero_id, 'full')
        : ($rep_id
                ? wp_get_attachment_image_url($rep_id, 'large')
                : get_template_directory_uri() . '/assets/images/lplaceholder3.png'
        );

// Bloques (galeria, video, cita)
$bloques = carbon_get_the_post_meta('ele_proyecto_bloques');
?>

?>


<?php if(have_posts()): while(have_posts()):the_post(); ?>
<div class="card bg-pink text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px] mb-[600px] pb-[100px] rounded-b-3xl">
    <div class="card  bg-light text-gray-900 relative z-40 lg:mb-[100px]  md:mb-[100px]  rounded-b-3xl flex flex-col">
            <section class="hero h-[360px] md:h-[400px] lg:h-[870px] overflow-hidden">
                <img
                        class="w-full h-full object-cover"
                        src="<?php echo esc_url($hero_url); ?>"
                        alt="<?php echo esc_attr(get_the_title()); ?>"
                >
            </section>
        <section class="px-[15px] py-[45px] relative -top-[20px] rounded-3xl bg-light md:px-[30px] lg:px-[10%]">
            <section class="desc">
                <h2 class="font-serif font-bold italic text-[18px] mb-[1em]"><?php the_title(); ?></h2>
                <?php if (!empty($slug_desc)) : ?>
                <h3 class="slug font-serif font-bold text-[22px]/6 mb-[1em]"><?php echo esc_html($slug_desc); ?></h3>
                <?php endif; ?>
                <?php if (!empty($descripcion_proj)) : ?>
                    <div class="proyecto-descripcion font-sans text-[15px]/6 js-proyecto-descripcion">
                        <?php echo apply_filters('the_content', $descripcion_proj); ?>
                    </div>
                <?php endif; ?>

                <button class="leer-mas-btn flex flex-row gap-[4px] my-[15px] content-center-safe"><span>Leer más</span><span class="block w-[14px] h-[14px] bg-cover bg-[url('../images/flecha_negra.svg')]"></span></button>
            </section>
            <section class="contenido flex flex-col justify-center md:px-[60px]">
                <?php if (!empty($bloques)) : ?>
                    <?php foreach ($bloques as $bloque) :
                        $tipo = $bloque['_type'] ?? '';

                        switch ($tipo) {

                            // -------------------------
                            // BLOQUE: CITA
                            // -------------------------
                            case 'cita':
                                $texto_cita = $bloque['texto_cita'] ?? '';
                                $autor_cita = $bloque['autor_cita'] ?? '';
                                if (empty($texto_cita)) {
                                    break;
                                }
                                ?>
                                <div class="cita px-[15px] py-[45px]">
                                    <blockquote
                                            class="font-serif font-bold text-[22px]/6
                                before:content-['“']
                                before:inline-block before:text-[63px]
                                before:font-serif before:font-bold
                                before:leading-none before:mr-0
                                before:translate-y-[28px] before:transform"
                                    >
                                        <?php echo esc_html($texto_cita); ?>
                                    </blockquote>
                                    <?php if (!empty($autor_cita)) : ?>
                                        <cite class="font-sans font-light text-[14px] not-italic">
                                            <?php echo esc_html($autor_cita); ?>
                                        </cite>
                                    <?php endif; ?>
                                </div>
                                <?php
                                break;

                            // -------------------------
                            // BLOQUE: GALERÍA
                            // -------------------------
                            case 'galeria':
                                $gal_titulo   = $bloque['titulo'] ?? '';
                                $gal_imagenes = $bloque['imagenes'] ?? [];
                                if (empty($gal_imagenes)) {
                                    break;
                                }
                                ?>
                                <div class="galeria px-[15px] py-[45px]">
                                    <?php if ($gal_titulo) : ?>
                                        <h3 class="font-serif font-bold italic text-[18px] mb-[1em]">
                                            <?php echo esc_html($gal_titulo); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <ul class="flex flex-col gap-[15px]">
                                        <?php foreach ($gal_imagenes as $img_item) :
                                            $img_id  = $img_item['imagen'] ?? null;
                                            $img_alt = $img_item['alt'] ?? '';

                                            $img_url = $img_id
                                                    ? wp_get_attachment_image_url($img_id, 'large')
                                                    : get_template_directory_uri() . '/assets/images/lplaceholder1.png';

                                            $alt = $img_alt ?: 'Imagen del proyecto';
                                            ?>
                                            <li>
                                                <img class="w-full"
                                                        src="<?php echo esc_url($img_url); ?>"
                                                        alt="<?php echo esc_attr($alt); ?>"
                                                >
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php
                                break;

                            // -------------------------
                            // BLOQUE: VIDEO (YouTube)
                            // -------------------------
                            case 'video':
                                $vid_titulo = $bloque['titulo'] ?? '';
                                $vid_url    = $bloque['youtube_url'] ?? '';
                                $vid_desc   = $bloque['descripcion'] ?? '';

                                if (empty($vid_url)) {
                                    break;
                                }

                                // Opcional: podrías procesar $vid_url para convertir watch?v= a /embed/, aquí lo dejamos directo
                                ?>
                                <div class="video px-[15px] py-[45px]">
                                    <?php if ($vid_titulo) : ?>
                                        <h3 class="font-serif font-bold italic text-[18px] mb-[1em]">
                                            <?php echo esc_html($vid_titulo); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <iframe
                                            class="w-[100%] h-auto lg:w-[861px] lg:h-[484px] md:w-[523px] md:h-[294px]"
                                            src="<?php echo esc_url($vid_url); ?>"
                                            title="<?php echo esc_attr($vid_titulo ?: get_the_title()); ?>"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen
                                    ></iframe>

                                    <?php if (!empty($vid_desc)) : ?>
                                        <p class="font-sans text-[14px]/6 mt-[10px] max-w-[60ch]">
                                            <?php echo esc_html($vid_desc); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <?php
                                break;
                            case 'imagen_texto':
                                $img_id = $bloque['imagen'] ?? null;
                                $titulo = $bloque['titulo'] ?? '';
                                $texto  = $bloque['texto'] ?? '';

                                // URL de la imagen o placeholder
                                $img_url = $img_id
                                        ? wp_get_attachment_image_url($img_id, 'large')
                                        : get_template_directory_uri() . '/assets/images/placeholder2.png';
                                ?>

                                <div class="textoimg flex flex-col px-[15px] py-[45px]">
                                    <img class="block w-full min-h-[200px]"
                                         src="<?php echo esc_url($img_url); ?>"
                                         alt="<?php echo esc_attr($titulo); ?>">

                                    <div class="txt">
                                        <?php if (!empty($titulo)) : ?>
                                            <h3 class="font-serif font-bold mb-[1em] text-[22px]">
                                                <?php echo esc_html($titulo); ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($texto)) : ?>
                                            <p class="font-sans font-light text-[18px]/6">
                                                <?php echo wp_kses_post($texto); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php
                                break;

                        }

                    endforeach; ?>
                <?php endif; ?>
            </section>
        </section>


    </div>
</div>
<?php endwhile; endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.js-proyecto-descripcion');
        const btn = document.querySelector('.leer-mas-btn');

        if (!container || !btn) return;

        const paragraphs = container.querySelectorAll('p');

        if (paragraphs.length === 0) return;

        // Añadir mb-[1em] a todos los párrafos
        paragraphs.forEach(p => p.classList.add('mb-[1em]'));

        // Ocultar todos menos el primero
        paragraphs.forEach((p, index) => {
            if (index > 0) {
                p.classList.add('hidden');
            }
        });

        let expanded = false;

        btn.addEventListener('click', function () {
            expanded = !expanded;

            paragraphs.forEach((p, index) => {
                if (index > 0) {
                    p.classList.toggle('hidden', !expanded);
                }
            });

            // Texto del botón
            btn.querySelector('span').textContent = expanded ? 'Leer menos' : 'Leer más';
        });
    });
</script>

<?php


get_footer();
?>
