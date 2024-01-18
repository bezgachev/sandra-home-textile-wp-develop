<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'woocommerce_before_main_content', 'container_remark', 25 ); //добавляем какой-то контент до начала показа каталога
function container_remark() {
	$min_cart_amount = get_theme_mod('my_wc_custom_section_settings');
	$min_cart_amount_int = (int)$min_cart_amount;
	$min_cart_amount_int_space = number_format($min_cart_amount_int, 0, '', '&nbsp;');
	?>
	
	<section class="container remark">Внимание! Уважаемые покупатели, минимальная сумма заказа <?php echo $min_cart_amount_int_space; ?>&nbsp;₽. Учитывайте это, когда будете делать покупки. Спасибо за понимание.</section>
	<section class="container catalog">

		<?php
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) &&  is_plugin_active( 'woocommerce-products-filter/index.php' )) {

			// $term = get_queried_object(); $slug = $term->slug;
			if( is_product_category() ) {
				$term = get_queried_object(); $slug = $term->slug;
				?>
				<div class="catalog__sidebar sidebar" data-cat="<?php echo $slug; ?>">
					<?php
			} else { ?><div class="catalog__sidebar sidebar"><?php } ?>
					<div class="sidebar-mob">
						<h3>Фильтры</h3>
						<button class="btn-close__filter type1">Отмена</button>
						<div class="catalog__nav_filter"></div>
					</div>
					<?php echo do_shortcode('[woof]');?>
					
					<button id="reset_filter" class="d-hide">Сбросить фильтры</button>
					<div class="apply_filter sidebar-mob"><button>Применить фильтр</button></div>
					<a href="" data-tax="price" id="reset-filter-price" class="d-hide"><span class="woof_remove_ppi"></span></a>
					


				</div>
		<?php		
		}
		?>
				
	<div class="catalog__wrapper">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="title-h1 title-catalog" ><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>
		
		<div class="catalog__nav">
			<button class="btn__filter">
				<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M16.2207 11.1248L16.1785 10.9328H4.73847C4.46566 10.9328 4.24446 10.7116 4.24446 10.4388C4.24446 10.166 4.46566 9.94482 4.73847 9.94482H16.1787L16.221 9.75291C16.5362 8.3205 17.8177 7.24446 19.341 7.24446C20.8633 7.24446 22.1455 8.32069 22.4609 9.75294L22.5032 9.94482H26.8926C27.1654 9.94482 27.3866 10.166 27.3866 10.4388C27.3866 10.7116 27.1654 10.9328 26.8926 10.9328H22.5034L22.4612 11.1249C22.1464 12.5578 20.8663 13.6333 19.341 13.6333C17.8157 13.6333 16.5355 12.5578 16.2207 11.1248ZM17.3792 10.4328L17.3791 10.4408L17.3791 10.4435C17.3815 11.5232 18.2607 12.4008 19.341 12.4008C20.4217 12.4008 21.3012 11.5223 21.3029 10.442L21.3027 10.4311C21.2981 9.35314 20.418 8.47699 19.341 8.47699C18.2624 8.47699 17.3824 9.35434 17.3792 10.4328Z"
						fill="#786453" />
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M15.4104 18.141L15.4526 18.333H26.8926C27.1654 18.333 27.3866 18.5542 27.3866 18.827C27.3866 19.0998 27.1655 19.321 26.8926 19.321H15.4524L15.4101 19.5129C15.0949 20.9453 13.8134 22.0214 12.2901 22.0214C10.7678 22.0214 9.48567 20.9451 9.17021 19.5129L9.12794 19.321H4.73847C4.46565 19.321 4.24446 19.0998 4.24446 18.827C4.24446 18.5542 4.46566 18.333 4.73847 18.333H9.12768L9.16987 18.141C9.48467 16.7081 10.7648 15.6326 12.2901 15.6326C13.8154 15.6326 15.0956 16.7081 15.4104 18.141ZM14.2519 18.833L14.252 18.8251L14.252 18.8224C14.2496 17.7427 13.3704 16.8651 12.2901 16.8651C11.2093 16.8651 10.3299 17.7435 10.3282 18.824L10.3284 18.8348C10.333 19.9127 11.2131 20.7888 12.2901 20.7888C13.3687 20.7888 14.2487 19.9115 14.2519 18.833Z"
						fill="#786453" />
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M4.73847 11.1773H15.9819C16.3208 12.7197 17.6982 13.8777 19.341 13.8777C20.9837 13.8777 22.3611 12.7198 22.7 11.1773H26.8926C27.3005 11.1773 27.6311 10.8467 27.6311 10.4388C27.6311 10.031 27.3005 9.70036 26.8926 9.70036H22.6996C22.3601 8.15871 20.9808 7 19.341 7C17.7003 7 16.3216 8.15852 15.9822 9.70036H4.73847C4.33065 9.70036 4 10.031 4 10.4388C4 10.8467 4.33065 11.1773 4.73847 11.1773ZM16.1785 10.9328L16.2207 11.1248C16.5355 12.5578 17.8157 13.6333 19.341 13.6333C20.8663 13.6333 22.1464 12.5578 22.4612 11.1249L22.5034 10.9328H26.8926C27.1654 10.9328 27.3866 10.7116 27.3866 10.4388C27.3866 10.166 27.1654 9.94482 26.8926 9.94482H22.5032L22.4609 9.75294C22.1455 8.32069 20.8633 7.24446 19.341 7.24446C17.8177 7.24446 16.5362 8.3205 16.221 9.75291L16.1787 9.94482H4.73847C4.46566 9.94482 4.24446 10.166 4.24446 10.4388C4.24446 10.7116 4.46566 10.9328 4.73847 10.9328H16.1785Z"
						fill="#786453" />
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M26.8926 18.0885H15.6492C15.3103 16.5461 13.9329 15.3882 12.2901 15.3882C10.6474 15.3882 9.26997 16.5461 8.9311 18.0885H4.73847C4.33065 18.0885 4 18.4192 4 18.827C4 19.2349 4.33065 19.5655 4.73847 19.5655H8.93147C9.27103 21.1071 10.6503 22.2658 12.2901 22.2658C13.9308 22.2658 15.3095 21.1073 15.6489 19.5655H26.8926C27.3005 19.5655 27.6311 19.2349 27.6311 18.827C27.6311 18.4192 27.3005 18.0885 26.8926 18.0885ZM15.4526 18.333L15.4104 18.141C15.0956 16.7081 13.8154 15.6326 12.2901 15.6326C10.7648 15.6326 9.48467 16.7081 9.16987 18.141L9.12768 18.333H4.73847C4.46566 18.333 4.24446 18.5542 4.24446 18.827C4.24446 19.0998 4.46565 19.321 4.73847 19.321H9.12794L9.17021 19.5129C9.48567 20.9451 10.7678 22.0214 12.2901 22.0214C13.8134 22.0214 15.0949 20.9453 15.4101 19.5129L15.4524 19.321H26.8926C27.1655 19.321 27.3866 19.0998 27.3866 18.827C27.3866 18.5542 27.1654 18.333 26.8926 18.333H15.4526Z"
						fill="#786453" />
				</svg>
			</button>
			<div class="catalog__nav_filter worker"></div>
				<?php if ( apply_filters( 'woocommerce_catalog_ordering', true ) ) : ?>
					<?php woocommerce_catalog_ordering(); ?>
				<?php endif; ?>
		</div>
