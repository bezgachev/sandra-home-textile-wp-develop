<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$product_attributes = $product->get_attributes();
if (!$product_attributes) {
	return;
}
?>

<div class="product-descr__specifications">
	<h3 class="title-h3">Характеристики:</h3>
	<div class="specifications">
        <?wc_display_product_attributes( $product );
		?>
	</div>
</div>
