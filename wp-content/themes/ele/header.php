<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="top-0 bg-white max-w-md mx-auto flex justify-between px-paddingm py-paddingm2">
    <h1 class="w-logo-w h-logo-h bg-[url(../images/logo_l.svg)] indent-[-9999px]">
        <a href="">
            <?php bloginfo('name'); ?>
        </a>
    </h1>
    <button class="md:hidden">Menu</button>
    <nav class="hidden md:block">

        <ul>
            <li><a href="">Work</a></li>
            <li><a href="">Studio</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </nav>



</header>


<nav class="mobile-menu hidden">
    <h2>Menu</h2>
    <button>Close</button>
    <ul>
        <li><a href="">Work</a></li>
        <li><a href="">Studio</a></li>
        <li><a href="">Contact</a></li>
    </ul>
    <ul class="redes">
        <li><a href="">Instagram</a></li>
        <li><a href="">Linkedin</a></li>
        <li><a href="">Youtube</a></li>
    </ul>
</nav>