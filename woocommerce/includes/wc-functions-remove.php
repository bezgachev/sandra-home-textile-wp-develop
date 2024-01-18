<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 ); //удаляем хлебные крошки
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 ); //удаляем что добавлено в корзину
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); //удаляем Представлено № товаров

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); //Удаляем вывод стандартной сортировки

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 ); // удаляем вывод инфо после добавления товара в корзину
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 ); //удаляем показ распродажа

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 ); // удаляем стандартный вывод изоображений товара

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 ); // Удаление артикула и название категории
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); // удаление title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );// удаление rating

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 ); // удаляем цены

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 ); //удаляем атрибуты
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 ); //удаляем описание


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 ); //удаляем похожие товары
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 ); //удаление уведомлений в корзине при добавлении товара
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display'); //отключение вывода кросселов-товаров в корзине
//remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10); //удаление инфы, что корзина пуста

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10); 
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10); //удаляем слова Уже покупали? Нажмите для входа

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

