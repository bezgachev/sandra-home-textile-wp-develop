<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'woocommerce_before_single_product_summary', 'product_single_content', 70 );
function product_single_content() {
	get_template_part('components/product-single/product-single');
}



//add_action( 'woocommerce_before_single_product_summary', 'woo_product_images', 25 ); //вставляем свою верстку и слайдер swiper для показа изоображений товара
function woo_product_images() {
?>
<div class="product__body">
	<div class="product__body_slider">
		<div class="product-slider">

			<!-- Миниатюры. Превью. Thumbs -->
			<div class="product-slider__wrapper-vertical">

				<div class="button-mini-prev"></div>
				<div class="button-mini-next"></div>
				<div class="image-mini-slider swiper-container">
					<div class="image-mini-slider__wrapper swiper-wrapper">
					<?
						// global $product;
						// $product_id = get_the_id();
						// $product_url = get_the_permalink();
						// $params = [
						// 	'product_id' => $product_id,
						// 	'product_url' => $product_url,
						// 	'wrapper_class' => 'card',
						// 	'item_slide_tag' => 'div',
						// 	'gallerys' => true,
						// 	'image_size' => 'woo-page-product'		
						// ];

						//get_template_part('components/product-card/product-card', null, $params);
						// global $product;
						
						// $img_thumb = get_the_post_thumbnail( $product->ID, 'woo-thumbnail-product');
						// $img_thumb_default = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
						// $video_id = $product->get_meta( '_text_field_videoid', true );
						// $img_gallerys = $product->get_gallery_attachment_ids();

						// 	empty($img_thumb) ? $url_bgc = $img_thumb_default : $url_bgc = $img_thumb;
							

						// if ($video_id) {
						// 	echo '<div class="image-mini-slider__slide swiper-slide slide-video"><div class="image-mini-slider__image">';
						// 	if (empty($img_thumb)) {
						// 		$url_bgc = $thumbnail;
						// 		echo $url_bgc;
						// 	}
						// 	else {
						// 		$url_bgc = $img_thumb;
						// 		echo $url_bgc;
						// 	}
						// 	echo '</div></div>';
						// }

						// echo '<div class="image-mini-slider__slide swiper-slide"><div class="image-mini-slider__image">';
						// //echo get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', false, $attributes );

						// if (empty($img_thumb)) {
						// 	//$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
						// 	//echo $thumbnail;
						// }
						// else {
						// 	//echo $img_thumb;
						// }



						// echo '</div></div>';  


						





						// foreach( $img_gallerys as $img_gallery ) {
						// 	echo '<div class="image-mini-slider__slide swiper-slide"><div class="image-mini-slider__image">';
						// 	echo wp_get_attachment_image( $img_gallery, 'woo-thumbnail-product', false );
						// 	echo '</div></div>';  
						// }
					?>
					</div>
				</div>
			</div>

			<!-- Слайдер -->
			<div class="product-slider__wrapper">
				<div class="image-slider swiper-container">
					<!-- Слайдер -->
							<? 
								// if( empty( $_COOKIE[ 'sht_woo_likelist_product' ] ) ) {
								// 	$like_products = array();
								// } else {
								// 	$like_products = (array) explode( '|', $_COOKIE[ 'sht_woo_likelist_product' ] );
								// }
								// if ( ! in_array( get_the_id(), $like_products ) ) {
								// 	$like_products[] = $product_id_like;
								// 	echo '<button class="product-slider__like" data-page="single-product" product_id="' . get_the_id() . '"><span>Добавить<br>в избранное</span>';
								// } else {
								// 	echo '<button class="product-slider__like active" data-page="single-product" product_id="' . get_the_id() . '"><span>Добавлено<br>в избранное</span>';
								// }
							?>
							<svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.1504 2.82183C20.955 1.6546 19.3422 1 17.6616 1C15.9811 1 14.3682 1.6546 13.1729 2.82183L12.4976 3.4736L11.8341 2.82183C10.6388 1.6546 9.02593 1 7.34535 1C5.66478 1 4.05194 1.6546 2.85662 2.82183C1.66772 3.99893 1 5.59399 1 7.25698C1 8.91997 1.66772 10.515 2.85662 11.6921L12.0839 20.8324C12.1942 20.9398 12.3428 21 12.4976 21C12.6525 21 12.8011 20.9398 12.9114 20.8324L22.1504 11.7037C23.3352 10.5222 24 8.9261 24 7.26276C24 5.59943 23.3352 4.00338 22.1504 2.82183Z" fill="white" fill-opacity="0.01" /><path d="M22.9877 2.00401C21.6885 0.720056 19.9356 0 18.109 0C16.2824 0 14.5295 0.720056 13.2303 2.00401L12.4964 2.72097L11.7752 2.00401C10.4761 0.720056 8.72314 0 6.89657 0C5.07 0 3.31706 0.720056 2.01791 2.00401C0.725722 3.29883 0 5.05339 0 6.88268C0 8.71196 0.725722 10.4665 2.01791 11.7613L12.0467 21.8156C12.1666 21.9338 12.3281 22 12.4964 22C12.6647 22 12.8263 21.9338 12.9461 21.8156L22.9877 11.7741C24.2755 10.4744 24.998 8.71871 24.998 6.88904C24.998 5.05937 24.2755 3.30372 22.9877 2.00401V2.00401ZM22.0883 10.8747L12.4964 20.4623L2.90455 10.8747C2.37957 10.3521 1.96341 9.73052 1.68015 9.04604C1.39689 8.36155 1.25215 7.6277 1.25429 6.88692C1.2621 5.39442 1.85875 3.96533 2.91452 2.91036C3.97029 1.85538 5.39982 1.25981 6.89233 1.25312C7.63257 1.25037 8.36596 1.39485 9.04984 1.67816C9.73372 1.96147 10.3544 2.37796 10.8759 2.90338L12.0467 4.07002C12.1055 4.12954 12.1756 4.17679 12.2528 4.20904C12.3299 4.24129 12.4128 4.2579 12.4964 4.2579C12.5801 4.2579 12.6629 4.24129 12.7401 4.20904C12.8173 4.17679 12.8873 4.12954 12.9461 4.07002L14.117 2.90338C15.1821 1.88586 16.6031 1.32557 18.076 1.34238C19.5489 1.3592 20.9568 1.95178 21.9983 2.99336C23.0399 4.03493 23.6325 5.44278 23.6493 6.91569C23.6661 8.38861 23.1058 9.80961 22.0883 10.8747Z" fill="white" />
							</svg>
						</button>
					<div class="image-slider__wrapper swiper-wrapper">
						<?
							//global $product;
							// //$attachment_ids = $product->get_gallery_attachment_ids();
							// echo '<div class="image-slider__slide swiper-slide"><div class="image-slider__image swiper-zoom-container">';
							// //echo get_the_post_thumbnail( $post->ID, 'woo-page-product', false);
							// $img_thumb = get_the_post_thumbnail( $post->ID, 'woo-page-product', $attributes );
							// if (empty($img_thumb)) {
							// 	$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-page-product'));
							// 	echo $thumbnail;
							// }
							// else {
							// 	echo $img_thumb;
							// }


							// echo '</div></div>';  
							// foreach( $attachment_ids as $attachment_id ) {
							// 	echo '<div class="image-slider__slide swiper-slide"><div class="image-slider__image swiper-zoom-container">';
							// 	echo wp_get_attachment_image( $attachment_id, 'woo-page-product', false );
							// 	echo '</div></div>';  
							// }
						?>

					</div>
				</div>

			</div>
		</div>
		<!-- Cтрелки управления -->
		<div class="product-slider__nav">
			<div class="button-prev"></div>
			<!-- Фракция -->
			<div class="number-pagination"></div>
			<!--  -->
			<div class="button-next"></div>
		</div>
	</div>

<?				
}





