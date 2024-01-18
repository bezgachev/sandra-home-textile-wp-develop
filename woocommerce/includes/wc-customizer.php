<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'customize_register', 'woo_min_cart_amount', 99 );
function woo_min_cart_amount( $wp_customize ) {
    $wp_customize->add_section(
        'my_wc_custom_section',
        array(
            'title'    => __( 'Корзина', 'text-domain' ),
            'priority' => 20,
            'panel'    => 'woocommerce',
            'description' => "Здесь можно указать минимальную сумму заказа в Интернет-магазине (без пробелов). Например, нужно указать 20 тыс.руб., напишите: 20000",
        )
    );
    $wp_customize->add_setting( 'my_wc_custom_section_settings', array( 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'my_wc_custom_section_settings_control', 
        array(
            'label'     => __( 'Укажите минимальную сумму ₽ (обязательно)', 'text-domain' ),
            'type' => 'number',
            'settings'  => 'my_wc_custom_section_settings',
            'section'   => 'my_wc_custom_section',
            'priority'  => 20,
        ) 
    );
}