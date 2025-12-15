<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<?php wc_print_notices(); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<div class="cart-wrapper">
		<!-- Товары в корзине -->
		<div class="cart-items-container">
			<h2 class="cart-section-title">Товары в корзине</h2>

			<div class="cart-items-list">
				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<div class="cart-item-card <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							
							<!-- Изображение -->
							<div class="cart-item-image">
								<a href="<?php echo get_permalink( $product_id ); ?>">
									<?php echo $_product->get_image( 'woocommerce_thumbnail' ); ?>
								</a>
							</div>

							<!-- Детали товара -->
							<div class="cart-item-details">
								<h3 class="cart-item-title">
									<a href="<?php echo get_permalink( $product_id ); ?>">
										<?php echo wp_kses_post( $_product->get_name() ); ?>
									</a>
								</h3>

								<?php if ( $_product->get_type() === 'variation' ) : ?>
									<div class="cart-item-attributes">
										<?php foreach ( $cart_item['variation'] as $attr_key => $attr_value ) : ?>
											<span class="attr-item">
												<strong><?php echo wc_attribute_label( str_replace( 'attribute_', '', $attr_key ) ); ?>:</strong>
												<?php echo wp_kses_post( $attr_value ); ?>
											</span><br>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>

								<div class="cart-item-price-info">
									<span class="label">Цена:</span>
									<span class="price"><?php echo WC()->cart->get_product_price( $_product ); ?></span>
								</div>
							</div>

							<!-- Количество, сумма, удаление -->
							<div class="cart-item-actions">
								<div class="quantity-section">
									<label class="qty-label screen-reader-text"><?php esc_html_e( 'Количество', 'woocommerce' ); ?></label>
									<?php
									woocommerce_quantity_input(
										array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->get_max_purchase_quantity(),
											'min_value'   => '0',
											'product_name'=> $_product->get_name(),
										),
										$_product,
										false
									);
									?>
								</div>

								<div class="subtotal-section">
									<span class="label">Сумма:</span>
									<span class="subtotal"><?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?></span>
								</div>

								<div class="remove-section">
									<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove-btn" aria-label="%s" title="%s">✕</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_attr__( 'Remove this item', 'woocommerce' ),
											esc_attr__( 'Remove', 'woocommerce' )
										),
										$cart_item_key
									);
									?>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<div class="cart-actions-bottom">
				<button type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
					Обновить корзину
				</button>

				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
			</div>
		</div>

		<!-- Итоги корзины -->
		<div class="cart-summary-container">
			<?php do_action( 'woocommerce_cart_collaterals' ); ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>