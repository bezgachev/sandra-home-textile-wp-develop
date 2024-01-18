<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$product_title = $product->get_name();
echo '<h1 class="title-h1">'.$product_title.'</h1>';