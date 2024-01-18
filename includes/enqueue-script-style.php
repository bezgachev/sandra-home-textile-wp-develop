<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
function remove_cssjs_ver( $src ) {
    if( strpos($src,'?ver='))
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

add_action( 'wp_enqueue_scripts', 'style_theme' );
function style_theme() {	
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css');
	$main = get_stylesheet_directory() . '/assets/css/style.min.css';
	wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/assets/css/style.min.css?leave=1', null, filemtime($main) );
	$woocommerce = get_stylesheet_directory() . '/assets/css/woocommerce.css';
	wp_enqueue_style( 'woocommerce', get_stylesheet_directory_uri().'/assets/css/woocommerce.css?leave=1', null, filemtime($woocommerce) );
}

add_action( 'wp_enqueue_scripts', 'scripts_theme' );
function scripts_theme() {	
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', false, null, true );
	wp_enqueue_script( 'jquery' );

	$swiper = get_stylesheet_directory() . '/assets/js/swiper.min.js';
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/assets/js/swiper.min.js?leave=1', array('jquery'), filemtime($swiper), true);
	$maskedinput = get_stylesheet_directory() . '/assets/js/maskedinput.js';
	wp_enqueue_script( 'maskedinput', get_template_directory_uri().'/assets/js/maskedinput.js?leave=1', array('jquery'), filemtime($maskedinput), true);
	$main = get_stylesheet_directory() . '/assets/js/script.js';
	wp_enqueue_script( 'main', get_template_directory_uri().'/assets/js/script.js?leave=1', array('jquery'), filemtime($main), true);

	$backend = get_stylesheet_directory() . '/assets/js/backend.js';
	wp_enqueue_script( 'backend', get_template_directory_uri().'/assets/js/backend.js?leave=1', array('wc-price-slider'), filemtime($backend), true);

	if ( is_page(2) || is_page(27)) {
		wp_enqueue_script('map-api', get_template_directory_uri() . '/assets/js/ymaps-api.js', array('jquery'), null, true);
		$map = get_stylesheet_directory() . '/assets/js/ymaps.js';
		wp_enqueue_script( 'map', get_template_directory_uri().'/assets/js/ymaps.js?leave=1', array('jquery'), filemtime($map), true);
	}	

	wp_enqueue_script( 'jquery-form' );
	// Подключаем файл скрипта формы обратной связи и заказа звонка
	$feedback = get_stylesheet_directory() . '/assets/js/feedback.js';
	wp_enqueue_script( 'feedback', get_template_directory_uri().'/assets/js/feedback.js?leave=1', array('jquery'), filemtime($feedback), true);

	// Задаем данные обьекта ajax
	wp_localize_script(
		'feedback',
		'feedback_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'feedback-nonce' ),
		)
	);

	$policy = get_stylesheet_directory() . '/assets/js/policy.js';
	wp_enqueue_script( 'policy', get_template_directory_uri().'/assets/js/policy.js?leave=1', array('jquery'), filemtime($policy), true);

	// Задаем данные обьекта ajax
	wp_localize_script(
		'policy',
		'policy_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'policy-nonce' ),
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_product()) {
			wp_enqueue_script( 'youtube-player-api', 'https://www.youtube.com/player_api', array('jquery'), null, true);
			$video = get_stylesheet_directory() . '/assets/js/video.js';
			wp_enqueue_script( 'video', get_template_directory_uri().'/assets/js/video.js?leave=1', null, filemtime($video), true);
		}
	}
}