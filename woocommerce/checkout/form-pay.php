<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
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

$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
$url = home_url();
$date_created = wc_format_datetime($order->get_date_created());
$order_status = wc_get_order_status_name($order->get_status());
$date_paid = $order->get_date_paid();
$notes = $order->get_customer_order_notes();
$total_quantity = $order->get_item_count();
?>
<section class="personal-account personal-account-item"><a href="<? echo $url;?>/account/orders/" class="bread-crumb">Вернуться назад</a>
<h1 class="title-h1">Личный кабинет</h1>
<div class="woocommerce container-main catalog">
	<nav class="woocommerce-MyAccount-navigation catalog__sidebar personal-account__navigation">
		<ul>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
				<a href="<? echo $url;?>/account/">Панель управления</a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders is-active">
				<a href="<? echo $url;?>/account/orders/">Заказы</a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--likelist">
				<a href="<? echo $url;?>/account/likelist/">Избранное</a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--account-info">
				<a href="<? echo $url;?>/account/account-info/">Детали профиля</a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account d-hide">
				<a href="<? echo $url;?>/account/edit-account/">Детали профиля</a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--password-change">
				<a href="<? echo $url;?>/account/password-change/">Смена пароля</a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--help">
				<a href="<? echo $url;?>/account/help/">Помощь</a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
				<a href="<? echo wp_logout_url( wc_get_page_permalink('myaccount') ); ?>">Выйти</a>
			</li>
		</ul>
	</nav>


<div class="woocommerce-MyAccount-content catalog__wrapper personal-account__content account-order"><div class="woocommerce-notices-wrapper"></div>

<div class="personal-account__content_title order-grid account-order__title">
	<div class="account-order__title_name">заказ № <?php echo $order->get_order_number(); ?></div>
	<div class="account-order__title_data">
		<?php echo $date_created; ?>
	</div>
	<?php
		$status = $order->get_status();
		if ($status === 'cancelled') {
			echo '<div class="account-order__title_status status-remark">';
		}
		else if ($status == 'refunded') {
			echo '<div class="account-order__title_status">';
		}
		else {
			if (!empty($date_paid)) {
				echo '<div class="account-order__title_status">';
			}
			else if (empty($date_paid)) {
				echo '<div class="account-order__title_status status-remark">';
			}
		}
		echo $order_status;
	?>
	</div>
</div>
<div class="account-order__descr order-grid">
	<div class="account-order__descr_quantity">Количество</div>
	<div class="account-order__descr_sum">Стоимость</div>
</div>

<div class="account-mob">

<?php
	$order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
		foreach ( $order_items as $item_id => $item ) {
			$product = $item->get_product();
			$product_thumb = get_the_post_thumbnail_url($item['product_id'], 'woo-thumbnail-product');
			if (empty($product_thumb)) {
				$thumbnail_tag = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
				preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $thumbnail_tag, $images, PREG_SET_ORDER);
				foreach ($images as $image) {
					$product_thumb_echo = '' . home_url() . $image[1] . '';
				}
			}
			else {
				$product_thumb_echo = $product_thumb;
			}
			$product_title = $item->get_name();
			$product_qty = $item->get_quantity();
			$amount_order = $item->get_total();
			$amount_order_space = number_format((int)$amount_order, 0, '', '&nbsp;');
			$is_visible = $product && $product->is_visible();
			$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
			echo '<div class="account-order__content order-grid">';
			echo '<a href="'. $product_permalink .'" class="account-order__content_img"><img src="' . $product_thumb_echo . '" alt="'. $product_title .'" title="'. $product_title .'"></a>';
			echo '<a href="'. $product_permalink .'" class="account-order__content_title">'. $product_title .'</a>
			<div class="account-order__content_quantity">'. $product_qty .'&nbsp;шт.</div>
			<div class="account-order__content_sum">'. $amount_order_space . '&nbsp;₽</div>';
			echo '</div>';
		}

	$payment_method = $order->get_payment_method_title();
	$order_shipping_total = $order->get_shipping_to_display();
	$order_billing_postcode = $order->billing_postcode;
	$order_billing_city = $order->billing_city;
	$order_billing_address = $order->billing_address_1;
	
	if (!empty($order_billing_postcode)) {
		$order_block_address = ''. $order_billing_postcode .', ' . $order_billing_city . ', ' . $order_billing_address;
	} else {$order_block_address = '' . $order_billing_city . ', ' . $order_billing_address;}
	
	$total_amount = $order->get_formatted_order_total();
	$total_amount_notag = strip_tags($total_amount);
	$total_amount_space = number_format((int)$total_amount_notag, 0, '', '&nbsp;');
	
