<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//Удаление ссылка на загрузки в панеле управления
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );
function custom_my_account_menu_items( $items ) {
	unset($items['downloads']);
	return $items;
}

add_action( 'wp_loaded', function(){
	$is_new = version_compare( $GLOBALS['wp_version'], '5.3.0', '>=' );
	if( $is_new )  add_filter( 'wp_date', 'russify_months', 11, 2 );   // WP 5.3
	else           add_filter( 'date_i18n', 'russify_months', 11, 2 ); // WP < 5.3
});

function russify_months( $date, $req_format ){
	// в формате есть "строковые" неделя или месяц. выходим, если в формате есть экранированные символы
	if( false !== strpos( $req_format, '\\') || ! preg_match('/[FMlS]/', $req_format ) || determine_locale() !== 'ru_RU'  )
		return $date;
	$date = strtr( $date, [
		'Январь'=>'января', 'Февраль'=>'февраля', 'Март'=>'марта', 'Апрель'=>'апреля', 'Май'=>'мая', 'Июнь'=>'июня', 'Июль'=>'июля', 'Август'=>'августа', 'Сентябрь'=>'сентября', 'Октябрь'=>'октября', 'Ноябрь'=>'ноября', 'Декабрь'=>'декабря',
		'Янв'=>'янв.', 'Фев'=>'фев.', 'Мар'=>'март', 'Апр'=>'апр.', 'Июн'=>'июнь', 'Июл'=>'июль', 'Авг'=>'авг.', 'Сен'=>'сен.', 'Окт'=>'окт.', 'Ноя'=>'ноя.', 'Дек'=>'дек.',
		'January'=>'января', 'February'=>'февраля', 'March'=>'марта', 'April'=>'апреля', 'May'=>'мая', 'June'=>'июня', 'July'=>'июля', 'August'=>'августа', 'September'=>'сентября', 'October'=>'октября', 'November'=>'ноября', 'December'=>'декабря',
		'Jan'=>'янв.', 'Feb'=>'фев.', 'Mar'=>'март.', 'Apr'=>'апр.', 'Jun'=>'июня', 'Jul'=>'июля', 'Aug'=>'авг.', 'Sep'=>'сен.', 'Oct'=>'окт.', 'Nov'=>'нояб.', 'Dec'=>'дек.',
		'Sunday'=>'воскресенье', 'Monday'=>'понедельник', 'Tuesday'=>'вторник', 'Wednesday'=>'среда', 'Thursday'=>'четверг', 'Friday'=>'пятница', 'Saturday'=>'суббота',
		'Sun'=>'вос.', 'Mon'=>'пон.', 'Tue'=>'вт.', 'Wed'=>'ср.', 'Thu'=>'чет.', 'Fri'=>'пят.', 'Sat'=>'суб.', 'th'=>'', 'st'=>'', 'nd'=>'', 'rd'=>'',
	] );
	return $date;
}

add_filter ( 'woocommerce_account_menu_items', 'truemisha_log_history_link', 25 );
function truemisha_log_history_link($menu_links){
	unset($menu_links['orders']);
	unset($menu_links['edit-address']);
	unset($menu_links['edit-account']);
	unset($menu_links['customer-logout']);
	unset($menu_links['payment-methods']);
	$menu_links['orders'] = 'Заказы';
	$menu_links['likelist'] = 'Избранное';
	$menu_links['account-info'] = 'Детали профиля';
	$menu_links['edit-account'] = 'Детали профиля';
	$menu_links['password-change'] = 'Смена пароля';
	$menu_links['help'] = 'Помощь';
	$menu_links['customer-logout'] = 'Выйти';
	return $menu_links;
}

//Содержимое вкладки Адрес добавляем в контент Детали профиля
//add_action( 'woocommerce_account_edit-account_endpoint', 'woocommerce_account_edit_address' );


add_action( 'init', 'new_page_in_account', 25 );
function new_page_in_account() {
	add_rewrite_endpoint( 'likelist', EP_PAGES );
	add_rewrite_endpoint( 'help', EP_PAGES );
	add_rewrite_endpoint( 'account-info', EP_PAGES );
	add_rewrite_endpoint( 'password-change', EP_PAGES );
}
 

