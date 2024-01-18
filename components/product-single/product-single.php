<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="product">
	<div class="container product__wrapper">
		<div class="product__crumb">
			<?get_template_part('components/product-single/product-single', 'crumb');?>
		</div>
		<div class="product__body">
			<?get_template_part('components/product-single/product-single', 'slider');?>
			<div class="product__body_description product-descr">
				<?
				get_template_part('components/product-single/description/product-single', 'title');
				get_template_part('components/product-single/description/product-single', 'price');
				get_template_part('components/product-single/description/product-single', 'add-to-cart');
				get_template_part('components/product-single/description/product-single', 'attributes');
				get_template_part('components/product-single/description/product-single', 'excerpt');
				?>

			</div>
		</div>
	</div>
</section>
<?get_template_part('components/product-single/product-single', 'imgs-zoom');?>