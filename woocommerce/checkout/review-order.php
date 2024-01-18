<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
	<?php do_action( 'woocommerce_review_order_before_cart_contents' ); ?>

	<?php do_action( 'woocommerce_review_order_after_cart_contents' ); ?>
	<?php 
	$wc_cart_totals = WC()->cart->get_cart_total();
	$pay_price = preg_replace('/<(.|\n)*?>/', '', $wc_cart_totals);
	$pay_price_space = number_format((int)$pay_price, 0, '', ' '); 
	?>

	<div class="pay-price__price"><?php echo $pay_price_space; ?>&nbsp;₽</div>
	<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
	<div class="pay-price__sum">Всего товаров:&nbsp;<?php echo $cart_count; ?>&nbsp;шт.</div>

	<!-- закрываем order__pay_price pay-price -->
	</div> 

	<div class="order__pay_info pay-info">
		<span class="pay-info__delivery">Доставка не входит в&nbsp;стоимость</span>
		<p class="text pay-info__descr">После оформления, наши менеджеры свяжутся с Вами и озвучат
			стоимость доставки или помогут выбрать для Вас наилучшие условия доставки.</p>
	</div>
		
	<div id="order_review">
		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>
	</div>
	<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	
