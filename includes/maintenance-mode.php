<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Режим технического обслуживания
$enabled_maintenance_mode = get_option('enabled_maintenance_mode');
if ($enabled_maintenance_mode === '1') {
	add_action('get_header', 'wp_maintenance_mode_on');
	function wp_maintenance_mode_on(){
		if(!current_user_can('administrator')){
			$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			$url = ''.home_url().'/';
			if ($current_url === $url.'?mode=maintenance') {
				require(WP_CONTENT_DIR. '/maintenance.php');
			exit();
			}
			else if ($current_url !== $url) {
				wp_redirect($url);
			exit();
			}
			else {
				$newval = 'maintenance';
				if(!count($_GET) ) {
				header('Location: ?mode=' . $newval);
				}
				if(!isset($_GET['mode'])) {
					$current_url .= '&mode='.$newval;
				}
				$_GET['mode'] = $newval;
				require(WP_CONTENT_DIR. '/maintenance.php');
			exit();
			}
		}
	}
	add_action('wp_dashboard_setup', 'maintenance_mode_widgets');
	function maintenance_mode_widgets() {
		global $wp_meta_boxes;
	
		wp_add_dashboard_widget('maintenance_mode_widget', 'Режим обслуживания включён', 'custom_dashboard_maintenance_mode_widgets');
	}
	function custom_dashboard_maintenance_mode_widgets() {
		echo '<span style="color:red;font-size:14px;font-weight:500;">Внимание!</span><p style="margin-top:5px;">На Вашем сайте включён режим технического обслуживания. Это означает, что <b>пользователям не доступен Ваш сайт</b>.</p><p><a href="/wp-admin/customize.php">Чтобы отключить</a>:<br>Внешний вид - Настроить - Техническое обслуживание</p>';
	}
}
else {
	add_action('get_header', 'wp_maintenance_mode_off');
	function wp_maintenance_mode_off(){
		$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$url = ''.home_url().'/';
		if ($current_url === $url.'?mode=maintenance') {
			wp_redirect($url);
		}
	}
}