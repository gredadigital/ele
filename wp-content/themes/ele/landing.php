<?php
/* Template name: Landing Page*/

get_header(); ?>

<main id="ele-landing" class="bg-white text-gray-900">

    <!-- HEADER (móvil) -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b">
        <div class="mx-auto max-w-md px-4 h-14 flex items-center justify-between">
            <a href="#hero" class="font-semibold">ELE</a>
            <button type="button" aria-label="Menú" class="p-2 rounded-lg ring-1 ring-gray-300">
                <span class="block w-5 h-0.5 bg-gray-900"></span>
                <span class="block w-5 h-0.5 bg-gray-900 mt-1"></span>
                <span class="block w-5 h-0.5 bg-gray-900 mt-1"></span>
            </button>
        </div>
    </header>

    <!-- HERO -->
    <section id="hero" class="mx-auto max-w-md px-4 py-10 grid gap-5">
        <p class="text-sm tracking-wide uppercase text-gray-500">No es magia</p>
        <h1 class="text-3xl font-bold leading-tight">
            Es <span class="underline underline-offset-4">branding bien hecho</span><br>(pero se siente mágico).
        </h1>

        <!-- Badge de cupos + CTA -->
        <div class="rounded-2xl bg-gray-50 ring-1 ring-gray-200 p-4">
            <p class="text-base">
                <strong class="font-semibold">Últimos 3 cupos</strong><br>
                para proyectos de <strong>branding</strong> este mes.
            </p>
            <a href="#form" class="mt-3 inline-flex w-full items-center justify-center rounded-xl px-4 py-3 bg-black text-white font-medium">
                Haz una cita
            </a>
        </div>
    </section>

    <!-- CTA intermedio -->
    <section class="mx-auto max-w-md px-4 py-8 grid gap-3">
        <h2 class="text-2xl font-semibold leading-tight">
            ¿Listo para <span class="italic">transformar tu negocio</span><br>con diseño?
        </h2>
        <p class="text-gray-600">De genérica, nada. Hagamos que tu marca brille.</p>
        <a href="#form" class="mt-1 inline-flex w-full items-center justify-center rounded-xl px-4 py-3 bg-black text-white font-medium">
            Empieza
        </a>
    </section>

    <!-- CHIPS / CATEGORÍAS -->
    <section class="mx-auto max-w-md px-4 pb-6">
        <div class="flex flex-wrap gap-2">
            <span class="px-3 py-2 rounded-xl ring-1 ring-gray-300 text-sm">Branding</span>
            <span class="px-3 py-2 rounded-xl ring-1 ring-gray-300 text-sm">Illustración</span>
            <span class="px-3 py-2 rounded-xl ring-1 ring-gray-300 text-sm">Rebranding</span>
            <span class="px-3 py-2 rounded-xl ring-1 ring-gray-300 text-sm">Packaging Diseño editorial</span>
        </div>
    </section>

    <!-- CLIENTES -->
    <section class="mx-auto max-w-md px-4 py-8 grid gap-4">
        <ul class="grid gap-3">
            <li class="rounded-xl ring-1 ring-gray-200 p-4">
                <p class="font-medium">Cecilia Guzmán De Rojas</p>
                <p class="text-sm text-gray-500">Mapochi</p>
            </li>
            <li class="rounded-xl ring-1 ring-gray-200 p-4">
                <p class="font-medium">Mariana Franco</p>
                <p class="text-sm text-gray-500">MF – Studio de Arquitectura</p>
            </li>
            <li class="rounded-xl ring-1 ring-gray-200 p-4">
                <p class="font-medium">Javier Veneros</p>
                <p class="text-sm text-gray-500">Jacinto</p>
            </li>
        </ul>
    </section>

    <!-- FORMULARIO -->
    <section id="form" class="mx-auto max-w-md px-4 py-10 border-t grid gap-6">
        <h2 class="text-2xl font-semibold leading-tight">Agenda aquí</h2>
        <p class="text-gray-600">¡Perfecto, gracias!<br>Sigue aquí para agendar tu reunión diagnóstico</p>

        <!-- ¿En qué estás interesado? (chips/radios) -->
        <fieldset class="grid gap-2">
            <legend class="text-sm font-medium">¿En que estás interesado? *</legend>
            <div class="grid grid-cols-2 gap-2">
                <!-- Chip -->
                <label class="relative">
                    <input type="radio" name="interes" value="branding" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Branding</span>
                </label>
                <label class="relative">
                    <input type="radio" name="interes" value="ilustracion" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Illustración</span>
                </label>
                <label class="relative">
                    <input type="radio" name="interes" value="rebranding" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">Rebranding</span>
                </label>
                <label class="relative col-span-2">
                    <input type="radio" name="interes" value="packaging-editorial" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 peer-checked:bg-black peer-checked:text-white">
            Packaging Diseño editorial
          </span>
                </label>
            </div>
        </fieldset>

        <!-- Cuéntanos sobre ti -->
        <div class="grid gap-4">
            <h3 class="text-sm font-medium">Cuéntanos sobre ti</h3>

            <div class="grid gap-1">
                <label for="nombre" class="text-sm">Nombre completo *</label>
                <input id="nombre" name="nombre" type="text" required
                       class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                       placeholder="Tu nombre y apellido">
            </div>

            <div class="grid gap-1">
                <label for="telefono" class="text-sm">Teléfono móvil *</label>
                <input id="telefono" name="telefono" type="tel" required
                       class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                       placeholder="+591 …">
            </div>

            <div class="grid gap-1">
                <label for="email" class="text-sm">Correo electrónico *</label>
                <input id="email" name="email" type="email" required
                       class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                       placeholder="tucorreo@ejemplo.com">
            </div>

            <div class="grid gap-1">
                <label for="empresa" class="text-sm">Nombre de Organización/Empresa *</label>
                <input id="empresa" name="empresa" type="text" required
                       class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                       placeholder="Nombre de tu empresa">
            </div>
        </div>

        <!-- Presupuesto ($us.)* (chips/radios) -->
        <fieldset class="grid gap-2">
            <legend class="text-sm font-medium">Presupuesto ($us.)*</legend>
            <div class="grid grid-cols-2 gap-2">
                <label class="relative">
                    <input type="radio" name="presupuesto" value="<500" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">&lt; 500</span>
                </label>
                <label class="relative">
                    <input type="radio" name="presupuesto" value="500-1000" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">500 - 1,000</span>
                </label>
                <label class="relative">
                    <input type="radio" name="presupuesto" value="1000-2000" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">1,000 - 2,000</span>
                </label>
                <label class="relative">
                    <input type="radio" name="presupuesto" value=">2000" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">&gt; 2,000</span>
                </label>
            </div>
        </fieldset>

        <!-- Descripción del proyecto -->
        <div class="grid gap-1">
            <label for="descripcion" class="text-sm font-medium">Descripción del proyecto*</label>
            <textarea id="descripcion" name="descripcion" rows="5" required
                      class="rounded-xl ring-1 ring-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-black"
                      placeholder="Cuéntanos sobre tu proyecto..."></textarea>
        </div>

        <!-- ¿Cómo te enteraste? (chips/radios) -->
        <fieldset class="grid gap-2">
            <legend class="text-sm font-medium">¿Cómo te enteraste de nosotros?*</legend>
            <div class="grid grid-cols-2 gap-2">
                <label class="relative">
                    <input type="radio" name="referencia" value="instagram" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">Instagram</span>
                </label>
                <label class="relative">
                    <input type="radio" name="referencia" value="linkedin" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">LinkedIn</span>
                </label>
                <label class="relative">
                    <input type="radio" name="referencia" value="facebook" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">Facebook</span>
                </label>
                <label class="relative">
                    <input type="radio" name="referencia" value="otro" class="peer sr-only" required>
                    <span class="block rounded-xl ring-1 ring-gray-300 px-3 py-2 text-center peer-checked:bg-black peer-checked:text-white">Otro</span>
                </label>
            </div>
        </fieldset>

        <!-- Enviar -->
        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl px-4 py-3 bg-black text-white font-medium">
                Enviar
            </button>
        </div>
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

<?php get_footer(); ?>
