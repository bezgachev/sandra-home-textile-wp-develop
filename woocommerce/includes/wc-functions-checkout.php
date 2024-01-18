<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_filter( 'woocommerce_default_address_fields' , 'wpbl_fileds_validation' );
function wpbl_fileds_validation( $array ) {
    
    // Имя
    //unset( $array['first_name']['required']);
    
    // Фамилия
    unset( $array['last_name']['required']);
    
    // Область / район
    unset( $array['state']['required']);
    
    // Почтовый индекс
    unset( $array['postcode']['required']);
    
    // Населённый пункт
    //unset( $array['city']['required']);
    
    // 1-ая строка адреса 
    //unset( $array['address_1']['required']);
    
    // 2-ая строка адреса 
    unset( $array['address_2']['required']);

    
    // Возвращаем обработанный массив
    return $array;
}

//add_filter( 'woocommerce_checkout_fields', 'wpbl_remove_some_fields', 9999 ); 
function wpbl_remove_some_fields( $array ) {
 
    //unset( $array['billing']['billing_first_name'] ); // Имя
    unset( $array['billing']['billing_last_name'] ); // Фамилия
    //unset( $array['billing']['billing_email'] ); // Email
    //unset( $array['order']['order_comments'] ); // Примечание к заказу
 
    //unset( $array['billing']['billing_phone'] ); // Телефон
    unset( $array['billing']['billing_company'] ); // Компания
    //unset( $array['billing']['billing_country'] ); // Страна
    //unset( $array['billing']['billing_address_1'] ); // 1-ая строка адреса 
    unset( $array['billing']['billing_address_2'] ); // 2-ая строка адреса 
    //unset( $array['billing']['billing_city'] ); // Населённый пункт
    unset( $array['billing']['billing_state'] );

	
	//unset( $array['shipping']['shipping_country'] ); // Область / район
    //unset( $array['billing']['billing_postcode'] ); // Почтовый индекс
	unset($array['shipping_city']);
	unset($array['shipping_first_name']);
	unset($array['shipping_last_name']);
	unset($array['shipping_company']);
	unset($array['shipping_address_1']);
	unset($array['shipping_address_2']);
	unset($array['shipping_postcode']);
	unset($array['shipping_country']);
	unset($array['shipping_state']);
    // Возвращаем обработанный массив
    return $array;
}

add_filter( 'woocommerce_checkout_fields', 'wplb_email_first' );
function wplb_email_first( $array ) {
    
    // Меняем приоритет

	$array['billing']['billing_first_name']['priority'] = 10;
	//$array['billing']['billing_first_name']['class'][0] = 'order-form__field';
	$array['billing']['billing_first_name']['label'] = 'ФИО';
	$array['billing']['billing_first_name']['custom_attributes'] = array("minlength" => "5", "maxlength" => "80" );

    //$array['billing']['billing_last_name']['priority'] = 2;
	$array['billing']['billing_email']['priority'] = 20;
	$array['billing']['billing_email']['input_class'][0] = 'light-opacity';
	$array['billing']['billing_email']['label'] = 'E-mail';

	$array['billing']['billing_phone']['priority'] = 30;
	//$array['billing']['billing_phone']['class'][0] = 'order-form__field';
	$array['billing']['billing_phone']['label'] = 'Контактный телефон';
	$array['billing']['billing_phone']['custom_attributes'] = array("inputmode" => "decimal", "minlength" => "11", "maxlength" => "11" );

	$array['billing']['billing_city']['priority'] = 40;
	//$array['billing']['billing_city']['class'][0] = 'order-form__field';
	$array['billing']['billing_city']['label'] = 'Населённый пункт / Город';
	//$array['billing']['billing_city']['input_class'][0] = 'hello';

	$array['billing']['billing_address_1']['priority'] = 50;
	//$array['billing']['billing_address_1']['class'][0] = 'order-form__field';

	$array['billing']['billing_postcode']['priority'] = 60;
	//$array['billing']['billing_postcode']['class'][0] = 'order-form__field';
	$array['billing']['billing_postcode']['label'] = 'Индекс';
	$array['billing']['billing_postcode']['custom_attributes'] = array( "inputmode" => "decimal", "minlength" => "6", "maxlength" => "6" ); 

	//$array['billing']['billing_company']['label'] = 'Название компании / ИП';

	$array['billing']['billing_country']['class'][0] = 'd-hide';
	$array['order']['order_comments']['label'] = 'Комментарий к заказу';


	
    
    // Возвращаем обработанный массив
    return $array;
}





