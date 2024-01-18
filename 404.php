<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package weblitex
 */

get_header();
?>

<div class="container">
	<div class="no-page">
		<div class="no-page__decsr">
			<h1 class="no-page__decsr_title">Страница не найдена</h1>
			<p class="no-page__decsr_text">
				К сожалению, такая страница не существует.
			</p>
			<p class="no-page__decsr_text">
				Вероятно, она была удалена, <br> либо её здесь никогда&nbsp;не&nbsp;было
			</p>
			<a href="<?php echo get_site_url(); ?>" class="btn">Вернуться на главную</a>
		</div>
		<div class="no-page__img">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/404.png" alt="404">
		</div>
	</div>
</div>

<?
get_footer();