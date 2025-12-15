<?php
defined( 'ABSPATH' ) || exit;

global $product;
?>

<li <?php wc_product_class( 'product-card', $product ); ?>>

    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     * Открывает ссылку
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>

    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     * Картинка + sale badge
     */
    do_action( 'woocommerce_before_shop_loop_item_title' );
    ?>

    <h2 class="product-title">
        <?php the_title(); ?>
    </h2>

    <?php
    /**
     * Краткое описание товара
     */
    if ( $product->get_short_description() ) {
        echo '<div class="product-short-description">' . wp_kses_post( $product->get_short_description() ) . '</div>';
    }
    ?>

    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     * Цена + рейтинг
     */
    do_action( 'woocommerce_after_shop_loop_item_title' );
    ?>

    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item.
     * Закрывает ссылку + add to cart
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>

</li>