add_action( 'woocommerce_account_likelist_endpoint', 'account_likelist_content', 25 );
function account_likelist_content() {
	?>
		<div class="personal-account__content_title">Избранное</div>
	<?php
		if ( is_user_logged_in() ) {
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$user_meta_favorites_array = get_user_meta( $user_id, 'favorites', true );
			$like_products = $user_meta_favorites_array;
		}
		else {
			$cookie_favorites = $_COOKIE['favorites_product'];
			if( (empty( $cookie_favorites )) || (!isset($cookie_favorites)) ) {
				$like_products = array();

			} else {
				$like_products = (array) explode( '|', $_COOKIE[ 'favorites_product' ] );
			}
		}

		if ( empty( $like_products ) ) {
			echo '<h2 class="personal-account__content_subtitle">В избранном пока пусто</h2>
			<p class="personal-account__content_text">Сохраняйте товары с помощью иконки<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15.6329 1.27528C14.7494 0.458217 13.5573 0 12.3151 0C11.073 0 9.88086 0.458217 8.99736 1.27528L8.49825 1.73152L8.0078 1.27528C7.12431 0.458217 5.93221 0 4.69005 0C3.44788 0 2.25578 0.458217 1.37229 1.27528C0.49353 2.09925 0 3.2158 0 4.37989C0 5.54398 0.49353 6.66052 1.37229 7.48449L8.19244 13.8827C8.27395 13.9579 8.38381 14 8.49825 14C8.6127 14 8.72256 13.9579 8.80407 13.8827L15.6329 7.49259C16.5087 6.6655 17 5.54827 17 4.38393C17 3.2196 16.5087 2.10236 15.6329 1.27528ZM15.0213 6.92026L8.49825 13.0215L1.97525 6.92026C1.61824 6.58767 1.33523 6.19215 1.14259 5.75657C0.949961 5.32099 0.851528 4.85399 0.852986 4.38259C0.858297 3.43281 1.26405 2.52339 1.98203 1.85205C2.70001 1.1807 3.67217 0.801698 4.68716 0.797442C5.19056 0.795689 5.68931 0.887631 6.15439 1.06792C6.61946 1.24821 7.04158 1.51325 7.39618 1.84761L8.19244 2.59001C8.23243 2.62789 8.28005 2.65796 8.33254 2.67848C8.38504 2.699 8.44136 2.70957 8.49825 2.70957C8.55515 2.70957 8.61147 2.699 8.66397 2.67848C8.71646 2.65796 8.76408 2.62789 8.80407 2.59001L9.60033 1.84761C10.3246 1.20009 11.291 0.843543 12.2927 0.854243C13.2943 0.864944 14.2517 1.24204 14.9601 1.90486C15.6684 2.56769 16.0714 3.46359 16.0828 4.4009C16.0943 5.33821 15.7132 6.24248 15.0213 6.92026Z" fill="#786453" /> </svg> в&nbsp;карточке товара или каталоге</p>
			<div class="personal-account__content_btn"><a href="'.get_permalink(wc_get_page_id("shop")).'" class="btn">В каталог</a></div>
			<div class="personal-account__content_img"><img src="'.get_template_directory_uri().'/assets/img/favourite-account-null.png" alt=""></div>';
			return;
		}
		// надо ведь сначала отображать последние просмотренные
		$like_products = array_reverse( array_map( 'absint', $like_products ) );
		//$product_ids = join( ", ", $viewed_products);
		$args = [
			'post_type'      => 'product',
			'posts_per_page' => -1,
			'post__in' => $like_products
		];
		$query = new WP_Query( $args );
		// обрабатываем результат
		if ( $query->have_posts() ) :
		?>
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				global $product;
				$img_thumb = get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', $attributes );
				?>
				<div class="account-like__content like-grid">
					<div class="account-like__content_img">
					<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="account-like-js active" data-page="account-likelist" product_id="<?php echo get_the_id();?>">
						<circle cx="14" cy="14" r="14" fill="#FCFCFC"/>
						<path d="M20.7133 9.27528C19.8818 8.45822 18.7598 8 17.5907 8C16.4216 8 15.2996 8.45822 14.4681 9.27528L13.9984 9.73152L13.5368 9.27528C12.7052 8.45822 11.5833 8 10.4142 8C9.24506 8 8.12309 8.45822 7.29156 9.27528C6.4645 10.0993 6 11.2158 6 12.3799C6 13.544 6.4645 14.6605 7.29156 15.4845L13.7105 21.8827C13.7873 21.9579 13.8906 22 13.9984 22C14.1061 22 14.2095 21.9579 14.2862 21.8827L20.7133 15.4926C21.5376 14.6655 22 13.5483 22 12.3839C22 11.2196 21.5376 10.1024 20.7133 9.27528Z" fill="#B39D96"/>
					</svg>
						<?php
							echo '<a href="' . get_the_permalink() . '">';
							if (empty($img_thumb)) {
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
								echo $thumbnail;
							}else { echo $img_thumb; }
							echo '</a>';
						?>
					</div>
					<div class="account-like__content_title">
						<?php echo '<a href="' . get_the_permalink() . '"><span>' . get_the_title() . '</span></a>'; ?>
						<span>
							<?php
								$attribute_sizes = array( 'razmer-pokryvala', 'razmer-pledy', 'razmer-shtory', 'razmer-chehly-dlya-mebeli', 'razmer-postelnoe-belyo' );
								$material = $product->get_attribute('material');
								$color = $product->get_attribute('czvet');
								$price = get_post_meta( get_the_ID(), '_regular_price', true); // основная цена товара
								$sale = get_post_meta( get_the_ID(), '_sale_price', true); 	//цена со скидкой
								$price_space = number_format((int)$price, 0, '', '&nbsp;');
								$sale_space = number_format((int)$sale, 0, '', '&nbsp;');
								foreach ( $attribute_sizes as $attribute_size ) {
									$razmer = $product->get_attribute( $attribute_size );
									if (!empty($razmer)) {
										echo ''. $razmer . ', ';
									}
								}
								if (!empty($material)) {
									echo '' . $material . ', ';
								} if (!empty($color)) {
									echo '' . $color;
								}
							?>
						</span>
					</div>
					<div class="account-like__content_sum">
						<?php if (!empty($sale)){ ?> <!-- если нет цены со скидкой выводим основную цену -->
							<span><?php echo ''. $sale_space .'&nbsp;₽'; ?></span>
							<span class="dash"><?php echo ''. $price_space .'&nbsp;₽'; ?></span><?php
						} else { ?> <!-- иначе, если есть цена со скидкой выводим все виды цен -->
							<span><?php echo ''. $price_space .'&nbsp;₽'; ?></span><?php
						}?>
					</div>
					<button class="account-like__content_btn btn-invert add-to-cart-product-js" product_id="<?php echo get_the_id();?>" quantity="1">в корзину</button>
				</div>
			<?php 
			} //endwhile ?> 
		<?php wp_reset_postdata(); endif;
		?>
	<?php
}
add_action( 'woocommerce_account_account-info_endpoint', 'account_info_content', 30 );
function account_info_content() {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$user_name = $current_user->user_firstname;
	$user_email = $current_user->user_email;
	$user_phone = $current_user->billing_phone;
	$user_login = $current_user->user_login;
	$user_postcode = $current_user->billing_postcode;
	$user_city = $current_user->billing_city;
	$user_address = $current_user->billing_address_1;
	$organisation = get_user_meta( $user_id, 'organisation', true);
	$user_id_company = get_user_meta( $user_id, 'company', true);
	$user_id_company_name = get_user_meta( $user_id, 'organisation_name', true );
	$user_id_company_inn = get_user_meta( $user_id, 'organisation_inn', true );

	$favorites = get_user_meta( $user_id, 'favorites', true );

	if ($user_city) {
		$addpress_block = ''.$user_city.'';
	}
	if ($user_address) {
		$addpress_block = ''.$user_address.'';
	}
	if ($user_city && $user_address) {
		$addpress_block = ''.$user_city.', '.$user_address.'';
	}
	if ($user_postcode && $user_city && $user_address) {
		$addpress_block = ''.$user_postcode.', '.$user_city.', '.$user_address.'';
	}
	?>
	<div class="personal-account__content_title">Учётные данные</div>
	<div class="credentials">
		<div class="credentials__content">
			<div class="credentials__content_title">ФИО</div>
			<div class="credentials__content_descr"><?php echo $user_name; ?></div>
		</div>
		<div class="credentials__content">
			<div class="credentials__content_title">E-mail</div>
			<div class="credentials__content_descr"><?php echo $user_email; ?></div>
		</div>
		<div class="credentials__content">
			<div class="credentials__content_title">Контактный телефон</div>
			<div class="credentials__content_descr">
				<?php if ($user_phone) {
					echo $user_phone;
				}
				else {
					echo '<a href="'.home_url().'/account/edit-account/">Заполнить</a>';
				}
				?>
			</div>
		</div>
		<div class="credentials__content">
			<div class="credentials__content_title">Логин</div>
			<div class="credentials__content_descr"><?php echo $user_login; ?></div>
		</div>
	</div>
	<div class="personal-account__content_title">
		<p>Адрес доставки</p><span class="title-info">Будет использован по умолчанию при оформлении заказов</span></div>
	<div class="credentials__content delivery-address">
		<div class="credentials__content_title">Адрес</div>
		<?php
		if ($user_city) {
			echo '<div class="credentials__content_descr">' . $addpress_block . '</div>';
			if ($user_id_company === 'on') {

					if ($user_id_company_name) {
						echo '<div class="credentials__content_descr">'.$user_id_company_name.'</div>';
					}
					else {
						echo '<div class="credentials__content_descr">Компания / ИП: <a href="'.home_url().'/account/edit-account/">Заполнить</a></div>';
					}


				 	



					if ($user_id_company_inn) {
						echo '<div class="credentials__content_descr">ИНН: '.$user_id_company_inn.'</div>';
					}
					else {
						echo '<div class="credentials__content_descr">ИНН: <a href="'.home_url().'/account/edit-account/">Заполнить</a></div>';
					}
				
				



			}
		}
		else {
			echo '<div class="credentials__content_descr"><a href="'.home_url().'/account/edit-account/">Заполнить</a></div>';
		}
		?>
		</div><a href="<?php echo home_url(); ?>/account/edit-account/" class="btn">Редактировать</a>
	<?php
}

