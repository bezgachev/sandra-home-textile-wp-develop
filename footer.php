</main>
	<footer class="footer">
		<div class="container">
			<div class="footer__wrapper">
				<div class="footer__info footer__wrapper_link">
					<div class="footer__logo">
						<a class="logo" href="<? echo home_url(); ?>">
							<img src="<? $custom_logo_url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' )); echo $custom_logo_url[0];  ?>" alt="textile-logo"> 
						</a>
					</div>

				<?get_template_part('components/socials/socials', 'footer');?>

				</div>
				<div class="footer__catalog footer__wrapper_link">
					<span>Каталог</span>
					<?footer_catalog_nav_menu();?>   
				</div>
				<div class="footer__shopper footer__wrapper_link">
					<span>Покупателям</span>
					<?footer_clients_nav_menu();?>
				</div>
				<div class="footer__help footer__wrapper_link">
					<span>Помощь</span>
					<?footer_help_nav_menu();?>
				</div>
				<div class="footer__contact-us footer__wrapper_link">
					<span>Свяжитесь с нами</span>
					<ul class="footer__links">
					<?
						$yandekskartys = get_field('contacts-yandekskarty', 27);
						foreach($yandekskartys as $yandekskarty) {
							$main_office = $yandekskarty['contacts-tip']['value'];
							if ($main_office == 'main-office') {
								$main_office_tel = $yandekskarty['contacts-tel'];
								$part1 = mb_substr($main_office_tel, 1, 3, 'UTF8');
								$part2 = mb_substr($main_office_tel, 4, 3, 'UTF8');
								$part3 = mb_substr($main_office_tel, 7, 2, 'UTF8');
								$part4 = mb_substr($main_office_tel, 9, 2, 'UTF8');
								$main_office_tel_all = '8 (' . $part1 . ') ' . $part2 . '-' . $part3 . '-' . $part4;

								$main_office_addr = $yandekskarty['contacts-indeks'] . ', ' . $yandekskarty['contacts-gorod'] . ', ' . $yandekskarty['contacts-adres'];
								$main_office_addr_2gis = $yandekskarty['contacts-2gis'];
							}
						}
					?>
						<li>
							<? 
								echo '<a class="footer__links_phone" href="tel:+' . $main_office_tel .'">' . $main_office_tel_all . '</a>';
							?>
						</li>
						<li>
						<? $site_email = get_option('admin_email'); 
							echo '<a class="footer__links_mail text" href="mailto:'. $site_email .'">'. $site_email .'</a>';
						?>
						</li>

						<li class="footer__links_map">
							<a href="<? echo $main_office_addr_2gis; ?>" target="_blank"><? echo $main_office_addr; ?></a>
							
						</li>
					</ul>
				</div>
			</div>
			<div class="footer__wrapper footer__wrapper-info">
				<div class="footer__wrapper_info footer__info-founder">
					<? echo get_field('contacts-ip', 27); ?>,
					ИНН <? echo get_field('contacts-inn', 27); ?>,
					ОГРНИП <? echo get_field('contacts-ogrnip', 27); ?>
				</div>
				<div class="footer__wrapper_info footer__info-company"><? echo date ('Y'); ?> © “<? echo get_bloginfo('name'); ?>” — оптовый интернет-магазин домашнего текстиля. Все права защищены.
					<a href="<? echo get_site_url(); ?>/privacy">Политика конфиденцильности</a>
				</div>
				<div class="footer__wrapper_info weblitex">
					<a target="_blank" href="https://weblitex.ru/?utm_source=clients&utm_medium=referal&utm_campaign=sandrahometextile.ru">Разработка сайтов «Лайтекс»</a>
				</div>
			</div>
		</div>
	</footer>




	<!-- Popap-------------------------------- -->
	<? echo do_shortcode('[call_form]');?>
	<!-- ---------------end-Popap-------------------- -->
	<? 
		if(empty($_COOKIE['sht_woo_policy'])) {
			echo '
			<div class="cookie" id="policy">
				<div class="cookie__text">Мы используем cookie-файлы, чтобы пользоваться сайтом было удобнее.</div>
				<div class="cookie__btn">Принять</div>
				<a href="'.get_site_url().'/privacy/" target="_blank" class="cookie__link">Подробнее</a>
			</div>';
		}
	?>
<? wp_footer(); ?>
</body>
<style>
	#order_review, #payment .wc_payment_methods.payment_methods.methods {
		display: block !important;
	}
</style>

</html>
