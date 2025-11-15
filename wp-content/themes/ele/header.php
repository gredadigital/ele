<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body class="bg-black">
<?php wp_body_open(); ?>
<header class="top-0 bg-white  mx-auto flex justify-between px-paddingm pb-paddingm2 pt-[60px] lg:px-paddingd absolute  left-0 w-full z-50 top-0">
    <h1 class="w-logo-w h-logo-h bg-[url(../images/logo_l.svg)] indent-[-9999px]">
        <a href="">
            <?php bloginfo('name'); ?>
        </a>
    </h1>
    <button id="abre_menu" class="block lg:hidden text-[22px]">Menu</button>
    <nav class="site-nav hidden lg:block" aria-label="Navegación principal" role="navigation">
        <?php
        wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false, // sin <div> extra
                'fallback_cb'    => false, // evita imprimir páginas si no hay menú asignado
            // ul semántico con role="list" (mejor compatibilidad con tecnologías asistivas modernas)
                'items_wrap'     => '<ul role="list" class="%2$s">%3$s</ul>',
            // clases del <ul> (Tailwind)
                'menu_class'     => 'flex flex-wrap gap-x-4 gap-y-2 items-center',
                'depth'          => 2, // por si tienes submenús
        ]);
        ?>
    </nav>

    <div class="menu_mobile absolute top-0 left-0 w-screen h-screen bg-[rgba(0,0,0,.4)] p-[15px] hidden">
        <div class="cont_menu bg-primario w-full h-full rounded-3xl grid content-between px-[20px] py-[27px]">
            <div class="sup">
                <div class="header_menu flex flex-row justify-between border-black border-b pb-[10px]">
                    <p class="font-sans text-[22px]">Menu</p>
                    <button id="cerrar_menu" class="bg-[url('../images/close.svg')] indent-[-9999px] w-[25px] h-[25px]">Close</button>
                </div>
                <nav>
                    <?php
                    wp_nav_menu([
                            'theme_location' => 'primary',
                            'container' => false, // sin <div> extra
                            'fallback_cb' => false, // evita imprimir páginas si no hay menú asignado
                        // ul semántico con role="list" (mejor compatibilidad con tecnologías asistivas modernas)
                            'items_wrap' => '<ul role="list" class="%2$s">%3$s</ul>',
                        // clases del <ul> (Tailwind)
                            'menu_class' => 'flex flex-col font-sans font-light text-[57px]',
                            'depth' => 2, // por si tienes submenús
                    ]);
                    ?>

                </nav>
            </div>
            <ul class="redes flex gap-[19px]">
                <li><a href="" class="block w-[40px] h-[40px] indent-[-9999px] bg-[url('../images/instagram.svg')] bg-cover bg-no-repeat">Instagram</a></li>
                <li><a href="" class="block w-[40px] h-[40px] indent-[-9999px] bg-[url('../images/linkedin.svg')] bg-cover bg-no-repeat">LinkedIn</a></li>
                <li><a href="" class="block w-[40px] h-[40px] indent-[-9999px] bg-[url('../images/youtube.svg')] bg-cover bg-no-repeat">YouTube</a></li>
                <li><a href="" class="block w-[40px] h-[40px] indent-[-9999px] bg-[url('../images/facebook.svg')] bg-cover bg-no-repeat">Facebook</a></li>
            </ul>
        </div>
    </div>
</header>
