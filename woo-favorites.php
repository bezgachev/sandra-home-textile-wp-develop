<?php
/*
Template Name: Избранные товары
Template Post Type: page
*/
?>

<?php get_header(); ?>
<div class="woocommerce">
    <div class="main">
    <?php
        $min_cart_amount = get_theme_mod('my_wc_custom_section_settings');
        $min_cart_amount_int = (int)$min_cart_amount;
        $min_cart_amount_int_space = number_format($min_cart_amount_int, 0, '', '&nbsp;');
    ?>
    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="bread-crumb margin-top">Вернуться назад</a>
    <h1 class="title-h1 title-page">Избранные товары</h1>
    <?php woo_echo_likelist(); ?>
        
    </div>
</div>
<?php get_footer(); ?>