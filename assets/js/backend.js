
// ---------------------- НАЧАЛО ФУНКЦИИ ----------------------




//Функция изменения dom по авторизации
function update_login_user() {
    $('.basket__title').text('Введите ваш логин и пароль для входа в аккаунт');
    $('#email-block').find('label').html('Логин или E-mail<span>&nbsp;*</span>');
    $('.basket__checkbox, #submit-block a').removeClass('d-hide');
    $('#submit-block input').val('Войти на сайт');
    $('.basket__register div').text('Пройти регистрацию');
    $('#username-block').addClass('d-hide');
    $('.basket__register').removeClass('btn-login');
    $('.basket__register').find('div').removeClass('btn-invert');
    $('.basket__register').find('div').addClass('btn');
    $('#auth-user').addClass('login_user');
    $('#auth-user').removeClass('register_user');
    $('#username-block input').prop('required', false);
    $('.ajax-login').find('input[name="security"]').attr('id', 'security');
    $('.ajax-register').find('input[name="security"]').removeAttr('id');
    $('#password').val('');
    $('.status-success, .status-error').text('');
    $('.status-success, .status-error').addClass('d-hide');
    $('#auth-user span.error-mess').addClass('d-hide');
    $('.order__pay_checkbox').addClass('d-hide');
    $('#email-block input').attr('type', 'text');
}

//Функция изменения dom по регистрации
function update_register_user() {
    $('.basket__title').html('Регистрация пользователя');
    $('#email-block').find('label').html('E-mail<span>&nbsp;*</span>');
    $('.basket__checkbox, #submit-block a').addClass('d-hide');
    $('#submit-block input').val('Зарегистрироваться');
    $('.basket__register div').text('Войти в аккаунт');
    $('#username-block').removeClass('d-hide');
    $('.basket__register').addClass('btn-login');
    $('.basket__register').find('div').removeClass('btn');
    $('.basket__register').find('div').addClass('btn-invert');
    $('#auth-user').removeClass('login_user');
    $('#auth-user').addClass('register_user');
    $('#username-block input').prop('required', true);
    $('.ajax-register').find('input[name="security"]').attr('id', 'security');
    $('.ajax-login').find('input[name="security"]').removeAttr('id');
    $('#password').val('');
    $('.status-success, .status-error').text('');
    $('.status-success, .status-error').addClass('d-hide');
    $('#auth-user span.error-mess').addClass('d-hide');
    $('.order__pay_checkbox').removeClass('d-hide');
    $('#email-block input').attr('type', 'email');
}

//Изменить верстку после загрузки Ajax фильтра
function changeFilterWoof() {

    $('.price_slider_amount').find('input').removeAttr('style');
    $('.price_slider_amount').find('.price_label').remove();
    $('.woof_turbo_mode_overlay, .woof_submit_search_form_container, #woof_html_buffer, .woof_container_inner h4 a').addClass('d-hide');
    $('.price_slider_amount input[name="min_price"]').attr('placeholder', 'от');
    $('.price_slider_amount input[name="max_price"]').attr('placeholder', 'до');

    //Прячем размеры всех категорий
    $('.woof_container_pa_razmer-pokryvala, .woof_container_pa_razmer-pledy, .woof_container_pa_razmer-shtory, .woof_container_pa_razmer-chehly-dlya-mebeli, .woof_container_pa_razmer-postelnoe-belyo').addClass('d-hide');
    var input_cat_checked_attr = $('.woof_container_product_cat input[type="radio"]:checked').attr('data-slug');
    catalog_attr = $('.catalog__sidebar').attr('data-cat');
    $('.woof_container_pa_razmer-' + catalog_attr + '').removeClass('d-hide');
    $('.woof_container_pa_razmer-' + input_cat_checked_attr + '').removeClass('d-hide');

    $('.woof_container').find('.woof_front_toggle').html('');
    $('.card-container .swiper-pagination-bullet').mouseenter(function () {
        $(this).trigger('click');
    });

    if ($('.catalog__nav_filter.worker').find('span').length > 0) {
        $('#reset_filter').removeClass('d-hide');
    } else {
        $('#reset_filter').addClass('d-hide');

    }

    selected_category = $('.woof_container_product_cat li a.woof_radio_term_reset_visible');
    selected_category.each(function () {
        $(this).parent('li').addClass('active-category');
    });

    $('.woof .woof_redraw_zone').find('div[style="clear:both;"]').addClass('d-hide');

    $('.price_slider_amount #min_price').after('<span class="solid"></span>');

    var urlString = location.href.split(location.host)[1];
    var catalog_filter = $('.catalog__nav_filter');
    if (urlString.indexOf('/price-') >= 0) {
        catalog_filter.find('.price_reset_filter').remove();
        catalog_filter.append($('<span class="saved price_reset_filter">Цена<button></button></span>'));
    }

    if ($('.woocommerce-info').text() == 'Товаров, соответствующих вашему запросу, не обнаружено.') {
        $('html').animate({ scrollTop: $("header").offset().top }, 600);
    }

    update_selected_index();
    preloaderStop();
}

//Добавляем функцию для показа loader в каталоге
function preloaderStart() {
    $('.title-catalog').before('<div class="loader"><span></span></div>');
}
//Останавливаем показ loader
function preloaderStop() {
    $('.catalog__wrapper').find('.loader').remove();
}


//Функция обновления метода получения в оформлении заказа
function update_select_method_shipping() {
    $('#shipping-method').parent().find('.select-input span').remove();
    $("#shipping_method label").each(function () {
        var text = $(this).text();
        var attr = $(this).attr('for');
        var checked = $('#shipping_method input[type="radio"]:checked').attr('id');
        var block = document.querySelector('#shipping-method');
        var blocknew = document.createElement('span');
        blocknew.textContent = text;
        blocknew.setAttribute('data-for', attr);
        block.appendChild(blocknew);
        $('#shipping-method').parent().find('.select-input span[data-for="' + checked + '"]').addClass('selected');
    });

}
//Функция обновления метода оплаты в оформлении заказа
function update_select_method_payment() {
    $('#payment-method').parent().find('.select-input span').remove();
    $("#payment label").each(function () {
        var text = $(this).text();
        var attr = $(this).attr('for');
        var checked = $('#payment input[type="radio"]:checked').attr('id');
        var block = document.querySelector('#payment-method');
        var blocknew = document.createElement('span');
        blocknew.textContent = text;
        blocknew.setAttribute('data-for', attr);
        block.appendChild(blocknew);
        $('#payment-method').parent().find('.select-input span[data-for="' + checked + '"]').addClass('selected');
    });
}


function update_select_method_order_pay() {
    $('#order-pay-method').find('span').remove();
    $("#payment-order-pay ul li").each(function () {
        var text = $(this).find('label').text();
        var attr = $(this).find('label').attr('for');
        var checked = $('#payment-order-pay input[type="radio"]:checked').attr('id');
        var checked_text = $('#payment-order-pay').find('label[for="' + checked + '"]').text();
        var block = document.querySelector('#order-pay-method');
        var blocknew = document.createElement('span');
        blocknew.textContent = text;
        blocknew.setAttribute('data-for', attr);
        block.appendChild(blocknew);
        $('#order-pay-method').find('span[data-for="' + checked + '"]').addClass('selected');
        $('.pay-method-js').text(checked_text);
        if (checked === 'payment_method_yookassa_epl') {
            $('.modal-account-order-pay-btn').find('#place_order').text('Оплатить заказ');
        }
        else {
            $('.modal-account-order-pay-btn').find('#place_order').text('Изменить способ оплаты');
        }
    });
}





