<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_shortcode('min_basket_amount', 'min_basket_amount_hortcode');
function min_basket_amount_hortcode() {
	$min_cart_amount = get_theme_mod('my_wc_custom_section_settings');
	$min_cart_amount_int = (int)$min_cart_amount;
	$min_cart_amount_int_space = number_format($min_cart_amount_int, 0, '', '&nbsp;');
    return $min_cart_amount_int_space;
}

add_shortcode('admin_email', 'admin_email_hortcode');
function admin_email_hortcode() {
	$admin_email = get_option('admin_email');
	$admin_email_block = '<a href="mailto:'. $admin_email .'">' . $admin_email . '</a>';
	return $admin_email_block;
}

add_shortcode('main_phone', 'main_phone_hortcode');
function main_phone_hortcode() {
	$yandekskartys = get_field('contacts-yandekskarty', 27);
	foreach($yandekskartys as $yandekskarty) {
		$main_office = $yandekskarty['contacts-tip']['value'];
		if ($main_office == 'main-office') {
			$main_office_tel = $yandekskarty['contacts-tel'];
			$part1 = mb_substr($main_office_tel, 1, 3, 'UTF8');
			$part2 = mb_substr($main_office_tel, 4, 3, 'UTF8');
			$part3 = mb_substr($main_office_tel, 7, 2, 'UTF8');
			$part4 = mb_substr($main_office_tel, 9, 2, 'UTF8');
			$main_office_tel_all = '+7 (' . $part1 . ') ' . $part2 . '-' . $part3 . '-' . $part4;
			
			$main_phone = '<a href="tel:+'. $main_office_tel . '">' . $main_office_tel_all . '</a>';
			return $main_phone;
		}
	}
}



add_shortcode( 'call_form', 'call_form' );
function call_form() {
	ob_start();
	?>
	<div class="modal modal-popup">
        <h3 class="form__title">Закажите обратный звонок</h3>
	
        <form class="popup" method="POST">
            <div class="popup__field ">
                <label class="popup__field_label" for="form-name">Как Вас зовут?<span>&nbsp;*</span>
                    
                </label>
                <input class="popup__field_input ym-record-keys" type="text" name="form-name">
				<span class="error-mess">Необходимо заполнить поле</span>
            </div>
            <div class="popup__field">
                <label class="popup__field_label" for="form-tel">Контактный телефон<span>&nbsp;*</span>
                    
                </label>
                <input class="popup__field_input ym-record-keys" type="tel" name="form-tel" inputmode="decimal">
				<span class="error-mess">Необходимо заполнить поле</span>
            </div>
            <div class="popup__field">
                <label class="popup__field_label" for="form-email">E-mail
                </label>
                <input class="popup__field_input ym-record-keys" type="email" name="form-email">
				<span class="error-mess">Введите корректный e-mail</span>
            </div>
            <div class="form__checkbox">
                <label class="custom-checkbox" for="form-checkbox-call">
                    <input type="checkbox" name="form-checkbox" id="form-checkbox-call">
                    <span>Я согласен(-а) на обработку своих&nbsp;
                        <a href="<?php echo home_url(); ?>/privacy" target="_blank"> персональных данных</a>
                    </span>
					<div class="error-mess">Требуется согласие</div>
                </label>
				
            </div>
			<input type="hidden" name="feedback" value="call">
            <input class="form__btn btn" type="submit" value="Заказать звонок" data-text="Заказать звонок">
        </form>



        <button class="close-button"></button>
    </div>
	<div id="overlay"></div>
	<!-- Popap: если отправка успешна к H3 добовляется класс popup-ok иначе popup-error --------------------------------------- -->
	<div class="modal modal-access">
		<h3 class="title-h2 modal-access__title popup-ok">Заявка успешно отправлена!</h3>
		<p class="text modal-access__text">В самое ближайшее время с Вами свяжется наш менеджер.</p>
	</div>

	<?php

	return ob_get_clean();
}