add_action( 'woocommerce_account_password-change_endpoint', 'password_change_content', 40 );
function password_change_content() {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$user_name = $current_user->user_firstname;
	$user_email = $current_user->user_email;
?>

	<form method="post" class="edit-password">
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

			<input type="hidden" name="account_first_name" id="account_first_name" value="<?php echo $user_name; ?>" readonly>
			<input type="hidden" name="account_email" id="account_email" value="<?php echo $user_email; ?>" readonly>
			<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_current">Текущий пароль <abbr class="required" title="обязательно">*</abbr></label>
				<input type="password" name="password_current" id="password_current" autocomplete="off" required>
				<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
			</div>
			<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_1">Пароль (не менее 6 символов) <abbr class="required" title="обязательно">*</abbr></label>
				<input type="password" name="password_1" id="password_1" autocomplete="off" minlength="6" required>
				<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
			</div>
			<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_2">Повторите новый пароль <abbr class="required" title="обязательно">*</abbr></label>
				<input type="password" name="password_2" id="password_2" autocomplete="off" minlength="6" required>
				<span class="error-mess">Пароли не совпадают</span>
				<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
			</div>

		<?php do_action( 'woocommerce_edit_account_form' ); ?>
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<p class="account-btn">
			<button type="submit" class="woocommerce-Button button btn" name="save_account_details">Изменить пароль</button>
			<input type="hidden" name="action" value="save_account_details" />
			<a href="<?php echo home_url(); ?>/account/lost-password/" class="btn-invert">Забыли пароль</a>
		</p>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</form>
	<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
<?php
}


