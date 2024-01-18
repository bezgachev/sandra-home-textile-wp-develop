<?php
/*
Template Name: Условия сотрудничества
Template Post Type: page
*/
?>
<?php get_header(); ?>
<div class="client">
	<h1 class="title-h1 client__title"><?php the_title(); ?></h1>
	<div class="container client__wrapper">
		<section class="client__container">
			<?php the_content(); ?>
		</section>
		<button class="title-h3 client__nav_btn">Навигация</button>
		<div class="client__nav">
			<button class="client__nav_esc"></button>
			<div class="title-h3 client__nav_title">Быстрая Навигация:</div>
			<ul class="client__nav_links">
				<li class="client__nav_link active"><a href="<?php echo get_permalink(34); ?>" class="text">Условия сотрудничества</a></li>
				<li class="client__nav_link"><a href="<?php echo get_permalink(22); ?>" class="text"><span>Доставка и оплата</span></a></li>
				<li class="client__nav_link"><a href="<?php echo get_permalink(18); ?>" class="text"><span>Возврат и обмен</span></a></li>
				<li class="client__nav_link"><a href="<?php echo get_permalink(20); ?>" class="text"><span>Вопросы и ответы</span></a></li>
			</ul>
		</div>
	</div>
</div>
<?php get_footer(); ?>