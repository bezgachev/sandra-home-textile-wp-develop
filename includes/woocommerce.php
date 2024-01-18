<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WooCommerce' ) ) {
    add_action( 'after_setup_theme', 'wc_weblitex_setup' );
	function wc_weblitex_setup() {
		add_theme_support( 'woocommerce' );
	}
    get_template_part('woocommerce/includes/wc-ajax');
    get_template_part('woocommerce/includes/wc-fragments');
    get_template_part('woocommerce/includes/wc-customizer');
    get_template_part('woocommerce/includes/wc-add-function');
    
    get_template_part('woocommerce/includes/wc-functions-remove');
    get_template_part('woocommerce/includes/wc-function-archive');
    get_template_part('woocommerce/includes/wc-functions-single');
    get_template_part('woocommerce/includes/wc-functions-cart');
    get_template_part('woocommerce/includes/wc-functions-checkout');
    get_template_part('woocommerce/includes/wc-functions-account');
    get_template_part('woocommerce/includes/wc-functions');
    get_template_part('woocommerce/includes/wc-optimization');
}

//Когда активирован плагин WooCommerce подключаем стили WooCommerce + Поддержка для WooCommerce. ЭТО ОБЯЗАТЕЛЬНО
// if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
// 	function mytheme_add_woocommerce_support() {
// 		add_theme_support( 'woocommerce' );
// 	}
// 	add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// }