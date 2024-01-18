<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Вызывается функция oneclick из JS по клику на .add-to-cart-product-js для добавления динамически товара в корзину
add_action('wp_ajax_oneclick', 'oneclick');
add_action('wp_ajax_nopriv_oneclick', 'oneclick');
function oneclick() {
	$product_id = $_POST['product_id'];
	$variation_id = $_POST['variation_id'];
	$quantity = $_POST['quantity'];
	if ($variation_id) {
	  WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
	} else {
	  WC()->cart->add_to_cart( $product_id, $quantity);
	}
	$items = WC()->cart->get_cart();
	global $woocommerce;
	$woocommerce->cart->cart_contents_count;
	$cart_count = WC()->cart->get_cart_contents_count();
	echo json_encode(array('count_basket'=>__($cart_count)));
	die();
}




//ОТПРАВКА ПОЧТЫ
add_action( 'wp_ajax_feedback_action', 'ajax_action_callback' );
add_action( 'wp_ajax_nopriv_feedback_action', 'ajax_action_callback' );
function ajax_action_callback() {
	$clean_str_tel = mb_eregi_replace('[^0-9]', '', $_POST['form-tel']);
	// Массив ошибок
	$err_message = array();

	if ( ! wp_verify_nonce( $_POST['nonce'], 'feedback-nonce' ) ) {
		wp_die();
	}


	if ( $_POST['feedback'] == 'call') {

		if ($_POST['form-checkbox'] !== '1') {
			$err_message['checkbox'] = '';
		}

		if ( empty( $_POST['form-name'] ) || ! isset( $_POST['form-name'] ) ) {
			$err_message['name'] = '';
		} else {
			$name = sanitize_text_field( $_POST['form-name'] );
		}

		if ( empty( $_POST['form-tel'] ) || ! isset( $_POST['form-tel'] ) ) {
			$err_message['tel'] = '';
		} elseif (mb_strlen($clean_str_tel) !== 11 ) {
			$err_message['tel'] = '';
		} else {
			$tel = sanitize_text_field( $_POST['form-tel'] );
		}

		
		if (!empty( $_POST['form-email'] )) {
			if ( ! preg_match( '/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $_POST['form-email'] ) ) {
				$err_message['email'] = '';
			}
			else {
				$email = sanitize_email( $_POST['form-email'] );
			}
		}

	}
	else if ( $_POST['feedback'] == 'feedback') {

		if ($_POST['form-checkbox'] !== '1') {
			$err_message['checkbox'] = '';
		}


		if ( empty( $_POST['form-name'] ) || ! isset( $_POST['form-name'] ) ) {
			$err_message['name'] = '';
		} else {
			$name = sanitize_text_field( $_POST['form-name'] );
		}


		if ( empty( $_POST['form-email'] ) || ! isset( $_POST['form-email'] ) ) {
			$err_message['email'] = '';
		} elseif ( ! preg_match( '/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $_POST['form-email'] ) ) {
			$err_message['email'] = '';
		} else {
			$email = sanitize_email( $_POST['form-email'] );
		}
		

		if ( empty( $_POST['form-textarea'] ) || ! isset( $_POST['form-textarea'] ) ) {
			$err_message['textarea'] = '';
		} else {
			$textarea = sanitize_text_field( $_POST['form-textarea'] );
		}


		

	}

	else if ( $_POST['feedback'] == 'account-help') {

		$tel = sanitize_text_field( $_POST['form-tel'] );
		$number_order = sanitize_text_field( $_POST['form-number-order'] );

		if ( empty( $_POST['form-name'] ) || ! isset( $_POST['form-name'] ) ) {
			$err_message['name'] = '';
		} else {
			$name = sanitize_text_field( $_POST['form-name'] );
		}




		if ( empty( $_POST['form-email'] ) || ! isset( $_POST['form-email'] ) ) {
			$err_message['email'] = '';
		} elseif ( ! preg_match( '/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $_POST['form-email'] ) ) {
			$err_message['email'] = '';
		} else {
			$email = sanitize_email( $_POST['form-email'] );
		}


		if ( empty( $_POST['form-question'] ) || ! isset( $_POST['form-question'] ) ) {
			$err_message['question'] = '';
		} else {
			$question = sanitize_text_field( $_POST['form-question'] );
		}


		if ( empty( $_POST['form-textarea'] ) || ! isset( $_POST['form-textarea'] ) ) {
			$err_message['textarea'] = '';
		} else {
			$textarea = sanitize_text_field( $_POST['form-textarea'] );
		}


	}
	else if ( $_POST['feedback'] == 'cancel-order') {
		$number_order = sanitize_text_field( $_POST['form-number-order'] );
		
		$name = sanitize_text_field( $_POST['form-name'] );
		$email = sanitize_email( $_POST['form-email'] );
		$tel = sanitize_text_field( $_POST['form-tel'] );

		if ( empty( $_POST['form-motive'] ) || ! isset( $_POST['form-motive'] ) ) {
			$err_message['motive'] = '';
		} else {
			$motive = sanitize_text_field( $_POST['form-motive'] );
		}

	}


	if ( $err_message ) {
		wp_send_json_error( $err_message );
	} else {

		$email_to = get_option('admin_email');
		$art_subject = 'Сообщение с сайта ' . get_bloginfo('name') .'';
		$website_addr = get_site_url();
		$company_name = get_bloginfo('name');
		

		if (!empty($motive)) {
			$motive_block = '<tr style="background-color: #f8f8f8;">
			<td style="padding: 10px; border: #e9e9e9 1px solid;"><b>Причина:</b></td>
			<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $motive . '</td>
		</tr>';
		}

		if (!empty($tel)) {
			$tel_block = '<tr style="background-color: #f8f8f8;">
			<td style="padding: 10px; border: #e9e9e9 1px solid;"><b>Телефон:</b></td>
			<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $tel . '</td>
		</tr>';
		}
		if (!empty($email)) {
			$email_block = '<tr style="background-color: #f8f8f8;">
			<td style="padding: 10px; border: #e9e9e9 1px solid;"><b>E-mail:</b></td>
			<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $email . '</td>
		</tr>';
		}
		if (!empty($textarea)) {
			$textarea_block = '<tr style="background-color: #f8f8f8;">
			<td style="padding: 10px; border: #e9e9e9 1px solid;"><b>Сообщение:</b></td>
			<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $textarea . '</td>
		</tr>';
		}


		if (!empty($question)) {
			$question_block = '<tr style="background-color: #f8f8f8;">
			<td style="padding: 10px; border: #e9e9e9 1px solid;"><b>Тема письма:</b></td>
			<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $question . '</td>
		</tr>';
		}

		if (!empty($number_order)) {
			$number_order_block = '<tr style="background-color: #f8f8f8;">
			<td style="padding: 10px; border: #e9e9e9 1px solid;"><b>Номер заказа:</b></td>
			<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $number_order . '</td>
		</tr>';
		}





		if ( $_POST['feedback'] == 'call') {
			$feedback_type = 'Поступило сообщение на обратный звонок';
		}
		else if ( $_POST['feedback'] == 'feedback') {
			$feedback_type = 'Поступило сообщение на обратную связь';
		}
		else if ( $_POST['feedback'] == 'account-help') {
			$feedback_type = 'Поступило сообщение на обратную связь помощи с Личного кабинета';
		}
		else if ( $_POST['feedback'] == 'cancel-order') {
			$feedback_type = 'Клиент не оплатил заказ и с Личного кабинета его отменил';
		}


		$message = '
			' . $feedback_type . ' с сайта <a href="' . $website_addr . '">' . $company_name . '</a>.<br><br>
			<table>
				<tr style="background-color: #f8f8f8;">
					<td style="padding: 10px; border: #e9e9e9 1px solid;"><b>Имя:</b></td>
					<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $name . '</td>
				</tr>
				' . $tel_block . '
				' . $email_block . '
				' . $question_block . '
				' . $number_order_block . '
				' . $textarea_block . '
				' . $motive_block . '
				
			</table>
		';

		$body = $message;
		$headers = 'From: ' . get_bloginfo('name') . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;

		// Отправляем письмо
		$sent_message = wp_mail($email_to, $art_subject, $body, $headers );
  
		if ($sent_message ) {
			echo json_encode(array('message'=>__('OK')));
		} else {
			echo json_encode(array('message'=>__('ERROR')));
		}
	}

	die();

}


$enabled_mail_smtp = get_option('enabled_mail_smtp');
if ($enabled_mail_smtp == '1') {
	add_action( 'phpmailer_init', 'my_phpmailer_example' );
	function my_phpmailer_example( $phpmailer ) {
		$phpmailer->isSMTP();
		$phpmailer->Host = get_option('mail_custom_SMTP_HOST');
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = get_option('mail_custom_SMTP_PORT');
		$phpmailer->Username = get_option('admin_email');
		$phpmailer->Password = get_option('mail_custom_SMTP_PASS');
		$phpmailer->SMTPSecure = get_option('mail_custom_SMTP_SECURE');
	}
}

add_filter( 'wp_mail_content_type', 'true_content_type' );
function true_content_type( $content_type ) {
	return 'text/html';
}


//создаем куки, записываем данные ID избранных товаров
add_action('wp_ajax_likelist', 'likelist');
add_action('wp_ajax_nopriv_likelist', 'likelist');
function likelist() {
	$post_product_id = $_POST['product_id'];
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;

		$user_meta_favorites_array = get_user_meta( $user_id, 'favorites', true );
		if (empty($user_meta_favorites_array)) {
			$user_meta_favorites_array = array();
		}

		$id_array = $user_meta_favorites_array;

		if ( ! in_array( $post_product_id, $id_array ) ) {
			$id_array[] = $post_product_id;
		} else {
			$remove_id = array_search($post_product_id, $id_array);
			unset($id_array[$remove_id]);
			
		}
		foreach ($id_array as $value_id) {
			$product_status = get_post_status($value_id);
			if ($product_status !== 'publish') {
				$remove = array_search($value_id, $id_array);
				unset($id_array[$remove]);
			}
		}

		$clear_duplicate_favorites = array_unique($id_array);
		$id_array = $clear_duplicate_favorites;

		update_user_meta( $user_id, 'favorites', $id_array);
		wc_setcookie( 'favorites_product', join( '|', $id_array ), time() + (3600 * 24 * 30) );
		$count_favorites = count($id_array);
		wc_setcookie( 'favorites_product_count', $count_favorites, time() + (3600 * 24 * 30) );
		echo json_encode(array('count_likelist'=>__($count_favorites)));
	}
	else {
		$cookie_favorites = $_COOKIE['favorites_product'];
		$cookie_favorites_remove = $_COOKIE['favorites_product_remove'];
		if (empty($cookie_favorites)) {
			$cookie_favorites = array();
		}else {
			$cookie_favorites = (array) explode( '|', $cookie_favorites);
		}

		if (empty($cookie_favorites_remove)) {
			$cookie_favorites_remove = array();
		}else {
			$cookie_favorites_remove = (array) explode( '|', $cookie_favorites_remove);
		}
		if (!in_array( $post_product_id, $cookie_favorites ) ) {
			$cookie_favorites[] = $post_product_id;
			if (in_array( $post_product_id, $cookie_favorites_remove ) ) {
				$remove_id = array_search($post_product_id, $cookie_favorites_remove);
				unset($cookie_favorites_remove[$remove_id]);
			}
		} else {
			$remove_id = array_search($post_product_id, $cookie_favorites);
			unset($cookie_favorites[$remove_id]);
			if (!in_array( $post_product_id, $cookie_favorites_remove ) ) {
				$cookie_favorites_remove[] = $post_product_id;
			}
		}

		wc_setcookie( 'favorites_product', join( '|', $cookie_favorites ), time() + (3600 * 24 * 30) );
		wc_setcookie( 'favorites_product_remove', join( '|', $cookie_favorites_remove ), time() + (3600 * 24 * 30) );
		$count_favorites = count($cookie_favorites);
		wc_setcookie( 'favorites_product_count', $count_favorites, time() + (3600 * 24 * 30) );
		echo json_encode(array('count_likelist'=>__($count_favorites)));
	}




	// $product_id_like = $_POST['product_id'];


	// if ( ! in_array( $product_id_like, $like_products ) ) {
	// 	$like_products[] = $product_id_like;
	// } else {
	// 	$remove_id = array_search($product_id_like, $like_products);
	// 	unset($like_products[$remove_id]);
	// }
	// wc_setcookie( 'sht_woo_likelist_product', join( '|', $like_products ), time() + (3600 * 24 * 7) );
	// $count_likelist = count($like_products);




	// if ( empty( $_COOKIE[ 'sht_woo_likelist_count' ] ) ) {
	// 	$likelist_count = array();
	// } else {
	// 	$likelist_count = $_COOKIE[ 'sht_woo_likelist_count' ];
	// }
	// $likelist_count = $count_likelist;
	// wc_setcookie( 'sht_woo_likelist_count', $likelist_count, time() + (3600 * 24 * 7) );


	// echo json_encode(array('count_likelist'=>__($count_likelist)));


	die();
}