add_action( 'woocommerce_account_help_endpoint', 'account_help_content', 45 );
function account_help_content() {
	$current_user = wp_get_current_user();
	$username = $current_user->user_firstname;
	$useremail = $current_user->user_email;
	$userid = $current_user->ID;
	$customer_orders = get_posts( array(
		'posts_per_page' => 5,
		'meta_key'    => '_customer_user',
		'order' => 'DESC', 
		'meta_value'  => get_current_user_id(),
		'post_type'   => wc_get_order_types(),
		'post_status' => array_keys(wc_get_order_statuses()),
	) );
	$ids = array();
	$time = array();
	foreach ( $customer_orders as $customer_order ) {
		$order = wc_get_order( $customer_order->ID );
		$items = $order->get_items();




		foreach ( $items as $item ) {
			$ids[] = $item->get_order_id();

			// echo '<pre>';
			// print_r($item);
			// echo '</pre>';
			//$time[] = $item->get_date_created();
			
		}
	}
	$id_remove_repeat = join(',', array_unique( $ids ));
	$id_array_separators = (array) explode( ',', $id_remove_repeat );


	?>
	<form method="post" class="account-help__form">
		<div class="woocommerce-address-fields">
			<fieldset>
				<legend>Возникли вопросы, проблемы? Напишите нам!</legend>
				<div class="form-row d-hide">
					<input type="hidden" name="form-name" value="<?php echo $username; ?>" readonly>
				</div>
				<div class="form-row d-hide">
					<input type="hidden" name="form-email" value="<?php echo $useremail; ?>" readonly>
				</div>

				<div class="form-row account-help__list">
					<label>Выберите тематику <abbr class="required" title="обязательно">*</abbr></label>
					<input type="hidden" name="form-question" class="input-text insert">
					<div class="account-help-js">Выбрать...</div>
					<div class="account-help-select">
						<span value="Заказ">Заказ</span>
						<span value="Оплата">Оплата</span>
						<span value="Доставка">Доставка</span>
						<span value="Личный кабинет">Личный кабинет</span>
						<span value="Другое">Другое</span>
					</div>
					<span class="error-mess">Необходимо заполнить поле</span>
				</div>
				<?php
				if ($customer_orders) { ?>

					<div class="form-row account-help__number">
						<label>Номер заказа</label>
						<input type="hidden" name="form-number-order" class="input-text insert">
						<div class="account-help-js">Выбрать...</div>
						<div class="account-help-select">
							<?php
							foreach ( $id_array_separators as $id_order ) {
								$order = wc_get_order($id_order);
								$data_order = $order->get_data();
								$date_created = wc_format_datetime($data_order['date_created']);
								$html_value = $id_order . ' от '.$date_created.'';
								echo '<span value="'.$html_value .'">'.$html_value.'</span>';
							}
							?>
						</div>

				</div>
				<?php } ?>
				<?php 
				$phone = get_user_meta($userid,'billing_phone', true);
					if (!empty($phone)) {
						echo '<div class="form-row account-help__tel d-hide"><label for="form-tel">Контактный телефон <abbr class="required" title="обязательно">*</abbr></label><input type="tel" class="input-text" name="form-tel" id="form-tel" autocomplete="off" value="' . $phone . '" readonly>';
					} else {
						echo '<div class="form-row account-help__tel" id="account_phone_field"><label for="form-tel">Контактный телефон <abbr class="required" title="обязательно">*</abbr></label><input type="tel" class="input-text account_phone" name="form-tel" id="form-tel" autocomplete="off" value="' . $phone .'" minlength="11" maxlength="11" inputmode="decimal"><span class="error-mess">Необходимо заполнить поле</span>';
					}
				?>
				</div>
				<div class="form-row account-help__textarea">
					<label for="form-textarea">Сообщение <abbr class="required" title="обязательно">*</abbr></label>
					<textarea type="text" class="input-text" name="form-textarea" id="form-textarea" maxlength="400" resize="none" rows="2" placeholder="Начните писать свой вопрос"></textarea>
					<span class="error-mess">Необходимо заполнить поле</span>
				</div>
				<input type="hidden" name="feedback" value="account-help">
				
				<div class="feedback__btn">
					<input class="btn" type="submit" value="Отправить сообщение" data-text="Отправить сообщение">
					<div class="feedback__btn_alert report">
						<span class="report__error d-hide">Сообщение не отправилось. <br> Пожалуйста, повторите ещё раз</span>
						<span class="report__ok d-hide">Сообщение успешно отправлено</span>
					</div>
				</div>
			</fieldset>
		</div>
	</form>
	<?php
}