add_filter( 'woocommerce_form_field_password', 'woo_form_field_billing', 10, 4 );
add_filter( 'woocommerce_form_field_text', 'woo_form_field_billing', 10, 4 );
add_filter( 'woocommerce_form_field_email', 'woo_form_field_billing', 10, 4 );
add_filter( 'woocommerce_form_field_tel', 'woo_form_field_billing', 10, 4 );
add_filter( 'woocommerce_form_field_number', 'woo_form_field_billing', 10, 4 );
function woo_form_field_billing( $field, $key, $args, $value ){

    if ( $args['required'] ) {
        //$args['class'][] = '';
        $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
    } else {
        $required = '';
    }

    $args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

    $args['autocomplete'] = ( $args['autocomplete'] ) ? 'autocomplete="' . esc_attr( $args['autocomplete'] ) . '"' : '';

    if ( is_string( $args['label_class'] ) ) {
        $args['label_class'] = array( $args['label_class'] );
    }

    if ( is_null( $value ) ) {
        $value = $args['default'];
    }

    // Custom attribute handling
    $custom_attributes = array();

    // Custom attribute handling
    $custom_attributes = array();

    if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
        foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
            $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
        }
    }

    $field = '';
    $label_id = $args['id'];
    $field_container = '<p class="order-form__field %1$s" id="%2$s">%3$s</p>';

    if ( $args['required'] ) {
		$field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' /><span class="error-mess">Необходимо заполнить ' . $args['label'] . '</span>';
    } else {
		$field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
    }

    if ( ! empty( $field ) ) {

        $field_html = '';
        
        // if ( $args['description'] ) {
        //     $field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
        // }

        if ( $args['label'] && 'checkbox' != $args['type'] ) {
            $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</label>';
        }
		
		$field_html .= $field;

        $container_class = 'form-row ' . esc_attr( implode( ' ', $args['class'] ) );
        $container_id = esc_attr( $args['id'] ) . '_field';

        $after = ! empty( $args['clear'] ) ? '<div class="clear"></div>' : '';

        $field = sprintf( $field_container, $container_class, $container_id, $field_html ) . $after;
    }
    return $field;
}



add_filter( 'woocommerce_form_field_textarea', 'woo_form_field_order', 10, 4 );
function woo_form_field_order( $field, $key, $args, $value ){

    $field = '';
    $label_id = $args['id'];
    $field_container = '<div class="order__textarea" id="%2$s">%3$s</div>';
    $field .= '<textarea type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"></textarea>';

    if ( ! empty( $field ) ) {
        $field_html = '';
        if ( $args['label'] && 'checkbox' != $args['type'] ) {
            $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . '</label>';
        }
		$field_html .= $field;
        $container_class = 'form-row ' . esc_attr( implode( ' ', $args['class'] ) );
        $container_id = esc_attr( $args['id'] ) . '_field';
        $after = ! empty( $args['clear'] ) ? '<div class="clear"></div>' : '';
        $field = sprintf( $field_container, $container_class, $container_id, $field_html ) . $after;
    }
    return $field;
}





