<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;
?>


<?php do_action( 'woocommerce_before_lost_password_confirmation_message' ); ?>

<div class="container">
	<h1 class="title-h1 title-page margin-top">вход на сайт</h1>
</div>
<section class="basket lost-password">
    <h3 class="basket__title">Письмо для восстановления пароля отправлено на указанный E-mail</h3>
    <span class="basket__subtitle">Инструкция по сбросу пароля была направлена на Ваш E-mail, доставка письма может занять несколько минут.</span>
    <a href="<?php echo home_url();?>" class="btn">Вернуться на главную</a>
</section>


<?php do_action( 'woocommerce_after_lost_password_confirmation_message' ); ?>
