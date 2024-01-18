<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
?>

<div class="modal-img">
	<div class="container">
		<button class="close-button"></button>
			<?
				$product_id = get_the_id();
				$product_url = get_the_permalink();
				$params_imgs = [
					'product_id' => $product_id,
					'product_url' => $product_url,
					'slider_type' => 'big',
					'slider_class' => 'popup-img',
					'image_size' => 'woo-large-size-product'
				];
				get_template_part('components/product-single/product-single', 'imgs', $params_imgs);

			?>
	</div>
</div>