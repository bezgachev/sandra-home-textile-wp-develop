<?php
/*
Template Name: Политика конфиденциальности
Template Post Type: page
*/
?>
<?php get_header(); ?>
<div class="client">
	<h1 class="title-h1 client__title"><?php the_title(); ?></h1>
	<div class="container client__wrapper">
		<section class="client__container privacy-policy">
			<?php the_content(); ?>
		</section>
	</div>
</div>
<?php get_footer(); ?>