//Создание переключателя юр. или физ. лица
add_action( 'woocommerce_after_checkout_billing_form', 'organisation_checkout_field' );
function organisation_checkout_field( $checkout ) {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$user_id_company = get_user_meta( $user_id, 'company', true);
	if ($user_id_company === 'on') {
		$default = 'company';
	} else {$default = 'private_person';}
    woocommerce_form_field( 'organisation', array(
        'type'    => 'radio',
        'class'   => array('d-hide'),
        'label'   =>  '',
		'default' => $default,
	    'options' => array(
			'private_person' => '',
			'company' => ''
		)
        ), $checkout->get_value( 'organisation' ));
}

//Создаем поля, которые нужны при выборе юридического лица:
add_action( 'woocommerce_legal_face', 'my_custom_checkout_field_legal_face' );
function my_custom_checkout_field_legal_face( $checkout ) {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;

    woocommerce_form_field( 'organisation_name', array(
		'required'      => true,
        'type'          => 'text',
        //'class'         => array('my-field-class form-row-wide'),
        'label'   		=>	'Название компании / ИП',
    ), get_user_meta( $user_id, 'organisation_name', true ));
	
	woocommerce_form_field( 'organisation_inn', array(
		'required'      => true,
        'type'          => 'number',
        //'class'         => array('my-field-class form-row-first'),
		'label'			=> 'ИНН',
		'maxlength'			=> '12',
    ), get_user_meta( $user_id, 'organisation_inn', true ));
	
}







//Функция верификации (заполнены ли обязательные поля). Особенностью функции является вывод предупреждения только в случае если выбрано юр. лицо:
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
function my_custom_checkout_field_process() {
	$radioVal = $_POST["organisation"];

	if($radioVal == "company") {
		if ( ! $_POST['organisation_name'] ) wc_add_notice( __( '<strong>Наименование организации</strong> является обязательным полем.' ), 'error' );
		if ( ! $_POST['organisation_inn'] ) wc_add_notice( __( '<strong>ИНН</strong> является обязательным полем.' ), 'error' );	
	}

}


//Обновить ФИО в личном кабинете если пользователь изменил ФИО при оформлении
// add_action( 'woocommerce_checkout_update_user_meta', 'woo_update_save_billing_f_name');
// function woo_update_save_billing_f_name( $user_id ) {

// 	if ( isset( $_POST['billing_first_name'] ) ) {
// 		update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
// 	}

// }

//Функция сохранения полей. Причем данные поля сохраняем не как order meta, а как user meta.
add_action( 'woocommerce_checkout_update_user_meta', 'my_custom_checkout_field_update_order_meta' );
// add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta() {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;


	if ( isset( $_POST['billing_first_name'] ) ) {
		update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	}

	$radioVal = $_POST["organisation"];
	if($radioVal == "company") {
		update_user_meta( $user_id, 'company', 'on' );
	}
	else { 
		//delete_user_meta( $user_id, 'company' );
	}

    if ( ! empty( $_POST['organisation_name'] ) ) { update_user_meta( $user_id, 'organisation_name', sanitize_text_field( $_POST['organisation_name'] ) ); }
    if ( ! empty( $_POST['organisation_inn'] ) ) { update_user_meta( $user_id, 'organisation_inn', sanitize_text_field( $_POST['organisation_inn'] ) ); }

}

//Если необходимо вывести Реквизиты в Личном кабинете во вкладке Адреса
add_action( 'woocommerce_insert_organisation_details', 'organisation_checkout_field_echo_in_order' );

//Выводим поля группы Реквизиты в бланке заказа:
add_action( 'woocommerce_order_details_after_customer_details', 'organisation_checkout_field_echo_in_order' );
function organisation_checkout_field_echo_in_order() {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$user_id_company = get_user_meta( $user_id, 'company', 'on' );
	if($user_id_company) {
		echo '<h2>Реквизиты компании</h2>';
		echo 'Название: '.get_user_meta( $user_id, 'organisation_name', true ).'<br>';
		//echo 'Адрес: '.get_user_meta( $user_id, 'organisation_address', true ).'<br>';
		echo 'ИНН: '.get_user_meta( $user_id, 'organisation_inn', true ).'<br>';
		//echo 'КПП: '.get_user_meta( $user_id, 'organisation_kpp', true ).'<br>';
		//echo 'Расч. счет: '.get_user_meta( $user_id, 'organisation_checking_account', true ).'<br>';
		//echo 'Банк: '.get_user_meta( $user_id, 'organisation_bank', true );	
	}
}

