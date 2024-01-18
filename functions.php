<?
// Скрытие меню панели управления
get_template_part('includes/admin-panel');

// Подключение настроек темы
get_template_part('includes/theme-settings');

// Подключение области виджетов
get_template_part('includes/widget-areas');

// Подключение скриптов и стилей
get_template_part('includes/enqueue-script-style');

// Кастомное меню
get_template_part('includes/nav-menu/register-nav-menu');

// Кастомайзер произвольных полей WP
get_template_part('includes/wp-customizer');

// Shortcode WP
get_template_part('includes/shortcodes');

// ajax WP
get_template_part('includes/wp-ajax');

// Подключение Woocommerce
get_template_part('includes/woocommerce');

// Удаление регистрационных размеров изображений WP и WC
get_template_part('includes/wp-remove-image-sizes');

// Оптимизация WP
get_template_part('includes/wp-optimization');

// Подключение Технического режима (закрытый сайт)
get_template_part('includes/maintenance-mode');