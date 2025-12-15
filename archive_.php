<?php
// Если это WooCommerce архив (shop / category / tag) — отдаем Woo
if ( function_exists('is_woocommerce') && is_woocommerce() ) {
    wc_get_template( 'archive-product.php' );
    return;
}
?>

<?php
if ( woocommerce_product_loop() ) {

    woocommerce_product_loop_start();

    while ( have_posts() ) :
        the_post();

        wc_get_template_part( 'content', 'product' );

    endwhile;

    woocommerce_product_loop_end();

} else {

    do_action( 'woocommerce_no_products_found' );

}
