<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter('show_admin_bar', '__return_false');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

//Функция просмотра подпунктов меню
// function remove_submenus() {
// 	global $submenu;
// 	echo '<pre style="margin-left:200px;">';
// 	var_dump($submenu);
// 	echo '</pre>';
//   }
//   add_action('admin_menu', 'remove_submenus');