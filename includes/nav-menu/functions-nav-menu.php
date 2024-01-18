<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function desktop_header_catalog_nav_menu(){
    if (is_product() || is_shop() || is_product_category()) {
        wp_nav_menu(array(
            'theme_location'  => 'header-catalog',
            'menu_id'      => false,
            'container'       => false, 
            'container_class' => false, 
            'menu_class'      => false,
            'items_wrap'      => '<section class="header-page__catalog">%3$s</section>',
            'order' => 'ASC',      
            'walker' => new catalog_menu_icon()   
        )); 
    }
    else {
        wp_nav_menu(array(
            'theme_location'  => 'header-catalog',
            'menu_id'      => false,
            'container'       => false, 
            'container_class' => false, 
            'menu_class'      => false,
            'items_wrap'      => '<section class="header-catalog"><ul class="header-catalog__nav">%3$s</ul></section>',
            'order' => 'ASC',      
            'walker' => new catalog_menu()   
        )); 
    }
}

function desktop_header_main_nav_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'header-main-menu',
        'menu_id'      => false,
        'container'       => 'nav', 
        'container_class' => 'header__nav', 
        'menu_class'      => false,
        'items_wrap'      => '<ul>%3$s</ul>',
        'order' => 'ASC',      
        'walker' => new header_main_menu()   
    ));
}

function mobile_header_main_nav_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'sibebar-menu',
        'menu_id'      => false,
        'container'       => false, 
        'container_class' => false, 
        'menu_class'      => false,
        'items_wrap'      => '<ul class="burger__catalog_links">%3$s</ul>',
        'order' => 'ASC',      
        'walker' => new sibebar_menu()   
    ));
}

function mobile_header_catalog_nav_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'header-catalog',
        'menu_id'      => false,
        'container'       => false, 
        'container_class' => false, 
        'menu_class'      => false,
        'items_wrap'      => '<ul class="burger__catalog_links">%3$s</ul>',
        'order' => 'ASC',      
        'walker' => new sibebar_menu()   
    ));
}

function footer_catalog_nav_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'header-catalog',
        'menu_id'      => false,
        'container'       => false, 
        'container_class' => false, 
        'menu_class'      => false,
        'items_wrap'      => '<ul class="footer__links">%3$s</ul>',
        'order' => 'ASC',      
        'walker' => new catalog_footer()   
    )); 
}

function footer_clients_nav_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'footer-clients',
        'menu_id'      => false,
        'container'       => false, 
        'container_class' => false, 
        'menu_class'      => false,
        'items_wrap'      => '<ul class="footer__links">%3$s</ul>',
        'order' => 'ASC',      
        'walker' => new catalog_footer()   
    )); 
}

function footer_help_nav_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'footer-help',
        'menu_id'      => false,
        'container'       => false, 
        'container_class' => false, 
        'menu_class'      => false,
        'items_wrap'      => '<ul class="footer__links">%3$s</ul>',
        'order' => 'ASC',      
        'walker' => new catalog_footer()   
    )); 
}
function desktop_page_catalog_nav_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'catalog-main',
        'menu_id'      => false,
        'container'       => false, 
        'container_class' => false, 
        'menu_class'      => false,
        'items_wrap'      => '<div class="first-catalog__items">%3$s</div>',
        'order' => 'ASC',      
        'walker' => new catalog_main()   
    )); 
}

