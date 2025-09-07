// ELE - Form + Modal GCal
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ele-contact-form');
    const modal = document.getElementById('ele-gcal-modal');

    // --- Helpers de modal ---
    const focusableSelector = [
        'a[href]',
        'button:not([disabled])',
        'input:not([disabled])',
        'select:not([disabled])',
        'textarea:not([disabled])',
        '[tabindex]:not([tabindex="-1"])'
    ].join(',');

    let lastFocused = null;

    function getFocusable(container) {
        return Array.from(container.querySelectorAll(focusableSelector))
            .filter(el => el.offsetParent !== null || el === document.activeElement);
    }

    function openModal() {
        if (!modal) return;
        lastFocused = document.activeElement;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // bloquea scroll fondo

        const focusables = getFocusable(modal);
        if (focusables.length) focusables[0].focus();

        // Enlazamos listeners de cierre
        document.addEventListener('keydown', onEsc, true);
        modal.addEventListener('click', onBackdrop, true);
        modal.addEventListener('keydown', trapFocus, true);
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // restaura scroll

        // Limpia listeners
        document.removeEventListener('keydown', onEsc, true);
        modal.removeEventListener('click', onBackdrop, true);
        modal.removeEventListener('keydown', trapFocus, true);

        // Devuelve foco
        if (lastFocused && typeof lastFocused.focus === 'function') {
            lastFocused.focus();
        }
    }

    function onEsc(e) {
        if (e.key === 'Escape') {
            e.preventDefault();
            closeModal();
        }
    }

    function onBackdrop(e) {
        // Cierra si el target tiene el data-ele-modal-close
        const target = e.target;
        if (target && target.hasAttribute('data-ele-modal-close')) {
            e.preventDefault();
            closeModal();
        }
    }

    function trapFocus(e) {
        if (e.key !== 'Tab') return;
        const focusables = getFocusable(modal);
        if (!focusables.length) return;

        const first = focusables[0];
        const last = focusables[focusables.length - 1];

        if (e.shiftKey && document.activeElement === first) {
            e.preventDefault();
            last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault();
            first.focus();
        }
    }

    // --- Mensajes accesibles (live region) ---
    let live = document.getElementById('ele-form-live');
    if (!live && form) {
        live = document.createElement('div');
        live.id = 'ele-form-live';
        live.setAttribute('role', 'status');
        live.setAttribute('aria-live', 'polite');
        live.className = 'sr-only';
        form?.prepend(live);
    }

    // --- Submit AJAX ---
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;

            if (live) live.textContent = 'Enviando…';

            try {
                const data = new FormData(form);

                const res = await fetch(ELE_CONTACT.restUrl, {
                    method: 'POST',
                    body: data,
                    headers: { 'Accept': 'application/json' }
                });

                const json = await res.json();

                if (res.ok && json && json.success) {
                    if (live) live.textContent = ELE_CONTACT.okText || '¡Envío exitoso!';
                    // Disparamos evento global para abrir el modal
                    document.dispatchEvent(new CustomEvent('ele:lead:saved', { detail: json }));
                    // Opcional: resetear form
                    // form.reset();
                } else {
                    throw new Error((json && json.message) || 'Error desconocido');
                }
            } catch (err) {
                console.error('[ELE] Error enviando lead:', err);
                if (live) live.textContent = ELE_CONTACT.errText || 'Error al enviar.';
                alert(ELE_CONTACT.errText || 'No pudimos enviar el formulario. Intenta de nuevo.');
            } finally {
                if (submitBtn) submitBtn.disabled = false;
            }
        });
    }

    // --- Abrir modal cuando el lead se guardó ---
    document.addEventListener('ele:lead:saved', () => {
        openModal();
    });

    // --- Botones "cerrar" dentro del modal (por si agregas más) ---
    if (modal) {
        modal.querySelectorAll('[data-ele-modal-close]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                closeModal();
            });
        });
    }
});
