<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	
		<div class="number">
			<button class="number-minus"></button>
			<input class="number-text" type="number" name="quantity" value="1" data-max-count="999">
			<input type="hidden" name="product_id" value="<?php echo get_the_id();?>">
			<button class="number-plus"></button>
		</div>
		<button data-title="<?php echo get_the_title(); ?>" class="btn add-to-cart-product-js">добавить в корзину</button>
	
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
