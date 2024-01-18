<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$excerpt = get_the_excerpt();
if (!$excerpt) {
    return;
}
?>
<div class="product-descr__text">
	<h3 class="title-h3">Описание:</h3>
    <?woocommerce_template_single_excerpt();?>
</div>