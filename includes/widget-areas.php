<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'widgets_init', 'true_register_wp_sidebars' );
function true_register_wp_sidebars() {
	register_sidebar(
		array(
			'id' => 'true_side', // уникальный id
			'name' => 'Боковая колонка', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
			'after_title' => '</h3>'
		)
	);
}

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;

	wp_add_dashboard_widget('custom_help_widget', 'Поддержка Вашего сайта', 'custom_dashboard_help');
}

function custom_dashboard_help() {
	echo '<p>Добро пожаловать в админ-панель управления Вашим Интернет-магазином.<br>Сайт разработан студией <a href="https://weblitex.ru" target="_blank">ООО "Лайтекс"</a>. Нужна помощь, доработка функционала?<br> Свяжитесь с нами <a href="mailto:info@weblitex.ru">info@weblitex.ru</a></p>';
}