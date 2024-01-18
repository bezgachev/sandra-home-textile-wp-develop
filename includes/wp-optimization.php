<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Добавляем в DOM дереве в тег id.main-js атрибут data-dir путь сайта директории темы для использования в JS в дальнейшем
add_filter( 'script_loader_tag', 'dataUrlDirectory', 10, 2 );
function dataUrlDirectory( $tag, $handle ) {
    if ( 'main' !== $handle ) {
        return $tag;
    }
	$dataUrlDirectory = get_template_directory_uri();
    return str_replace( 'id', 'data-dir="'.$dataUrlDirectory.'"id', $tag );
}




//Удаляем уведомление об обновлении WordPress для всех кроме админа
add_action( 'admin_head', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		remove_action( 'admin_notices', 'update_nag', 3 );
		remove_action( 'admin_notices', 'maintenance_nag', 10 );
	}
} );


//удаляем мета-тег версии движка с DOM дерева
add_filter('the_generator', 'remove_wpversion');
function remove_wpversion() {
	return '';
}


//удаление ненужных текстов в DOM дереве(type для css)
add_filter('style_loader_tag', 'clean_style_tag');
function clean_style_tag($src) {
    return str_replace("type='text/css'", '', $src);
}

// //удаление ненужных текстов в DOM дереве(type для js)
add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($src) {
    return str_replace("type='text/javascript'", '', $src);
}


//Удалить ссылки на RSS ленты
function fb_disable_feed(){wp_redirect(get_option('siteurl'));}
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
add_action( 'do_feed', 'fb_disable_feed', 1 );
add_action( 'do_feed_rdf', 'fb_disable_feed', 1 );
add_action( 'do_feed_rss', 'fb_disable_feed', 1 );
add_action( 'do_feed_rss2', 'fb_disable_feed', 1 );
add_action( 'do_feed_atom', 'fb_disable_feed', 1 );


// //Отключить REST API
// add_filter( 'rest_enabled', '__return_false' );
// remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
// remove_action( 'template_redirect', 'rest_output_link_header', 11);
// remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
// remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
//remove_action( 'init', 'rest_api_init' );
//remove_action( 'rest_api_init', 'rest_api_default_filters', 10 );
// remove_action( 'parse_request', 'rest_api_loaded' );
// remove_action( 'rest_api_init', 'wp_oembed_register_route' );
// remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10 );

// //Отключаем Emoji
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

//Отменяем srcset
add_filter('wp_calculate_image_srcset_meta', '__return_null' );
add_filter('wp_calculate_image_sizes', '__return_false', 99 );
remove_filter('the_content', 'wp_make_content_images_responsive' );

//Отключаем Gutenberg
add_filter('use_block_editor_for_post_type', '__return_false', 100);
add_action('admin_init', function() {
    remove_action('admin_notices', ['WP_Privacy_Policy_Content', 'notice']);
    add_action('edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice']); 
});
function gut_style_disable() { wp_dequeue_style('wp-block-library'); }
add_action('wp_enqueue_scripts', 'gut_style_disable', 100);


//Отключение XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

//Отключение dns-prefetch
remove_action( 'wp_head', 'wp_resource_hints', 2 );

//Отключение rel shortlink
remove_action( 'wp_head', 'wp_shortlink_wp_head' );


add_action('wp_footer','wooexperts_remove_block_data',0);
add_action('admin_enqueue_scripts','wooexperts_remove_block_data',0);
function wooexperts_remove_block_data(){ 
    remove_filter('wp_print_footer_scripts',array('Automattic\WooCommerce\Blocks\Assets','print_script_block_data'),1);
    remove_filter('admin_print_footer_scripts',array('Automattic\WooCommerce\Blocks\Assets','print_script_block_data'),1);
}


