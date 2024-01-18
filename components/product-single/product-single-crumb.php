<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$product_article = $product->get_sku();

echo '<div><a href="'.$_SERVER['HTTP_REFERER'].'" class="bread-crumb">Вернуться назад</a></div>';
echo (empty($product_article)) ? '' : '<div class="product__crumb_article">Артикул: '.$product_article.'</div>';