//Убираем ненужные поля инпутов обязательно для заполнения
add_filter('woocommerce_save_account_details_required_fields', 'remove_required_fields');
function remove_required_fields( $required_fields ) {
	unset($required_fields['account_display_name']);
	unset($required_fields['account_last_name']);
return $required_fields;
}

//Обновляем данные пользователя с личного кабинета с вкладки edit-account
add_action( 'woocommerce_save_account_details', 'wp_kama_woocommerce_save_account_details_action' );
function wp_kama_woocommerce_save_account_details_action(){
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$account_phone = sanitize_text_field($_POST["account_phone"]);
	$account_billing_city = sanitize_text_field($_POST["account_billing_city"]);
	$account_billing_address = sanitize_text_field($_POST["account_billing_address"]);
	$account_billing_postcode = sanitize_text_field($_POST["account_billing_postcode"]);
	$account_org_checked = sanitize_text_field($_POST["organisation"]);
	$account_company_name = sanitize_text_field($_POST["organisation_name"]);
	$account_company_inn = sanitize_text_field($_POST["organisation_inn"]);

	$account_password_1 = sanitize_text_field($_POST["password_1"]);
	$account_password_2 = sanitize_text_field($_POST["password_2"]);

	$clean_str_tel = mb_eregi_replace('[^0-9]', '', $account_phone);
	if (mb_strlen($clean_str_tel) < 11 ) {
		$err_message['tel'] = '';
	}
	else {
		update_user_meta( $user_id, 'billing_phone', $account_phone);
	}

	if ($account_billing_city == '') {
		$err_message['city'] = '';
	}
	else {
		update_user_meta( $user_id, 'billing_city', $account_billing_city);
	}

	if ($account_billing_address == '') {
		$err_message['address'] = '';
	}
	else {
		update_user_meta( $user_id, 'billing_address_1', $account_billing_address);
	}


	if($account_org_checked == "company") {
		update_user_meta( $user_id, 'company', 'on' );

		if ($account_company_name == '') {
			$err_message['company_name'] = '';
		}
		else {
			update_user_meta( $user_id, 'organisation_name', $account_company_name);
		}

		if ($account_company_inn == '') {
			$err_message['company_inn'] = '';
		}
		else {
			update_user_meta( $user_id, 'organisation_inn', $account_company_inn);
		}
	
	}
	else { 
		delete_user_meta( $user_id, 'company' );
		delete_user_meta( $user_id, 'organisation_name');
		delete_user_meta( $user_id, 'organisation_inn');
	}
	update_user_meta( $user_id, 'billing_postcode', $account_billing_postcode);
	$url = $_SERVER['HTTP_REFERER'];
	if (strpos($url, '/password-change/') !== false) {
		wp_redirect(''. home_url() .'/account/password-change/');
		die();
	}

	if (!$err_message) {
		wp_redirect(''. home_url() .'/account/account-info/');
		die();
	}



}




