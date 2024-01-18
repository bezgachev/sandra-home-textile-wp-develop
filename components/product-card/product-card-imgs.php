<? if (!defined('ABSPATH')) {
    exit;
}

global $product;
$args = get_query_var('params_product_card');
$img_thumb = get_the_post_thumbnail_url($args['product_id'], $args['image_size'], false);
$img_thumb_default = apply_filters('woocommerce_cart_item_thumbnail', $product->get_image($args['image_size']));
$class_item_swiper = 'card-slide swiper-slide';

wrapper_items_slide_product_card_start($args['item_slide_tag'], $class_item_swiper, $args['product_url']);
	if (empty($img_thumb)) echo $img_thumb_default;
	else echo '<img src="' . $img_thumb . '">';
wrapper_items_slide_product_card_end($args['item_slide_tag']);

if ($args['gallerys'] == true) {
    $img_gallerys = $product->get_gallery_image_ids();
    foreach ($img_gallerys as $index_gallery => $img_gallery) {
        if ($index_gallery < 5) {
			wrapper_items_slide_product_card_start($args['item_slide_tag'], $class_item_swiper, $args['product_url']);
                $img_src = wp_get_attachment_image_src($img_gallery, $args['image_size'], false);
                echo '<img data-src="'.$img_src[0].'" src="'.directory_lazy_pixel().'" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
            wrapper_items_slide_product_card_end($args['item_slide_tag']);
        }
    }
}