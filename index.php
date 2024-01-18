<?get_header();?>
    <section class="first">
        <div class="first__text">
            <div class="first__text_subtitle">Ивановский производитель</div>
            <h1 class="first__text_title">Sandra Home Textile</h1>
            <div class="first__text_descr">
                <p>Собственное производство домашнего текстиля в России и Турции. Широкий ассортимент высококачественной продукции разных направлений и стилей.</p>
                <a href="<? echo get_permalink(wc_get_page_id('shop')); ?>">перейти в каталог</a>
            </div>
        </div>

        <?

        //ЭТО ВЫКЛЮЧИТЬ, КОГДА БУДУТ ПРОДАЖИ
        $first = [
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => 15, 
                )
            ),
        ];

        //ТОВАРЫ ТОЛЬКО ПО АКЦИИ
        // $first = array(
        //     'post_type'      => 'product',
        //     'meta_query'     => array(
        //         'relation' => 'OR',
        //         array( // Simple products type
        //             'key'           => '_sale_price',
        //             'value'         => 0,
        //             'compare'       => '>',
        //             'type'          => 'numeric'
        //         ),
        //         array( // Variable products type
        //             'key'           => '_min_variation_sale_price',
        //             'value'         => 0,
        //             'compare'       => '>',
        //             'type'          => 'numeric'
        //         )
        //     )
        // );

        //ЭТО ВКЛЮЧИТЬ, КОГДА БУДУТ ПРОДАЖИ, ЧТОБЫ ПОПУЛЯРНЫЕ ТОВАРЫ ВЫВОДИЛИСЬ, ИНАЧЕ БУДЕТ ПУСТО
        //Популярные товары (те, что были оформлены после корзины в заказах Woo)
        // $first = [
        //     'post_type' => 'product',
        //     'post_status' => 'publish',
        //     'posts_per_page' => 4,
        //     'orderby' => 'meta_value_num',
        //     'meta_query'     => array(
        //         array(
        //             'key'           => 'total_sales',
        //             'value'         => 0,
        //             'compare'       => '>',
        //             'type'          => 'numeric'
        //         ),
        //     ),
        // ];



        //  СОРТИРОВКА ПО АКЦИИ С НАРАСТАЮЩЕЙ
        //$first = [
        // 'post_type'      => 'product',
        // 'orderby'       => array('meta_value' => 'ASC', 'date' => 'ASC'),
        // 'meta_query' => array(
        //     array(
        //         'key' => '_stock_status',
        //         'value' => 'instock',
        //         'compare' => '=',
                
        //         'key' => '_sale_price',
        //         'value' => 0,
        //         'compare' => '>',
        //         'type' => 'numeric'
        //     )
        // ),
        // 'posts_per_page' => 4
        //];

        
        $query = new WP_Query( $first );
        // обрабатываем результат
        if ( $query->have_posts() ) :
        ?>

        <div class="first__slider">
            <div class="first-swiper swiper">
                <!-- Slides -->
                <div class="first-wrapper swiper-wrapper">

                <?
                $slider_dots = 1;
                while ( $query->have_posts() ) {
                $query->the_post();
                global $product;
                $attachment_ids = $product->get_gallery_image_ids();
                $thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'woo-mini-catalog', true);

                $price_first = get_post_meta( get_the_ID(), '_regular_price', true); // основная цена товара
                $sale_first = get_post_meta( get_the_ID(), '_sale_price', true); 	//цена со скидкой
                $price_first_int = (int)$price_first;
                $price_first_space = number_format($price_first_int, 0, '', '&nbsp;');
                $sale_first_int = (int)$sale_first;
                $sale_first_space = number_format($sale_first_int, 0, '', '&nbsp;');
                ?>
                    <!-- Slide -->
                    <a href="<? echo get_the_permalink(); ?>" class="first-slide swiper-slide first__slider_item" style="background: url('<?
                        if (!empty($thumbnail_url)) {
                            echo $thumbnail_url;
                        }
                        else {
                            $thumbnail_tag = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image('woo-thumbnail-product'));
                            preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $thumbnail_tag, $images, PREG_SET_ORDER);
                            foreach ($images as $image) {
                                echo home_url() . $image[1];
                            }
                        }?>') no-repeat;">

                        <div class="first__slider_asset">в наличии</div>
                        <div class="first__slider_link">УЗНАТЬ ПОДРОБНЕЕ</div>

                        <div class="first__slider_descr">
                            <div class="first__slider_dots">
                                <?
                                if ($slider_dots > 9) {
                                    echo $slider_dots;
                                }
                                else {
                                    echo '0' . $slider_dots .'';
                                }
                                
                                $slider_dots++;
                                ?>
                            </div>
                            <div class="first__slider_text">
                                <div class="first__slider_title"><? echo get_the_title(); ?></div>
                                <div class="first__slider_price"><span class="nowrap">
                                    <?
                                    if (!empty($sale_first)){
                                            echo $sale_first_space;
                                    } else {
                                        echo $price_first_space;
                                    } 
                                    ?>
                                </span>&nbsp;₽
                                </div>
                            </div>
                        </div>
                    </a>
                <? 
                } //endwhile ?> 
                <? wp_reset_postdata(); endif;  ?>
                <!-- / Slides -->
                </div>
                <div class="swiper-button">
                    <div class="button-prev"></div>
                    <div class="button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>       

    </section>

    <section class="trigger">
        <div class="trigger__wrapper">
            <div class="trigger__items">
                <div class="trigger__item_img">
                    <img src="<? echo get_template_directory_uri(); ?>/assets/icons/trigger-tangle.svg" alt="">
                </div>
                <div class="trigger__item">
                    <h3 class="subtitle trigger__item_title">Собственное производство</h3>
                    <div class="text trigger__item_descr">Гарантируем высокое качество пошива, проходящего строжайший ОТК</div>
                </div>
            </div>

            <div class="trigger__items">
                <div class="trigger__item_img">
                    <img src="<? echo get_template_directory_uri(); ?>/assets/icons/trigger-delivery.svg" alt="">
                </div>
                <div class="trigger__item">
                    <h3 class="subtitle trigger__item_title">Доставка<br>по всей России</h3>
                    <div class="text trigger__item_descr">Быстрая обработка и отправка заказов в любую точку России</div>
                </div>
            </div>

            <div class="trigger__items">
                <div class="trigger__item_img">
                    <img src="<? echo get_template_directory_uri(); ?>/assets/icons/trigger-mass.svg" alt="">
                </div>
                <div class="trigger__item">
                    <h3 class="subtitle trigger__item_title">Оптовые цены без посредников</h3>
                    <div class="text trigger__item_descr">Работаем с физическими и юридическими лицами</div>
                </div>
            </div>
        </div>
    </section>

    <section class="first-catalog container">
        <h2 class="title first-catalog__title">“Sandra Home Textile” – домашний текстиль «премиум» класса от Ивановского производителя</h2>
            <?desktop_page_catalog_nav_menu();?> 
    </section>

    <section class="looked bg-gray">
        <h2 class="title">
            <ul class="looked__filter">
                <li class="looked__filter_tab" data-id="hits">хиты</li><span></span>
                <li class="looked__filter_tab" data-id="new">новинки</li><span></span>
                <li class="looked__filter_tab" data-id="sale">акции</li>
            </ul>
        </h2>
        <div class="container">
            <div class="button-prev looked-button-prev"></div>
            <div class="looked__slider swiper">
                <div class="looked__wrapper swiper-wrapper">

                    <?
                    
                    // ТОВАРЫ ХИТЫ
                    $products_hits = [
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 6,
                        'orderby' => 'meta_value_num',
                        'meta_query'     => array(
                            array(
                                'key'           => 'total_sales',
                                'value'         => 0,
                                'compare'       => '>',
                                'type'          => 'numeric'
                            ),
                        ),
                    ];

                    $products_new = [
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => 6,
                            'orderby'       => array('date' => 'DESC'),
                            'meta_query' => array(
                                array(
                                    'key' => '_stock_status',
                                    'value' => 'instock',
                                    'compare' => '=',
                                    
                                    'key' => '_price',
                                    'value' => 0,
                                    'compare' => '>',
                                    'type' => 'numeric'
                                )
                            ),
                        ];



                    //  ТОВАРЫ АКЦИИ С НАРАСТАЮЩЕЙ СОРТИРОВКОЙ
                    $products_sale = [
                    'post_type'      => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => 6,
                    'orderby'       => array('meta_value' => 'ASC', 'date' => 'ASC'),
                    'meta_query' => array(
                        array(
                            'key' => '_stock_status',
                            'value' => 'instock',
                            'compare' => '=',
                            
                            'key' => '_sale_price',
                            'value' => 0,
                            'compare' => '>',
                            'type' => 'numeric'
                        )
                    ),
                    ];

                    //НАЧАЛО ВЫВОДА ТОВАРЫ ХИТЫ
                    $query_hits = new WP_Query( $products_hits );
                    // обрабатываем результат
                    if ( $query_hits->have_posts() ) :

                        while ( $query_hits->have_posts() ) {
                            $query_hits->the_post();
                            $product_id = get_the_ID();
                            $product_url = get_the_permalink();
                        ?>
                        
                            <? //product_card(); 
                            $params = [
                                'product_id' => $product_id,
                                'product_url' => $product_url,
                                'wrapper_class' => 'card swiper-slide hits',
                                'item_slide_tag' => 'a',
                                'gallerys' => true,
                                'image_size' => 'woo-page-product',
                                'location_page' => null
                                
                            ];
                            get_template_part('components/product-card/product-card', null, $params);
                            ?>

                        

                    <? 
                    } //endwhile 
                    wp_reset_postdata(); endif;  
                    //КОНЕЦ ВЫВОДА ТОВАРЫ ХИТЫ
                        
                    //НАЧАЛО ВЫВОДА ТОВАРЫ НОВИНКИ
                    $query_new = new WP_Query( $products_new );
                    // обрабатываем результат
                    if ( $query_new->have_posts() ) :

                        while ( $query_new->have_posts() ) {
                            $query_new->the_post();
                            $product_id = get_the_ID();
                            $product_url = get_the_permalink();
                        ?>
                        
                            <? //product_card();
                                $params = [
                                    'product_id' => $product_id,
                                    'product_url' => $product_url,
                                    'wrapper_class' => 'card swiper-slide new',
                                    'item_slide_tag' => 'a',
                                    'gallerys' => true,
                                    'image_size' => 'woo-page-product',
                                    'location_page' => null
                                ];
                                get_template_part('components/product-card/product-card', null, $params);
                            
                            
                            ?>
                        

                    <? 
                    } //endwhile 
                    wp_reset_postdata(); endif;  
                    //КОНЕЦ ВЫВОДА ТОВАРЫ НОВИНКИ
                        
                    //НАЧАЛО ВЫВОДА ТОВАРЫ АКЦИИ
                    $query_sale = new WP_Query( $products_sale );
                    // обрабатываем результат
                    if ( $query_sale->have_posts() ) :

                        while ( $query_sale->have_posts() ) {
                            $query_sale->the_post();
                            $product_id = get_the_ID();
                            $product_url = get_the_permalink();
                        ?>
                            <? //product_card();
                            
                            $params = [
                                'product_id' => $product_id,
                                'product_url' => $product_url,
                                'wrapper_class' => 'card swiper-slide sale',
                                'item_slide_tag' => 'a',
                                'gallerys' => true,
                                'image_size' => 'woo-page-product',
                                'location_page' => null
                                
                            ];
                            get_template_part('components/product-card/product-card', null, $params);
                            
                            ?>
                       

                    <? 
                    } //endwhile 
                    wp_reset_postdata(); endif;  
                    //КОНЕЦ ВЫВОДА ТОВАРЫ АКЦИИ
                    ?>



                </div>
            </div>
            <div class="button-next looked-button-next"></div>
        </div>
        <div class="slider-pagination"></div>
    </section>

    <section class="contacts first-contacts">
        <div class="contacts__wrapper container">
            <div class="contacts__info">
                <h2 class="contacts__info_title title">
                    <span>Как с нами</span>
                    <span class="title__transform">связаться</span>
                </h2>
                <p class="contacts__info_subtitle">Выберите, чтобы показать другие контакты</p>

                <div class="select-js">
                    <div class="option-js-active"></div>
                    <div class="options-js">
                    <?

                    $yandekskartys = get_field('contacts-yandekskarty', 27);
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
                    <div class="descr-info__text icon-map text" id="addr"></div>
                    <? $site_email = get_option('admin_email'); ?>
                    <div class="descr-info__text text"><span class="icon-mail"><a href="mailto:<? echo $site_email; ?>"><? echo $site_email; ?></a></span>
                    </div>
                    <div class="descr-info__text icon-tel">
                        <a href="" class="descr-info__text_tel" id="tel"></a>
                        <br>
                        <button id="btn-modal-call" class="descr-info__text_call">Заказать звонок</button>
                    </div>
                    <div class="descr-info__text icon-clock text" id="mode"></div>
                </div>
            </div>
            <div class="contacts__map">
                <div class="map">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>
<? get_footer(); ?>