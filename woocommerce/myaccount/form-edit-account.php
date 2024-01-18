<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_edit_account_form' ); ?>
<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?>>
	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
	<div class="woocommerce-address-fields">
		<fieldset>
			<legend>Учетные данные</legend>
			<div class="account-credentials">

				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
					<label for="account_first_name">ФИО <abbr class="required" title="обязательно">*</abbr></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr($user->first_name); ?>">
					<span class="error-mess">Необходимо заполнить Имя</span>
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="account_email" class="">Email <abbr class="required" title="обязательно">*</abbr></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>">
					<span class="error-mess">Необходимо заполнить E-mail</span>
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" id="account_phone_field">
					<label for="account_phone">Контактный телефон <abbr class="required" title="обязательно">*</abbr></label>
					<input type="tel" class="input-text" name="account_phone" id="account_phone" autocomplete="off" value="<?php echo esc_attr($user->billing_phone); ?>" minlength="11" maxlength="11" inputmode="decimal">
					<span class="error-mess">Необходимо заполнить Контактный телефон</span>
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="account_display_name">Логин&nbsp;<span class="required">*</span>
					<span class="question"></span><span class="question-tooltip">Это ваш постоянный логин.<br>Используется для входа в аккаунт</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->user_login); ?>" readonly>
					
				</p>
				
			</div>
			


		</fieldset>
		<fieldset>
			<legend>адрес доставки <br>
				<span>Будет использован по умолчанию при оформлении заказов</span>
			</legend>
			<div class="account-address">
				<div class="register__fields">
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" id="account_billing_city_field">
						<label for="account_billing_city">Населённый пункт / Город&nbsp;<abbr class="required" title="обязательно">*</abbr></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-text" name="account_billing_city" id="account_billing_city" value="<?php echo esc_attr($user->billing_city); ?>">
						<span class="error-mess">Необходимо заполнить поле</span>
					</p>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" id="account_billing_address_field">
						<label for="account_billing_address">Адрес&nbsp;<abbr class="required" title="обязательно">*</abbr></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-text" name="account_billing_address" id="account_billing_address" value="<?php echo esc_attr($user->billing_address_1); ?>">
							<span class="error-mess">Необходимо заполнить поле</span>
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="account_billing_postcode">Индекс</label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-text" name="account_billing_postcode" id="account_billing_postcode" value="<?php echo esc_attr($user->billing_postcode); ?>" inputmode="decimal">
					</p>


				</div>

				<?php
				$current_user = wp_get_current_user();
				$user_id = $current_user->ID;
				$user_id_company = get_user_meta( $user_id, 'company', true);
				?>

				<div class="register__fields">
					<div class="register__radio">
						<?php if ($user_id_company === 'on') {
							echo '<span class="custom-radio"></span>';
							echo '<span class="text">Переключить профиль на юр. лицо?</span></div>';
							echo '<div class="order_form_organisation__fields organisation__fields">';
						}
						else {
							echo '<span class="custom-radio off"></span>';
							echo '<span class="text">Переключить профиль на юр. лицо?</span></div>';
							echo '<div class="order_form_organisation__fields organisation__fields d-hide">';
						}
						?>

						<?php 
							woocommerce_form_field( 'organisation_name', array(
								'required'      => true,
								'type'          => 'text',
								'label'   		=>	'Название компании / ИП',
							), get_user_meta( $user_id, 'organisation_name', true ));
							
							woocommerce_form_field( 'organisation_inn', array(
								'required'      => true,
								'type'          => 'number',
								'label'			=> 'ИНН',
								'maxlength'			=> '12',
								'custom_attributes' => array("inputmode" => "decimal"),
							), get_user_meta( $user_id, 'organisation_inn', true ));
						?>
						</div>

							
						<p class="form-row d-hide" id="organisation_field">
							<span class="woocommerce-input-wrapper">
								<?php if ($user_id_company === 'on') { ?>
									<input type="radio" class="input-radio" value="private_person" name="organisation" id="organisation_private_person">
									<input type="radio" class="input-radio" value="company" name="organisation" id="organisation_company" checked="checked">
								<?php
								}
								else { ?>
									<input type="radio" class="input-radio" value="private_person" name="organisation" id="organisation_private_person" checked="checked">
									<input type="radio" class="input-radio" value="company" name="organisation" id="organisation_company">
								<?php }
								?>						
							</span>
						</p>
					</div>


				</div>
			<?php do_action( 'woocommerce_edit_account_form' ); ?>

			<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
			<p class="account-btn">
				<button type="submit" class="woocommerce-Button button btn" name="save_account_details">Сохранить</button>
				<input type="hidden" name="action" value="save_account_details" />
				<a href="<?php echo home_url(); ?>/account/account-info/" class="btn-invert">Отмена</a>
			</p>


		</fieldset>
	</div>
	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>
<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