<?php
}




//Создаем фильтрацию сортировки для новинок
add_filter( 'woocommerce_get_catalog_ordering_args', 'woo_catalog_ordering_new' );
function woo_catalog_ordering_new( $args ) {
    $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    if ( 'new' == $orderby_value ) {
        $args['orderby'] = ['date' => 'DESC'];
		$args['order'] = 'DESC';
        $args['meta_key'] = '_price';
    }
    return $args;
};

//Создаем фильтрацию сортировки для акций
add_filter( 'woocommerce_get_catalog_ordering_args', 'woo_catalog_ordering_sale' );
function woo_catalog_ordering_sale( $args ) {
	$orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	if ( 'sale' == $orderby_value ) {
		$args = [
			'orderby'  => 'meta_value_num',
			'meta_key' => '_sale_price',
			'order'    => 'ASC',
		];
	}
	return $args;
}

//Добавляем возможность фильтрации new, sale интеграцию в woof filter
add_filter('woof_order_catalog', function($args){
    $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    if ( 'new' == $orderby_value ) {
        $args['orderby'] = ['date' => 'DESC'];
		$args['order'] = 'DESC';
        $args['meta_key'] = '_price';
    }
	if ( 'sale' == $orderby_value ) {
		$args = [
			'orderby'  => 'meta_value_num',
			'meta_key' => '_sale_price',
			'order'    => 'ASC',
		];
	}


    if ('price' == $orderby_value) {
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        $args['meta_key'] = '_price';
    }

    if ('price-desc' == $orderby_value) {
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        $args['meta_key'] = '_price';
    }

	return $args;
});