//add_action( 'woocommerce_after_single_product', 'woo_single_product_big_img', 5);
function woo_single_product_big_img() {
?>
	</div>
	</section><!-- закрываем section.product -->

	<div class="modal-img">
		<div class="container">
			<button class="close-button"></button>
			<div class="popup-img swiper">
				
				<div class="popup-img-wrapper swiper-wrapper">
					<?
						global $product;
						$attachment_ids = $product->get_gallery_attachment_ids();
						echo '<div class="popup-img-slide swiper-slide">';	
						$img_src = get_the_post_thumbnail_url( $product->ID, 'woo-large-size-product', false );
						if (empty($img_src)) {
							$thumbnail_tag = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
							preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $thumbnail_tag, $images, PREG_SET_ORDER);
							foreach ($images as $image) {
								echo '<img width="1200" height="1600" src="' . home_url() . $image[1] . '">';
							}
						}
						else {
							echo '<img width="1200" height="1600" data-src="' . esc_url($img_src) . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
						}
						echo '</div>';
						foreach( $attachment_ids as $attachment_id ) {
							echo '<div class="popup-img-slide swiper-slide">';
							$img_src = wp_get_attachment_image_src( $attachment_id, 'woo-large-size-product', false );
							echo '<img width="' . $img_src[1] . '" height="' . $img_src[2] . '" data-src="' . $img_src[0] . '" src="' . get_template_directory_uri() . '/assets/img/pixel.png" class="swiper-lazy"><div class="swiper-lazy-preloader"></div>';
							echo '</div>';
						}
					?>
				</div>
				<!-- Cтрелки управления -->
				<div class="popup-img__nav">
					<div class="popup-btn-prev"></div>
					<!-- Фракция -->
					<div class="popup-pagination"></div>
					<div class="popup-btn-next"></div>
				</div>
			</div>


		</div>
	</div>
