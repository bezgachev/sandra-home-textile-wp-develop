<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>


<!-- <main>
	<div class="container">
		<h1 class="title-h1 title-page">вход на сайт</h1>
		<section class="basket">
			<h3 class="basket__title">Введите ваш логин и пароль
				для входа на сайт</h3>
			<form id="login" action="login" method="POST">
				<div class="basket__field">
					<label class="basket__field_label" for="username">Имя пользователя или e-mail<span> *</span>
						<!-- <span class="error-mess">Необходимо заполнить поле</span> -->
				<!-- <	</label>
					<input class="basket__field_input" id="username" type="text" name="username">
				</div>
				<div class="basket__field">
					<label class="basket__field_label" for="password">Пароль<span> *</span>
					</label>
					<input class="basket__field_input" id="password" type="password" name="password">
				</div>
				<div class="basket__checkbox">
					<label class="custom-checkbox" for="popap-checkbox">
						<input type="checkbox" id="popap-checkbox">
						<span>Запомнить меня</span>
					</label>
				</div>
				<div class="basket__btn">
					<input class="btn basket__btn_log" type="submit" value="войти на сайт">
					<input class="btn basket__btn_lost-pass" type="submit" value="забыли пароль">
				</div>
				<div class="basket__register">
					<input class="btn" type="submit" value="зарегистрироваться">
				</div>
			</form>
		</section> -->

	<!-- <form id="login" action="login" method="post">
		<h1>Site Login</h1>
		<p class="status"></p>
		<label for="username">Username</label>
		<input id="username" type="text" name="username">
		<label for="password">Password</label>
		<input id="password" type="password" name="password">
		<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="">
		<span>Запомнить меня</span>
		<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
		<input class="submit_button" type="submit" value="Login" name="submit">
		<a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
	</form> -->