add_filter( 'woocommerce_default_catalog_orderby_options', 'woocust_catalog_orderby' ); // выводим сортировку свою, лишнее удаляем
add_filter('woocommerce_catalog_orderby', 'woocust_catalog_orderby'); // выводим сортировку свою, лишнее удаляем
function woocust_catalog_orderby($sortby) {
	unset($sortby['menu_order']); // удаляем
	unset($sortby['rating']);
	unset($sortby['date']);
	unset($sortby['popularity']);
	unset($sortby['price']);
	unset($sortby['price-desc']);

	//Заново сортируем свой порядок и свое название для option сортировки
	$sortby['popularity'] = 'Популярности';
	$sortby['new'] = 'Новинке';
	$sortby['price'] = 'Цене дешевле';
	$sortby['price-desc'] = 'Цене дороже';
	$sortby['sale'] = 'Акции';
	return $sortby;
	//Стандартные option
    // [menu_order] => Исходная сортировка
    // [popularity] => По популярности
    // [rating] => По рейтингу
    // [date] => Сортировка от последнего
    // [price] => Цены: по возрастанию
    // [price-desc] => Цены: по убыванию

}




//Удаляем все хуки в content-product


//Привязываем к хуку content-product нашу верстку карточки товара в архиве, чтобы использовать один шаблон везде
add_action('woocommerce_before_shop_loop_item', 'product_card', 15);
function product_card() {
	$product_id = get_the_id();
	$product_url = get_the_permalink();
	$params = [
		'product_id' => $product_id,
		'product_url' => $product_url,
		'wrapper_class' => 'card swiper-slide',
		'item_slide_tag' => 'div',
		'gallerys' => true,
		'image_size' => 'woo-page-product',
		'location_page' => null
	];
	get_template_part('components/product-card/product-card', null, $params);
}


