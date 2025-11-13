<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body class="bg-black">
<?php wp_body_open(); ?>
<header class="top-0 bg-white  mx-auto flex justify-between px-paddingm pb-paddingm2 pt-[60px] lg:px-paddingd absolute top-0 left-0 w-full z-[9999]">
    <h1 class="w-logo-w h-logo-h bg-[url(../images/logo_l.svg)] indent-[-9999px]">
        <a href="">
            <?php bloginfo('name'); ?>
        </a>
    </h1>
    <button class="block lg:hidden">Menu</button>
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

</header>
