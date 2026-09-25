document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.menu');

    if (!toggle || !menu) {
        return;
    }

    toggle.addEventListener('click', function () {
        const isOpen = menu.classList.toggle('menu--open');
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            menu.classList.remove('menu--open');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });
});
