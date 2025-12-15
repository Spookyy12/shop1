<?php
defined('ABSPATH') || exit;

get_header('shop');
do_action('woocommerce_before_main_content');

// Этот div мы будем использовать для вставки фильтра и товаров
echo '<div id="shop-content-wrapper-for-snippet"></div>';

do_action('woocommerce_after_main_content');
get_footer('shop');