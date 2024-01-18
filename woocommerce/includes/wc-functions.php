<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//отключение абсолютно все стили WooCommerce (не удаляет в админке стили woo)
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


add_filter( 'product_type_options', function( $options ) {
	// remove "Virtual" checkbox
	if( isset( $options[ 'virtual' ] ) ) {
		unset( $options[ 'virtual' ] );
	}
	// remove "Downloadable" checkbox
	if( isset( $options[ 'downloadable' ] ) ) {
		unset( $options[ 'downloadable' ] );
	}
	return $options;
});

//Отключение виртуальный, скачиваемый товары
add_filter( 'woocommerce_products_admin_list_table_filters', function( $filters ) {
	if( isset( $filters[ 'product_type' ] ) ) {
		$filters[ 'product_type' ] = 'misha_product_type_callback';
	}
	return $filters;
});


//Отключение виртуальный, скачиваемый товары в админке фильтрации
function misha_product_type_callback(){
	$current_product_type = isset( $_REQUEST['product_type'] ) ? wc_clean( wp_unslash( $_REQUEST['product_type'] ) ) : false;
	$output               = '<select name="product_type" id="dropdown_product_type"><option value="">Filter by product type</option>';
	foreach ( wc_get_product_types() as $value => $label ) {
		$output .= '<option value="' . esc_attr( $value ) . '" ';
		$output .= selected( $value, $current_product_type, false );
		$output .= '>' . esc_html( $label ) . '</option>';
	}
	$output .= '</select>';
	echo $output;
}

//Удаление блока редактора в странице редактора товаров woo
add_action('admin_head', 'remove_content_editor');
function remove_content_editor() { 
    remove_post_type_support('product', 'editor');        
}

add_filter( 'product_type_selector', 'remove_product_types' );
add_filter( 'product_type_selector', 'remove_product_types' );

function remove_product_types( $types ){
    unset( $types['grouped'] );
    unset( $types['external'] );
    unset( $types['variable'] );

    return $types;
}

add_filter( 'woocommerce_products_admin_list_table_filters', 'remove_products_admin_list_table_filters', 10, 1 );
function remove_products_admin_list_table_filters( $filters ){
    // Remove "Product type" dropdown filter
    if( isset($filters['product_type']))
        unset($filters['product_type']);

    // Remove "Product stock status" dropdown filter
    if( isset($filters['stock_status']))
        unset($filters['stock_status']);

    return $filters;
}



add_filter( 'woocommerce_product_data_tabs', 'truemisha_new_tab' );
 
function truemisha_new_tab( $tabs ){
	unset( $tabs[ 'shipping' ] ); // Доставка
	unset( $tabs[ 'advanced' ] ); // Дополнительно

	$tabs['general']['priority'] = 10;
	$tabs['general']['label'] = 'Цены';
	
	$tabs['attribute']['priority'] = 20;
	$tabs['attribute']['label'] = 'Характеристики';

	$tabs['linked_product']['priority'] = 30;
	$tabs['linked_product']['label'] = 'Предложить доп. товары';

	$tabs['inventory']['priority'] = 40;
	$tabs['inventory']['label'] = 'Артикул';

	return $tabs;
}





add_filter( 'manage_edit-product_columns', 'change_columns_filter',10, 1 );
function change_columns_filter( $columns ) {
	unset($columns['thumb']);
	unset($columns['name'] );
	unset($columns['sku'] );
	unset($columns['is_in_stock']);
	unset($columns['price']);
	unset($columns['product_cat'] );
	unset($columns['product_tag']);
	unset($columns['featured']);
	unset($columns['product_type']);
	unset($columns['date']);
	$columns['name'] = 'Имя товара';
	$columns['thumb'] = 'Превью';
	$columns['product_cat'] = 'Категория';
	$columns['price'] = 'Цена';
	$columns['sku'] = 'Артикул';
	$columns['is_in_stock'] = 'Запасы';
	return $columns;
}


function wrapper_items_slide_product_card_start($tag, $class, $url) {
	echo ($tag === 'div') ? '<div class="'.$class.'">' : '<a href="'.$url.'" class="'.$class.'">';
}

function wrapper_items_slide_product_card_end($tag) {
	echo ($tag === 'div') ? '</div>' : '</a>';
}
function set_query_params_product_card($args) {
	set_query_var('params_product_card', $args);
}

function wrapper_items_slide_product_single_start($type, $class, $video) {
	echo '<div class="'.$class.'__slide swiper-slide';
	echo ($type === 'mini') && ($video) ? ' slide-video' : '';
	echo '">';


	if ($type !== 'big') {
		echo '<div class="'.$class.'__image';
		echo ($type === 'standart') && (!$video) ? ' swiper-zoom-container' : '';
		echo '">';
	}
}

