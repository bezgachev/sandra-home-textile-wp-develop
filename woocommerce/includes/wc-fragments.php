<?
// if ( ! defined( 'ABSPATH' ) ) {
// 	exit;
// }

//Динамически обновляем кол-во товаров и сумму корзины в header
add_filter( 'woocommerce_add_to_cart_fragments', 'woo_reset_basket_header');
function woo_reset_basket_header($fragments){
    ob_start(); 
	$cart_count = WC()->cart->get_cart_contents_count();
	$card_total = WC()->cart->get_cart_total(); 
	$notag_card_total = strip_tags($card_total);
	$card_total_space = number_format((int)$notag_card_total, 0, '', ' ');

	if ( empty( $_COOKIE[ 'sht_woo_basket_count' ] ) ) {
		$basket_count = array();
	} else {
		$basket_count = $_COOKIE[ 'sht_woo_basket_count' ];
	}
	$basket_count = $cart_count;
	wc_setcookie( 'sht_woo_basket_count', $basket_count, time() + (3600 * 24 * 7) );
	?>
		<?php
		if (!empty($cart_count)){
			?>
				<a class="header__menu_basket desktop" href="<?php echo wc_get_cart_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/icon-card.svg" alt="icon-cart">
					<span class="header__icon_num"><?php echo $cart_count; ?></span>&nbsp;
					<span class="header__icon_sum"><?php echo $card_total_space; ?>&nbsp;₽</span>
				</a>
			<?php
		}
		else { ?>
			<a class="header__menu_basket desktop" href="<?php echo wc_get_cart_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/icon-card.svg" alt="icon-cart"></a>
		<?php } ?>
    <?php
        $fragments['.header__menu_basket.desktop'] = ob_get_clean();

    return $fragments;

}