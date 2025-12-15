<?php
defined( 'ABSPATH' ) || exit;
?>

<table class="shop_table woocommerce-checkout-review-order-table">
	<tbody>

	<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
		$product = $cart_item['data'];
		if ( ! $product || ! $product->exists() ) continue;
	?>

	<tr class="cart-item" data-key="<?php echo esc_attr( $cart_item_key ); ?>">

		<td class="product-name">
			<?php echo esc_html( $product->get_name() ); ?>
		</td>

		<td class="product-qty">
			<button type="button" class="qty-btn minus">−</button>

			<input
				type="number"
				class="qty-input"
				value="<?php echo esc_attr( $cart_item['quantity'] ); ?>"
				min="1"
			/>

			<button type="button" class="qty-btn plus">+</button>
		</td>

		<td class="product-total">
			<?php echo WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ); ?>
		</td>

		<td class="product-remove">
			<button type="button" class="remove-item">×</button>
		</td>

	</tr>

	<?php endforeach; ?>

	</tbody>

	<tfoot>
		<tr class="order-total">
			<th colspan="3"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>
	</tfoot>
</table>
