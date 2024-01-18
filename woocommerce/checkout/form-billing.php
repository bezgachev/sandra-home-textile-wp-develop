<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>


<!-- <div class="woocommerce-billing-fields"> -->
	<?php /*if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

	<?php endif; */ ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); 

		$fields = $checkout->get_checkout_fields( 'billing');

		// foreach ( $fields as $key => $field ) {
		// 	woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		// }
		?>
		<div class="order-form__fields">
		<?php
		woocommerce_form_field(
			"billing_first_name",
			$checkout->checkout_fields['billing']['billing_first_name'], 
			$checkout->get_value( 'billing_first_name' )
		);
		woocommerce_form_field(
			"billing_email",
			$checkout->checkout_fields['billing']['billing_email'], 
			$checkout->get_value( 'billing_email' )
		);
		woocommerce_form_field(
			"billing_phone",
			$checkout->checkout_fields['billing']['billing_phone'], 
			$checkout->get_value( 'billing_phone' )
		);
		?>
		</div>
		<div class="order-form__fields">
		<?php
		woocommerce_form_field(
			"billing_country",
			$checkout->checkout_fields['billing']['billing_country'], 
			$checkout->get_value( 'billing_country' )
		);
		woocommerce_form_field(
			"billing_city",
			$checkout->checkout_fields['billing']['billing_city'], 
			$checkout->get_value( 'billing_city' )
		);
		woocommerce_form_field(
			"billing_address_1",
			$checkout->checkout_fields['billing']['billing_address_1'], 
			$checkout->get_value( 'billing_address_1' )
		);
		woocommerce_form_field(
			"billing_postcode",
			$checkout->checkout_fields['billing']['billing_postcode'], 
			$checkout->get_value( 'billing_postcode' )
		);

		?>
		</div>
		<div class="order-form__fields">
			<div class="order-form__field shipping-form__field">
			<label>Способ получения<span class="required"> *</span></label>
				<div class="select-css select-method-js">Выберите способ доставки</div>
				<div class="select-input" id="shipping-method"></div>
				<span class="delivery_amount_info">Cтоимость доставки оплачивается и обговаривается позднее</span>
				<span class="error-mess" style="display:none;">Необходимо выбрать способ доставки</span>
			</div>
			<div class="order-form__field payment-form__field">
				<label>Форма оплаты<span class="required"> *</span></label>
				<div class="select-css select-method-js light-opacity">Выберите метод оплаты</div>
				<div class="select-input" id="payment-method"></div>
				<span class="error-mess" style="display:none;">Необходимо выбрать метод оплаты</span>
			</div>
		</div>
		<div class="register__fields">
			<div class="register__radio">
			<?php
				$current_user = wp_get_current_user();
				$user_id = $current_user->ID;
				$user_id_company = get_user_meta( $user_id, 'company', true);
				if ($user_id_company === 'on') {
					echo '<span class="custom-radio"></span>';
					echo '<span class="text">Оформить заказ как юр. лицо?</span></div>';
					echo '<div class="organisation__fields order-form__fields">';
				}
				else {
					echo '<span class="custom-radio off"></span>';
					echo '<span class="text">Оформить заказ как юр. лицо?</span></div>';
					echo '<div class="organisation__fields order-form__fields d-hide">';
				}
			?>
			<?php do_action( 'woocommerce_legal_face' ); ?>
			</div>
		</div>
	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>



