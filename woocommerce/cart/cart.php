<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="bread-crumb margin-top">Вернуться назад</a>
<h1 class="title-h1 title-page">корзина товаров</h1>

<div class="shopping-cart">
	<div class="shopping-cart__wrapper">
		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="POST">

			<?php do_action( 'woocommerce_before_cart_table' ); ?>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<div class="woocommerce-cart-form__contents shopping-cart__body showcase <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woo-thumbnail-product'), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail; // PHPCS: XSS ok.
							} else {
								printf( '<a href="%s" class="showcase__img">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
							

							?>
							<div class="showcase__specification">

								
									<?php
									if ( ! $product_permalink ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
									} else {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="title-h3">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

									// Meta data.
									echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

									// Backorder notification.
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
									}
										?>
										<div class="specifications">
											<?php
											$attribute_sizes = array( 'razmer-pokryvala', 'razmer-pledy', 'razmer-shtory', 'razmer-chehly-dlya-mebeli', 'razmer-postelnoe-belyo' );
											$napolnitel_cart = $_product->get_attribute('napolnitel');
											$material_cart = $_product->get_attribute('material');
											$razmer_cart = $_product->get_attribute('razmer');
											if (!empty($napolnitel_cart)) { ?>
												<div class="specification">
													<div class="text-min">Наполнитель</div>
													<div class="text-min"><?php echo $napolnitel_cart; ?></div>
												</div>
											<?php }
											if (!empty($material_cart)) { ?>
												<div class="specification">
													<div class="text-min">Материал</div>
													<div class="text-min"><?php echo $material_cart; ?></div>
												</div>
											<?php }
											foreach ( $attribute_sizes as $attribute_size ) {
												$razmer = $_product->get_attribute( $attribute_size );
												if (!empty($razmer)) { ?>
													<div class="specification">
														<div class="text-min">Размер</div>
														<div class="text-min"><?php echo $razmer; ?></div>
													</div>
												<?php }} ?>
										</div>
							
							</div>


							<div class="showcase__count">
							<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
									),
									$_product,
									false
								);
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>

							<div class="showcase__count_piece">
								<?php $quantity_product = $cart_item['quantity'];
								if ($quantity_product > 1) {
									$item_quantity = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									$item_quantity_text = strip_tags($item_quantity);
									$item_quantity_space = number_format((int)$item_quantity_text, 0, '', ' ');
									echo ''. $item_quantity_space .'&nbsp;₽&nbsp;/&nbsp;шт.';
								}
								?></div>


							</div>

							<div class="showcase__sum">
								<?php
									$item_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
									$item_subtotal_text = strip_tags($item_subtotal);
									$item_subtota_space = number_format((int)$item_subtotal_text, 0, '', ' ');
									echo ''. $item_subtota_space .'&nbsp;₽'; ?>
							</div>
							<!-- Кнопка удаления товара -->
							<div class="product-remove showcase__close">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>


							</div>
						</div> 

						<?php
					}
					//<!-- end div.shopping-cart__body showcase -->
				}
				?>

					<?php do_action( 'woocommerce_cart_contents' ); ?>

					
						<div class="actions">
							

							<?php /** КУПОНЫ
							if ( wc_coupons_enabled() ) { ?>
								<div class="coupon">
									<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
									<?php do_action( 'woocommerce_cart_coupon' ); ?>
								</div>
							<?php } */ ?>
							
							<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

							<?php do_action( 'woocommerce_cart_actions' ); ?>

							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
						</div>
				

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>





			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>

		<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
	</div>

	<!-- СУММА ЗАКАЗОВ ИТОГ ЦЕН -->
	<!-- <div class="shopping-cart__total"> -->

		
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
	<!-- </div> -->
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>

<?php if (! is_user_logged_in()) { ?>

<div class="auth__account">
	<div class="loader d-hide"><span></span></div>
	<section class="basket">
		<div class="esc-popap"></div>
		<h3 class="basket__title">Введите ваш логин и пароль для входа в аккаунт</h3>
		<form id="auth-user" method="POST" class="login_user">
			<span class="status-success d-hide"></span>
			<span class="status-error d-hide"></span>
			<div class="basket__field d-hide" id="username-block">
				<label class="basket__field_label" for="username">ФИО<span>&nbsp;*</span></label>
				<input class="basket__field_input" id="username" type="text" name="username" required>
				<span class="error-mess d-hide">Необходимо заполнить поле</span>
			</div>
			<div class="basket__field" id="email-block">
				<label class="basket__field_label" for="email">Логин или E-mail<span>&nbsp;*</span></label>
				<input class="basket__field_input" id="email" type="text" name="email" required>
				<span class="error-mess d-hide">Необходимо заполнить поле</span>
			</div>
			<div class="basket__field basket__field_pass">
				<label class="basket__field_label" for="password">Пароль<span>&nbsp;*</span></label>
				<div>
					<input class="basket__field_input" id="password" type="password" name="password" autocomplete="off" required>
					<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
				</div>


				<span class="error-mess d-hide">Необходимо заполнить поле</span>
			</div>
			<div class="basket__checkbox">
				<label class="custom-checkbox" for="rememberme">
					<input name="rememberme" type="checkbox" id="rememberme" value="" checked>
					<span>Запомнить меня</span>
				</label>
			</div>

			<label for="privacy_policy_cart" class="order__pay_checkbox d-hide">
				<input type="checkbox" name="privacy_policy_cart" id="privacy_policy_cart">
				<span class="text">Я согласен на обработку <a href="https://test.sandrahometextile.ru/privacy-policy" target="_blank">персональных данных</a></span>
			</label>


			<div class="ajax-register d-hide">
				<?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
			</div>
			<div class="ajax-login d-hide">
				<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
			</div>
			
			<div class="basket__btn" id="submit-block">
				<input class="btn basket__btn_log" type="submit" name="submit" value="Войти на сайт">
				<a href="<?php echo wp_lostpassword_url(); ?>" class="btn basket__btn_lost-pass">Забыли пароль</a>
			</div>
			<div class="basket__register">
				<div class="btn">Пройти регистрацию</div>
			</div>
		</form>
	</section>
</div>
<div class="overlay-basket"></div>
<?php } ?>