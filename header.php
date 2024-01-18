<!doctype html>
<html lang="ru">
<head>
	<meta charset="<?bloginfo('charset');?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<?wp_head();?>
</head>
<body>
	<? 
// $current_user = wp_get_current_user();
// $user_id = $current_user->ID;
// update_user_meta( $user_id, 'favorites', '');
// update_favorites_product_authorization_user();
	?>
<header>
	<section class="header">
		<div class="header__mob-navigation">
			<ul class="mob-navigation">

				<li class="mob-navigation__link <? if( is_front_page() ) {
					echo 'active">'; }
					else { echo '">'; } ?>
			
						<a href="<? echo home_url(); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 26">
							<path
								d="M28.5332,12.73389a.78764.78764,0,0,0-.26953-.47461.81183.81183,0,0,0-.51269-.18848h-.02149a.78515.78515,0,0,0-.5625.2168.94791.94791,0,0,0-.25879.69678v8.57714H22.31836V16.99316c0-.26074.001-.52246-.01856-.78222a3.2146,3.2146,0,0,0-1.34863-2.38428,3.33717,3.33717,0,0,0-2.79394-.51709,3.25436,3.25436,0,0,0-2.47657,3.21973q-.00585,1.604-.00244,3.209l.00049,1.73633c0,.03223-.00146.06445-.00293.09668H11.08936v-8.479l.00048-.06348c.00049-.06836.001-.13672-.0039-.20068a.79184.79184,0,0,0-.24658-.53125.84331.84331,0,0,0-1.09961-.04151.78107.78107,0,0,0-.28223.5166,2.323,2.323,0,0,0-.01563.32178l-.00048,9.10449a2.29547,2.29547,0,0,0,.0083.24024.80059.80059,0,0,0,.832.75879q3.10547.00585,6.21191,0a.79957.79957,0,0,0,.83106-.82032c.002-.05078.00146-.10156.001-.15136l-.001-1.85645q-.00147-1.94238.00342-3.88574a1.648,1.648,0,0,1,.51025-1.2002,1.58868,1.58868,0,0,1,1.2373-.457,1.65679,1.65679,0,0,1,1.59473,1.68653q.00513,1.77539.00244,3.55175l-.00049,2.24317a.8076.8076,0,0,0,.8628.89062q1.541.00147,3.082.002,1.541,0,3.083-.002a.80582.80582,0,0,0,.85156-.79c.00488-.05566.00488-.11132.00488-.20312l-.001-9.1377A1.91059,1.91059,0,0,0,28.5332,12.73389Z"
								style="fill:#b7a39d" />
							<path
								d="M30.75391,10.05371Q25.18458,6.05615,19.61816,2.05566a.874.874,0,0,0-1.24365.00684L7.24316,10.05908a1.58263,1.58263,0,0,0-.21045.1709.79711.79711,0,0,0-.07617,1.03809.81985.81985,0,0,0,.46436.30859.84794.84794,0,0,0,.56494-.06152,2.13327,2.13327,0,0,0,.27393-.17823q5.332-3.82983,10.66064-7.66455c.07813-.05468.07764-.05713.165.00537Q24.11792,7.304,29.15918,10.92139l.20117.145c.18555.13525.3711.27.55762.395a.79349.79349,0,0,0,.42578.145l.03418.001a.76731.76731,0,0,0,.3916-.105.80154.80154,0,0,0,.30567-.27832.7917.7917,0,0,0,.125-.394v-.00781A.91841.91841,0,0,0,30.75391,10.05371Z"
								style="fill:#b7a39d" />
						</svg>
						Главная</a>
					</li>
				
					<li class="mob-navigation__link <? if( is_product_category() || is_shop() ) {
					echo 'active">'; }
					else { echo '">'; } ?>
				
					<a href="<? echo get_permalink(wc_get_page_id('shop')); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 26">
						<path
							d="M36.58319,20.97821v-.00043a.86943.86943,0,0,0-.32086-.82861c-.85022-.853-1.69653-1.70966-2.54761-2.57135q-.48633-.49219-.97522-.98669l-.2417-.24451.20533-.2757a8.63271,8.63271,0,0,0-1.56366-11.912,8.29623,8.29623,0,0,0-10.97376.6709A8.57729,8.57729,0,0,0,19.298,15.94489a8.06743,8.06743,0,0,0,4.97016,3.23669,8.26235,8.26235,0,0,0,6.8609-1.53821l.27869-.20416.24255.246.69647.70642q.81912.83066,1.63013,1.65259c.13226.13391.26306.269.39245.40253h0l.00031.0003.002.002c.31348.32355.61841.638.93763.934l.00555.00512-.00006.00006a.75637.75637,0,0,0,.35229.19214.74542.74542,0,0,0,.398-.01593.76045.76045,0,0,0,.33667-.21991v-.00006A.7818.7818,0,0,0,36.58319,20.97821ZM30.82782,15.8429a6.80454,6.80454,0,0,1-10.54224-1.16559,6.99279,6.99279,0,0,1-1.10614-3.86823h-.00012l.00006-.001-.00006-.001h.00012A6.88766,6.88766,0,0,1,26.061,3.96722V3.96716l.00049.00006.00086-.00006v.00013A6.79058,6.79058,0,0,1,29.8681,5.15961a6.916,6.916,0,0,1,2.50562,3.13305,6.9926,6.9926,0,0,1-1.5459,7.55024Z"
							style="fill:#b7a39d" />
						<path
							d="M10.70117,11.222h-.00366c-1.2193-.00048-1.84723-.00067-3.60492-.00067h0q-1.93112.00073-3.86237-.00012a.86339.86339,0,0,0-.46936.11609.79054.79054,0,0,0,.48084,1.44464q1.90393.00669,3.80926.00269.79075-.00065,1.58179-.0008c.54071,0,.9032.00147,1.19483.00281h.00006c.66668.00281.96325.004,2.19256-.01849a1.19253,1.19253,0,0,0,.68067-.26422.649.649,0,0,0,.14264-.79511.76391.76391,0,0,0-.77582-.48633h0Z"
							style="fill:#b7a39d" />
						<path
							d="M14.48761,17.83289a.87146.87146,0,0,0-.47052-.11481H14.017q-3.35211.00045-6.7041.00043H7.31268q-2.04053.001-4.081-.00013a.86542.86542,0,0,0-.47.11585.79026.79026,0,0,0,.47851,1.44488q1.90412.00687,3.80957.00269.79056-.00065,1.58149-.00067.70605,0,1.41229-.00043,1.97158-.00064,3.94482.00238a.788.788,0,0,0,.64691-.24817.83843.83843,0,0,0,.2118-.405.73826.73826,0,0,0-.06549-.43457A.77373.77373,0,0,0,14.48761,17.83289Z"
							style="fill:#b7a39d" />
						<path
							d="M2.63477,4.9505a.7144.7144,0,0,0-.22828.56116.71916.71916,0,0,0,.23322.55121.99831.99831,0,0,0,.67865.22338L4.795,6.28674h0l1.39063.00037,1.57776-.00037h0l1.28949-.00036a1.03343,1.03343,0,0,0,.70141-.23011.77021.77021,0,0,0-.00671-1.1076,1.073,1.073,0,0,0-.7146-.22418h0l-.4881-.00006-.07055-.00006H8.46924L8.46613,4.7243l-.00458-.00012q-2.56329-.00127-5.12647.00037A1.02876,1.02876,0,0,0,2.63477,4.9505Z"
							style="fill:#b7a39d" />
					</svg>
					Каталог</a></li>
				

				<li class="mob-navigation__link basket-mob-count <? if(is_cart()) {
					echo 'active">'; }
					else { echo '">'; } ?>

					<a href="<? echo wc_get_cart_url(); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 26">
						<path
							d="M27.38477,8.04346a.64969.64969,0,0,0-.23536-.41211.75187.75187,0,0,0-.45019-.15674H24.21875V6.76367a3.87022,3.87022,0,0,0-1.24023-2.80713,4.4131,4.4131,0,0,0-5.957,0,3.8721,3.8721,0,0,0-1.24072,2.80713v.71094H13.29688a.79037.79037,0,0,0-.45118.15723.64921.64921,0,0,0-.23486.41162L10.80566,20.86523a.62456.62456,0,0,0,.02832.29.65148.65148,0,0,0,.15479.248c.23193.23242.456.43945.68408.63184a.70728.70728,0,0,0,.45508.165H27.87207a.71237.71237,0,0,0,.457-.167l.04688-.04a7.25948,7.25948,0,0,0,.63476-.58984.64659.64659,0,0,0,.1543-.24707.613.613,0,0,0,.0293-.292ZM17.15723,7.46533l.01172-.71094a2.5466,2.5466,0,0,1,.82861-1.8706,2.97325,2.97325,0,0,1,2.01709-.78125,2.93241,2.93241,0,0,1,2.0166.78125,2.54527,2.54527,0,0,1,.8291,1.8706v.71094ZM12.395,20.88867l-.18555-.16894,1.68311-11.9336h12.21l1.68359,11.93262-.18945.16992Z"
							style="fill:#b7a39d" />
					</svg>
					Корзина</a>
				
				<? $cart_count = WC()->cart->get_cart_contents_count();
					if (!empty($cart_count)){
						echo '<span> ' .$cart_count .' </span>';
					}

				?>
				
				
				
				</li>


				<li class="mob-navigation__link likelist-mob-count <? if( is_page(24) ) {
				echo 'active">'; }
				else { echo '">'; } ?>

				<a href="<? echo get_permalink(24); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 26">
					<path
						d="M29.33594,4.62451l-.001-.00146a6.34124,6.34124,0,0,0-8.79541-.00049l-.541.519-.53125-.51855a6.34057,6.34057,0,0,0-8.79639.001,6.03593,6.03593,0,0,0,0,8.64063l8.82715,8.68457a.72129.72129,0,0,0,1.00049-.001l8.8374-8.67334a6.06232,6.06232,0,0,0,0-8.65039Zm.32715,4.3501A4.64565,4.64565,0,0,1,28.333,12.28613l-8.33545,8.17578-8.33643-8.17773a4.66185,4.66185,0,0,1-1.04443-1.52979,4.58956,4.58956,0,0,1-.36279-1.80566,4.66938,4.66938,0,0,1,1.416-3.32812,4.85529,4.85529,0,0,1,3.39649-1.38868h.01513a4.82377,4.82377,0,0,1,1.82617.35645,4.73866,4.73866,0,0,1,1.5586,1.02637l1.03027,1.00683a.70122.70122,0,0,0,.22949.15235.71956.71956,0,0,0,.54346,0,.70677.70677,0,0,0,.229-.15137L21.52637,5.6167a4.83753,4.83753,0,0,1,3.32519-1.30762h.05469a4.83271,4.83271,0,0,1,3.34863,1.38281A4.65252,4.65252,0,0,1,29.66309,8.97461Z"
						style="fill:#b7a39d" />
				</svg>	
				Избранное</a>
			
			
					<?udpate_favorites_product_count('header-bottom');?>


			
			
			
			
				</li>


				<li class="mob-navigation__link <? if(is_account_page()) {
					echo 'active">'; }
					else { echo '">'; } ?>


				<a href="<? echo wc_get_page_permalink('myaccount')?>">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 26">
						<path
							d="M29.7002,21.81836H28.2998a8.2998,8.2998,0,1,0-16.5996,0H10.2998a9.7002,9.7002,0,0,1,19.4004,0Z"
							style="fill:#b7a39d" />
						<path
							d="M20,11.18213a4.09107,4.09107,0,1,1,4.09082-4.09131A4.096,4.096,0,0,1,20,11.18213Zm0-6.78174a2.69068,2.69068,0,1,0,2.69043,2.69043A2.69362,2.69362,0,0,0,20,4.40039Z"
							style="fill:#b7a39d" />
					</svg>
					Профиль</a></li>
				
			</ul>
		</div>
		<div class="header__wrapper">
			<?desktop_header_main_nav_menu();?>   
			<div class="header__logo">
				<? 
					if (is_page(2)) {
					?>
						<div class="logo"><img src="<? $custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' )); echo $custom_logo__url[0];  ?>" alt="textile-logo"></div>
					<?

					} else { ?>
						<a class="logo" href="<? echo home_url(); ?>">
						<img src="<? $custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' )); echo $custom_logo__url[0];  ?>" alt="textile-logo"></a> 
					<?
					}
				?>        
			</div>
			<div class="header__menu">
				<div class="header__callback">
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
								echo '<a href="tel:+' . $main_office_tel .'">' . $main_office_tel_all . '</a>';
							}
						}
					?>
					<button id="btn-modal-call">
						<span class="header__callback_icon">
							<img src="<?=get_template_directory_uri(); ?>/assets/icons/menu-call.svg" alt="menu-call">
						</span>
						<span class="header__callback_text">
							Заказать звонок
						</span>
					</button>
				</div>
				<div class="header__icon">
					<a class="header__menu_account" href="<?=wc_get_page_permalink('myaccount')?>"><img src="<?=get_template_directory_uri(); ?>/assets/icons/icon-men.svg" alt="icon-menu"></a>


					<a class="header__menu_favourites" href="<?=get_the_permalink(24);?>">
						<img src="<?=get_template_directory_uri(); ?>/assets/icons/icon-like.svg" alt="icon-like">
						<?udpate_favorites_product_count('header');?>
					</a>

					<!-- Обвертка для вывода кнопки корзины со счетчиком -->
					
					<a class="header__menu_basket desktop" href="<?= wc_get_cart_url(); ?>"><img src="<?=get_template_directory_uri(); ?>/assets/icons/icon-card.svg" alt="icon-cart"></a>


				</div>
				<button id="btn-burger"></button>
			</div>
		</div>
		
	</section>
	<section class="burger-wrapper">
		<div class="burger">
			<div class="burger__header">
				<span class="icon-close"></span>
				<a class="header__menu_account text-min" href="<?=wc_get_page_permalink('myaccount')?>"><img src="<?=get_template_directory_uri(); ?>/assets/icons/icon-men.svg" alt="icon-menu">Личный кабинет</a>
				<a class="header__menu_favourites text-min" href="<?=get_site_url(); ?>/izbrannye-tovary"><img src="<?=get_template_directory_uri(); ?>/assets/icons/icon-like.svg" alt="icon-like">Избранное</a>
				<a class="header__menu_basket text-min" href="<?=wc_get_cart_url(); ?>"><img src="<?=get_template_directory_uri(); ?>/assets/icons/icon-card.svg" alt="icon-card"><span>Корзина</span></a>
			</div>
			
			<div class="burger__main">
				<div class="burger__catalog">
					<div class="text-min">Меню:</div>
					<?mobile_header_main_nav_menu(); ?>   
				</div>
				<div class="burger__catalog">
					<div class="text-min">Категории Каталога:</div>
					<?mobile_header_catalog_nav_menu();?>   
				</div>
			</div>
			<div class="burger__footer">
				<div class="burger__footer_wrapper">
					<div class="burger-footer__icon icon-tel-nav">
						<? echo '<a href="tel:+' . $main_office_tel .'">' . $main_office_tel_all . '</a>'; ?>
					</div>
					<div class="burger-footer__icon">
						<? $site_email = get_option('admin_email'); 
							echo '<a class="text icon-mail-nav" href="mailto:'. $site_email .'">'. $site_email .'</a>';
						?>
					</div>
					<?
						$yandekskartys = get_field('contacts-yandekskarty', 27);
						foreach($yandekskartys as $yandekskarty) {
							$main_office = $yandekskarty['contacts-tip']['value'];
							if ($main_office == 'main-office') {
								$main_office_addr = $yandekskarty['contacts-indeks'] . ', ' . $yandekskarty['contacts-gorod'] . ', ' . $yandekskarty['contacts-adres'];
								$main_office_addr_2gis = $yandekskarty['contacts-2gis'];
							}
						}
						echo '<a class="burger-footer__icon text icon-map-nav" href="'.$main_office_addr_2gis.'" target="_blank">'.$main_office_addr.'</a>';
					?>
				</div>
				<?get_template_part('components/socials/socials', 'header');?>
			</div>
		</div>
	</section>
	<?desktop_header_catalog_nav_menu();?>
</header>
<?
	if (is_product()) {
		echo '<div id="message-wrapper" class="message-wrapper-product"></div>';
	}
	else {
		echo '<div id="message-wrapper"></div>';
	}
?>
<main>