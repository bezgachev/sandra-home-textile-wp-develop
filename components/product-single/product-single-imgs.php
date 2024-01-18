<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$slider_class = $args['slider_class'];
$slider_type = $args['slider_type'];
$video_id = $product->get_meta( '_text_field_videoid', true );

$img_thumb = get_the_post_thumbnail_url($args['product_id'], $args['image_size'], false);
$img_thumb_default_tag = apply_filters('woocommerce_cart_item_thumbnail', $product->get_image($args['image_size']));
$img_gallerys = $product->get_gallery_image_ids();

preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $img_thumb_default_tag, $img_thumb_defaults, PREG_SET_ORDER);
foreach ($img_thumb_defaults as $src_image_defaults) {
    $img_thumb_default = $src_image_defaults[1];
}

echo '<div class="'.$slider_class.' swiper">';

    echo ($slider_type === 'standart') ? btn_add_favorites_product_single($args['product_id']) : '';

    echo '<div class="'.$slider_class.'__wrapper swiper-wrapper">';

            if (empty($img_thumb)) $url_img = $img_thumb_default;
            else $url_img = $img_thumb;
            $img_html = '<img src="'.directory_lazy_pixel().'" data-src="'.$url_img.'" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';

            if ($video_id) {
                $video_id_modified = $video_id;
                for ($i = 0; $i < 2; $i++) {
                    wrapper_items_slide_product_single_start($slider_type, $slider_class, $video_id_modified);
                        if ($slider_type === 'standart') {
                            if ($i === 0) {
                                card_video($video_id, $url_img, $slider_type);
                            }
                            else {
                                echo $img_html;
                            }
                        }
                        else {
                            echo $img_html;
                        }
                    wrapper_items_slide_product_single_end($slider_type);
                    $video_id_modified = null;
                }
            }
            else {
                wrapper_items_slide_product_single_start($slider_type, $slider_class, null);
                    echo $img_html;
                wrapper_items_slide_product_single_end($slider_type);
            }


            foreach ($img_gallerys as $index_gallery => $img_gallery) {
                wrapper_items_slide_product_single_start($slider_type, $slider_class, null);
                    $img_src = wp_get_attachment_image_src($img_gallery, $args['image_size'], false);
                    echo '<img data-src="' . $img_src[0] . '" src="'.directory_lazy_pixel().'" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
                wrapper_items_slide_product_single_end($slider_type);
            }

            if ($slider_type === 'big') {
                if ($video_id) {
                    wrapper_items_slide_product_single_start($slider_type, $slider_class, $video_id);
                        card_video($video_id, $url_img, $slider_type);
                    wrapper_items_slide_product_single_end($slider_type);
                }
            }

    echo '</div>';
    echo ($slider_type === 'big') ? btn_navigations_slider_big_product_single() : '';
echo '</div>';