//Вывести реквизиты в адмике (в заказе):
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'organisation_checkout_field_echo_in_admin_order', 10 );
function organisation_checkout_field_echo_in_admin_order($order) {
	//$current_user = wp_get_current_user();
	//$user_id = $current_user->ID;
	$user_id = $order->get_user_id();
	$user_id_company = get_user_meta( $user_id, 'company', 'on' );
	if($user_id_company) {
		//echo '</div></div><div class="clear"></div>';
		echo '<div class="order_data_column_wide">';
		echo '<h3>Реквизиты компании</h3>';
		echo 'Название: '.get_user_meta( $user_id, 'organisation_name', true ).'<br>';
		//echo 'Адрес: '.get_user_meta( $user_id, 'organisation_address', true ).'<br>';
		echo 'ИНН: '.get_user_meta( $user_id, 'organisation_inn', true ).'';
		echo '</div>';
		//echo 'КПП: '.get_user_meta( $user_id, 'organisation_kpp', true ).'<br>';
		//echo 'Расч. счет: '.get_user_meta( $user_id, 'organisation_checking_account', true ).'<br>';
		//echo 'Банк: '.get_user_meta( $user_id, 'organisation_bank', true );
	}
}



function ajax_auth_init(){
    wp_register_script('ajax-auth', get_template_directory_uri() . '/assets/js/register.js', array('jquery'), null, true);	
    wp_enqueue_script('ajax-auth');

    wp_localize_script( 'ajax-auth', 'ajax_auth_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Загрузка. Пожалуйста, подождите...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	// Enable the user with no privileges to run ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
	
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_auth_init');
}



function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
	$email = $_POST['email'];
	$info['user_login'] = $email;
    $info['user_password'] = $_POST['password'];
	$info['remember'] = $_POST['rememberme'];
    $user_signon = wp_signon( $info, false );

	$userdata = get_user_by('login', $info['user_login']);


	if ( is_wp_error($user_signon) ){
		echo json_encode(array('loggedin'=>false, 'message'=>__('Не верный Логин или Пароль')));
		
	}
	else {
		
        // echo json_encode(array('loggedin'=>true, 'success_message'=>__('Успешно! Авторизация...')));
		echo json_encode(array('loggedin'=>true, 'success_message'=>__('Успешно! Авторизация...')));
		auto_login( $userdata );
    }

    // die();
}


function auto_login( $user ) {

    if ( !is_user_logged_in() ) {

        $user_id = $user->data->ID;
        $user_login = $user->data->user_login;

        wp_set_current_user( $user_id, $user_login );
        wp_set_auth_cookie( $user_id );

		update_favorites_product_authorization_user($user_id);
    } 
}


