document.addEventListener('DOMContentLoaded', function () {
    const modal      = document.getElementById('project-filter-modal');
    const overlay    = document.getElementById('modal-overlay');
    const openBtn    = document.getElementById('open-project-filter');
    const galSection = document.querySelector('.gal');

    if (!openBtn || !galSection) return;

    // --- Abrir / cerrar modal ---
    const openModal = () => {
        if (modal) modal.classList.remove('hidden');
    };

    const closeModal = () => {
        if (modal) modal.classList.add('hidden');
    };

    openBtn.addEventListener('click', openModal);
    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    // --- Mostrar / ocultar botón según posición de .gal ---

    const showButton = () => {
        openBtn.classList.remove('translate-y-8', 'opacity-0', 'pointer-events-none');
        openBtn.classList.add('translate-y-0', 'opacity-100');
    };

    const hideButton = () => {
        openBtn.classList.add('translate-y-8', 'opacity-0', 'pointer-events-none');
        openBtn.classList.remove('translate-y-0', 'opacity-100');
    };

    const updateFilterButtonVisibility = () => {
        const rect = galSection.getBoundingClientRect();
        const vh   = window.innerHeight || document.documentElement.clientHeight;
        const mid  = vh * 0.5;

        // .gal todavía no entra a pantalla → oculto
        if (rect.top >= vh) {
            hideButton();
            return;
        }

        // .gal ya pasó por encima del 50% → oculto
        if (rect.bottom <= mid) {
            hideButton();
            return;
        }

        // En cualquier otro caso → visible
        showButton();
    };

    // Forzar primer cálculo después de un frame para asegurar animación
    requestAnimationFrame(updateFilterButtonVisibility);

    window.addEventListener('scroll', updateFilterButtonVisibility, { passive: true });
    window.addEventListener('resize', updateFilterButtonVisibility);
});
