document.addEventListener('click', function (e) {

    const btn = e.target;
    if (
        !btn.classList.contains('plus') &&
        !btn.classList.contains('minus') &&
        !btn.classList.contains('remove-item')
    ) return;

    e.preventDefault();

    const row = btn.closest('.cart-item');
    if (!row) return;

    const key = row.dataset.key;
    const input = row.querySelector('.qty-input');

    let qty = parseInt(input.value, 10);

    if (isNaN(qty)) qty = 1;

    if (btn.classList.contains('plus')) qty++;
    if (btn.classList.contains('minus')) qty = Math.max(1, qty - 1);
    if (btn.classList.contains('remove-item')) qty = 0;

    // Блокируем кнопки, чтобы не спамили
    row.classList.add('loading');

    fetch(istoreCheckout.ajax_url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'istore_update_checkout_cart',
            cart_key: key,
            qty: qty
        })
    })
    .then(() => {
        // ✅ ЕДИНСТВЕННО правильный способ обновить checkout
        jQuery('body').trigger('update_checkout');
    })
    .finally(() => {
        row.classList.remove('loading');
    });

});
