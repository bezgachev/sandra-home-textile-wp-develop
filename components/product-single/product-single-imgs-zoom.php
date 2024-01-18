<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
?>

<div class="modal-img">
	<div class="container">
		<button class="close-button"></button>

		<!-- <div class="popup-img swiper"> -->
			
			<!-- <div class="popup-img__wrapper swiper-wrapper"> -->

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



/*
					global $product;
					$attachment_ids = $product->get_gallery_attachment_ids();
					echo '<div class="popup-img-slide swiper-slide">';	
					$img_src = get_the_post_thumbnail_url( $product->ID, 'woo-large-size-product', false );
					if (empty($img_src)) {
						$thumbnail_tag = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
						preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $thumbnail_tag, $images, PREG_SET_ORDER);
						foreach ($images as $image) {
							echo '<img width="1200" height="1600" src="' . home_url() . $image[1] . '">';
						}
					}
					else {
						echo '<img width="1200" height="1600" data-src="' . esc_url($img_src) . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
					}
					echo '</div>';
					foreach( $attachment_ids as $attachment_id ) {
						echo '<div class="popup-img-slide swiper-slide">';
						$img_src = wp_get_attachment_image_src( $attachment_id, 'woo-large-size-product', false );
						echo '<img width="' . $img_src[1] . '" height="' . $img_src[2] . '" data-src="' . $img_src[0] . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
						echo '</div>';
					}
					*/
				?>


			<!-- </div> -->

			<!-- Cтрелки управления -->
<!-- 			
			<div class="popup-img__nav">
				<div class="popup-btn-prev"></div>

				<div class="popup-pagination"></div>
				<div class="popup-btn-next"></div>
			</div>
			
		</div> -->


	</div>
</div>