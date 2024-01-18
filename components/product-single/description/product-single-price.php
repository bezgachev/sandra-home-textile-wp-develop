<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$product_price = get_post_meta( get_the_ID(), '_regular_price', true); // основная цена товара
$product_sale = get_post_meta( get_the_ID(), '_sale_price', true); //цена со скидкой
$product_price_space = number_format((int)$product_price, 0, '', ' ');
$product_sale_space = number_format((int)$product_sale, 0, '', ' ');
?>
<div class="product-descr__price">
	<? if (!empty($product_sale)){ ?>
		<span class="product-descr__price_main">
			<? echo $product_sale_space; ?>&nbsp;₽
		</span>
		<span class="product-descr__price_dash dash">
			<? echo $product_price_space; ?>&nbsp;₽
		</span><?
	} else { ?>
		<span class="product-descr__price_main">
			<? echo $product_price_space; ?>&nbsp;₽
		</span><?
	}?>
</div>