/*
function product_card() {
	?>
		<div class="card__slider swiper-container">
			<div class="card-container swiper">
				<div class="card-wrapper swiper-wrapper">
					<!-- Слайдер в слайдере -->

					<?php
						global $product;
						$attachment_ids = $product->get_gallery_attachment_ids();

						if (is_product() ) {
							echo '<div class="card-slide swiper-slide">';
							$img_thumb = get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', $attributes );
							if (empty($img_thumb)) {
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
								echo $thumbnail;
							}
							else {
								echo $img_thumb;
							}

							echo '</div>';



						




						} 
						else if ( is_cart()) {
							echo '<a href="'.get_the_permalink().'" class="card-slide swiper-slide">';
							// get_the_permalink()

							$img_thumb = get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', $attributes );
							if (empty($img_thumb)) {
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
								echo $thumbnail;
							}
							else {
								$img_src = get_the_post_thumbnail_url( $post->ID, 'woo-mini-catalog', false ); //подключаем вывод превью изоображения товара
								echo '<img data-src="' . esc_url($img_src) . '" data-test="test" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
							}
							echo '</a>';


						}
						
						
						
						
						else {
							// echo '<div class="card-slide swiper-slide">';
							echo '<a href="'.get_the_permalink().'" class="card-slide swiper-slide">';
							// get_the_permalink()

							$img_thumb = get_the_post_thumbnail( $product->ID, 'woo-thumbnail-product');
							if (empty($img_thumb)) {
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
								echo $thumbnail;
							}
							else {
								$img_src = get_the_post_thumbnail_url( $product->ID, 'woo-mini-catalog', false ); //подключаем вывод превью изоображения товара
								echo '<img data-src="' . esc_url($img_src) . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
							}
							echo '</a>';
							
							// echo '</div>';

							foreach( $attachment_ids as $attachment_id ) {
								//echo '<div class="card-slide swiper-slide">';
								echo '<a href="'.get_the_permalink().'" class="card-slide swiper-slide">';
								$img_src = wp_get_attachment_image_src( $attachment_id, 'woo-mini-catalog', false );
								echo '<img width="' . $img_src[1] . '" height="' . $img_src[2] . '" data-src="' . $img_src[0] . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
								echo '</a>';
								//echo '</div>';
							}
						}
			
					?>

				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>

		<div class="card__control control">

		<?php 
			if( empty( $_COOKIE[ 'sht_woo_likelist_product' ] ) ) {
				$like_products = array();
			} else {
				$like_products = (array) explode( '|', $_COOKIE[ 'sht_woo_likelist_product' ] );
			}
			if ( ! in_array( get_the_id(), $like_products ) ) {
				$like_products[] = $product_id_like;
				echo '<div class="card__control_like"></div>';
			} else {
				if (is_page('izbrannye-tovary')) {
					echo '<div class="card__control_like active" data-page="likelist"></div>';
				}
				else {
					echo '<div class="card__control_like active"></div>';
				}
			}
		?>


			<div class="card__control_hover control__hover">
				<span class="control__hover_asset">в наличии</span>

				<?php 
					if( empty( $_COOKIE[ 'sht_woo_likelist_product' ] ) ) {
						$like_products = array();
					} else {
						$like_products = (array) explode( '|', $_COOKIE[ 'sht_woo_likelist_product' ] );
					}
					if ( ! in_array( get_the_id(), $like_products ) ) {
						$like_products[] = $product_id_like;
						echo '<div class="control__hover_like">Добавить в избранное</div>';
					} else {
						if (is_page('izbrannye-tovary')) {
							echo '<div class="control__hover_like active" data-page="likelist">Добавлено в избранное</div>';
						}
						else {
							echo '<div class="control__hover_like active">Добавлено в избранное</div>';
						}

					}
				?>

				<input type="hidden" name="product_id" value="<?php echo get_the_id();?>">
				<input type="hidden" name="quantity" value="1">
				<div class="control__hover_btn add-to-cart-product-js"></div>
				<a class="control__hover_link" href="<?php echo get_the_permalink(); ?>"></a>
			</div>
			<div class="card__control_dots"></div>
		</div>
		<div class="card__descr descr-card">


			<a class="descr-card__title" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
			<div class="descr-card__subtitle">
				<?php
					$attribute_sizes = array( 'razmer-pokryvala', 'razmer-pledy', 'razmer-shtory', 'razmer-chehly-dlya-mebeli', 'razmer-postelnoe-belyo' );
					$material = $product->get_attribute('material');
					$color = $product->get_attribute('czvet');
					$price = get_post_meta( get_the_ID(), '_regular_price', true); // основная цена товара
					$sale = get_post_meta( get_the_ID(), '_sale_price', true); 	//цена со скидкой
					$price_space = number_format((int)$price, 0, '', '&nbsp;');
					$sale_space = number_format((int)$sale, 0, '', '&nbsp;');
					foreach ( $attribute_sizes as $attribute_size ) {
						$razmer = $product->get_attribute( $attribute_size );
						if (!empty($razmer)) {
							echo ''. $razmer . ', ';
						}
					}
					if (!empty($material)) {
						echo '' . $material . ', ';
					} if (!empty($color)) {
						echo '' . $color;
					}
				?>
			</div>

			<div class="descr-card__priсe">
				<?php if (!empty($sale)){ ?> <!-- если нет цены со скидкой выводим основную цену -->
					<div class="descr-card__priсe_normal nowrap">
						<?php echo ''. $sale_space .'&nbsp;₽'; ?>
					</div>
					<div class="descr-card__priсe_dash nowrap dash">
						<?php echo ''. $price_space .'&nbsp;₽'; ?>
					</div><?php
				} else { ?> <!-- иначе, если есть цена со скидкой выводим все виды цен -->
					<div class="descr-card__priсe_normal nowrap">
						<?php echo ''. $price_space .'&nbsp;₽'; ?>
					</div><?php
				}?>
			</div>
			<div class="descr-card__cart add-to-cart-product-js"></div>

		</div>
	<?php
}



*/