//Скрываем пункты меню в админке
add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu()
{
  //remove_menu_page('options-general.php'); // Настройки
  //remove_menu_page('tools.php'); // Инструменты
  //remove_menu_page('users.php'); // Пользователи
  //remove_menu_page('plugins.php'); // Плагины
  //remove_menu_page('themes.php'); // Внешний вид
  remove_menu_page('edit.php'); // Записи
  //remove_menu_page('upload.php'); // Медиафайлы
  //remove_menu_page('edit.php?post_type=page'); // Страницы
  remove_menu_page('edit-comments.php'); // Комментарии
  remove_menu_page('marketing'); // Комментарии
  //remove_submenu_page("edit.php", "edit-tags.php?taxonomy=post_tag");
  //remove_submenu_page($menu_slug, $submenu_slug);
  //remove_submenu_page('options-discussion.php');
  //remove_submenu_page("edit.php", " edit-tags.php?taxonomy=product_tag&post_type=product");
 
  //remove_menu_page('index.php'); // Консоль
}


add_filter(
    'document_title_parts',
    function($parts) {
        if (isset($parts['tagline'])) unset($parts['tagline']);
        return $parts;
    }
);


//Отключение визуального редактора
//add_filter( 'user_can_richedit', '__return_false' );

//Footer в админке
add_filter('admin_footer_text', 'remove_footer_admin');
function remove_footer_admin () {
	echo 'Разработка Интернет-магазинов <a href="https://weblitex.ru" target="_blank">ООО "Лайтекс"</a> | E-mail: <a href="mailto:info@weblitex.ru">info@weblitex.ru</a> | Сайт разработан на основе WordPress.</p>';

    // <style>
	// #dropdown_product_type {display:none !important;}
	// select[name="stock_status"]{display:none !important;}
	// .postbox-header .hndle.ui-sortable-handle .type_box.hidden {display:none !important;}
	// .postbox-header .hndle.ui-sortable-handle .product-type{display:none !important;}
	// #postdivrich #wp-content-media-buttons{display:none !important;}
	// #woocommerce-fields.inline-edit-col .dimension_fields, #woocommerce-fields.inline-edit-col .inline-edit-group, #woocommerce-fields.inline-edit-col .stock_status_field, .inline-edit-tags-wrap, .inline-edit-group.wp-clearfix, #woocommerce-fields.inline-edit-col .text:nth-child(3) {display:none !important;}
	// .term-description-wrap, #linked_product_data .options_group p.form-field:nth-child(2), #postexcerpt .inside #wp-excerpt-editor-tools, #postexcerpt .inside #qt_excerpt_toolbar { display: none !important; }
	// #mceu_86 {display: none !important; }
	// #order_data .order_data_column_container .order_data_column:nth-child(3) .edit_address,
	// #order_data .order_data_column_container .order_data_column:nth-child(3) .address p:nth-child(1),
	// #order_data .order_data_column_container .order_data_column:nth-child(3) h3 {display: none !important; }
	// #order_data .order_data_column_container .order_data_column:nth-child(3) .order_data_column_wide h3 {display:block !important; }
	// #order_data .order_data_column_container .order_data_column:nth-child(2) .edit_address ._billing_last_name_field,
	// #order_data .order_data_column_container .order_data_column:nth-child(2) .edit_address ._billing_company_field,
	// #order_data .order_data_column_container .order_data_column:nth-child(2) .edit_address ._billing_address_2_field,
	// #order_data .order_data_column_container .order_data_column:nth-child(2) .edit_address ._billing_state_field {display: none !important; }
	// </style>
	// <script type="text/javascript">
	// var dataClient;
	// dataClient = document.querySelectorAll("#order_data > div.order_data_column_container > div.order_data_column:nth-child(2) > h3");
	// for (var i = 0; i < dataClient.length; i++) {
	// 	dataClient[i].outerHTML = "<h3>Данные клиента<a href=\"#\" class=\"edit_address\">Изменить</a></h3>";
	// }
	// </script>
}