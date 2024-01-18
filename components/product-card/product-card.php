<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$product_id = $args['product_id'];
$product_url = $args['product_url'];
$wrapper_class = $args['wrapper_class'];
$item_slide_tag = $args['item_slide_tag'];
$gallerys = $args['gallerys'];
$image_size = $args['image_size'];
$location_page = $args['location_page'];

$params_product_card = [
    'product_id' => $product_id,
    'product_url' => $product_url,
    'wrapper_class' => $wrapper_class,
    'item_slide_tag' => $item_slide_tag,
    'gallerys' => $gallerys,
    'image_size' => $image_size,
    'location_page'=> $location_page,
];
set_query_params_product_card($params_product_card);
?>

<div class="<?=$wrapper_class;?>">
    <div class="card__slider swiper-container">
        <?//=$product_id;?>
        <div class="card-container swiper">
            <div class="card-wrapper swiper-wrapper">
                <?get_template_part('components/product-card/product-card', 'imgs');?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="card__control control">
        <?get_template_part('components/product-card/product-card', 'control');?>
	</div>
    <div class="card__descr descr-card">
        <?get_template_part('components/product-card/product-card', 'attributes');?>
    </div>
</div>
