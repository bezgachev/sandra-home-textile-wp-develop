<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Скрытые пункта меню маркетинг в woo
add_filter( 'woocommerce_admin_features', function( $features ) {
    return array_values(
        array_filter( $features, function($feature) {
            return $feature !== 'marketing';
        } ) 
    );
});

//Скрытие меток в товары woo
add_action('admin_menu', 'remove_submenus');
function remove_submenus() {
	global $submenu;
	unset($submenu['edit.php?post_type=product'][16]); //скрытие меток woo
	unset($submenu['edit.php?post_type=product'][18]); //отзывы woo

}