</div>

<?
}


add_action('woocommerce_after_single_product', 'show_cross_sell_in_single_product', 10); // выводим сопутствующие товары (кросселы)
function show_cross_sell_in_single_product(){
    //$crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);
	$upsells = get_post_meta( get_the_ID(), '_upsell_ids',true);
    if(empty($upsells)){
        return;
    }

    $args = array( 
        'post_type' => 'product', 
        'posts_per_page' => 6, 
        'post__in' => $upsells 
        );
    $products = new WP_Query( $args );
    if( $products->have_posts() ) : 
		?>
		
        <section class="kit">
			<div class="container">
				<h2 class="title">с этим товаром покупают</h2>
				<div class="kit__container">
					<div class="button-prev kit-button-prev"></div>
					<div class="kit-slider swiper">
						<!-- Слайдер -->
						<div class="swiper-wrapper">
							<?
							while ( $products->have_posts() ) : $products->the_post();
							?>
								<div class="kit__slide swiper-slide">
									<div class="kit__slide_image">
										<a href="<? echo get_the_permalink(); ?>">
										<?

										global $product;
										$attachment_ids = $product->get_gallery_attachment_ids();
										//echo get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', $attributes ); //выводим картинку превью товара

										$img_thumb = get_the_post_thumbnail( $post->ID, 'woo-thumbnail-product', $attributes );
										if (empty($img_thumb)) {
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
											echo $thumbnail;
										}
										else {
											echo $img_thumb;
										}

										?>
										</a>
									</div>
									<a href="<? echo get_the_permalink(); ?>" class="kit__slide_title">
										<? echo get_the_title(); ?>
									</a>

									<?
										$price = get_post_meta( get_the_ID(), '_regular_price', true); // основная цена товара
										$sale = get_post_meta( get_the_ID(), '_sale_price', true); 	//цена со скидкой
										$price_space = number_format((int)$price, 0, '', '&nbsp;');
										$sale_space = number_format((int)$sale, 0, '', '&nbsp;');
									?>

									<span class="kit__slide_price">
										<? if (!empty($sale)){
											echo ''. $sale_space .'&nbsp;₽';
										} else {
											echo ''. $price_space .'&nbsp;₽';
										} ?>
									</span>

									<p class="kit__slide_descr">
										<? 
											$attribute_sizes = array( 'razmer-pokryvala', 'razmer-pledy', 'razmer-shtory', 'razmer-chehly-dlya-mebeli', 'razmer-postelnoe-belyo' );
											$material = $product->get_attribute('material');
											$color = $product->get_attribute('czvet');
											foreach ( $attribute_sizes as $attribute_size ) {
												$razmer = $product->get_attribute( $attribute_size );
												if (!empty($razmer)) {
													echo ''. $razmer . ',&nbsp;';
												}
											}
											if (!empty($material)) {
												echo ''. $material . ',&nbsp;';
											}
											if (!empty($color)) {
												echo $color;
											}
										?>
									</p>
								</div>
							<?

							endwhile;
							?>
						</div>


					</div>
					<div class="button-next kit-button-next"></div>
				
				
				</div>
				<!-- kit__container -->
			</div>
		</section>
	<?
	endif;
    wp_reset_postdata();
}



