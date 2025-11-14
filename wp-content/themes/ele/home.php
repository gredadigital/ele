<?php
/*Template Name: Home*/
get_header();
?>
<div class="card bg-primario text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px] mb-[600px] pb-[100px] rounded-b-3xl">
    <div class="card bg-light text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px]  rounded-b-3xl flex flex-col gap-38 pt-[100px]">
        <section class="hero py-28"><h2 class="text-32/9 text-center font-sans">
                <span>Bienvenido</span>
                <span>al mundo donde</span>
                <span>se crean marcas con magia.</span></h2>
        </section>
        <section class="separador bg-otrogris h-186"></section>
        <section class="pretitulo_seleccionados px-63 py-38">
            <h3 class="text-center font-serif italic font-bold text-16">Trabajos seleccionados</h3>
            <p class="text-center font-sans text-22/7 font-light">Marcas que conectan con las personas a través de historias inolvidables</p>
        </section>
        <section class="trabajos_seleccionados px-[30px] py-[9px] flex flex-col gap-[34px]">
            <div class="seleccionado flex flex-col gap-[7px]">

                    <a href="">
                        <img class="object-cover" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt="">
                    </a>

                <div class="txt"><h3 class="font-serif font-bold italic text-[18px]">Jacinto</h3>
                    <p CLASS="font-sans font-light text-[16px]/5">Una marca que captura lo cotidiano y se
                        transforma en extraordinario, sin perder calidez.</p></div>
            </div>
            <div class="seleccionado flex flex-col gap-[7px]">

                    <a href="">
                        <img class="object-cover" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt="">
                    </a>

                <div class="txt"><h3 class="font-serif font-bold italic text-[18px]">BCP</h3>
                    <p CLASS="font-sans font-light text-[16px]/5">Hacer de una banca móvil un lugar que recordar, un lugar
                        con un poco de casa.</p></div>
            </div>
            <div class="seleccionado  flex flex-col gap-[7px]">

                    <a href="">
                        <img class="object-cover" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt="">
                    </a>

                <div class="txt"><h3 class="font-serif font-bold italic text-[18px]">Comanche</h3>
                    <p CLASS="font-sans font-light text-[16px]/5">Un producto turístico con el que puedes viajar en el
                        tiempo.</p></div>
            </div>
        </section>
        <section class="negocios px-[80px] py-[69px]">
            <h3 class="font-serif font-bold italic text-center text-[24px]/6">Negocios que ayudamos a crear emociones intensas.</h3>
        </section>
        <section class="logos px-[30px]">
            <ul class="logos flex flex-wrap justify-center align-middle items-center gap-x-[65px] gap-y-[34px]">
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/typica.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bcp.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/lfwbi.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/fundaciongastonugalde.svg" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/master_blends.svg" alt=""></li>
            </ul>
        </section>
        <section class="reunion px-[100px] py-[83px]">
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
        <section class="gal py-10 space-y-2">
            <!-- Fila 1: derecha → izquierda -->
            <div class="gal-wrapper">
                <div class="gal-track gal-track-left">
                    <!-- Bloque 1 -->
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal1.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal2.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal3.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal4.png" alt="">
                    </div>

                    <!-- Bloque 2 (duplicado para cinta continua) -->
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal1.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal2.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal3.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal4.png" alt="">
                    </div>
                </div>
            </div>

            <!-- Fila 2: izquierda → derecha -->
            <div class="gal-wrapper">
                <div class="gal-track gal-track-right">
                    <!-- Bloque 1 -->
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal1.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal2.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal3.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal4.png" alt="">
                    </div>

                    <!-- Bloque 2 (duplicado para cinta continua) -->
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal1.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal2.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal3.png" alt="">
                    </div>
                    <div class="gal-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal_horizontal4.png" alt="">
                    </div>
                </div>
            </div>
        </section>



        <section class="cierre px-[100px] py-[44px] text-[40px]/9 text-center flex flex-col gap-[52px]">
            <h3 class="font-sans font-light ">¿Listo para una nueva aventura?</h3>
            <div class="anim">
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

<?php get_footer(); ?>