?>
<button class="account-order__btn"></button>
</div>

<div class="account-order__result order-grid">
	<div class="account-order__result_descr">
		<div><span>Метод оплаты:</span> <span><?php echo $payment_method; ?></span></div>
		<div><span>Доставка:</span> <span><?php echo $order_shipping_total; ?></span></div>
		<div><span>Адрес:</span> <span><?php echo $order_block_address; ?></span></div>
	</div>
	<div class="account-order__result_sum"><?php echo $total_amount_space; ?>&nbsp;₽</div>
</div>

<div class="order-payment">
<?php
// $actions = $order->get_checkout_payment_url();
// $actions2 = $order->get_cancel_order_url();
$cancel_order = $order->get_cancel_order_url($order->get_view_order_url() );
$payment_title = $order->get_payment_method_title();
if ( $order->get_status() === "pending" ) {
	echo '<div class="btn" id="pay-now">Оплатить</div>';
	echo '<div class="btn-underline" id="change-payment-method">Сменить способ оплаты</div>';
	// echo '<div class="btn-invert">Отменить заказ</div>';

	echo '<div class="btn-invert" id="cancel-order-js">Отменить заказ</div>';
	echo '<a href="'.$cancel_order.'" class="d-hide" id="cancel-order-tech">Отменить заказ</a>';
}
?>

</div>


<?php if ( $notes ) : ?>
	<?php 
	$note_count = 0;
	foreach ( $notes as $note ) {
		$note_count++;
	}?>
<div class="account-comments">
	<h3 class="account-comments-title">
	<?php
		if ($note_count === 1){
			echo 'Вы получили комментарий от продавца:';
		}
		else if ($note_count > 1 ) {
			echo 'Вы получили комментарии от продавца:';
		}
		?> 
	</h3>
	<?php foreach ( $notes as $note ) : ?>

		<div class="account-comment-block">
			<div class="account-comment-date">
				<?php
					$date_created_comment = date_i18n( esc_html__( 'j.m.y', 'woocommerce' ), strtotime( $note->comment_date ) ); 
					$time_created_comment = date_i18n( esc_html__( 'H:i', 'woocommerce' ), strtotime( $note->comment_date ) );
					echo '<span class="comment-date">'.$date_created_comment .'</span><br>';
					echo $time_created_comment;
				?>
			</div>
			<div class="account-comment-descr">
				<?php 
				$comment_content = wpautop( wptexturize( $note->comment_content ) );
				$notag_comment_content = strip_tags($comment_content);
				echo $notag_comment_content;
				?>
			</div>
		</div>

	<?php endforeach; ?>
</div>
<?php endif; ?>





</div>



<div class="popap-account">
	<div class="mob-popap">

	<?php 
		foreach ( $order_items as $item_id => $item ) {
			$product = $item->get_product();

			$product_thumb = get_the_post_thumbnail_url($item['product_id'], 'woo-thumbnail-product');
			if (empty($product_thumb)) {
				$thumbnail_tag = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
				preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $thumbnail_tag, $images, PREG_SET_ORDER);
				foreach ($images as $image) {
					$product_thumb_echo = '' . home_url() . $image[1] . '';
				}
			}
			else {
				$product_thumb_echo = $product_thumb;
			}

			$product_title = $item->get_name();
			$product_qty = $item->get_quantity();
			$amount_order = $item->get_total();
			$amount_order_space = number_format((int)$amount_order, 0, '', '&nbsp;');
			$is_visible = $product && $product->is_visible();
			$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
			echo '<a href="'. $product_permalink .'" class="account-order__content order-grid">';
			echo '<div class="account-order__content_img" ><img src="' . $product_thumb_echo . '" alt="'. $product_title .'" title="'. $product_title .'"></div>';
			echo '<div class="account-order__content_title">'. $product_title .'</div>
			<div class="account-order__content_quantity">'. $product_qty .'&nbsp;шт.</div>
			<div class="account-order__content_sum">'. $amount_order_space . '&nbsp;₽</div>';
			echo '</a>';
		}

	?>
		
		<button class="account-order__btn"></button>
	</div>



