<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>
<p class="personal-account__content_title">
	Заказы
</p>
<?php if ( $has_orders ) : ?>
	<?php
	foreach ( $customer_orders->orders as $customer_order ) {
		$order = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$item_count = $order->get_item_count() - $order->get_item_count_refunded();

		$amount_order = $order->get_total();
		$amount_space = number_format((int)$amount_order, 0, '', '&nbsp;');

		$date_created = $order->get_date_created();
		$date_paid = $order->get_date_paid();
		?>
		<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="account-orders__item">
			<div class="account-orders__item_title">
				<div>Заказ<br> от <?php echo $date_created->date_i18n( 'j F', false ); ?> № <?php echo $order->get_order_number(); ?></div>
				<div><?php echo $amount_space; ?>
					<?php
						$status = $order->get_status();
						if ($status === 'cancelled' || $status == 'refunded') {
							echo '&nbsp;₽';
						}
						else {
							if (!empty($date_paid)) {
								echo '&nbsp;₽<span>, <br>оплачено</span>';
							}
							else if (empty($date_paid)) {
								echo '&nbsp;₽<span>, <br>к оплате</span>';
							}
						}
					?>
				</div>
			</div>
			<div class="account-orders__item_content">
				<div class="account-orders__item_text">
					<div class="account-orders__status">
						<?php
							$status = $order->get_status();
							//echo $status;
							if ($status === 'cancelled' ) {
								echo '<span class="status status-remark">';
							}
							else if ($status == 'refunded') {
								echo '<span class="status status-ok">';
							}
							else {
								if (!empty($date_paid)) {
									echo '<span class="status status-ok">';
								}
								else if (empty($date_paid)) {
									echo '<span class="status status-remark">';
								}
							}
							?>
							<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
						</span>
					</div>
				</div>
				<div class="account-orders__item_img">
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
							echo '<div><img src="' . $product_thumb_echo . '" alt="'. $product_title .'" title="'. $product_title .'"></div>';
						}
					?>
				</div>
			</div>


			<?php /* foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
				<div class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
					<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
						<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

					<?php elseif ( 'order-number' === $column_id ) : ?>
						<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
							<?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
						</a>

					<?php elseif ( 'order-date' === $column_id ) : ?>
						<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

					<?php elseif ( 'order-status' === $column_id ) : ?>
						<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

					<?php elseif ( 'order-total' === $column_id ) : ?>
						<?php
						/* translators: 1: formatted order total 2: total order items */
						//echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
						/* ?>

					<?php elseif ( 'order-actions' === $column_id ) : ?>
						<?php
						$actions = wc_get_account_orders_actions( $order );

						if ( ! empty( $actions ) ) {
							foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
								echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
							}
						}
						?>
					<?php endif; ?>
					</div>
			<?php endforeach; */ ?>

		</a>
		<?php
	}
	?>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php
		$paginate_links = array(
			'base'          => esc_url( wc_get_endpoint_url( 'orders') ) . '%_%',
			'format'        => '%#%',
			'total'         => $customer_orders->max_num_pages,
			'current'      => max( 1, $current_page ),
			'show_all'      => false,
			'end_size'      => 3,
			'mid_size'      => 3,
			'prev_next'     => true,
			'prev_text'     => '',
			'next_text'     => '',
			'type'          => 'plain',
		);
		$current = $paginate_links['current'];
		$total = $paginate_links['total'];

		if ($total > 1) {

	?>
	<nav class="woocommerce-pagination pagination">
		<?php
			if ( is_array( $paginate_links ) ) {
				if ($current == 1 ) {
					echo '<span class="prev disabled"></span>';
				}
				echo paginate_links( $paginate_links );
				if ($total == $current) { 
					echo '<span class="next disabled"></span>';
				}
			}
		?>
	</nav> 
	<?php }?>

<?php else : ?>
	<h2 class="personal-account__content_subtitle">Вы пока не сделали ни одного заказа</h2>
	<p class="personal-account__content_text">Посмотрите предложения на главной странице или воспользуйтесь каталогом, чтобы выбрать нужный товар. Приятных покупок!</p>
	<div class="personal-account__content_btn">
		<a href="<?php echo home_url();?>" class="btn-invert">На главную</a>
		<a href="<?php echo get_permalink(wc_get_page_id("shop")); ?>" class="btn">В каталог</a>
	</div>
	<div class="personal-account__content_img">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/order-null.png" alt="Нет заказов">
	</div>
	<!-- <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div> -->
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

