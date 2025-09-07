// /assets/js/gcal-init.js
(function(){
    function ready(fn){
        if(document.readyState !== 'loading') fn();
        else document.addEventListener('DOMContentLoaded', fn);
    }

    ready(function(){
        const MAX_TRIES = 30;
        let tries = 0;

        function ensureGoogle(cb){
            if (window.calendar?.schedulingButton?.load) return cb();
            if (++tries < MAX_TRIES) return setTimeout(()=>ensureGoogle(cb), 150);
        }

        ensureGoogle(function(){
            document.querySelectorAll('.gcal-proxy [data-gcal-mount]').forEach(function(btn){
                if (btn.__gcalWired) return;
                btn.__gcalWired = true;

                const mountId = btn.getAttribute('data-gcal-mount');
                const mount   = document.getElementById(mountId);
                const url     = btn.getAttribute('data-url');
                const color   = btn.getAttribute('data-color') || '#000';
                const label   = btn.getAttribute('data-label') || 'Haz una cita';

                // 1) Monta el botón de Google JUNTO al mount (queda oculto para UI)
                calendar.schedulingButton.load({
                    url, color, label, target: mount
                });

                // Helpers para ubicar y ocultar el botón de Google
                function getGoogleButton() {
                    const sib = mount.nextElementSibling;
                    return (sib && sib.tagName === 'BUTTON') ? sib : null;
                }

                function hideGoogleButton() {
                    const gbtn = getGoogleButton();
                    if (gbtn) {
                        gbtn.setAttribute('aria-hidden', 'true');
                        gbtn.tabIndex = -1;
                        gbtn.style.display = 'none';          // Ocúltalo
                        gbtn.style.pointerEvents = 'none';    // Previene interacción
                    }
                }

                // Oculta inmediatamente y si Google reinyecta, vuelve a ocultar
                hideGoogleButton();
                const mo = new MutationObserver(hideGoogleButton);
                mo.observe(mount.parentNode, { childList: true });

                // 2) Al hacer click en nuestro botón Tailwind -> disparar el de Google
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    const gbtn = getGoogleButton();
                    if (gbtn) gbtn.click();
                });
            });
        });
    });
})();