function update_favorites_product_authorization_user($user) {
	$cookie_favorites = $_COOKIE['favorites_product'];
	$cookie_favorites_remove = $_COOKIE['favorites_product_remove'];

	if (!isset($cookie_favorites)) {
		$cookie_favorites = array();
	}
	else {
		$cookie_favorites = (array) explode( '|', $cookie_favorites);
	}

	if (!isset($cookie_favorites_remove)) {
		$cookie_favorites_remove = array();
	}
	else {
		$cookie_favorites_remove = (array) explode( '|', $cookie_favorites_remove);
	}

	// $current_user = wp_get_current_user();
	// $user_id = $current_user->ID;
	// $user_id = $user->data->ID;
	$user_id = $user;

	$user_meta_favorites = get_user_meta( $user_id, 'favorites', true );

	if (empty($user_meta_favorites)) {
		$user_meta_favorites = array();
	}


	$combining_favorites = array_merge($user_meta_favorites, $cookie_favorites);
	$clear_duplicate_favorites = array_unique($combining_favorites);

	$id_remove_products = $cookie_favorites_remove;
	if (!empty($id_remove_products)) {
		foreach ($id_remove_products as $value_id) {
			$remove_id = array_search($value_id, $clear_duplicate_favorites);
			unset($clear_duplicate_favorites[$remove_id]);
		}
	}

	$id_array = $clear_duplicate_favorites;
	foreach ($id_array as $value) {
		// $product_id = $favorites;
		$product_status = get_post_status($value);
		if ($product_status !== 'publish') {
			$remove = array_search($value, $id_array);
			unset($id_array[$remove]);
		}
	}


	update_user_meta( $user_id, 'favorites', $id_array);
	wc_setcookie( 'favorites_product', join( '|', $id_array ), time() + (3600 * 24 * 30) );
	$count_favorites = count($id_array);
	wc_setcookie( 'favorites_product_count', $count_favorites, time() + (3600 * 24 * 30) );


	unset($_COOKIE['favorites_product_remove']);
	wc_setcookie( 'favorites_product_remove', '', time() - (3600 * 24 * 30));
	
	// echo '<pre>';
	// print_r($id_array);
	// echo '</pre>';

	// echo json_encode(array('loggedin'=>true, 'success_message'=>__($id_array)));
	// die();
	// return;
	die();
}

function ajax_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$info = array();
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$user_login = strstr($email, '@', true);
		$email_domen = substr($email, strrpos($email, '@')+1);
		$user_password = $_POST['password'];
		$privacy_policy = $_POST['privacy_policy_cart'];

		if(!empty($user_name)){
			if (preg_match('/[^абвгдеёжзийклмнопрстуфхцчшщъыьэюя\s]+/isu', $user_name)) {
				echo json_encode(array('loggedin'=>false, 'message'=>__('ФИО должно содержать только русские буквы')));
				die();
			}
			if (mb_strlen($user_name) < 5 ) {
				echo json_encode(array('loggedin'=>false, 'message'=>__('Введите полное ФИО')));
				die();
			}
				elseif (mb_strlen($user_name) > 80 ) {
					echo json_encode(array('loggedin'=>false));
					die();
				}
		}
		else {
			echo json_encode(array('loggedin'=>false, 'message'=>__('Заполните ФИО')));
			die();
		}
		if(!empty($email)){
			$valid_email = preg_match('/[^.a-z0-9\-_]+/isu', $user_login);
			$valid_email_domen = preg_match('/[^.a-z0-9\-_]+/isu', $email_domen);
			if ($valid_email || $valid_email_domen) {
				echo json_encode(array('loggedin'=>false, 'message'=>__('Введите корректный E-mail')));
				die();
			}
		}
		else {
			echo json_encode(array('loggedin'=>false, 'message'=>__('Заполните E-mail')));
			die();
		}
		if(!empty($user_password)){
			if (mb_strlen($user_password) < 6 ) {
				echo json_encode(array('loggedin'=>false, 'message'=>__('Введите Пароль не менее 6 символов')));
				die();
			}
		}
		else {
			echo json_encode(array('loggedin'=>false, 'message'=>__('Заполните Пароль')));
			die();
		}
	
		$info['user_email'] = sanitize_email($email);
		$info['nickname'] = sanitize_user($user_login);
		$info['user_login'] = sanitize_user($user_login);
		$info['user_pass'] = sanitize_text_field($user_password);
		$info['first_name'] = sanitize_user($user_name);
		
		//update_user_meta( $user_id, 'billing_first_name', $first_name );
		
		//$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
	
		if ($privacy_policy !== '1') {
			echo json_encode(array('loggedin'=>false, 'message'=>__('Необходимо соглашение на обработку персональных данных')));
			die();
		}
		elseif($privacy_policy == '1') {
		
			// Register the user
			$user_register = wp_insert_user($info);
			
			if ( is_wp_error($user_register) ){
				$error = $user_register->get_error_codes();
		
				if(in_array('empty_user_login', $error)) {
					echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
				}
					
				elseif(in_array('existing_user_login',$error)) {
					echo json_encode(array('loggedin'=>false, 'message'=>__('Пользователь с таким E-mail уже зарегистрирован')));
				}
					
					elseif(in_array('existing_user_email',$error)) {
						echo json_encode(array('loggedin'=>false, 'message'=>__('Пользователь с таким E-mail уже зарегистрирован')));
					}
		
		
		
			} else {
				$info = array();
				update_user_meta( $user_register, 'billing_first_name', sanitize_user($user_name));
				$info['user_login'] = $user_login;
				$info['user_password'] = $_POST['password'];
				$info['remember'] = true;
				wp_signon( $info, false );
				$userdata = get_user_by('login', $info['user_login']);
				echo json_encode(array('loggedin'=>true, 'success_message'=>__('Успешная регистрация. Авторизация...')));
				auto_login($userdata);
				die(); 
			}
			die();
		}
	}
	else {
		die();
	}
}