</div>





</div>
</section>

<section class="modal modal-account-order-pay">
	<button class="close-button"></button>
	<h3 class="form__title">Способ оплаты</h3>

	<div class="select-order-pay-wrapper">
		<div class="select-css pay-method-js">Онлайн оплата на сайте</div>
		<div class="select-input" id="order-pay-method"></div>
	</div>
	
	<div class="order-pay__result_descr">
		<div><span>Ваш заказ</span>
		<span>
			<?php
			
			echo $total_quantity;
			if ($total_quantity === 1) {echo '&nbsp;товар';}
			else if ($total_quantity === 2 || $total_quantity === 3 || $total_quantity === 4) {echo '&nbsp;товара';}
			else if ($total_quantity > 4) {echo '&nbsp;товаров';}
			?>
		
		</span></div>
		<div><span>Доставка</span><span><?php echo $order_shipping_total; ?></span></div>
	</div>
	<div class="order-pay__result_sum">

		<span>Итого:</span><span><?php echo $total_amount_space; ?>&nbsp;₽</span>

	</div>

	<form id="order_review" method="post">
		<div id="payment-order-pay">
			<?php if ( $order->needs_payment() ) : ?>
				<ul class="wc_payment_methods payment_methods methods">
					<?php
					if ( ! empty( $available_gateways ) ) {
						foreach ( $available_gateways as $gateway ) {
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						}
					} else {
						echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', esc_html__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
					}
					?>
				</ul>
		</div>
			<?php endif; ?>
			<div class="modal-account-order-pay-btn">
				<input type="hidden" name="woocommerce_pay" value="1" />

				<?php wc_get_template( 'checkout/terms.php' ); ?>

				<?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

				<?php echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class="btn" id="place_order">Оплатить заказ</button>' ); // @codingStandardsIgnoreLine ?>

				<?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

				<?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>
			</div>
		
	</form>

</section>
<?php
	$current_user = wp_get_current_user();
	$username = $current_user->user_firstname;
	$useremail = $current_user->user_email;
	$userid = $current_user->ID;
	$userphone = get_user_meta($userid,'billing_phone', true);
?>
<section class="modal modal-account-cancel-order">
	<button class="close-button"></button>
	<h3 class="form__title">Укажите причину отмены</h3>
	<p class="form__subtitle">Почему Вы решили отменить заказ?</p>

	<div class="select-order-pay-wrapper">
		<div class="select-css motive-cancel-js">Выбрать...</div>
		<div class="select-input" id="motive-cancel-method">
			<span data-for="">Хочу изменить заказ и оформить заново</span>
			<span data-for="">Указал неверный адрес</span>
			<span data-for="">Передумал покупать</span>
			<span data-for="">Нашел дешевле</span>
			<span data-for="">Не нашел нужную причину</span>
		</div>
		<span class="error-mess d-hide">Необходимо выбрать причину отмены</span>
	</div>

	<div class="order-pay__goods-cancel">
		<?php
			echo $total_quantity;
			if ($total_quantity === 1) {echo '&nbsp;товар';}
			else if ($total_quantity === 2 || $total_quantity === 3 || $total_quantity === 4) {echo '&nbsp;товара';}
			else if ($total_quantity > 4) {echo '&nbsp;товаров';}
		?>&nbsp;к отмене</div>
	<div class="order-pay__sum-cancel">На сумму <?php echo $amount_order_space;?>&nbsp;₽</div>

	<div class="modal-account-order-pay-btn">
		<form method="post" class="cancel-order">
			<input type="hidden" name="feedback" value="cancel-order">
			<input type="hidden" name="form-number-order" value="<?php echo $number_order;?>">
			<input type="hidden" name="form-motive" value="">
			<input type="hidden" name="form-name" value="<?php echo $username;?>">
			<input type="hidden" name="form-email" value="<?php echo $useremail;?>">
			<input type="hidden" name="form-tel" value="<?php echo $userphone;?>">
			<input class="btn" type="submit" value="Подтвердить отмену" data-text="Подтвердить отмену">
		</form>
	</div>

</section>


