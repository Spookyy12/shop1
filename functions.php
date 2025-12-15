<?php

/* ================= THEME SUPPORT ================= */

add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('woocommerce');

add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary' => 'Main Menu',
    ]);
});
/* ================= STYLES & SCRIPTS (ИСПРАВЛЕННАЯ ВЕРСИЯ) ================= */

add_action('wp_enqueue_scripts', function () {

    // --- Основные стили темы ---
    wp_enqueue_style(
        'istore-style',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        '1.0'
    );

    // --- Основной скрипт темы (для мобильного меню, аккордеона и т.д.) ---
    wp_enqueue_script(
        'istore-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [], // Зависимость от jQuery здесь не нужна, так как используется нативный JS
        '1.0',
        true
    );

    // --- Скрипт для страницы Checkout ---
    if ( is_checkout() ) {
        wp_enqueue_script(
            'istore-checkout',
            get_template_directory_uri() . '/assets/js/checkout-update.js',
            ['jquery'], // Здесь нужна зависимость от jQuery
            '1.0',
            true
        );
        wp_localize_script( 'istore-checkout', 'istoreCheckout', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ] );
    }
});
/* ================= CART COUNTER ================= */

add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {
    ob_start(); ?>
    <span class="ts-cart-count">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $fragments['.ts-cart-count'] = ob_get_clean();
    return $fragments;
});

/* ================= CHECKOUT FIELDS ================= */

add_filter( 'woocommerce_checkout_fields', function ( $fields ) {

    unset( $fields['billing']['billing_company'] );
    unset( $fields['billing']['billing_address_2'] );
    unset( $fields['billing']['billing_postcode'] );
    unset( $fields['billing']['billing_state'] );
    unset( $fields['shipping'] );

    $fields['billing']['billing_first_name']['required'] = true;
    $fields['billing']['billing_last_name']['required']  = true;
    $fields['billing']['billing_phone']['required']     = true;
    $fields['billing']['billing_email']['required']     = true;

    return $fields;
});

/* ================= DISABLE SHIPPING ================= */



/* ================= CHECKOUT AJAX ================= */

add_action( 'wp_ajax_istore_update_checkout_cart', 'istore_update_checkout_cart' );
add_action( 'wp_ajax_nopriv_istore_update_checkout_cart', 'istore_update_checkout_cart' );

function istore_update_checkout_cart() {

    if ( ! isset( $_POST['cart_key'], $_POST['qty'] ) ) {
        wp_send_json_error();
    }

    $cart_key = sanitize_text_field( $_POST['cart_key'] );
    $qty      = intval( $_POST['qty'] );

    if ( $qty <= 0 ) {
        WC()->cart->remove_cart_item( $cart_key );
    } else {
        WC()->cart->set_quantity( $cart_key, $qty, true );
    }

    WC()->cart->calculate_totals();
    wp_send_json_success();
}
