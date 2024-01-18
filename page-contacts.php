<?php
/*
Template Name: Контакты
Template Post Type: page
*/
?>

<?php get_header(); ?>
<h1 class="title-h1 contact-info__title">Контактная информация</h1>

<section class="first-contacts contact-info">
	<div class="contacts__info">
		<p class="contacts__info_subtitle">Выберите, чтобы показать другие контакты</p>

		<div class="select-js">
			<div class="option-js-active"></div>
			<div class="options-js">
			<?php

			$yandekskartys = get_field('contacts-yandekskarty');
			if($yandekskartys)
			{
				foreach($yandekskartys as $yandekskarty)
				{
					$main_office = $yandekskarty['contacts-tip']['value'];
					$contacts_tel_type = $yandekskarty['contacts-tel-type'];

					if ($main_office == 'main-office') {
						$main_office_tel = $yandekskarty['contacts-tel'];
						$tel = $main_office_tel;
					}
					else {
						if ($contacts_tel_type == 'tel-new') {
							$tel = $yandekskarty['contacts-tel-new'];
						}
						else {
							$tel = $main_office_tel;
						}

					}

					$part1 = mb_substr($tel, 1, 3, 'UTF8');
					$part2 = mb_substr($tel, 4, 3, 'UTF8');
					$part3 = mb_substr($tel, 7, 2, 'UTF8');
					$part4 = mb_substr($tel, 9, 2, 'UTF8');
					$part_all = '8 (' . $part1 . ') ' . $part2 . '-' . $part3 . '-' . $part4;

					echo '<span class="option-js"';
					echo 'tel="' . $part_all . '"';
					echo 'addrmap="' . $yandekskarty['contacts-adres'] . '"';
					echo 'addr="' . $yandekskarty['contacts-indeks'] . ', ' . $yandekskarty['contacts-gorod'] . ', ' . $yandekskarty['contacts-adres'] . '"';
					echo 'telhref="' . $tel . '"';

					$work_time = $yandekskarty['contacts-work-time']['contacts-time-ezhednevno'];
					if ($work_time == 'true') {
						echo 'mode="Ежедневно: '. $yandekskarty['contacts-work-time']['contacts-time-pn-vs'] . '"';

					}
					if ($work_time == 'false')  {
						echo 'mode="ПН-ПТ: '. $yandekskarty['contacts-work-time']['contacts-time-pn-pt'] . '<br>СБ-ВС: '. $yandekskarty['contacts-work-time']['contacts-time-sb-vs'] . '"';

					}

					echo 'geo="' . $yandekskarty['contacts-geo'] . '"';
					echo '2gis="' . $yandekskarty['contacts-2gis'] . '">';
					echo '' . $yandekskarty['contacts-gorod'] . ', ' . $yandekskarty['contacts-tip']['label'] . '</span>';
				}

			} ?>
			</div>
		</div>

		<div class="contacts__info_descr descr-info">
			<div class="descr-info__text icon-tel">
				<a href="tel:+<?php echo $main_office_tel; ?>" class="descr-info__text_tel" id="tel"><?php echo $part_all; ?></a>
			</div>
			<?php $site_email = get_option('admin_email'); ?>
			<div class="descr-info__text text"><span class="icon-mail"><a href="mailto:<?php echo $site_email; ?>"><?php echo $site_email; ?></a></span>
			</div>
			<div class="descr-info__text icon-clock text" id="mode"></div>
			<a class="descr-info__text icon-map text" id="addr" href="#" target="_blank"></a>
			<div class="contact-info__item_social">
			<?get_template_part('components/socials/socials', 'contact');?>
			</div>
		</div>
	</div>
	<div class="contacts__map">
		<div class="map">
			<div id="map"></div>
		</div>
	</div>
