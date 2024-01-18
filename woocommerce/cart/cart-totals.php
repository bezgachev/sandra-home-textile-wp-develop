<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="shopping-cart__total cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<div class="shopping-cart__total_container">


		<div class="total-price">
			<div class="total-price__wrapper">
				<span class="total-price__title">Ваша корзина:</span>
				<?php
					$total_price = WC()->cart->get_cart_total();
					$cart_count = WC()->cart->get_cart_contents_count();
					$notag_total_price = strip_tags($total_price);
					$total_price_space = number_format((int)$notag_total_price, 0, '', '&nbsp;');
				?>
				<span class="total-price__price"><?php echo ''. $total_price_space .'&nbsp;₽'; ?></span>
			</div>
			<div class="total-price__sum">Всего товаров:&nbsp;<?php echo $cart_count; ?>&nbsp;шт.</div>
		</div>




		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
		<?php if ( is_user_logged_in() ) { 
		$total_price_text = strip_tags($total_price);
		$total_price_no_space = str_replace(' ','',$total_price_text);
		$total_price_int = (int)$total_price_no_space;
		$min_cart_amount = get_theme_mod('my_wc_custom_section_settings');
		$min_cart_amount_int = (int)$min_cart_amount;
		$min_cart_amount_int_space = number_format($min_cart_amount_int, 0, '', '&nbsp;');
			if ($total_price_int < $min_cart_amount_int) {
			?>
				<div class="total-warn" data-total-price="<?php echo $total_price_int; ?>" data-min-amount="<?php echo $min_cart_amount_int; ?>">Минимальная сумма заказа составляет <?php echo $min_cart_amount_int_space; ?>&nbsp;₽</div></div><button class="btn btn-disabled">перейти к оформлению</button><?php
			}
			else {
				?>
				</div>
				<a href="<?php echo wc_get_checkout_url() ; ?>" class="checkout-button wc-forward btn">перейти к оформлению</a>
			<?php } ?>
		<?php }
		else {
			?>	
				<div class="total-warn auth">
					Для оформления заказа необходимо авторизоваться
				</div>
			</div>

				<div class="total-private">
					<div class="total-private__account auth-js">Войдите в личный кабинет</div>
					<div class="total-private__registration auth-js">Пройдите регистрацию</div>
				</div>

				<?php
		}
		?>

<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>