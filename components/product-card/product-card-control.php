<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$args = get_query_var('params_product_card');
$location_page = $args['location_page'];
$add_attr = ($location_page === 'favorites') ? 'data-page="likelist"' : '';

echo '<div class="card__control_like';
	echo (check_list_favorites_product_id($args['product_id']) === true)
		?
			' active" '.$add_attr.'>'
		:
			'" '.$add_attr.'>';
echo '</div>';
?>
<div class="card__control_hover control__hover">
    <span class="control__hover_asset">в наличии</span>
    <?
    echo '<div class="control__hover_like';
	echo (check_list_favorites_product_id($args['product_id']) === true)
		?
			' active" '.$add_attr.'>Добавлено в избранное</div>'
		:
			'" '.$add_attr.'>Добавить в избранное</div>';
    ?>
    <input type="hidden" name="product_id" value="<?=$args['product_id'];?>">
    <input type="hidden" name="quantity" value="1">
    <div class="control__hover_btn add-to-cart-product-js"></div>
    <a class="control__hover_link" href="<?=$args['product_url'];?>"></a>
</div>
<div class="card__control_dots"></div>