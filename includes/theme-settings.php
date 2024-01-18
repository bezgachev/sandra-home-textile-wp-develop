<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'wp_weblitex_setup' );
function wp_weblitex_setup() {
	add_theme_support(
	'custom-logo',
	array(
		'width'       => 210,
		'height'      => 70,
		'flex-width'  => true,
		'flex-height' => true,
	));
	add_image_size( 'woo-thumbnail-product', 300, 400, true );
	add_image_size( 'woo-page-product', 600, 800, true );
	add_image_size( 'woo-large-size-product', 1200, 1600, true );
	add_image_size( 'woo-mini-catalog', 600, 800, true );
	add_theme_support( 'title-tag' );
}