/*
function product_card() {
	?>
		<div class="card__slider swiper-container">
			<div class="card-container swiper">
				<div class="card-wrapper swiper-wrapper">
					<!-- Слайдер в слайдере -->

					<?php
						global $product;
						$attachment_ids = $product->get_gallery_attachment_ids();

						if (is_product() ) {
							echo '<div class="card-slide swiper-slide">';
							$img_thumb = get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', $attributes );
							if (empty($img_thumb)) {
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
								echo $thumbnail;
							}
							else {
								echo $img_thumb;
							}

							echo '</div>';



						




						} 
						else if ( is_cart()) {
							echo '<a href="'.get_the_permalink().'" class="card-slide swiper-slide">';
							// get_the_permalink()

							$img_thumb = get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', $attributes );
							if (empty($img_thumb)) {
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
								echo $thumbnail;
							}
							else {
								$img_src = get_the_post_thumbnail_url( $post->ID, 'woo-mini-catalog', false ); //подключаем вывод превью изоображения товара
								echo '<img data-src="' . esc_url($img_src) . '" data-test="test" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
							}
							echo '</a>';


						}
						
						
						
						
						else {
							// echo '<div class="card-slide swiper-slide">';
							echo '<a href="'.get_the_permalink().'" class="card-slide swiper-slide">';
							// get_the_permalink()

							$img_thumb = get_the_post_thumbnail( $product->ID, 'woo-thumbnail-product');
							if (empty($img_thumb)) {
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
								echo $thumbnail;
							}
							else {
								$img_src = get_the_post_thumbnail_url( $product->ID, 'woo-mini-catalog', false ); //подключаем вывод превью изоображения товара
								echo '<img data-src="' . esc_url($img_src) . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
							}
							echo '</a>';
							
							// echo '</div>';

							foreach( $attachment_ids as $attachment_id ) {
								//echo '<div class="card-slide swiper-slide">';
								echo '<a href="'.get_the_permalink().'" class="card-slide swiper-slide">';
								$img_src = wp_get_attachment_image_src( $attachment_id, 'woo-mini-catalog', false );
								echo '<img width="' . $img_src[1] . '" height="' . $img_src[2] . '" data-src="' . $img_src[0] . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
								echo '</a>';
								//echo '</div>';
							}
						}
			
					?>

				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>

		<div class="card__control control">

		<?php 
			if( empty( $_COOKIE[ 'sht_woo_likelist_product' ] ) ) {
				$like_products = array();
			} else {
				$like_products = (array) explode( '|', $_COOKIE[ 'sht_woo_likelist_product' ] );
			}
			if ( ! in_array( get_the_id(), $like_products ) ) {
				$like_products[] = $product_id_like;
				echo '<div class="card__control_like"></div>';
			} else {
				if (is_page('izbrannye-tovary')) {
					echo '<div class="card__control_like active" data-page="likelist"></div>';
				}
				else {
					echo '<div class="card__control_like active"></div>';
				}
			}
		?>


			<div class="card__control_hover control__hover">
				<span class="control__hover_asset">в наличии</span>

				<?php 
					if( empty( $_COOKIE[ 'sht_woo_likelist_product' ] ) ) {
						$like_products = array();
					} else {
						$like_products = (array) explode( '|', $_COOKIE[ 'sht_woo_likelist_product' ] );
					}
					if ( ! in_array( get_the_id(), $like_products ) ) {
						$like_products[] = $product_id_like;
						echo '<div class="control__hover_like">Добавить в избранное</div>';
					} else {
						if (is_page('izbrannye-tovary')) {
							echo '<div class="control__hover_like active" data-page="likelist">Добавлено в избранное</div>';
						}
						else {
							echo '<div class="control__hover_like active">Добавлено в избранное</div>';
						}

					}
				?>

				<input type="hidden" name="product_id" value="<?php echo get_the_id();?>">
				<input type="hidden" name="quantity" value="1">
				<div class="control__hover_btn add-to-cart-product-js"></div>
				<a class="control__hover_link" href="<?php echo get_the_permalink(); ?>"></a>
			</div>
			<div class="card__control_dots"></div>
		</div>
		<div class="card__descr descr-card">


			<a class="descr-card__title" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
			<div class="descr-card__subtitle">
				<?php
					$attribute_sizes = array( 'razmer-pokryvala', 'razmer-pledy', 'razmer-shtory', 'razmer-chehly-dlya-mebeli', 'razmer-postelnoe-belyo' );
					$material = $product->get_attribute('material');
					$color = $product->get_attribute('czvet');
					$price = get_post_meta( get_the_ID(), '_regular_price', true); // основная цена товара
					$sale = get_post_meta( get_the_ID(), '_sale_price', true); 	//цена со скидкой
					$price_space = number_format((int)$price, 0, '', '&nbsp;');
					$sale_space = number_format((int)$sale, 0, '', '&nbsp;');
					foreach ( $attribute_sizes as $attribute_size ) {
						$razmer = $product->get_attribute( $attribute_size );
						if (!empty($razmer)) {
							echo ''. $razmer . ', ';
						}
					}
					if (!empty($material)) {
						echo '' . $material . ', ';
					} if (!empty($color)) {
						echo '' . $color;
					}
				?>
			</div>

			<div class="descr-card__priсe">
				<?php if (!empty($sale)){ ?> <!-- если нет цены со скидкой выводим основную цену -->
					<div class="descr-card__priсe_normal nowrap">
						<?php echo ''. $sale_space .'&nbsp;₽'; ?>
					</div>
					<div class="descr-card__priсe_dash nowrap dash">
						<?php echo ''. $price_space .'&nbsp;₽'; ?>
					</div><?php
				} else { ?> <!-- иначе, если есть цена со скидкой выводим все виды цен -->
					<div class="descr-card__priсe_normal nowrap">
						<?php echo ''. $price_space .'&nbsp;₽'; ?>
					</div><?php
				}?>
			</div>
			<div class="descr-card__cart add-to-cart-product-js"></div>

		</div>
	<?php
}
*/