function submit_search() {
    preloaderStart();
    $('.woof_submit_search_form').trigger('click');
}

function update_selected_index() {
    var list_selected = $('.catalog__nav_filter.worker span');
    var total_selected = list_selected.length;
    list_selected.each(function (index) {
        $('.btn__filter').find('.filter-selected-index').remove();
        var filter_selected_index = index + 1;
        $('.btn__filter').append('<span class="filter-selected-index">' + filter_selected_index + '</span>');
    });
    if (total_selected === 0) {
        $('.btn__filter').find('.filter-selected-index').remove();
    }
}

function set_message(text) {
    var $item = $('<div class="message"><div class="message_icon"></div><div class="message_text">' + text + '</div></div>');
    if (document.documentElement.clientWidth > 991) {
        $item.appendTo($('#message-wrapper'));
        $item.addClass('show');
        setTimeout(() => { $item.removeClass('show'); }, 5000);
        setTimeout(() => { $item.remove(); }, 5300);
    }
    else {
        $('#message-wrapper .message').removeClass('show');
        setTimeout(() => { $('#message-wrapper .message').remove(); }, 200);
        setTimeout(() => {
            $item.appendTo($('#message-wrapper'));
            $item.addClass('show');
            setTimeout(() => { $item.removeClass('show'); }, 5000);
            setTimeout(() => { $item.remove(); }, 5300);
        }, 300);
    }
}

// ---------------------- КОНЕЦ ФУНКЦИИ ----------------------

