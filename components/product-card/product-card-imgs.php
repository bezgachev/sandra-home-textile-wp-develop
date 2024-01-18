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

//echo '</div>';
// if (empty($img_thumb)) {
//     $img_thumb_default_tag = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image($image_size));
//     preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $img_thumb_default_tag, $img_thumb_defaults, PREG_SET_ORDER);
//     foreach ($img_thumb_defaults as $img_thumb_default) {
//         //echo $img_thumb_default[1];
//         echo '<img data-src="' . home_url() . $img_thumb_default[1] . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
//     }
// }
// else {
//     echo '<img data-src="' . esc_url($img_thumb) . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
// }