</section>
<section class="details">
	<div class="details__wrapper container">
		<h2 class="title details__title">реквизиты компании</h2>
		<div class="details__body">
			<div class="details__content">
				<div class="details__content_items details-content">
					<div class="details-content__title title-h3 details-data">Данные о компании <?php echo get_field('contacts-ip'); ?></div>
					<div class="details-content__subtitle">Юр.адрес:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-yur_adres'); ?></div>
					<div class="details-content__subtitle">ИНН:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-inn'); ?></div>
					<div class="details-content__subtitle">ОГРНИП:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-ogrnip'); ?></div>
					<div class="details-content__subtitle">Руководитель:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-rukovoditel'); ?></div>
				</div>
				<div class="details__content_items">
					<div class="details-content__title title-h3 details-bank">Платёжные данные</div>
					<div class="details-content__subtitle">Банк:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-bank'); ?></div>
					<div class="details-content__subtitle">БИК:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-bik'); ?></div>
					<div class="details-content__subtitle">Расч. счет:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-rasch_schyot'); ?></div>
					<div class="details-content__subtitle">Кор. счет:</div>
					<div class="details-content__descr text"><?php echo get_field('contacts-korresp_schyot'); ?></div>
				</div>
			</div>
			<?php 
				$menedzhery_enabled = get_field('contacts-menedzhery-enabled');
				if ($menedzhery_enabled == 'true') { ?>
			<div class="details__content details-manager">
				<div class="title-h3 details-manager__title">вас будут обслуживать
					наши менеджеры продаж:</div>
				<div class="details-manager__body">
				<?php
					$menedzherys = get_field('contacts-menedzhery');
						foreach($menedzherys as $menedzhery) { ?>
					<div class="details-manager__content">
						<div class="details-manager__content_img"><img src="<?php echo $menedzhery['contacts-menedzher-img']; ?>" alt=""></div>
						<div class="details-manager__content_text text"><?php echo $menedzhery['contacts-menedzher-name']; ?></div>
					</div>
				
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<section class="feedback">
	<div class="feedback__content">
		<div class="container">
			<h2 class="title feedback__title">обратная связь</h2>
			<form class="feedback__form" method="POST">
				<div class="feedback__fields">
					<div class="feedback__field">
						<label class="feedback__field_label" for="form-name">Имя <span>*</span></label>
						<input class="feedback__field_input ym-record-keys" type="text" name="form-name" placeholder="Введите Ваше имя"\>
						<span class="error-mess">Необходимо заполнить поле</span>
					</div>

					<div class="feedback__field">
						<label class="feedback__field_label" for="form-email">E-mail <span>*</span></label>
						<input class="feedback__field_input ym-record-keys" type="text" name="form-email" placeholder="Введите Ваш E-mail">
						<span class="error-mess">Необходимо заполнить поле</span>
					</div>
				</div>
				<div class="feedback__textarea">
					<label class="feedback__field_label" for="form-textarea">Сообщение<span>*</span></label>
					<textarea class="feedback__field_input" type="text" name="form-textarea"
						type="text" name="Message" maxlength="400" resize="none" rows="2" placeholder="Начните писать свой вопрос"></textarea>
						<span class="error-mess">Необходимо заполнить поле</span>
				</div>

				<div class="feedback__checkbox">
					<label class="custom-checkbox" for="form-checkbox-feedback">
						<input type="checkbox" name="form-checkbox" id="form-checkbox-feedback">
						<span class="text">Я согласен(-а) на обработку своих&nbsp;<a href="<?php echo home_url(); ?>/privacy-policy" target="_blank">персональных данных</a></span>
						<span class="error-mess">Требуется согласие</span>
					</label>
					
				</div>
				<input type="hidden" name="feedback" value="feedback">

				<div class="feedback__btn">
					<input class="btn" type="submit" value="отправить письмо" data-text="отправить письмо">
					<div class="feedback__btn_alert report">
						<span class="report__error d-hide">Сообщение не отправилось. <br> Пожалуйста, повторите ещё раз</span>
						<span class="report__ok d-hide">Сообщение успешно отправлено</span>
					</div>
				</div>

			</form>
		</div>
	</div>
	<div class="feedback__img"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/envelope.png" alt="envelope"></div>
</section>
<?php get_footer(); ?>