//ВЫ СМОТРЕЛИ РАНЕЕ
add_action( 'template_redirect', 'woo_recently_viewed_product_cookie', 20 ); //создаем куки, записываем данные ID просмотренных товаров
function woo_recently_viewed_product_cookie() {
	// если находимся не на странице товара, ничего не делаем
	if ( ! is_product() ) {
		return;
	}
	if ( empty( $_COOKIE[ 'recently_viewed_product' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'recently_viewed_product' ] );
	}
	// добавляем в массив текущий товар
	if ( ! in_array( get_the_ID(), $viewed_products ) ) {
		$viewed_products[] = get_the_ID();
	}
	// нет смысла хранить там бесконечное количество товаров
	if ( sizeof( $viewed_products ) > 10 ) {
		array_shift( $viewed_products ); // выкидываем первый элемент
	}
 	// устанавливаем в куки
	wc_setcookie( 'recently_viewed_product', join( '|', $viewed_products ), time() + (3600 * 24 * 7) );
}









//Вывод избранных товаров
function woo_echo_likelist() {
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$user_meta_favorites_array = get_user_meta( $user_id, 'favorites', true );
		$like_products = $user_meta_favorites_array;
	}
	else {
		if( (empty( $_COOKIE['favorites_product'])) || (!isset($_COOKIE['favorites_product'])) ) {
			$like_products = array();

		} else {
			$like_products = (array) explode( '|', $_COOKIE[ 'favorites_product' ] );
		}
	}



	if ( empty( $like_products ) ) {
		echo '<div class="favourites-null">
		<a href="'. get_permalink(wc_get_page_id("shop")) .'" class="favourites-null__descr">
			<h3>Избранных товаров нет</h3>
			<p>Сохраняйте товары с помощью иконки
				<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.6329 1.27528C14.7494 0.458217 13.5573 0 12.3151 0C11.073 0 9.88086 0.458217 8.99736 1.27528L8.49825 1.73152L8.0078 1.27528C7.12431 0.458217 5.93221 0 4.69005 0C3.44788 0 2.25578 0.458217 1.37229 1.27528C0.49353 2.09925 0 3.2158 0 4.37989C0 5.54398 0.49353 6.66052 1.37229 7.48449L8.19244 13.8827C8.27395 13.9579 8.38381 14 8.49825 14C8.6127 14 8.72256 13.9579 8.80407 13.8827L15.6329 7.49259C16.5087 6.6655 17 5.54827 17 4.38393C17 3.2196 16.5087 2.10236 15.6329 1.27528ZM15.0213 6.92026L8.49825 13.0215L1.97525 6.92026C1.61824 6.58767 1.33523 6.19215 1.14259 5.75657C0.949961 5.32099 0.851528 4.85399 0.852986 4.38259C0.858297 3.43281 1.26405 2.52339 1.98203 1.85205C2.70001 1.1807 3.67217 0.801698 4.68716 0.797442C5.19056 0.795689 5.68931 0.887631 6.15439 1.06792C6.61946 1.24821 7.04158 1.51325 7.39618 1.84761L8.19244 2.59001C8.23243 2.62789 8.28005 2.65796 8.33254 2.67848C8.38504 2.699 8.44136 2.70957 8.49825 2.70957C8.55515 2.70957 8.61147 2.699 8.66397 2.67848C8.71646 2.65796 8.76408 2.62789 8.80407 2.59001L9.60033 1.84761C10.3246 1.20009 11.291 0.843543 12.2927 0.854243C13.2943 0.864944 14.2517 1.24204 14.9601 1.90486C15.6684 2.56769 16.0714 3.46359 16.0828 4.4009C16.0943 5.33821 15.7132 6.24248 15.0213 6.92026Z"
						fill="#786453" />
				</svg>
				в&nbsp;карточке товара или <span>каталоге</span>
			</p>
		</a>
	</div>';
		return;
	}

	// надо ведь сначала отображать последние просмотренные
	$like_products = array_reverse( array_map( 'absint', $like_products ) );
	$args = [
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'post__in' => $like_products
	];

	$query = new WP_Query( $args );

	// обрабатываем результат
	if ( $query->have_posts() ) :
		?>
		<section class="favourites">
			<?
			while ( $query->have_posts() ) {
				$query->the_post(); ?>
					<?
					$product_id = get_the_id();
					$product_url = get_the_permalink();
					$params = [
						'product_id' => $product_id,
						'product_url' => $product_url,
						'wrapper_class' => 'card',
						'item_slide_tag' => 'a',
						'gallerys' => true,
						'image_size' => 'woo-page-product',
						'location_page' => 'favorites'
					];
					get_template_part('components/product-card/product-card', null, $params);
			}?> 
		</section>
		<?wp_reset_postdata();
	endif; 
}




