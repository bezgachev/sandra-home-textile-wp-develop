<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
// if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
// 	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
// 	return;
// }

?>
<?php if ( is_user_logged_in() ) {


$total_price = WC()->cart->get_cart_total();
$total_price_text = strip_tags($total_price);
$total_price_no_space = str_replace(' ','',$total_price_text);
$total_price_int = (int)$total_price_no_space;
$min_cart_amount = get_theme_mod('my_wc_custom_section_settings');
$min_cart_amount_int = (int)$min_cart_amount;
	if ($total_price_int < $min_cart_amount_int) {
		$url = wc_get_cart_url();
		header('Location: '. $url . '', true, 301);
	}
	else { ?>
	<main>
		<div class="main">
			<a href="<?php echo wc_get_cart_url(); ?>" class="bread-crumb margin-top">Вернуться к корзине</a>
			<h1 class="title-h1 title-page">оформление заказа</h1>
		</div>
		<div class="container">
			
			<form name="checkout" method="POST" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
				<div class="order">
					<div class="order__register">

						<?php if ( $checkout->get_checkout_fields() ) : ?>

							<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
							<div class="order-form">

								<?php do_action( 'woocommerce_checkout_billing' ); ?>
								
									
							</div>
								
								<?php do_action( 'woocommerce_checkout_shipping' ); ?>
							

							<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

						<?php endif; ?>
						
						<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
					</div>

					<div class="order__pay">
						<div class="order__pay_price pay-price">
							<div class="pay-price__title">Ваш заказ:</div>
							
								<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
							
										
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
								
						</div>
						
							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

					</div>
				</div>
			</form>


			
		</div>
	</main>
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	<?php
	}

}
else {
	//редирект на корзину, если не авторизован
	$url = wc_get_cart_url();
	header('Location: '. $url . '', true, 301);

}
?>
