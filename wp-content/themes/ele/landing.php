<?php
/* Template name: Landing Page*/

get_header(); ?>

<main id="ele-landing" class="bg-white text-gray-900">



    <!-- HERO -->
    <section id="hero" class="mx-auto max-w-md px-paddingm2 py-paddingm2 flex-col gap-5">
        <div><p class="text-21 font-serif font-bold italic text-center">No es magia</p>
            <h1 class="text-23 font-sans font-light leading-tight text-center  mb-paddingm">
                Es branding bien hecho<br>(pero se siente mágico).
            </h1>
        </div>

        <div class="grid gap-5 mb-big">
            <div class="justify-self-start">
                <iframe width="320" height="180"
                        src="https://www.youtube.com/embed/qwRrP24jFm4"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                </iframe>
                <h2 class="font-serif font-bold italic text-21">Branding</h2>
        </div>
        <div class="justify-self-end">
            <iframe width="320" height="180"
                    src="https://www.youtube.com/embed/DQuKJFvU-d0"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
            </iframe>
            <h2 class="font-serif font-bold italic text-21">Rebranding</h2>
        </div>
        <div class="justify-self-start">
            <iframe width="320" height="180"
                    src="https://www.youtube.com/embed/jmeAGwpsbQw"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
            </iframe>
            <h2 class="font-serif font-bold italic text-21">Ilustración</h2>
        </div>
        </div>

        <!-- Badge de cupos + CTA -->
        <div class="relative mb-big">
            <p class="font-serif font-bold text-27 text-center leading-tight">
                Últimos 3 cupos <br> para proyectos de branding este mes.
            </p>
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/circulogesto.svg" alt="" class="absolute top-0 left-[50%] -translate-x-1/2 ">
            <?php echo do_shortcode('[gcal_button label="Haz una cita"]'); ?>

        </div>
    </section>

    <!-- CTA intermedio -->
    <section class="mx-auto max-w-md px-4 py-8">
             <p class="font-serif font-bold italic text-21">De genérica, nada.
             </p>
        <p class="font-sans font-light text-21">
                 Hagamos que tu marca brille.</p>
    </section>


    <!-- FORMULARIO -->
    <section id="form" class="mx-auto max-w-md px-4 py-10">

        <form id="ele-contact-form" method="post" class="grid gap-6">
            <?php wp_nonce_field('ele_contact_form', 'ele_contact_nonce'); ?>
            <fieldset class="grid gap-2">
                <legend class="font-sans font-medium mb-paddingm2">¿En que estás interesado?</legend>
                <div class="flex flex-wrap gap-4">
                    <!-- Chip -->
                    <label class="relative">
                        <input type="radio" name="interes" value="branding" class="peer sr-only" required>
                        <span class="inline-block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Ilustración</span>
                    </label>
                    <label class="relative">
                        <input type="radio" name="interes" value="ilustracion" class="peer sr-only" required>
                        <span class="inline-block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Branding</span>
                    </label>
                    <label class="relative">
                        <input type="radio" name="interes" value="rebranding" class="peer sr-only" required>
                        <span class="inline-block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Packaging</span>
                    </label>
                    <label class="relative col-span-2">
                        <input type="radio" name="interes" value="packaging-editorial" class="peer sr-only" required>
                        <span class="inline-block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Diseño editorial</span>
                    </label>
                </div>
            </fieldset>

            <!-- Cuéntanos sobre ti -->
            <div class="grid gap-4">
                <h3 class="font-sans font-medium">Cuéntanos sobre ti</h3>

                <div class="grid gap-1">
                    <label for="nombre" class="font-regular">Nombre completo <span
                                class="text-primario font-bold">*</span></label>
                    <input id="nombre" name="nombre" type="text" required
                           class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                           placeholder="Tu nombre y apellido">
                </div>

                <div class="grid gap-1">
                    <label for="telefono" class="font-regular">Teléfono móvil <span
                                class="text-primario font-bold">*</span></label>
                    <input id="telefono" name="telefono" type="tel" required
                           class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                           placeholder="+591 …">
                </div>

                <div class="grid gap-1">
                    <label for="email" class="font-regular">Correo electrónico <span
                                class="text-primario font-bold">*</span></label>
                    <input id="email" name="email" type="email" required
                           class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                           placeholder="tucorreo@ejemplo.com">
                </div>

                <div class="grid gap-1">
                    <label for="empresa" class="font-regular">Nombre de Organización/Empresa <span
                                class="text-primario font-bold">*</span></label>
                    <input id="empresa" name="empresa" type="text" required
                           class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                           placeholder="Nombre de tu empresa">
                </div>
            </div>

            <!-- Presupuesto ($us.)* (chips/radios) -->
            <fieldset class="space-y-2">
                <legend class="font-medium">Presupuesto ($us.) <span class="text-primario font-bold">*</span></legend>

                <label class="flex items-center gap-2">
                    <input type="radio" name="presupuesto" value=">500" required class="w-5 h-5 accent-primario">
                    <span class="font-light">> 500</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="presupuesto" value="500-1000" required class="w-5 h-5 accent-primario">
                    <span class="font-light">500 - 1,000</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="presupuesto" value="1000-2000" required class="w-5 h-5 accent-primario">
                    <span class="font-light">1,000 - 2,000</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="presupuesto" value="<2000" required class="w-5 h-5 accent-primario">
                    <span class="font-light">< 2,000</span>
                </label>
            </fieldset>


            <!-- Descripción del proyecto -->
            <div class="grid gap-1">
                <label for="descripcion" class="font-medium">Descripción del proyecto <span
                            class="text-primario font-bold">*</span></label>
                <textarea id="descripcion" name="descripcion" rows="5" required
                          class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                          placeholder="Cuéntanos sobre tu proyecto..."></textarea>
            </div>

            <!-- ¿Cómo te enteraste? (chips/radios) -->
            <fieldset class="space-y-2">
                <legend class="text-sm font-medium">¿Cómo te enteraste de nosotros?*</legend>

                <label class="flex items-center gap-2">
                    <input type="radio" name="referencia" value="instagram" required class="w-5 h-5 accent-primario">
                    <span class="font-light">Instagram</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="referencia" value="linkedin" required class="w-5 h-5 accent-primario">
                    <span class="font-light">LinkedIn</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="referencia" value="facebook" required class="w-5 h-5 accent-primario">
                    <span class="font-light">Facebook</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="referencia" value="otro" required class="w-5 h-5 accent-primario">
                    <span class="font-light">Otro</span>
                </label>
            </fieldset>


            <!-- Enviar -->
            <div class="pt-2 flex justify-center">
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-full px-paddingm py-3 bg-black text-white font-regular">
                    Enviar
                </button>
            </div>
            <div class="hidden">
                <label for="website">Deja este campo vacío</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

        </form>
    </section>
    <section class="px-paddingm2 py-big">
        <p class="text-center font-sans font-light text-27 tracking-tight">¿Listo para transformar tu negocio</p>
        <p class="text-center font-serif font-bold text-27 italic">con diseño?</p>
    </section>



    <!-- FOOTER -->
    <footer class="mt-10 border-t">
        <div class="mx-auto max-w-md px-4 py-8 grid gap-3 text-sm">
            <nav class="flex items-center justify-center gap-6">
                <a href="#hero" class="hover:underline">Home</a>
                <a href="#casos" class="hover:underline">Work</a>
                <a href="#form" class="hover:underline">Contact</a>
            </nav>
            <div class="flex items-center justify-center gap-6">
                <a href="#" class="hover:underline">Instagram</a>
                <a href="#" class="hover:underline">LinkedIn</a>
            </div>
            <p class="text-center text-gray-500">© Copyright ELE 2025</p>
        </div>
    </footer>