add_action( 'woocommerce_review_order_after_payment', 'woo_privacy_checkbox');
function woo_privacy_checkbox() {
	$domain_site = get_site_url();
	woocommerce_form_field( 'privacy_policy', array(
	'type' => 'checkbox',
	'label_class' => array('order__pay_checkbox'),
	'required' => true,
	'label' => '<span class="text">Я принимаю условия <a href="'. $domain_site . '/privacy" target="_blank">Пользовательского соглашения</a> и даю согласие на обработку <a href="'. $domain_site . '/privacy" target="_blank">Персональных данных</a>',
	));
}

add_action( 'woocommerce_checkout_process', 'privacy_checkbox_error_message' );
function privacy_checkbox_error_message() {
	if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
		wc_add_notice( __( 'Необходимо соглашение' ), 'error' );
	}

	$client_name = $_POST['billing_first_name'];
	$client_tel = $_POST['billing_phone'];
	$clean_str_tel = mb_eregi_replace('[^0-9]', '', $client_tel);
	if (!$client_name || (preg_match('/[^абвгдеёжзийклмнопрстуфхцчшщъыьэюя\s]+/isu', $client_name))) {
		wc_add_notice( __( '<span class="error_name">error_name</span>' ), 'error' );
	}
	if (mb_strlen($clean_str_tel) < 11 ) {
		wc_add_notice( __( '<span class="error_tel">error_tel</span>' ), 'error' );
	}
}







add_filter( 'woocommerce_form_field_checkbox', 'woo_form_field_checkbox', 10, 4 );
function woo_form_field_checkbox( $field, $key, $args, $value ){

    if ( $args['required'] ) {
        $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr></span><span class="error-mess">Необходимо соглашение</span>';
    } else {
        $required = '';
    }

    $field = '';
    $label_id = $args['id'];
    $field_container = '<p class="privacy_checkbox %1$s" id="%2$s">%3$s</p>';


	$field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" />';
    

    if ( ! empty( $field ) ) {
        $field_html = '';
        
        if ( $args['label'] != $args['type'] ) {
            $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">'. $field . $args['label'] . $required . '</label>';
        }
		

        $container_class = 'form-row ' . esc_attr( implode( ' ', $args['class'] ) );
        $container_id = esc_attr( $args['id'] ) . '_field';

        $after = ! empty( $args['clear'] ) ? '<div class="clear"></div>' : '';

        $field = sprintf( $field_container, $container_class, $container_id, $field_html ) . $after;
    }
    return $field;
}