function wrapper_items_slide_product_single_end($type) {
	echo ($type === 'big') ? '</div>' : '</div></div>';
}

function directory_lazy_pixel() {
	return get_template_directory_uri().'/assets/img/pixel.png';
}


function card_video($id_video, $url_bcg, $type) {?>
	<div class="card__video player__video <?=($type === 'standart') ? 'product-video' : 'product-video-popup';?>">
		<div class="video" <?=($type === 'standart') ? 'id' : 'data-blocked-id';?>="<?=$id_video;?>" data-params="loop=1&playlist=<?=$id_video;?>&enablejsapi=1" id="<?=$id_video;?>" style="background-image: url('<?=$url_bcg;?>');background-size:contain;"> </div>
		<div class="block__video-error loader-error" data-i="<?=$id_video;?>">
			<span>
				<svg width="50" height="45" viewBox="0 0 50 45" fill="none"
					xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M3.5607 44.5165C9.03165 40.1153 16.8458 37.5905 25.0001 37.5905C33.1544 37.5905 40.9686 40.1153 46.4396 44.5165C46.8438 44.8425 47.3292 45.0003 47.8112 45.0003C48.4495 45.0003 49.0836 44.7222 49.516 44.1863C50.274 43.2469 50.1253 41.8714 49.1844 41.1145C42.9504 36.099 34.1346 33.2217 25.0001 33.2217C15.8656 33.2217 7.04991 36.099 0.815826 41.1145C-0.125909 41.8714 -0.27375 43.2469 0.484253 44.1863C1.24226 45.1249 2.61982 45.2742 3.5607 44.5165Z"
						fill="#A58C84" />
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M49.3588 0.640933C48.5051 -0.212342 47.1198 -0.212342 46.2653 0.640933L41.3216 5.57713L36.377 0.640933C35.5233 -0.212342 34.1381 -0.212342 33.2835 0.640933C32.4289 1.49335 32.4289 2.87651 33.2835 3.72979L38.2272 8.66598L33.2835 13.603C32.4289 14.4554 32.4289 15.8386 33.2835 16.6919C34.1372 17.5452 35.5225 17.5452 36.377 16.6919L41.3216 11.7557L46.2653 16.6919C46.6926 17.1185 47.2523 17.3318 47.812 17.3318C48.3718 17.3318 48.9315 17.1185 49.3588 16.6919C50.2134 15.8386 50.2134 14.4554 49.3588 13.603L44.4151 8.66598L49.3588 3.72979C50.2134 2.87651 50.2134 1.49335 49.3588 0.640933Z"
						fill="#A58C84" />
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M0.641903 16.6918C1.49562 17.5442 2.88088 17.5442 3.73545 16.6909L8.67913 11.7547L13.6228 16.6909C14.0501 17.1175 14.6099 17.3309 15.1696 17.3309C15.7294 17.3309 16.29 17.1175 16.7164 16.6909C17.571 15.8385 17.571 14.4553 16.7172 13.6021L11.7736 8.66586L16.7172 3.72881C17.571 2.87639 17.571 1.49323 16.7164 0.639956C15.8627 -0.212465 14.4774 -0.213319 13.6228 0.639956L8.67913 5.57615L3.73545 0.639956C2.88088 -0.213319 1.49562 -0.213319 0.641903 0.639956C-0.212666 1.49323 -0.212666 2.87639 0.641903 3.72881L5.58559 8.66586L0.641903 13.6021C-0.212666 14.4553 -0.212666 15.8385 0.641903 16.6918Z"
						fill="#A58C84" />
				</svg>
			</span>
			<div class="page-reload btn">Перезагрузить</div>
		</div>
		<div class="play__btn <?=($type === 'standart') ? 'play-btn-product-video' : 'play-btn-product-video-popup';?>" data-btn="<?=$id_video;?>" data-url="<?=$url_bcg;?>"><span></span></div>
		
		
	</div>
<?
}



function btn_navigations_slider_big_product_single() {?>
	<div class="popup-img__nav">
		<div class="popup-btn-prev"></div>
		<div class="popup-pagination"></div>
		<div class="popup-btn-next"></div>
	</div>
<?
}
// function check_favorites_product_id_in_shop_html() {
// 	$current_user = wp_get_current_user();
// 		$user_id = $current_user->ID;

// 		$account_favorites_array = get_user_meta( $user_id, 'favorites', true );
// 		echo '<pre>';
// 		print_r($account_favorites_array);
// 		echo '</pre>';

