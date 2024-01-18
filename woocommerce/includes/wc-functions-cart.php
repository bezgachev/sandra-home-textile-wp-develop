<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('woocommerce_after_cart', 'woo_recently_viewed_product', 15); //добавляем блок вы смотрели ранее в корзине

// Open the container before WooCommerce content
add_action( 'woocommerce_before_cart', function() {
    echo '<div class="main">'; 
}, 10);


// Close the div tag opened for the container
add_action( 'woocommerce_after_cart', function() {
    echo '</div>'; 
}, 10);
