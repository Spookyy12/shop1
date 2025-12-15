
<?php
defined('ABSPATH') || exit;

get_header('shop');

do_action('woocommerce_before_main_content');
?>

<main class="container shop-wrapper">
<?php echo do_shortcode('[wpf-filters id=1]') ?>

<?php

if (woocommerce_product_loop()) {

    woocommerce_product_loop_start();

    while (have_posts()) :
        the_post();
        wc_get_template_part('content', 'product');
    endwhile;

    woocommerce_product_loop_end();

} else {
    do_action('woocommerce_no_products_found');
}
?>

</main>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