// }

// function update_favorites_product_authorization_user($user) {
// 	// return 'test';
// 	$cookie_favorites = $_COOKIE['favorites_product'];
// 	$cookie_favorites_remove = $_COOKIE['favorites_product_remove'];
// 	if (empty($cookie_favorites)) {
// 		$cookie_favorites = array();
// 	}
// 	if (empty($cookie_favorites_remove)) {
// 		$cookie_favorites_remove = array();
// 	}

// 	// $current_user = wp_get_current_user();
// 	// $user_id = $current_user->ID;
// 	$user_id = $user->data->ID;
// 	$user_meta_favorites = get_user_meta( $user_id, 'favorites', true );
// 	if (empty($user_meta_favorites)) {
// 		$user_meta_favorites = array();
// 	}


// 	$combining_favorites = array_merge($user_meta_favorites, $cookie_favorites);
// 	$clear_duplicate_favorites = array_unique($combining_favorites);

// 	$id_remove_products = $cookie_favorites_remove;
// 	foreach ($id_remove_products as $value_id) {
// 		$remove_id = array_search($value_id, $clear_duplicate_favorites);
// 		unset($clear_duplicate_favorites[$remove_id]);
// 	}

// 	$id_array = $clear_duplicate_favorites;
// 	foreach ($id_array as $value) {
// 		// $product_id = $favorites;
// 		$product_status = get_post_status($value);
// 		if ($product_status !== 'publish') {
// 			$remove = array_search($value, $id_array);
// 			unset($id_array[$remove]);
// 		}
// 	}
// 	update_user_meta( $user_id, 'favorites', $id_array);
// 	wc_setcookie( 'favorites_product', join( '|', $id_array ), time() + (3600 * 24 * 30) );
// 	unset($_COOKIE['favorites_product_remove']);
// 	// return;
// 	// die();
// }





// function check_favorites_product_id_in_shop() {
// 	$cookie_favorites = $_COOKIE['sht_woo_likelist_product'];
// 	if (empty($cookie_favorites)) {
// 		$favorites_cookie_array = array();
// 	} else {
// 		$favorites_cookie_array = (array) explode( '|', $cookie_favorites);
// 	}

// 	if (is_user_logged_in() ) {
// 		$current_user = wp_get_current_user();
// 		$user_id = $current_user->ID;

// 		$account_favorites_array = get_user_meta( $user_id, 'favorites', true );
// 		//$get_account_favorites = get_user_meta( $user_id, 'favorites', true );
// 		// $account_favorites_array = (array) explode( '|', $get_account_favorites);

// 		$combining_favorites = array_merge($favorites_cookie_array, $account_favorites_array);
// 		$clear_duplicate_favorites = array_unique($combining_favorites);

// 		$new_favorites = $clear_duplicate_favorites;

// 		$favorites_id = array();
// 		foreach ($new_favorites as $favorites) {
// 			$product_id = $favorites;
// 			$product_status = get_post_status($product_id);
// 			if ($product_status === 'publish') {
// 				$favorites_id[] = $product_id;
// 			}
// 		}

// 		// $favorites_id = join( '|', $favorites_id );

// 		update_user_meta( $user_id, 'favorites', $favorites_id);
// 		wc_setcookie( 'sht_woo_likelist_product', join( '|', $favorites_id ), time() + (3600 * 24 * 7) );
// 		// get_post_status( $post );

// 		// echo '<pre>';
// 		// print_r($favorites_cookie_array);
// 		// echo '</pre>';
// 		// echo '<br>';

// 		// echo '<pre>';
// 		// print_r($account_favorites_array);
// 		// echo '</pre>';
// 		// echo '<br>';

// 		// echo $cookie_favorites;
// 		// echo '<br>';

// 		// echo $get_account_favorites;
// 		// echo '<br>';

// 		// echo '<pre>';
// 		// print_r($combining_favorites);
// 		// echo '</pre>';
// 		// echo '<br>';

// 		// echo '<pre>';
// 		// print_r($clear_duplicate_favorites);
// 		// echo '</pre>';
// 		// echo '<br>';

// 		// echo '<pre>';
// 		// print_r($favorites_id);
// 		// echo '</pre>';
		
