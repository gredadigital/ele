<?php
/* Template name: Contact*/

get_header('negativo'); ?>

<main id="ele-landing" class="bg-white text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px] mb-[600px] rounded-b-3xl">



    <!-- HERO -->
    <section id="hero" class="mx-auto px-paddingm2  px-[60px] py-[120px] flex-col bg-black rounded-b-3xl ">

            <h3 class="text-light font-serif font-bold italic text-[16px] text-center">Hablemos</h3>
        <p class="text-light font-sans font-light text-[22px] text-center">¿Un proyecto nuevo?</p>
        <p class="text-light font-sans font-light text-center text-[22px] ">¿Una idea loca?</p>
        <p class="text-light font-sans font-light  text-center text-[22px]">¡Queremos saberlo todo!</p>


    </section>
    <section class="hagamos px-[60px] py-[40px] text-center">

        <p class="font-serif font-bold italic text-[16px]/6">Hagamos que tu proyecto brille</p>
        <p class="font-sans font-light text-[22px]/6">¿Quieres un comienzo rápido para obtener un alcance y una cotización del proyecto?</p>
    </section>


    <!-- FORMULARIO -->
    <section id="form" class="mx-auto px-4 py-10 lg:px-paddingd md:px-big">

        <form id="ele-contact-form" method="post" class="grid gap-6 lg:max-w-[50%]">
            <input type="hidden" name="started_at" value="<?php echo esc_attr(time()); ?>">

            <?php wp_nonce_field('ele_contact_form', 'ele_contact_nonce'); ?>
            <fieldset class="grid gap-2">
                <legend class="font-sans font-medium mb-paddingm2">¿En que estás interesado?</legend>
                <div class="flex flex-wrap gap-4">
                    <!-- Chip -->
                    <label class="relative">
                        <input type="radio" name="interes" value="ilustracion" class="peer sr-only" required>
                        <span class="inline-block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Ilustración</span>
                    </label>
                    <label class="relative">
                        <input type="radio" name="interes" value="branding" class="peer sr-only" required>
                        <span class="inline-block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Branding</span>
                    </label>
                    <label class="relative">
                        <input type="radio" name="interes" value="packaging" class="peer sr-only" required>
                        <span class="inline-block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Packaging</span>
                    </label>
                    <label class="relative col-span-2">
                        <input type="radio" name="interes" value="editorial" class="peer sr-only" required>
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
    <section class="acordion p-[15px]">
        <h3 class="font-sans font-light text-[22px]">Estas tienden a aparecer</h3>
        <div class="item">
            <div class="consulta flex justify-between border-lightgrey border-b py-[16px]">
                <p class="font-serif font-bold italic text-[18px]">¿Con quién trabajan?</p>
                <span class="inline-block w-[20px] h-[20px] bg-[url('../images/chevrondown.svg')]"></span>
            </div>
            <div class="respuesta py-[16px]">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, beatae consequatur fuga ipsum
                    repudiandae sit. Laudantium numquam quos reiciendis sapiente totam! At commodi consequuntur,
                    eligendi excepturi facilis fugiat laudantium, molestias nihil nisi quasi quis quod ratione, saepe
                    sint tenetur? Rerum?</p>
            </div>
        </div>
        <div class="item">
            <div class="consulta flex justify-between border-lightgrey border-b py-[16px]">
                <p class="font-serif font-bold italic text-[18px]">¿Cuánto suele costar un proyecto?</p>
                <span class="inline-block w-[20px] h-[20px] bg-[url('../images/chevrondown.svg')]"></span>
            </div>
            <div class="respuesta py-[16px] hidden">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, beatae consequatur fuga ipsum
                    repudiandae sit. Laudantium numquam quos reiciendis sapiente totam! At commodi consequuntur,
                    eligendi excepturi facilis fugiat laudantium, molestias nihil nisi quasi quis quod ratione, saepe
                    sint tenetur? Rerum?</p>
            </div>
        </div>
        <div class="item">
            <div class="consulta flex justify-between border-lightgrey border-b py-[16px]">
                <p class="font-serif font-bold italic text-[18px]">¿Necesito un briefing?</p>
                <span class="inline-block w-[20px] h-[20px] bg-[url('../images/chevrondown.svg')]"></span>
            </div>
            <div class="respuesta py-[16px] hidden">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, beatae consequatur fuga ipsum
                    repudiandae sit. Laudantium numquam quos reiciendis sapiente totam! At commodi consequuntur,
                    eligendi excepturi facilis fugiat laudantium, molestias nihil nisi quasi quis quod ratione, saepe
                    sint tenetur? Rerum?</p>
            </div>
        </div>
        <div class="item">
            <div class="consulta flex justify-between border-lightgrey border-b py-[16px]">
                <p class="font-serif font-bold italic text-[18px]">¿Hacen trabajo pro bono?</p>
                <span class="inline-block w-[20px] h-[20px] bg-[url('../images/chevrondown.svg')]"></span>
            </div>
            <div class="respuesta py-[16px] hidden">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, beatae consequatur fuga ipsum
                    repudiandae sit. Laudantium numquam quos reiciendis sapiente totam! At commodi consequuntur,
                    eligendi excepturi facilis fugiat laudantium, molestias nihil nisi quasi quis quod ratione, saepe
                    sint tenetur? Rerum?</p>
            </div>
        </div>


    </section>





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
        class="relative mx-auto mt-24 w-[90%] lg:w-[400px] rounded-2xl bg-black bg-[url(../images/brujula.png)] bg-no-repeat bg-[right_20px_center] bg-position-x p-6 shadow-2xl"
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
