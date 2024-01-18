<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_ajax_policy_action', 'ajax_action_policy' );
add_action( 'wp_ajax_nopriv_policy_action', 'ajax_action_policy' );
function ajax_action_policy() {
	if ( ! wp_verify_nonce( $_POST['nonce'], 'policy-nonce' ) ) {
		echo json_encode(array('message'=>__('POLICY-ERROR')));
		wp_die();
	}

	if ( $_POST['feedback'] === 'accept-policy') {
		echo json_encode(array('message'=>__('POLICY-OK')));

		if ( empty( $_COOKIE[ 'sht_woo_policy' ] ) ) {
			$policy = 'true';
		} else {
			$policy = $_COOKIE[ 'sht_woo_policy' ];
		}
		wc_setcookie( 'sht_woo_policy', $policy, time() + (3600 * 24 * 30) );

	}
	else {
		echo json_encode(array('message'=>__('POLICY-ERROR')));
	}
	wp_die();
}