<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$product_id = get_the_id();
$product_url = get_the_permalink();
?>
<div class="product__body_slider">
	<div class="product-slider">
		<div class="product-slider__wrapper-vertical">
			<div class="button-mini-prev"></div>
			<div class="button-mini-next"></div>
			<?
			$params_imgs = [
				'product_id' => $product_id,
				'product_url' => $product_url,
				'slider_type' => 'mini',
				'slider_class' => 'image-mini-slider',
				'image_size' => 'woo-thumbnail-product'		
			];
			get_template_part('components/product-single/product-single', 'imgs', $params_imgs);?>
		</div>

		<div class="product-slider__wrapper">
			<?
			$params_imgs = [
				'product_id' => $product_id,
				'product_url' => $product_url,
				'slider_type' => 'standart',
				'slider_class' => 'image-slider',
				'image_size' => 'woo-page-product'		
			];
			get_template_part('components/product-single/product-single', 'imgs', $params_imgs);?>
		</div>
	</div>
	<div class="product-slider__nav">
		<div class="button-prev"></div>
		<div class="number-pagination"></div>
		<div class="button-next"></div>
	</div>
</div>