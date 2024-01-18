<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' ); ?>
<div class="container">
	<h1 class="title-h1 title-page margin-top">вход на сайт</h1>
</div>
<section class="basket lost-password">
	<h3 class="basket__title">Введите Ваш новый пароль</h3>
	<form method="post" class="edit-password">
		<div class="basket__field">
			<label class="basket__field_label" for="password_1"><?php esc_html_e( 'New password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="input-text basket__field_input" name="password_1" id="password_1" autocomplete="new-password" minlength="6" required/>
			<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
		</div>

		<div class="basket__field">
			<label class="basket__field_label" for="password_2"><?php esc_html_e( 'Re-enter new password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="input-text basket__field_input" name="password_2" id="password_2" autocomplete="new-password" minlength="6" required/>
			<span class="error-mess">Пароли не совпадают</span>
			<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
		</div>

		<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
		<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

		<div class="basket__btn" id="submit-block">
		<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="woocommerce-Button button btn basket__btn_log">Сохранить пароль</button>
		</div>

		<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>
	</form>
</section>


<?php do_action( 'woocommerce_after_reset_password_form' ); ?>

