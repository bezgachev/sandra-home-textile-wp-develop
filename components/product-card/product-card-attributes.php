<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$args = get_query_var('params_product_card');
$id = $args['product_id'];
//$attribute_sizes = array( 6, 7, 8, 9, 10);
$attribute_sizes = array( 'razmer-pokryvala', 'razmer-pledy', 'razmer-shtory', 'razmer-chehly-dlya-mebeli', 'razmer-postelnoe-belyo' );
$material = $product->get_attribute('material');
$color = $product->get_attribute('czvet');
$price = get_post_meta( $id, '_regular_price', true); // основная цена товара
$sale = get_post_meta( $id, '_sale_price', true); 	//цена со скидкой
$price_space = number_format((int)$price, 0, '', '&nbsp;');
$sale_space = number_format((int)$sale, 0, '', '&nbsp;');
// $product_id = $args['product_id'];
// $product_url = $args['product_url'];

// 'product_id' => $product_id,
// 'product_url' => $product_url,
// 'wrapper_class' => $wrapper_class,
// 'swiper_container' => $swiper_container,
// 'gallerys' => $gallerys,
// 'image_size' => $image_size

?>

<a class="descr-card__title" href="<?=$args['product_url']?>"><?=get_the_title($id);?></a>
<div class="descr-card__subtitle">
    <?
        foreach ( $attribute_sizes as $attribute_size ) {
            $razmer = $product->get_attribute( $attribute_size );
            if (!empty($razmer)) {
                echo $razmer . ', ';
            }
        }
        if (!empty($material)) {
            echo $material . ', ';
        } if (!empty($color)) {
            echo $color;
        }
    ?>
</div>
<div class="descr-card__priсe">
    <? if (!empty($sale)){ ?> <!-- если нет цены со скидкой выводим основную цену -->
        <div class="descr-card__priсe_normal nowrap">
            <? echo ''. $sale_space .'&nbsp;₽'; ?>
        </div>
        <div class="descr-card__priсe_dash nowrap dash">
            <? echo ''. $price_space .'&nbsp;₽'; ?>
        </div><?
    } else { ?> <!-- иначе, если есть цена со скидкой выводим все виды цен -->
        <div class="descr-card__priсe_normal nowrap">
            <? echo ''. $price_space .'&nbsp;₽'; ?>
        </div><?
    }?>
</div>
<div class="descr-card__cart add-to-cart-product-js"></div>
   