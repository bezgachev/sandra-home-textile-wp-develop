<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// do_action( 'woocommerce_before_customer_login_form' ); ?>
<div class="container">
	<h1 class="title-h1 title-page margin-top">Вход на сайт</h1>
</div>

<section class="basket login-form">
	<h3 class="basket__title">Введите ваш логин и пароль для входа в аккаунт</h3>
	<form id="auth-user" method="POST" class="login_user">
		<span class="status-success d-hide"></span>
		<span class="status-error d-hide"></span>
		<div class="basket__field d-hide" id="username-block">
			<label class="basket__field_label" for="username">ФИО<span>&nbsp;*</span></label>
			<input class="basket__field_input" id="username" type="text" name="username" required>
			<span class="error-mess d-hide">Необходимо заполнить поле</span>
		</div>
		<div class="basket__field" id="email-block">
			<label class="basket__field_label" for="email">Логин или E-mail<span>&nbsp;*</span></label>
			<input class="basket__field_input" id="email" type="text" name="email" required>
			<span class="error-mess d-hide">Необходимо заполнить поле</span>
		</div>
		<div class="basket__field basket__field_pass">
			<label class="basket__field_label" for="password">Пароль<span>&nbsp;*</span></label>
			<div>
				<input class="basket__field_input" id="password" type="password" name="password" autocomplete="off" required>
				<button type="button" class="password__icon-eyes" title="Показать пароль"><span class="eyes"></span></button>
			</div>
			<span class="error-mess d-hide">Необходимо заполнить поле</span>
		</div>
		<div class="basket__checkbox">
			<label class="custom-checkbox" for="rememberme">
				<input name="rememberme" type="checkbox" id="rememberme" value="" checked>
				<span>Запомнить меня</span>
			</label>
		</div>

		<label for="privacy_policy_cart" class="order__pay_checkbox d-hide">
			<input type="checkbox" name="privacy_policy_cart" id="privacy_policy_cart">
			<span class="text">Я согласен на обработку <a href="https://test.sandrahometextile.ru/privacy-policy" target="_blank">персональных данных</a></span>
		</label>


		<div class="ajax-register d-hide">
			<?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
		</div>
		<div class="ajax-login d-hide">
			<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
		</div>
		
		<div class="basket__btn" id="submit-block">
			<input class="btn basket__btn_log" type="submit" name="submit" value="Войти на сайт">
			<a href="<?php echo wp_lostpassword_url(); ?>" class="btn basket__btn_lost-pass">Забыли пароль</a>
		</div>
		<div class="basket__register">
			<div class="btn">Пройти регистрацию</div>
		</div>
	</form>
</section>





<?php /* if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' );*/  ?>
