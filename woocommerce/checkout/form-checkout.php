<?php
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_checkout_form', $checkout );
// ... (код проверки логина, если нужен) ...
?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="checkout-columns">
        <div class="checkout-fields">
            
            <div class="col-1">
                <h2 class="checkout-section-title"><?php esc_html_e( 'Детали оплаты', 'woocommerce' ); ?></h2>
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>

            <div class="col-2">
                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                    <h2 class="checkout-section-title"><?php esc_html_e( 'Адрес доставки', 'woocommerce' ); ?></h2>
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                <?php endif; ?>
            </div>

        </div>
        <div class="checkout-summary">
            <h2 class="checkout-section-title"><?php esc_html_e( 'Ваш заказ', 'woocommerce' ); ?></h2>
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>
    </div>
</form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>