// 	}
// }
function udpate_favorites_product_count($location) {
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$user_meta_favorites_array = get_user_meta( $user_id, 'favorites', true );
		$count_favorites = count($user_meta_favorites_array);
	}
	else {
		if( (!empty($_COOKIE['favorites_product'])) || (isset($_COOKIE['favorites_product'])) ) {
			$cookie_favorites = $_COOKIE['favorites_product'];
			$cookie_favorites = (array) explode( '|', $cookie_favorites);
			$count_favorites = count($cookie_favorites);
		}
	}
	if ((!empty($count_favorites)) && ($count_favorites !== 0)) {
		echo ($location === 'header') ? '<span class="header__icon_num">'.$count_favorites.'</span>' : '<span>'.$count_favorites.'</span>';
	}

}



function check_list_favorites_product_id($product_id) {
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$user_meta_favorites_array = get_user_meta( $user_id, 'favorites', true );
		if((empty( $user_meta_favorites_array )) || (!isset($user_meta_favorites_array)) ) {
			return false;
		}
		else {
			if (in_array( $product_id, $user_meta_favorites_array ) ) {
				return true;
			} else {
				return false;
			}
		}
	}
	else {
		// 
		if((empty( $_COOKIE[ 'favorites_product' ])) || (!isset($_COOKIE[ 'favorites_product' ])) ) {
			return false;
		} else {
			$cookie_favorites = $_COOKIE[ 'favorites_product' ];
			$favorites_products = (array) explode( '|', $cookie_favorites);
			if (in_array( $product_id, $favorites_products ) ) {
				return true;
			} else {
				return false;
			}
		}
	}
}



function btn_add_favorites_product_single($product_id) {
	$add_attr = 'data-page="single-product" product_id="'.$product_id.'"';
	echo '<button class="product-slider__like';
	echo (check_list_favorites_product_id($product_id) === true)
		?
			' active"'.$add_attr.'><span>Добавлено<br>в избранное</span>'
		:
			'"'.$add_attr.'><span>Добавить<br>в избранное</span>';

	echo '<svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.1504 2.82183C20.955 1.6546 19.3422 1 17.6616 1C15.9811 1 14.3682 1.6546 13.1729 2.82183L12.4976 3.4736L11.8341 2.82183C10.6388 1.6546 9.02593 1 7.34535 1C5.66478 1 4.05194 1.6546 2.85662 2.82183C1.66772 3.99893 1 5.59399 1 7.25698C1 8.91997 1.66772 10.515 2.85662 11.6921L12.0839 20.8324C12.1942 20.9398 12.3428 21 12.4976 21C12.6525 21 12.8011 20.9398 12.9114 20.8324L22.1504 11.7037C23.3352 10.5222 24 8.9261 24 7.26276C24 5.59943 23.3352 4.00338 22.1504 2.82183Z" fill="white" fill-opacity="0.01" /><path d="M22.9877 2.00401C21.6885 0.720056 19.9356 0 18.109 0C16.2824 0 14.5295 0.720056 13.2303 2.00401L12.4964 2.72097L11.7752 2.00401C10.4761 0.720056 8.72314 0 6.89657 0C5.07 0 3.31706 0.720056 2.01791 2.00401C0.725722 3.29883 0 5.05339 0 6.88268C0 8.71196 0.725722 10.4665 2.01791 11.7613L12.0467 21.8156C12.1666 21.9338 12.3281 22 12.4964 22C12.6647 22 12.8263 21.9338 12.9461 21.8156L22.9877 11.7741C24.2755 10.4744 24.998 8.71871 24.998 6.88904C24.998 5.05937 24.2755 3.30372 22.9877 2.00401V2.00401ZM22.0883 10.8747L12.4964 20.4623L2.90455 10.8747C2.37957 10.3521 1.96341 9.73052 1.68015 9.04604C1.39689 8.36155 1.25215 7.6277 1.25429 6.88692C1.2621 5.39442 1.85875 3.96533 2.91452 2.91036C3.97029 1.85538 5.39982 1.25981 6.89233 1.25312C7.63257 1.25037 8.36596 1.39485 9.04984 1.67816C9.73372 1.96147 10.3544 2.37796 10.8759 2.90338L12.0467 4.07002C12.1055 4.12954 12.1756 4.17679 12.2528 4.20904C12.3299 4.24129 12.4128 4.2579 12.4964 4.2579C12.5801 4.2579 12.6629 4.24129 12.7401 4.20904C12.8173 4.17679 12.8873 4.12954 12.9461 4.07002L14.117 2.90338C15.1821 1.88586 16.6031 1.32557 18.076 1.34238C19.5489 1.3592 20.9568 1.95178 21.9983 2.99336C23.0399 4.03493 23.6325 5.44278 23.6493 6.91569C23.6661 8.38861 23.1058 9.80961 22.0883 10.8747Z" fill="white" /></svg>';
	echo '</button>';
}