add_action('woocommerce_after_single_product', 'woo_recently_viewed_product', 15);  //создаем функцию со своей версткой просмотренных товаров, берем данные из куки
function woo_recently_viewed_product() {
	if( empty( $_COOKIE[ 'recently_viewed_product' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'recently_viewed_product' ] );
	}
	if ( empty( $viewed_products ) ) {
		return;
	}
	// надо ведь сначала отображать последние просмотренные
	$viewed_products = array_reverse( array_map( 'absint', $viewed_products ) );
	$args = [
		'post_type'      => 'product',
		'posts_per_page' => 10,
		'post__in' => $viewed_products
	];

	$query = new WP_Query( $args );

	// обрабатываем результат
	if ( $query->have_posts() ) :
	?>
	<section class="looked">
		<h2 class="title">Вы смотрели ранее</h2>
		<div class="container">
			<div class="button-prev looked-button-prev"></div>
			<div class="looked__slider swiper-container worker">
				<div class="looked__wrapper swiper-wrapper">
					<?
					while ( $query->have_posts() ) {
						$query->the_post();
						$product_id = get_the_ID();
						$product_url = get_the_permalink();
						$params = [
							'product_id' => $product_id,
							'product_url' => $product_url,
							'wrapper_class' => 'card swiper-slide',
							'item_slide_tag' => 'div',
							'gallerys' => false,
							'image_size' => 'woo-page-product',
							'location_page' => null
						];
						
						get_template_part('components/product-card/product-card', null, $params);
					}?>
				</div>
			</div>
			<div class="button-next looked-button-next"></div>
		</div>
	</section>
	<? wp_reset_postdata(); endif; 
}
//КОНЕЦ ВЫ СМОТРЕЛИ РАНЕЕ