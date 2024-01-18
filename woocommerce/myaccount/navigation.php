<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );


$url = $_SERVER['REQUEST_URI'];

if ($url === '/account/') {
	echo '<section class="personal-account control-panel">';
}
else if ((strpos($url, '/help/') !== false)) {
	echo '<section class="personal-account personal-account-item account-help">';
}
else if ((strpos($url, '/account-info/') !== false)) {
	echo '<section class="personal-account personal-account-item account-info">';
}
else {
	echo '<section class="personal-account personal-account-item">';
}

?>
<?php
if ((strpos($url, '/view-order/') !== false)) {
	echo '<a href="'. home_url().'/account/orders/" class="bread-crumb">Вернуться назад</a>';
}
else {
	echo '<a href="'. wc_get_page_permalink('myaccount').'" class="bread-crumb">Вернуться назад</a>';
}

?>

<h1 class="title-h1">Личный кабинет</h1>
<div class="woocommerce container-main catalog">
	<nav class="woocommerce-MyAccount-navigation catalog__sidebar personal-account__navigation">
		<ul>
			<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
				<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>

