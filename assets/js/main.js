// Файл: assets/js/main.js (ФИНАЛЬНАЯ ВЕРСИЯ)

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Код для бургер-меню ---
    const burger = document.getElementById('tsBurger');
    const menu = document.getElementById('tsMobileMenu');

    if (burger && menu) {
        burger.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    }

    // --- Код для аккордеона в фильтре ---
    const filterContainer = document.querySelector('.wpfMainWrapper');

    if (filterContainer) {
        const firstBlock = filterContainer.querySelector('.wpfFilterWrapper');
        if (firstBlock) {
            firstBlock.classList.add('active');
        }
        filterContainer.addEventListener('click', function(event) {
            const title = event.target.closest('.wpfFilterTitle');
            if (!title) return;
            const filterBlock = title.closest('.wpfFilterWrapper');
            if (filterBlock) {
                filterBlock.classList.toggle('active');
            }
        });
    }
});