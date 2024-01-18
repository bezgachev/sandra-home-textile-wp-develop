<?php
/*
Template Name: О компании
Template Post Type: page
*/

?>
<?php get_header(); ?>
<section class="about">
		<div class="container">
			<h1 class="title-h1">О компании</h1>
			<div class="about__items">
				<div class="about__item">
					<div class="about__item_descr about-descr">
						<h3 class="about-descr__title title-h3">
							<?php $about_blocks = get_field('about-blocks');
							echo $about_blocks['one-block-h3']; ?>
						</h3>
						<div class="about-descr__text">
							<?php
								$paragraph_ones = $about_blocks['one-block-p'];
								if($paragraph_ones) {
									foreach($paragraph_ones as $paragraph_one) {
										$paragraph_one_text = $paragraph_one['one-block-p-text'];
										echo '<p class="text">' . $paragraph_one_text .'</p><br>';
									}
								}
							?>
						</div>
					</div>
					<div class="sticky">
						<div class="swiper about__item_slider about-slider">
							<div class="swiper-wrapper">
								<?php 
									$slider_ones = $about_blocks['one-block-slider'];
									if($slider_ones) {
										foreach($slider_ones as $slider_one) {
											echo '<div class="about-slider__item swiper-slide"><img src="'.$slider_one.'" alt="О компании, производство"></div>';
										}
									}
								?>
							</div>
						</div>
						<div class="about-slider__nav">
							<div class="about-prev"></div>
							<div class="about-pagination"></div>
							<div class="about-next"></div>
						</div>
					</div>
				</div>
				<div class="about__item">
					<?php $block_one_img = $about_blocks['one-block-img']; ?>
					<div class="about__item_img"><img src="<?php echo $block_one_img;?>" alt=""></div>
					<h3 class="title-h3"><?php echo $about_blocks['two-block-h3']; ?></h3>
					<div class="about-descr__text">
						<?php
							$paragraph_twos = $about_blocks['two-block-p'];
							if($paragraph_twos) {
								foreach($paragraph_twos as $paragraph_two) {
									$paragraph_two_text = $paragraph_two['two-block-p-text'];
									echo '<p class="text">' . $paragraph_two_text .'</p><br>';
								}
							}
						?>		
						<div class="about-descr__img">
							<?php
								$two_block_imgs = $about_blocks['two-block-imgs'];
								if($two_block_imgs) {
									foreach($two_block_imgs as $two_block_img) {
										echo '<div><img src="'.$two_block_img.'" alt="О компании, производство"></div>';
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="aesthetics">
				<?php $block_three_img = $about_blocks['three-block-img']; ?>
				<div class="aesthetics__img"><img src="<?php echo $block_three_img; ?>" alt="О компании, производство"></div>
				<div class="aesthetics__text">
					<h3 class="title-h3 aesthetics__text_title"><?php echo $about_blocks['three-block-h3']; ?></h3>
					<div class="aesthetics__text_descr">
						<?php
							$paragraph_threes = $about_blocks['three-block-p'];
							if($paragraph_threes) {
								foreach($paragraph_threes as $paragraph_three) {
									$paragraph_three_text = $paragraph_three['three-block-p-text'];
									echo '<p class="text">' . $paragraph_three_text .'</p><br>';
								}
							}
						?>	
					</div>
				</div>
			</div>
			<div class="about-skill">
				<div class="about-skill__text">
					<div class="about-skill__text_title title-h3"><?php echo $about_blocks['four-block-h3']; ?></div>
					<div class="about-skill__text_descr text">
						<?php
							$paragraph_fours = $about_blocks['four-block-p'];
							if($paragraph_fours) {
								foreach($paragraph_fours as $paragraph_four) {
									$paragraph_fours_text = $paragraph_four['four-block-p-text'];
									echo '<p class="text">' . $paragraph_fours_text .'</p><br>';
								}
							}
						?>	
					</div>
				</div>
				<?php $block_four_img = $about_blocks['four-block-img']; ?>
				<div class="about-skill__picture"><img src="<?php echo $block_four_img; ?>" alt="О компании, производство"></div>
				<div class="about-skill__pictures">
					<?php
						$four_block_imgs = $about_blocks['four-block-imgs'];
						if($four_block_imgs) {
							foreach($four_block_imgs as $four_block_img) {
								echo '<div class="about-skill__pictures_img"><img src="'.$four_block_img.'" alt="О компании, производство"></div>';
							}
						}
					?>
				</div>
			</div>
		</div>
	</section>
	<section class="about-trigger">
		<div class="about-trigger__content">
			<div class="container">
				<div class="about-trigger__items">
					<div class="about-trigger__item">
						<h3 class="about-trigger__item_title title-h3">Собственное производство</h3>
						<div class="text about-trigger__item_text">Гарантируем высокое качество пошива, проходящего
							строжайший ОТК</div>
					</div>
					<div class="about-trigger__item">
						<h3 class="title-h3 about-trigger__item_title">Доставляем <br> по всей России</h3>
						<div class="text about-trigger__item_text">Быстрая обработка и отправка заказов в любую точку
							России</div>
					</div>
					<div class="about-trigger__item">
						<h3 class="title-h3 about-trigger__item_title">350+ авторских <br> изделий</h3>
						<div class="text about-trigger__item_text">Работаем с физическими и юридическими лицами</div>
					</div>
					<div class="about-trigger__item">
						<h3 class="title-h3 about-trigger__item_title">Оптовые цены без посредников</h3>
						<div class="text about-trigger__item_text">Работаем с физическими и юридическими лицами</div>
					</div>
					<div class="about-trigger__item">
						<h3 class="title-h3 about-trigger__item_title">На рынке более <br> 10 лет</h3>
						<div class="text about-trigger__item_text">Работаем с физическими и юридическими лицами</div>
					</div>
					<div class="about-trigger__item">
						<h3 class="title-h3 about-trigger__item_title">Являемся поставщиком для турецких фабрик</h3>
						<div class="text about-trigger__item_text">Работаем с физическими и юридическими лицами</div>
					</div>
				</div>
			</div>
		</div>
		<div class="about-trigger__img"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-trigger.jpg" alt=""></div>
	</section>
<section class="first-catalog container">
	<h2 class="title first-catalog__title">“Sandra Home Textile” – домашний текстиль «премиум» класса от Ивановского производителя</h2>
		<?php wp_nav_menu(array(
			'theme_location'  => 'catalog-main',
			'menu_id'      => false,
			'container'       => false, 
			'container_class' => false, 
			'menu_class'      => false,
			'items_wrap'      => '<div class="first-catalog__items">%3$s</div>',
			'order' => 'ASC',      
			'walker' => new catalog_main()   
		)); ?> 
</section>
<?php 
$certificates_on = get_field('certificates-on');
if ($certificates_on === 'on') { ?>
	<section class="certified">
		<div class="container certified__wrapper">
			<h2 class="title certified__title">сертифицированная продукция</h2>
			<div class="swiper certified__catalog">
				<div class="swiper-wrapper">
					<?php
						$certificates_imgs = get_field('certificates-imgs');
						if($certificates_imgs) {
							foreach($certificates_imgs as $certificates_img) {
								echo '<div class="certified__catalog_img swiper-slide"><img src="'.$certificates_img.'" alt="Сертификаты компании"></div>';
							}
						}
					?>
				</div>
				<div class="certified-pagination"></div>
			</div>
		</div>
	</section>
<?php } ?>
<?php get_footer(); ?>