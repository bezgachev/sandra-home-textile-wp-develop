<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="container">
	<a href="<?php echo wc_get_page_permalink('myaccount')?>" class="bread-crumb margin-top">Вернуться назад</a>
	<h1 class="title-h1 title-page ">вход на сайт</h1>
</div>
<section class="basket lost-password">
<h3 class="basket__title">Введите Ваш email адрес учётной записи.<br>Вы получите сообщение с инструкциями<br>по сбросу пароля</h3>
	<form method="post" class="woocommerce-ResetPassword lost_reset_password">

		<div class="basket__field">
			<label class="basket__field_label" for="user_login">Ваш E-mail<span> *</span></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text basket__field_input" type="text" name="user_login" id="user_login">
		</div>

		<?php do_action( 'woocommerce_lostpassword_form' ); ?>

		<div class="basket__btn" id="submit-block">
		<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="woocommerce-Button button btn basket__btn_log">Сбросить пароль</button>
		</div>

		<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
	</form>
</section>

<!-- <div class="auth__account open">
	<section class="basket">
		<h3 class="basket__title">Введите Ваш email адрес учётной записи. Вы получите сообщение с инструкциями по сбросу пароля</h3>
		<form id="auth-user" method="POST" class="login_user">
			<span class="status-success d-hide"></span>
			<span class="status-error d-hide"></span>
			<div class="basket__field d-hide" id="username-block">
				<label class="basket__field_label" for="username">ФИО<span>&nbsp;*</span></label>
				<input class="basket__field_input" id="username" type="text" name="username">
				<span class="error-mess d-hide">Необходимо заполнить поле</span>
			</div>
			<div class="basket__field" id="email-block">
				<label class="basket__field_label" for="email">Логин или E-mail<span>&nbsp;*</span></label>
				<input class="basket__field_input" id="email" type="text" name="email" required="">
				<span class="error-mess d-hide">Необходимо заполнить поле</span>
			</div>
			<div class="basket__field basket__field_pass">
				<label class="basket__field_label" for="password">Пароль<span>&nbsp;*</span></label>
				<div>
					<input class="basket__field_input" id="password" type="password" name="password" autocomplete="off" required="">
					<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
				</div>


				<span class="error-mess d-hide">Необходимо заполнить поле</span>
			</div>
			<div class="basket__checkbox">
				<label class="custom-checkbox" for="rememberme">
					<input name="rememberme" type="checkbox" id="rememberme" value="" checked="">
					<span>Запомнить меня</span>
				</label>
			</div>

			<label for="privacy_policy_cart" class="order__pay_checkbox d-hide">
				<input type="checkbox" name="privacy_policy_cart" id="privacy_policy_cart">
				<span class="text">Я согласен на обработку <a href="https://test.sandrahometextile.ru/privacy-policy" target="_blank">персональных данных</a></span>
			</label>


			<div class="ajax-register d-hide">
				<input type="hidden" name="security" value="0cc02cb7f8"><input type="hidden" name="_wp_http_referer" value="/cart/">			</div>
			<div class="ajax-login d-hide">
				<input type="hidden" name="security" value="0b299efe64" id="security"><input type="hidden" name="_wp_http_referer" value="/cart/">			</div>
			
			<div class="basket__btn" id="submit-block">
				<input class="btn basket__btn_log" type="submit" name="submit" value="Войти на сайт">
				<a href="https://test.sandrahometextile.ru/account/lost-password/" class="btn basket__btn_lost-pass">Забыли пароль</a>
			</div>
			<div class="basket__register">
				<div class="btn">Пройти регистрацию</div>
			</div>
		</form>
	</section>
</div>
 -->












<?php
do_action( 'woocommerce_after_lost_password_form' );