</main>
<!-- Modal: Agendar diagnóstico -->
<div
        id="ele-gcal-modal"
        class="fixed inset-0 z-50 hidden"
        role="dialog"
        aria-modal="true"
        aria-labelledby="ele-gcal-title"
        aria-describedby="ele-gcal-desc"
>
    <!-- Fondo -->
    <button
            type="button"
            class="absolute inset-0 bg-black/80"
            data-ele-modal-close
            aria-label="Cerrar modal"
    ></button>

    <!-- Contenido -->
    <div
            class="relative mx-auto mt-24 w-[90%] rounded-2xl bg-black bg-[url(../images/brujula.png)] bg-no-repeat bg-[right_20px_center] bg-position-x p-6 shadow-2xl"
            tabindex="-1"
    >
        <!-- Cerrar -->
        <button
                type="button"
                class="absolute right-3 top-3 inline-flex h-8 w-8 items-center justify-center rounded-full ring-1 ring-gray-300 hover:bg-gray-50 text-white"
                data-ele-modal-close
                aria-label="Cerrar"
        >
            ×
        </button>

        <!-- Contenido textual -->
        <div class="grid gap-3 w-[70%]">


                <p id="ele-gcal-title" class="font-serif text-21 font-bold italic text-white">
                    ¡Perfecto, gracias!
                </p>
                <p id="ele-gcal-desc" class="font-sans text-21 font-light text-white">
                    Sigue aquí para agendar tu reunión diagnóstico.
                </p>

            <!-- Slot del botón de Google Calendar -->
            <div class="mt-2">
                <?php echo do_shortcode('[gcal_button label="Agenda aquí" bg="bg-secundario" text="text-black" font="font-sans font-medium"]'); ?>
            </div>

        </div>
    </div>
</div>



<?php get_footer(); ?>
