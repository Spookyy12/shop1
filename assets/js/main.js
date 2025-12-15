document.addEventListener('DOMContentLoaded', () => {
    const burger = document.getElementById('tsBurger');
    const menu = document.getElementById('tsMobileMenu');

    if (burger && menu) {
        burger.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    }
});
