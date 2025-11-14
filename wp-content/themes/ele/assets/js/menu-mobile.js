document.addEventListener('DOMContentLoaded', function () {
    const btnAbrir = document.getElementById('abre_menu');
    const btnCerrar = document.getElementById('cerrar_menu');
    const overlay = document.querySelector('.menu_mobile');
    const panel = overlay ? overlay.querySelector('.cont_menu') : null;

    if (!btnAbrir || !btnCerrar || !overlay || !panel) return;

    function abrirMenu() {
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');

        overlay.classList.remove('overlay-fade-out');
        panel.classList.remove('panel-slide-out-right');

        void overlay.offsetWidth;
        void panel.offsetWidth;

        overlay.classList.add('overlay-fade-in');
        panel.classList.add('panel-slide-in-right');
    }

    function cerrarMenu() {
        overlay.classList.remove('overlay-fade-in');
        panel.classList.remove('panel-slide-in-right');

        void overlay.offsetWidth;
        void panel.offsetWidth;

        overlay.classList.add('overlay-fade-out');
        panel.classList.add('panel-slide-out-right');

        const handler = function () {
            if (panel.classList.contains('panel-slide-out-right')) {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
            }
            panel.removeEventListener('animationend', handler);
        };

        panel.addEventListener('animationend', handler);
    }

    btnAbrir.addEventListener('click', abrirMenu);
    btnCerrar.addEventListener('click', cerrarMenu);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) cerrarMenu();
    });
});