$(function () {
    // ---------------------- НАЧАЛО ПЕРЕМЕННЫЕ ----------------------
    //var notices_for_user = $('.notices_for_user_wrapper');
    var count_like_desktop = $('.header__menu_favourites');
    var count_like_mob = $('.likelist-mob-count');
    var basket_count_mob = $('.basket-mob-count');
    var basket_count_burger = $('.burger__header .header__menu_basket');
    const msg_min_cart = 'Минимальная сумма заказа<br>составляет';
    const msg_auth = 'Для оформления заказа<br>необходимо авторизоваться';
    const msg_likelist_add = 'Добавлено в избранное';
    const msg_likelist_reset = 'Добавить в избранное';
    const msg_likelist_success = 'Товар успешно добавлен в Избранное';
    const msg_likelist_error = 'Не удалось добавить товар в Избранное';
    const msg_likelist_remove = 'Товар успешно удалён из Избранного';
    const msg_basket_success = 'Товар успешно добавлен в Корзину';
    const msg_basket_error = 'Не удалось добавить товар в Корзину';
    const msg_basket_update = 'Корзина была обновлена';


    // ---------------------- КОНЕЦ ПЕРЕМЕННЫЕ ----------------------

    //var message_wrapper = $('#message-wrapper');
    // const message_wrapper = document.querySelector('#message-wrapper');
    // $(document).on('click', '#click-message', function () {


    // 	block = document.createElement('div');
    // 	block.classList.add('message');
    // 	icon = document.createElement('div');
    // 	icon.classList.add('icon');
    // 	icon.textContent = 'icon';
    // 	text = document.createElement('div');
    // 	text.classList.add('text');
    // 	text.textContent = 'text';
    // 	block.appendChild(icon);
    // 	block.appendChild(text);
    // 	message_wrapper.appendChild(block);

    // $('#click-message').click(function(){
    // 	console.log('click');
    // 	set_message('This is an awesome message!');
    // });

    // 	setTimeout(function () {
    // 		$('#message-wrapper').find(".message").addClass("show");
    // 	}, 500);

    // 	//setInterval(function() {

    // 		setTimeout(function () {
    // 			$('#message-wrapper').find(".message:last-child").removeClass("show");
    // 		}, 3000);
    // 		// setTimeout(function () {
    // 		// 	$('#message-wrapper').find(".message:first-child").remove();
    // 		// }, 4000);

    // 	//}, 6000);


    // });

    // $('.message').livequery(function() {
    // 	console.log(' элемент был добавлен');
    // });


    // notices_for_user.addClass('show');
    // notices_for_user.find('.notices_for_user_text').text(msg_likelist_success);


    // Убавляем кол-во по клику
    $('.number .number-minus').click(function () {
        var $input = $(this).parent().find('.number-text');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
    });

    // Прибавляем кол-во по клику
    $('.number .number-plus').click(function () {
        var $input = $(this).parent().find('.number-text');
        var count = parseInt($input.val()) + 1;
        count = count > parseInt($input.data('max-count')) ? parseInt($input.data('max-count')) : count;
        $input.val(parseInt(count));
    });

    // Убираем все лишнее и невозможное при изменении поля
    setInterval(function () {
        $(document).on('change keyup input click', '.number .number-text, .quantity .quantity-input', function () {
            //$('.number .number-text').bind("change keyup input click", function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
            if (this.value == "") {
                this.value = 1;

            }
            if (this.value > parseInt($(this).data('max-count'))) {
                this.value = parseInt($(this).data('max-count'));
            }
        });
    }, 1000);


    //Добавляем и убираем класс disabled
    setInterval(function () {
        var count_num = $('.number .number-text').val();
        if (count_num == 1) {
            $('.number-minus').addClass('disabled');
        }
        else {
            $('.number-minus').removeClass('disabled');
        }
        if (count_num == 999) {
            $('.number-plus').addClass('disabled');
        }
        else {
            $('.number-plus').removeClass('disabled');
        }
    }, 200);


    // ---------------------- НАЧАЛО КАТАЛОГ ----------------------

    //Сканирование при загрузке страницы, где есть radio (категории) в фильтре, отобразить в результатах
    // $('.woof_container_product_cat li input[type="radio"]').each(function() {
    // 	if ($(this).is(':checked')){
    // 		var attr_term_id= $(this).attr('data-term-id');
    // 		text_label = $(this).parent().find('label').text();
    // 		nav_filter = document.querySelector('catalog__nav_filter');
    // 		blockspan = document.createElement('span');
    // 		button = document.createElement('button');
    // 		button.textContent = '×';
    // 		button.setAttribute('data-type', 'cat');
    // 		blockspan.textContent = text_label;
    // 		blockspan.setAttribute('attr-term-id', attr_term_id);
    // 		blockspan.appendChild(button);
    // 		nav_filter.appendChild(blockspan);
    // 	}
    // });

    $('.woof_container_product_cat li input[type="radio"]').each(function () {
        if ($(this).is(':checked')) {
            var attr_term_id = $(this).attr('data-term-id');
            text_label = $(this).parent().find('label').text();
            nav_filter = document.querySelectorAll('.catalog__nav_filter');
            nav_filter.forEach(nav_filter => {
                blockspan = document.createElement('span');
                blockspan.classList.add('saved');
                button = document.createElement('button');
                //button.textContent = '';
                button.setAttribute('data-type', 'cat');
                blockspan.textContent = text_label;
                blockspan.setAttribute('attr-term-id', attr_term_id);
                blockspan.appendChild(button);
                nav_filter.appendChild(blockspan);
            });
        }
    });









    //Сканирование при загрузке страницы, где есть checked в фильтре, отобразить в результатах
    // $('.woof_container li input[type="checkbox"]').each(function() {
    // 	if ($(this).is(':checked')){
    // 		var attr_term_id= $(this).attr('data-term-id');
    // 		text_label = $(this).parent().find('label').text();
    // 		nav_filter = document.querySelector('.catalog__nav_filter');
    // 		blockspan = document.createElement('span');
    // 		button = document.createElement('button');
    // 		button.textContent = '×';
    // 		blockspan.textContent = text_label;
    // 		blockspan.setAttribute('attr-term-id', attr_term_id);
    // 		blockspan.appendChild(button);
    // 		nav_filter.appendChild(blockspan);
    // 	}
    // });

    $('.woof_container li input[type="checkbox"]').each(function () {
        if ($(this).is(':checked')) {
            var attr_term_id = $(this).attr('data-term-id');
            text_label = $(this).parent().find('label').text();
            nav_filter = document.querySelectorAll('.catalog__nav_filter');
            nav_filter.forEach(nav_filter => {
                blockspan = document.createElement('span');
                blockspan.classList.add('saved');
                button = document.createElement('button');
                //button.textContent = '';
                blockspan.textContent = text_label;
                blockspan.setAttribute('attr-term-id', attr_term_id);
                blockspan.appendChild(button);
                nav_filter.appendChild(blockspan);
            });
        }
    });


    //Клик по фильтру категорий radio
    // product_cat_radio = 1;
    // $(document).on('click', '.woof_container_product_cat li input[type="radio"]', function() {
    // 	preloaderStart();
    // 	attr_term_id = $(this).attr('data-term-id');
    // 	text_label = $(this).parent().find('label').text();
    // 	nav_filter = document.querySelector('.catalog__nav_filter');
    // 	blockspan = document.createElement('span');

    // 		if (document.documentElement.clientWidth < 991) {
    // 			blockspan.classList.add('selected');
    // 		}
    // 		else {
    // 			blockspan.classList.add('saved');
    // 		}


    // 	button = document.createElement('button');
    // 	filter_cat = $('.catalog__nav_filter button[data-type="cat"]').parent().attr('attr-term-id');
    // 	if (attr_term_id == filter_cat) {
    // 		$('.catalog__nav_filter button[data-type="cat"]').parent().remove();
    // 		product_cat_radio = 2;
    // 	}
    // 	if (attr_term_id !== filter_cat) {
    // 		$('.catalog__nav_filter button[data-type="cat"]').parent().remove();
    // 		product_cat_radio = 1;
    // 	}
    // 	if (product_cat_radio == 1) {
    // 			blockspan = document.createElement('span');
    // 			button.textContent = '×';
    // 			button.setAttribute('data-type', 'cat');
    // 			blockspan.textContent = text_label;
    // 			blockspan.setAttribute('attr-term-id', attr_term_id);
    // 			blockspan.appendChild(button);
    // 			nav_filter.appendChild(blockspan);

    // 	}
    // 	else if (product_cat_radio == 2) {
    // 		$('.woof_container_product_cat li input[data-term-id="'+ attr_term_id + '"]').parent().find('.woof_radio_term_reset').trigger('click');
    // 	}
    // 	return product_cat_radio;
    // });

    product_cat_radio = 1;
    $(document).on('click', '.woof_container_product_cat li input[type="radio"]', function () {
        //preloaderStart();
        attr_term_id = $(this).attr('data-term-id');
        text_label = $(this).parent().find('label').text();
        nav_filter = $('.catalog__nav_filter');
        if (document.documentElement.clientWidth < 991) {
            nav_filter_select = 'selected';
        } else {
            nav_filter_select = 'saved';
        }
        filter_cat = $('.catalog__nav_filter button[data-type="cat"]').parent().attr('attr-term-id');
        if (attr_term_id == filter_cat) {
            $('.catalog__nav_filter button[data-type="cat"]').parent().remove();
            product_cat_radio = 2;
        }
        if (attr_term_id !== filter_cat) {
            $('.catalog__nav_filter button[data-type="cat"]').parent().remove();
            product_cat_radio = 1;
        }
        if (product_cat_radio == 1) {
            nav_filter.append($('<span class="' + nav_filter_select + '" attr-term-id="' + attr_term_id + '">' + text_label + '<button data-type="cat"></button></span>'));
        }
        else if (product_cat_radio == 2) {
            $('.woof_container_product_cat li input[data-term-id="' + attr_term_id + '"]').parent().find('.woof_radio_term_reset').trigger('click');
        }

        if (document.documentElement.clientWidth > 991) {
            setTimeout(function () {
                submit_search();
            }, 300);
        }

        return product_cat_radio;
    });


    //При закрытии фильтра на планшете/моб. удалить или сохранить выбранные значения
    $(document).on('click', '.btn-close__filter, .apply_filter', function () {
        selected_filter = $('.sidebar-mob .catalog__nav_filter span.selected');

        if ($(this).hasClass('btn-close__filter')) {
            selected_filter.each(function () {
                selected_attr = $(this).attr('attr-term-id');
                // $('.woof_container_product_cat li input[data-term-id="'+ selected_attr + '"]').parent().find('.woof_radio_term_reset').trigger('click');
                $('.woof_container_product_cat li input[data-term-id="' + selected_attr + '"]').parent().find('a').trigger('click');
                //$('.woof_container_product_cat li input[data-term-id="'+ selected_attr + '"]').trigger('click');
                $('.woof_container_checkbox input[data-term-id="' + selected_attr + '"]').trigger('click');


                $('.catalog__nav_filter').find('span[attr-term-id="' + selected_attr + '"]').remove();

                console.log(selected_attr);
                //console.log(this);

            });
            preloaderStop();

            selected_cat = $('.woof_container_product_cat .active-category');
            selected_cat.each(function () {
                selected_cat_id = $(this).find('input[type="radio"]').attr('data-term-id');
                selected_cat_label = $(this).find('label').text();
                $(this).find('input[type="radio"]').attr('checked', 'checked');
                $(this).find('input[type="radio"]').prop('checked', true);

                if (!$('.catalog__nav_filter').find('span[attr-term-id="' + selected_cat_id + '"]').length > 0) {
                    $('.catalog__nav_filter').append($('<span class="saved" attr-term-id="' + selected_cat_id + '">' + selected_cat_label + '<button data-type="cat"></button></span>'));
                }
            });
            // 		setTimeout(function () {

            // 	visible_selected = $('.woof_container_product_cat li a.woof_radio_term_reset_visible');

            // 	visible_selected.each(function() {
            // 		//if ($(this).hasClass('woof_radio_term_reset_visible')) {
            // 			visible_selected_attr = $(this).attr('data-term-id');
            // 			console.log(visible_selected_attr);
            // 		//}

            // 	});
            // }, 1000);

            //$('#reset_filter_mob').remove();

        }
        else if ($(this).hasClass('apply_filter')) {




            $('.catalog__nav_filter span.selected').addClass('saved');
            $('.catalog__nav_filter span').removeClass('selected');
            $('.sidebar').removeClass('active');
            // $('.sidebar').css('top', '100vh');

            $('.apply_filter').removeAttr('style');

            setTimeout(function () {
                $('.apply_filter').removeClass('active');
                submit_search();
            }, 300);
            $('#reset_filter_mob').remove();
            if ($('.sidebar-mob .catalog__nav_filter').find('span[class="saved"]').length >= 2) {
                // console.log('> 1');
                if (!$('.sidebar-mob .catalog__nav_filter').find('span[id="reset_filter_mob"]').length > 0) {
                    // console.log('> 0');
                    $('.sidebar-mob .catalog__nav_filter').append($('<span id="reset_filter_mob">очистить все<button></button></span>'));
                }
            }
            else {
                // console.log('< 1');
                $('#reset_filter_mob').remove();
            }


        }

        // setTimeout(function () {
        // 	$('.woof_submit_search_form').trigger('click');
        // }, 300);
    });


    $(document).on('click', '#reset_filter_mob', function () {
        $('#reset_filter').trigger('click');
    });

    //При клике на чекбоксы добавлять/удалять выбранный фильтр из результатов
    // $(document).on('click', '.woof_container li input[type="checkbox"]', function() {
    // 	preloaderStart();
    // 	var attr_term_id= $(this).attr('data-term-id');
    // 	text_label = $(this).parent().find('label').text();
    // 	if ($(this).is(':checked')){
    // 		var nav_filter = document.querySelectorAll('.catalog__nav_filter');
    // 		nav_filter.forEach(nav_filter => {
    // 			blockspan = document.createElement('span');
    // 			button = document.createElement('button');
    // 			button.textContent = '×';
    // 			blockspan.textContent = text_label;
    // 			blockspan.setAttribute('attr-term-id', attr_term_id);
    // 			blockspan.appendChild(button);
    // 			nav_filter.appendChild(blockspan);

    // 		});

    // 		// $(window).on('load resize', function () {
    // 		// 	if (document.documentElement.clientWidth < 991) {
    // 		// 		var save_filter = $('.btn-close__filter');

    // 		// 	}
    // 		// });
    // 	}
    // 	else {
    // 		$('.catalog__nav_filter').find('span[attr-term-id="' + attr_term_id + '"]').remove();
    // 	}
    // });


    $(document).on('click', '.woof_container li input[type="checkbox"]', function () {
        //preloaderStart();
        var attr_term_id = $(this).attr('data-term-id');
        text_label = $(this).parent().find('label').text();
        if ($(this).is(':checked')) {
            var nav_filter = document.querySelectorAll('.catalog__nav_filter');
            nav_filter.forEach(nav_filter => {
                blockspan = document.createElement('span');


                if (document.documentElement.clientWidth < 991) {
                    blockspan.classList.add('selected');
                }
                else {
                    blockspan.classList.add('saved');

                }



                button = document.createElement('button');
                // button.textContent = '';
                blockspan.textContent = text_label;
                blockspan.setAttribute('attr-term-id', attr_term_id);
                blockspan.appendChild(button);
                nav_filter.appendChild(blockspan);

            });
        }
        else {
            $('.catalog__nav_filter').find('span[attr-term-id="' + attr_term_id + '"]').remove();
        }

        if (document.documentElement.clientWidth > 991) {
            setTimeout(function () {
                submit_search();
            }, 300);
        }
    });


    //При клике на фильтр из результатов, убирать checked в фильтре
    // $(document).on('click', '.catalog__nav_filter button', function() {
    // 	preloaderStart();
    // 	var attr_term_id= $(this).parent('span').attr('attr-term-id');
    // 	if ($(this).attr('data-type') == 'cat') {
    // 		$('a[data-term-id="'+ attr_term_id + '"]').trigger('click');
    // 		$(this).parent('span').remove();
    // 	}
    // 	else {
    // 		$('input[data-term-id="'+ attr_term_id + '"]').trigger('click');
    // 		$(this).parent('span').remove();
    // 	}
    // });


    $(document).on('click', '.catalog__nav_filter button', function () {
        //preloaderStart();
        var attr_term_id = $(this).parent('span').attr('attr-term-id');
        var filter_worker = $(this).parent('span').parent('div');
        if ($(this).attr('data-type') == 'cat') {
            $('a[data-term-id="' + attr_term_id + '"]').trigger('click');
            $('.catalog__nav_filter').find('span[attr-term-id="' + attr_term_id + '"]').remove();
        }
        else {
            $('input[data-term-id="' + attr_term_id + '"]').trigger('click');
            $('.catalog__nav_filter').find('span[attr-term-id="' + attr_term_id + '"]').remove();
        }

        if (filter_worker.hasClass('worker')) {
            setTimeout(function () {
                submit_search();
            }, 300);
        }


    });

    // $(document).on('click', '.catalog__nav .catalog__nav_filter button', function() {
    // 	preloaderStart();

    // });


    update_selected_index();


    // $.ajaxSetup({
    // 	beforeSend: function() {
    // 		var urlString = location.href.split(location.host)[1];
    // 		if (urlString.indexOf('price') >= 0) {
    // 			console.log('Параметр "?price" присутствует');
    // 		}
    // 		else {
    // 			console.log('Параметра "?price" нет');
    // 		}
    // 	}
    // });

    //Изменение ползунков, их расположение после изменения значений в input
    $(document).on('change', '.price_slider_amount input', function () {
        // preloaderStart();
        price_min_val = $('.price_slider_amount').find('input#min_price').val();
        price_max_val = $('.price_slider_amount').find('input#max_price').val();
        $(".ui-slider").slider("values", [price_min_val, price_max_val]);
    });

    //Обновление фильтра при измненении цены в input-тах
    $(document).on('change', '.price_slider_amount input', function () {
        price_min = $('.price_slider_amount').find('input#min_price').attr('data-min');
        price_max = $('.price_slider_amount').find('input#max_price').attr('data-max');
        if ($('#min_price').val() == '') {
            $('#min_price').val(price_min);
            //$('.price_slider_amount').find('button').trigger('click');
        }
        if ($('#max_price').val() == '') {
            $('#max_price').val(price_max);
            //$('.price_slider_amount').find('button').trigger('click');
        }
    });

    //Обновление фильтра при измненении цены ползунками
    $(document).on("slidechange", '.price_slider_wrapper .ui-slider', function (event, ui) {
        if (document.documentElement.clientWidth > 991) {
            setTimeout(function () {
                $('.price_slider_amount').find('button').trigger('click');
                submit_search();
            }, 500);
        }
    });

    //Сброс всего фильтра результатов, кроме filter woo.orderby
    $(document).on('click', '#reset_filter', function () {
        preloaderStart();
        $('.woof_reset_search_form').trigger('click');
        $('.catalog__nav_filter span').remove();

        var urlString = location.href.split(location.host)[1];
        if (urlString.indexOf('orderby') >= 0) {
            const url = new URL(document.location);
            const searchParams = url.searchParams;
            searchParams.delete('orderby');
            window.history.pushState({}, '', url.toString());
        }
    });

    // $(document).on('click', '.woof_reset_search_form', function () {
    //     preloaderStart();

    //     $('.catalog__nav_filter span').remove();
    //     var urlString = location.href.split(location.host)[1];
    //     if (urlString.indexOf('orderby') >= 0) {
    //         console.log('yes');
    //         // const url = new URL(document.location);
    //         // const searchParams = url.searchParams;
    //         // searchParams.delete('orderby'); // удалить параметр "test"
    //         // window.history.pushState({}, '', url.toString());
    //         // console.log(searchParams);
    //     }
    // });



    //Вызываем функцию Woof после загрузки JS
    changeFilterWoof();
    var text_sorting = $('#select').find('option[selected=selected]').text();
    val_sorting = $('#select').find('option[selected=selected]').val();
    $('.select-orderby-js').parent('').find('.select-input span[data-for="' + val_sorting + '"]').addClass('selected');
    $('.select-orderby-js').text(text_sorting);
    $(document).on('click', '.select-orderby-js', function () {
        $(this).parent().find('.select-input').toggleClass('show');
        $(this).toggleClass('active');

    });

    $(document).on('click', '.select-input span', function () {
        if ($(this).parent().parent().attr('class') == 'catalog__nav_sorting') {
            if (!$(this).hasClass('selected')) {
                preloaderStart();
                attr = $(this).attr('data-for');
                text = $(this).text();
                $('.select-orderby-js').text(text);
                $(this).parent().find('span').removeClass('selected');
                $(this).addClass('selected');
                $('#select option').removeAttr('selected');
                $('#select option[value="' + attr + '"]').prop('selected', true);
                $('#select option[value="' + attr + '"]').attr('selected', 'selected');
                $('#select').trigger('change');
            }
        }
    });

    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".quantity-js, .select-method-js, .select-orderby-js, .option-js-active, .quantity-input, .account-help-js, .pay-method-js"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.select-orderby-js').removeClass('active');
            $('.select-input, .options-js, .option-js-active, .account-help-select').removeClass('show');
            div.parents('.quantity').find('.quantity-input').attr('type', 'hidden');
            div.parents('.quantity').find('.quantity-js').css("display", "block");
            div.removeClass('active');
        }
    });

    $(document).on('click', '.control__hover_like, .account-like-js, .product-slider__like', function (e) {
        e.preventDefault();

        th = $(this);
        if (th.data('page') == 'account-likelist') {
            product_id = th.attr('product_id');
        }
        else if (th.data('page') == 'single-product') {
            product_id = th.attr('product_id');
        }
        else {
            product_id = th.parent().find('input[name=product_id]').val();
        }

        // console.log(product_id);


        var ajax_url = "/wp-admin/admin-ajax.php";
        $.ajax({
            type: 'POST',
            url: ajax_url,
            dataType: 'json',
            data: 'action=likelist&product_id=' + product_id + '',
            success: function (data) {
                var count_likelist = data.count_likelist;
                // console.log(count_likelist);

                // console.log(data.remove_id);


                if (th.data('page') == 'likelist') {
                    th.parents('.card').remove();
                    if (count_likelist == '') {
                        location.reload();
                    }
                }
                if (th.data('page') == 'account-likelist') {
                    th.parents('.account-like__content').remove();
                    if (count_likelist == '') {
                        location.reload();
                    }
                }
                if (th.hasClass('active')) {
                    set_message(msg_likelist_remove);
                    //notices_for_user.find('.notices_for_user_text').html(msg_likelist_remove);
                }
                th.toggleClass('active');

                if (th.hasClass('active')) {
                    if (th.data('page') == 'single-product') {
                        th.find('span').html('Добавлено<br>в избранное');
                    }
                    else {
                        th.text(msg_likelist_add);
                    }
                    set_message(msg_likelist_success);
                    //notices_for_user.find('.notices_for_user_text').html(msg_likelist_success);
                } else {
                    if (th.data('page') == 'single-product') {
                        th.find('span').html('Добавить<br>в избранное');
                    }
                    else {
                        th.text(msg_likelist_reset);
                    }
                }
                 yaCounter86800166.reachGoal('izbrannoe');
            },
            error: function () {
                set_message(msg_likelist_error);
                //notices_for_user.find('.notices_for_user_text').html(msg_likelist_error);
            }
        });
        // notices_for_user.addClass('show');
        // setTimeout(function () {
        // 	notices_for_user.removeClass('show');
        // }, 2000);

    });



    $(document).on('click', '.card__control_like', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $(this).parents('.card').find('.control__hover_like').trigger('click');
    });


    $(document.body).on('click', 'a.page-numbers, #reset_filter', function (e) {
        setTimeout(function () {
            $('html').animate({ scrollTop: $("header").offset().top }, 600);
        }, 300);
    });



    // ---------------------- КОНЕЦ КАТАЛОГ ----------------------

    $(document).on('click', '.price_reset_filter', function (e) {
        $('.price_reset_filter').remove();
        $('#reset-filter-price').trigger('click');
    });

    //Функция добавления товара в корзину (динамически без перезагрузки)
    $(document).on('click', '.add-to-cart-product-js', function (e) {
        e.preventDefault();
        input_quantity = $('.number-text');

        if ($(this).hasClass('descr-card__cart')) {
            var product_id = $(this).parents('.card.swiper-slide').find('.card__control_hover input[name=product_id]').val();
            var product_quantity = $(this).parents('.card.swiper-slide').find('.card__control_hover input[name=quantity]').val();
        }
        else {
            var product_id = $(this).parent().find('input[name=product_id]').val();
            var product_quantity = $(this).parent().find('input[name=quantity]').val();
        }

        if ($(this).hasClass('account-like__content_btn')) {
            var product_id = $(this).attr('product_id');
            var product_quantity = $(this).attr('quantity');
        }

        ajax_url = "/wp-admin/admin-ajax.php";
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: 'action=oneclick&product_id=' + product_id + '&quantity=' + product_quantity + '',
            success: function () {
                set_message(msg_basket_success);
                // notices_for_user.find('.notices_for_user_text').html(msg_basket_success);
                //notices_for_user.addClass('show');
                $(document.body).trigger('wc_fragment_refresh'); //ЭТО ШТУКА ОБНОВЛЯЕТ КОЛ-ВО ТОВАРОВ И СУММУ КОРЗИНЫ В HEADER
                setTimeout(function () {
                    // notices_for_user.removeClass('show');
                    input_quantity.val('1');
                }, 1000);
                 yaCounter86800166.reachGoal('add-card');
            },
            error: function () {
                set_message(msg_basket_error);
                // notices_for_user.find('.notices_for_user_text').html(msg_basket_error);
                notices_for_user.addClass('show');
                // setTimeout(function () {
                // 	notices_for_user.removeClass('show');
                // }, 4000);
            }
        });
    });

    //Закрыть уведомление пользователю по клику на блок уведомления
    $(document).on('click', '#message-wrapper .message', function () {
        var item = $('#message-wrapper .message');
        item.removeClass('show');
        setTimeout(() => { item.remove(); }, 500);
    });

    // ---------------------- НАЧАЛО КОРЗИНА ----------------------

    //Открытие select выбора кол-во товара
    $(document).on('click', '.quantity-js', function () {
        $(this).addClass('active');
        $(this).parent().find('.select-input').toggleClass('show');
        $('.quantity-js').not(this).parent().find('.select-input').removeClass('show');
    });

    //Применение выбора кол-ва, обновление корзины
    $(document).on('click', '.select-input span', function () {
        var select_input_num = $(this).attr("value");
        quantity_input = $(this).parents('.quantity').find('.quantity-input').val();
        if (select_input_num !== quantity_input) {
            $(this).parents('.quantity').find('.quantity-js').text(select_input_num);
            $('.select-input span').not(this).removeAttr('class');
            $(this).addClass('selected');
            $(this).parents('.quantity').find('.quantity-input').val(select_input_num);
            setTimeout(function () {
                $('.actions button[name="update_cart"]').removeAttr("disabled").trigger("click");
            }, 200);
        }
    });

    //Когда пользователь выбирает вставить другое число кол-во товара
    $(document).on('click', '.add-quantity-js', function () {
        th = $(this);
        th.parents('.quantity').find('.quantity-input').val('');
        th.parents('.quantity').find('.quantity-input').css("background", "none");
        th.parents('.quantity').find('.quantity-js').css("display", "none");
        th.parents('.quantity').find('.quantity-input').attr('type', 'number');
        th.parents('.quantity').find('.quantity-input').focus();

        // var div = $(this).parents('.quantity').find( ".quantity-input" );
        // $(document).mouseup( function(e) { // событие клика по веб-документу
        // 	var quantityInput = div.val();
        // 		if ( !div.is(e.target) && div.has(e.target).length === 0 ) { 
        // 			if (quantityInput == '') {
        // 				div.parents('.quantity').find('.quantity-input').attr('type', 'hidden');
        // 				div.parents('.quantity').find('.quantity-js').css("display", "block");
        // 			}
        // 		}
        // });
    });


    //При изменении ввода своего числа кол-во товаров в input обновляем корзину (срабатывает, когда убрали фокус с input)
    $(document).on('change', '.quantity, input[class="quantity-input"]', function () {
        setTimeout(function () {
            $('.actions button[name="update_cart"]').removeAttr("disabled").trigger("click");
        }, 200);
    });

    //Убрать фокус с input, когда нажали enter, или на ios готово, чтобы обновить корзину
    $(document).on('keydown', '.quantity input', function (event) {
        if (event.keyCode == 13) {
            input_keydown = $(this).parents('.quantity').find('.quantity-input');
            if (input_keydown.val() !== '') {
                input_keydown.blur();
            }
        }
    });

    //При обновлении корзины показать уведомление пользователю
    $(document).on('click', '.actions button[name="update_cart"], .showcase__close a', function () {
        if (document.documentElement.clientWidth > 991) {
            set_message(msg_basket_update);
        }
        // notices_for_user.find('.notices_for_user_text').html(msg_basket_update);
        // notices_for_user.addClass('show');
        // setTimeout(function () {
        // 	notices_for_user.removeClass('show');
        // }, 2000);
    });



    // ---------------------- КОНЕЦ КОРЗИНА ----------------------
    // ---------------------- НАЧАЛО АВТОРИЗАЦИИ, РЕГИСТРАЦИИ ----------------------

    //Вывод уведомлений по мин.сумме заказа и требование авторизоваться
    var total_warn = $('.total-warn');
    min_cart_amount = total_warn.data('min-amount');
    total_price = total_warn.data('total-price');
    domain_site_cart = document.location.origin + '/cart/';
    function min_cart_amount_space(n) {
        n += "";
        n = new Array(4 - n.length % 3).join("U") + n;
        return n.replace(/([0-9U]{3})/g, "$1 ").replace(/U/g, "");
    }
    if (document.URL == domain_site_cart) {
        if (total_price < min_cart_amount) {
            setTimeout(function () {
                if (document.documentElement.clientWidth > 991) {
                    set_message(msg_min_cart + '&nbsp;' + min_cart_amount_space(min_cart_amount) + '&nbsp;₽');
                }

                // notices_for_user.find('.notices_for_user_text').html(msg_min_cart + '&nbsp;' + min_cart_amount_space(min_cart_amount) + '&nbsp;₽');
                // notices_for_user.addClass('show');
                // setTimeout(function () {
                // 	notices_for_user.removeClass('show');
                // }, 4000);
            }, 800);
        }
        if ($('.total-warn').hasClass('auth')) {
            setTimeout(function () {
                if (document.documentElement.clientWidth > 991) {
                    set_message(msg_auth);
                }

                //notices_for_user.find('.notices_for_user_text').html(msg_auth);
                // notices_for_user.addClass('show');
                // setTimeout(function () {
                // 	notices_for_user.removeClass('show');
                // }, 4000);
            }, 800);
        }
    }

    //Открыть модалку по авторизации/регистрации
    $(document).on('click', '.auth-js', function () {
        if ($(this).hasClass('total-private__account')) {
            update_login_user();
        } else if ($(this).hasClass('total-private__registration')) {
            update_register_user();
        }
        $('.auth__account, .overlay-basket').addClass('open');
    });


    //Переключение между авторизации/регистрации при открытой модалке
    $(document).on('click', '.basket__register', function () {
        if ($(this).hasClass('btn-login')) {
            update_login_user();
        } else { update_register_user(); }
    });


    //По клику войти/зарегистрироваться проверяем форму на заполняемость, выводим требование
    $(document).on('click', '.basket__btn_log', function () {
        $('#auth-user input').focus(function () {
            if (!$.trim(this.value).length) {
                $(this).parents('.basket__field').find('span.error-mess').removeClass('d-hide');
            } else {
                $(this).parents('.basket__field').find('span.error-mess').addClass('d-hide');
            }
        });
    });

    //Убираем требование, когда ввел в input
    $('#auth-user input').blur(function () {
        if ($(this).val().length === 0) { } else {
            $(this).parents('.basket__field').find('span.error-mess').addClass('d-hide');
        }
    });

    //По клику на глазик input password меняем type (скрытый/открытый) ввод значений
    $(document).on('click', '.password__icon-eyes', function () {
        $(this).parent().find('.password__icon-eyes span').toggleClass('eyes-show');
        if ($(this).parent().find('.password__icon-eyes span').hasClass('eyes-show')) {
            $(this).parent().find('input').attr('type', 'text');
            $(this).parent().find('input').focus();
            $(this).parent().find('.password__icon-eyes').attr('title', 'Скрыть пароль');
        }
        else {
            $(this).parent().find('input').attr('type', 'password');
            $(this).parent().find('input').focus();
            $(this).parent().find('.password__icon-eyes').attr('title', 'Показать пароль');
        }
    });

    //Ставим value=1 в input checkbox если пол-ль согласился с политикой
    $(document).on('click', '#privacy_policy_cart', function () {
        if ($(this).is(':checked')) {
            $(this).attr('value', '1');
        } else {
            $(this).attr('value', '');
        }
    });

    //Закрыть модалку по overlay и крестика
    $(document).on('click', '.esc-popap, .overlay-basket.open', function () {
        $('.auth__account, .overlay-basket').removeClass('open');
    });

    // ---------------------- КОНЕЦ АВТОРИЗАЦИИ, РЕГИСТРАЦИИ ----------------------
    // ---------------------- НАЧАЛО ОФОРМЛЕНИЕ ЗАКАЗА ----------------------
    $('#billing_phone, #billing_email').attr('autocomplete', 'off');
    $('#organisation_inn').attr('maxlength', '12');
    $('#billing_email_field').css('pointer-events', 'none');
    $('#billing_email').prop('readonly', 'true');

    //Запретить ввод Ю 12 цифр в ИНН
    $(document).on('input', '#organisation_inn[maxlength]', function () {
        if (this.value.length > this.maxLength) {
            this.value = this.value.slice(0, this.maxLength);
        }
    });

    //Разрешено вводить только русс.буквы в ФИО
    $(document).on('input', '#billing_first_name, .basket__field #username, #feedback input[name="form-name"], #account_first_name', function () {
        this.value = this.value.replace(/[^а-яё\s]/gi, '');
    });

    //Маска e-mail
    $(document).on('input', '.basket__field #email, #feedback input[name="form-email"], #account_email', function () {
        this.value = this.value.replace(/[^a-z@\-_.0-9\s]/gi, '');
    });

    //Каждое слово в ФИО с заглавной буквой
    $('input#billing_first_name, .basket__field #username, #feedback input[name="form-name"], #account_first_name').keyup(function (evt) {
        var txt = $(this).val();
        $(this).val(txt.replace(/^(.)|\s(.)/g, function ($1) { return $1.toUpperCase(); }));
    });


    $('#billing_phone, input[name="form-tel"], #account_phone').mask("+7 (999) 999-99-99", {
        autoclear: false
    });



    $(document).on('click', '#place_order', function (e) {
        setInterval(function () {
            if ($('.woocommerce-error li span').hasClass('error_tel')) {
                $('#billing_phone_field').addClass('woocommerce-invalid woocommerce-invalid-required-field');
            }
        }, 200);

    });
    //Маска ввода телефона
    // [].forEach.call( document.querySelectorAll('#billing_phone, #feedback input[name="form-tel"]'), function(input) {
    // 	var keyCode;
    // 	function mask(event) {
    // 		event.keyCode && (keyCode = event.keyCode);
    // 		var pos = this.selectionStart;
    // 		if (pos < 3) event.preventDefault();
    // 		var matrix = "+7 (___) ___-__-__",
    // 			i = 0,
    // 			def = matrix.replace(/\D/g, ""),
    // 			val = this.value.replace(/\D/g, ""),
    // 			new_value = matrix.replace(/[_\d]/g, function(a) {
    // 				return i < val.length ? val.charAt(i++) || def.charAt(i) : a
    // 			});
    // 		i = new_value.indexOf("_");
    // 		if (i != -1) {
    // 			i < 5 && (i = 3);
    // 			new_value = new_value.slice(0, i)
    // 		}
    // 		var reg = matrix.substr(0, this.value.length).replace(/_+/g,
    // 			function(a) {
    // 				return "\\d{1," + a.length + "}"
    // 			}).replace(/[+()]/g, "\\$&");
    // 		reg = new RegExp("^" + reg + "$");
    // 		if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
    // 		if (event.type == "blur" && this.value.length < 5)  this.value = ""
    // 	}
    // 	input.addEventListener("input", mask, false);
    // 	input.addEventListener("blur", mask, false);
    // 	input.addEventListener("keydown", mask, false);
    // });


    // $(document).on('click', '#billing_phone', function () {
    //     $('#billing_phone').on("blur", function () {
    //         var minlength = $(this).attr('minlength');
    //         var maxlength = $(this).attr('maxlength');
    //         var phone_val = $(this).val();
    //         var clean_str_phone = phone_val.replace(/[^0-9]/g, '');
    //         if (clean_str_phone.length >= maxlength && clean_str_phone.length <= minlength) {
    //             $('#billing_phone_field').removeClass('woocommerce-invalid woocommerce-invalid-required-field');
    //         } else {
    //             $('#billing_phone_field').addClass('woocommerce-invalid woocommerce-invalid-required-field');
    //         }
    //     });
    // });


    //При клике на инпут телефона, при блюре проверяем значения
    $(document).on('click', '#billing_phone, #account_phone, .account_phone', function () {
        $('#billing_phone, #account_phone, .account_phone').on("blur", function () {
            var minlength = $(this).attr('minlength');
            var maxlength = $(this).attr('maxlength');
            var phone_val = $(this).val();
            var clean_str_phone = phone_val.replace(/[^0-9]/g, '');
            if (clean_str_phone.length >= maxlength && clean_str_phone.length <= minlength) {
                $(this).parent().find('span').text('Необходимо заполнить телефон');
                $('#billing_phone_field, #account_phone_field').removeClass('woocommerce-invalid woocommerce-invalid-required-field');
            } else {
                $(this).parent().find('span').text('Введите полностью телефон');
                $('#billing_phone_field, #account_phone_field').addClass('woocommerce-invalid woocommerce-invalid-required-field');
            }
        });
    });

    //Открываем select по любому методу, объявляем функции обновления контента доставки, оплаты
    $(document).on('click', '.select-method-js', function () {
        update_select_method_shipping();
        update_select_method_payment();
        $(this).addClass('active');
        $(this).parent().find('.select-input').toggleClass('show');
        $('.select-method-js').not(this).parent().find('.select-input').removeClass('show');

    });

    //Работаем определенно с разными вариантами нажатий на span внутри select
    $(document).on('click', '.select-input span', function () {
        if ($(this).parent().attr('id') === 'shipping-method') {
            if (!$(this).hasClass('selected')) {
                $(this).parent().parent().find('.select-method-js').text($(this).text());
                var data_for = $(this).attr('data-for');
                $(this).parent().find('span').removeAttr('class');
                $(this).addClass('selected');
                $('#shipping_method label[for="' + data_for + '"]').trigger('click');
                $('#payment-method').find('span.selected').removeAttr('class');
                $('.payment-form__field').find('.select-method-js').removeClass('light-opacity');
                $('#payment-method').parent().find('.select-method-js').text('Выберите метод оплаты');
                $('.shipping-form__field').find('.error-mess').removeClass('d-show');
                $('.pay-price__title').text('Ваш заказ:');
                $('#place_order').text('Оформить заказ');
            }
        }
        if ($(this).parent().attr('id') === 'payment-method') {
            $(this).parent().parent().find('.select-method-js').text($(this).text());
            var data_for = $(this).attr('data-for');
            $(this).parent().find('span').removeAttr('class');
            $(this).addClass('selected');
            $('#payment label[for="' + data_for + '"]').trigger('click');
            if ($(this).text() !== '') {
                $('.payment-form__field').find('.error-mess').removeClass('d-show');
            }
            // if ($(this).attr('data-for') == 'payment_method_yookassa_epl') {
            if ($(this).attr('data-for') == 'payment_method_yookassa_widget') {

                $('.pay-price__title').text('Итого к оплате:');
                $('#place_order').text('оплатить заказ');
            }
            else {
                $('.pay-price__title').text('Ваш заказ:');
                $('#place_order').text('Оформить заказ');
            }
        }
        if ($(this).parent().attr('id') === 'order-pay-method') {
            var data_for = $(this).attr('data-for');
            $('#payment-order-pay').find('input[name="payment_method"]').removeAttr('checked');
            $('#payment-order-pay').find('input[id="' + data_for + '"]').attr('checked', 'checked');
            $('#payment-order-pay').find('input[id="' + data_for + '"]').prop('checked', true);
            update_select_method_order_pay();
        }
        if ($(this).parent().attr('id') === 'motive-cancel-method') {
            $('#motive-cancel-method').find('span').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).text();
            $('.motive-cancel-js').text(text);
            $('form.cancel-order').find('input[name="form-motive"]').val(text);
        }

    });

    //При обновлении checkout работаем с checked доставки/оплаты (технические скрытые)
    $(document).on('updated_checkout', function () {
        //при изменении checked (выбран) в доставке, добавляем класс
        $('input[type=radio][class="shipping_method"]').change(function () {
            $('#order_review').addClass('shipping_method_made');
        });
        //если нету класса, удаляем все checked в доставке/оплате
        if (!$('#order_review').hasClass('shipping_method_made')) {
            $('#shipping_method input[name="shipping_method[0]"], #payment input[name="payment_method"]').attr('checked', false);
        }
        //при изменении на новый checked в доставке, удаляем checked в оплате
        else {
            $('#payment input[name="payment_method"]').attr('checked', false);
        }
    });

    //При клике оформить/оплатить заказ, проверяем заполняемость методов доставки/оплаты, иначе ошибка
    $(document).on('click', '#place_order', function () {
        if (!$('#shipping-method').find('span').hasClass('selected')) {
            $('#shipping-method').parent().find('.error-mess').addClass('d-show');
        }
        if (!$('#payment-method').find('span').hasClass('selected')) {
            $('#payment-method').parent().find('.error-mess').addClass('d-show');
        }
    });

    //ОФОРМЛЕНИЕ ЮРИДИЧЕСКОГО ЗАКАЗА
    var checked_company = $('input#organisation_company');
    if (checked_company.is(':checked')) {
        console.log('checked');
        var count_org = 1;
    }
    else {
        var count_org = 0;
    }

    $(document).on('click', '.register__radio', function () {
        $(this).find('.custom-radio').toggleClass('off');
        if (count_org == 0) {
            $('input[id="organisation_company"]').prop('checked', true);
            $('.organisation__fields').removeClass('d-hide');

            count_org++;
            return count_org;
        }
        if (count_org == 1) {
            $('input[id="organisation_private_person"]').prop('checked', true);
            $('.organisation__fields').addClass('d-hide');
            count_org--;
            return count_org;
        }
    });












    // ---------------------- КОНЕЦ ОФОРМЛЕНИЕ ЗАКАЗА ----------------------

    //При клике на ссылку гибридного меню приложения
    $(document).on('click', '.mob-navigation a', function () {
        $(this).parents('.mob-navigation').find('.mob-navigation__link').removeClass('active');
        $(this).parent().addClass('active');
    });

    if (!$('.favourites .card').length > 0) {
        $('.favourites-null').removeClass('d-hide');
        $('.favourites').remove();
    }

    setInterval(function () {
        const likelist_count_product = Cookies.get('favorites_product_count');
        const basket_count_product = Cookies.get('sht_woo_basket_count');
        const basket_amount = $('.header__menu_basket.desktop .header__icon_sum').text();
        if (likelist_count_product == '' || likelist_count_product == '0' || !likelist_count_product) {
            count_like_desktop.find('span').remove();
            count_like_mob.find('span').remove();
        } else {
            count_like_desktop.find('span').remove();
            count_like_desktop.find('img').after('<span class="header__icon_num">' + likelist_count_product + '</span>');
            count_like_mob.find('span').remove();
            count_like_mob.find('a').after('<span>' + likelist_count_product + '</span>');
        }
        if (basket_count_product == '' || basket_count_product == '0' || !basket_count_product) {
            basket_count_mob.find('span').remove();
            basket_count_burger.find('span').remove();
            basket_count_burger.find('img').after('<span>Корзина</span>');
        }
        else {
            basket_count_mob.find('span').remove();
            basket_count_burger.find('span').remove();
            basket_count_burger.find('img').after('<span class="header__icon_num">' + basket_count_product + '</span><span class="header__icon_sum">' + basket_amount + '</span>');
            basket_count_mob.find('a').after('<span>' + basket_count_product + '</span>');
        }
    }, 1000);

    //Открытие select выбора и закрытие в личном кабинете
    $(document).on('click', '.account-help-js', function () {
        $(this).addClass('active');
        $(this).parent().find('.account-help-select').toggleClass('show');
        $('.account-help-js').not(this).parent().find('.account-help-select').removeClass('show');
    });

    $(document).on('click', '.account-help-select span', function () {
        var selected_val = $(this).attr('value');
        $(this).parent().parent().find('.account-help-select span').removeAttr('class');
        $(this).addClass('selected');
        $(this).parent().parent().find('.account-help-js').html(selected_val);
        $(this).parents('.form-row').find('input.insert').val(selected_val);
        // console.log(selected_val);
    });


    var edit_account = $('form.edit-account');
    var edit_password = $('form.edit-password');
    if (edit_account.length > 0) {
        var error_class = 'woocommerce-invalid woocommerce-invalid-required-field';
        $('#account_billing_city, #account_billing_address, #organisation_name, #organisation_inn').on("blur", function () {
            var account_th_val = $(this).val();
            if (account_th_val !== '') {
                $(this).parent().removeClass(error_class);
            } else {
                $(this).parent().addClass(error_class);
            }
        });
        if ($('.woocommerce-MyAccount-navigation-link--edit-account').hasClass('is-active')) {
            $('.woocommerce-MyAccount-navigation-link--account-info').addClass('is-active');
        }


        edit_account.find('#account_phone').click();
        edit_account.find('#account_phone').blur();
        edit_account.find('input').each(function (e) {
            $(this).focus();
            $(this).blur();
        });



    }
    $('.woocommerce-MyAccount-navigation-link--edit-account').addClass('d-hide');


    if ($('.basket').hasClass('login-form')) {
        update_login_user();
    }

    if ($('form.edit-password').length > 0) {
        setInterval(function () {
            $(document).on('change keyup input', 'form.edit-password input#password_2', function () {
                var change_password_1 = $('form.edit-password input#password_1').val();
                var change_password_2 = $('form.edit-password input#password_2').val();
                if (change_password_2 !== change_password_1) {
                    $(this).parent().addClass('woocommerce-invalid woocommerce-invalid-required-field');
                } else {
                    $(this).parent().removeClass('woocommerce-invalid woocommerce-invalid-required-field');
                }
            });
        }, 0);
    }
    if ($('.modal-account-order-pay').length > 0) {
        update_select_method_order_pay();
        $(document).on('click', '#change-payment-method', function () {
            $('.modal-account-order-pay, #overlay').css('display', 'block');
            $('#overlay').css('z-index', '209');
        });

        $(document).on('click', '#pay-now', function () {
            $('#order-pay-method').find('span[data-for="payment_method_yookassa_epl"]').trigger('click');
            $('.modal-account-order-pay-btn').find('#place_order').trigger('click');
        });

        var urlString = location.href.split(location.host)[1];
        if (urlString.indexOf('&pay-now=true') >= 0) {
            $('#order-pay-method').find('span[data-for="payment_method_yookassa_epl"]').trigger('click');
            $('.modal-account-order-pay-btn').find('#place_order').trigger('click');
        }
        else {
            $('#change-payment-method').trigger('click');
        }

        $(document).on('click', '.modal-account-order-pay .close-button', function () {
            $('.modal-account-order-pay, #overlay').removeAttr('style');
            // $('#overlay').removeAttr('style');
            // $('.modal-account-order-pay').css('display','none');
        });

        $(document).on('click', '.pay-method-js', function () {
            $('#order-pay-method').toggleClass('show');
            $(this).toggleClass('active');
        });
    }
    if ($('.modal-account-cancel-order').length > 0) {

        $(document).on('click', '#cancel-order-js', function () {
            $('.modal-account-cancel-order, #overlay').css('display', 'block');
            $('#overlay').css('z-index', '209');
        });
        $(document).on('click', '.motive-cancel-js', function () {
            $('#motive-cancel-method').toggleClass('show');
            $(this).toggleClass('active');
        });
        $(document).on('click', '.modal-account-cancel-order .close-button', function () {
            $('.modal-account-cancel-order, #overlay').removeAttr('style');
            //$('.modal-account-cancel-order').css('display','none');
        });
    }



});