//Создаем свой статус заказа "Передан в доставку"
add_action( 'init', 'register_my_new_order_statuses' );
function register_my_new_order_statuses() {
	register_post_status( 'wc-delivery', array(
		'label'                     => _x( 'Передан в доставку', 'Order status', 'textdomain' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Передан в доставку <span class="count">(%s)</span>', 'Передан в доставку <span class="count">(%s)</span>', 'textdomain' ) 
	));
	register_post_status( 'wc-point-issue', array(
		'label'                     => _x( 'Ожидает в пункте выдачи', 'Order status', 'textdomain' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Ожидает в пункте выдачи <span class="count">(%s)</span>', 'Ожидает в пункте выдачи <span class="count">(%s)</span>', 'textdomain' ) 
	));
}

add_filter( 'wc_order_statuses', 'my_new_wc_order_statuses' );
function my_new_wc_order_statuses( $order_statuses ) {
	$order_statuses['wc-delivery'] = _x( 'Передан в доставку', 'Order status', 'textdomain' );
	$order_statuses['wc-point-issue'] = _x( 'Ожидает в пункте выдачи', 'Order status', 'textdomain' );
	return $order_statuses;
}

add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );
function wc_renaming_order_status( $order_statuses ) {
    foreach ( $order_statuses as $key => $status ) {
        if ( 'wc-completed' === $key ) {
			$order_statuses['wc-completed'] = _x( 'Заказ получен', 'Order status', 'woocommerce' );
		}
		if ( 'wc-on-hold' === $key ) {
			$order_statuses['wc-on-hold'] = _x( 'Заказ принят', 'Order status', 'woocommerce' );
		}  
		if ( 'wc-processing' === $key ) {
			$order_statuses['wc-processing'] = _x( 'Ожидает отправки', 'Order status', 'woocommerce' );
		}  	
		if ( 'wc-pending' === $key ) {
			$order_statuses['wc-pending'] = _x( 'Ожидает оплаты', 'Order status', 'woocommerce' );
		}  	
	}
    return $order_statuses;
}


//Указываем статус on-hold всегда при наличном расчете
add_filter( 'woocommerce_cod_process_payment_order_status', 'change_cod_payment_order_status', 10, 2 );
function change_cod_payment_order_status( $order_status, $order ) {
    return 'on-hold';
}


//ошибка в заказе (просмотр заказа с неверной ссылкой)
//remove_action('woocommerce_account_view-order_endpoint', 'woocommerce_account_view_order');
//add_action('woocommerce_account_view-order_endpoint', 'new_view_order');

function new_view_order($order_id) {
        $order = wc_get_order($order_id);

        if (!current_user_can('view_order', $order_id)) {
            echo '<div class="woocommerce-error">' . esc_html__('Invalid order.', 'woocommerce') . '</div>';

            return;
        }

        // Backwards compatibility.
        $status = new stdClass();
        $status->name = wc_get_order_status_name($order->get_status());

        wc_get_template(
                'myaccount/view-order.php', array(
            'status' => $status, // @deprecated 2.2.
            'order' => wc_get_order($order_id),
            'order_id' => $order_id,
                )
        );
}


/*
add_action( 'woocommerce_edit_account_form', 'cssigniter_add_account_details' );
function cssigniter_add_account_details() {
    $user = wp_get_current_user();
    ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="dob"><?php esc_html_e( 'Date of birth', 'your-text-domain' ); ?></label>
        <input type="date" class="woocommerce-Input woocommerce-Input--text input-text" name="dob" id="dob" value="<?php echo esc_attr( $user->dob ); ?>" />
    </p>
    <?php
}
 
add_action( 'woocommerce_save_account_details', 'cssigniter_save_account_details' );
function cssigniter_save_account_details( $user_id ) {
    if ( isset( $_POST['dob'] ) ) {
        update_user_meta( $user_id, 'dob', sanitize_text_field( $_POST['dob'] ) );
    }
}

add_action( 'show_user_profile', 'cssigniter_show_extra_account_details', 15 );
add_action( 'edit_user_profile', 'cssigniter_show_extra_account_details', 15 );
function cssigniter_show_extra_account_details( $user ) {
    $dob = get_user_meta( $user->ID, 'dob', true );
 
    if ( empty( $dob ) ) {
        return;
    }
 
    ?>
    <h3><?php esc_html_e( 'Extra account details', 'your-text-domain' ); ?></h3>
    <table class="form-table">
    <tr>
        <th><?php esc_html_e( 'Date of birth', 'your-text-domain' ); ?></label></th>
        <td>
            <p><?php echo esc_html( $dob ); ?></p>
        </td>
    </tr>
    </table>
<?php
}
*/