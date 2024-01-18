
//------------------------------------------------
function addClassActie(btn, containerForActive) {
	btn.on("click", function () {
		containerForActive.addClass('active');
		$('body').addClass('stop-scrolling');
	});
}

function removeClassActie(btnClose, containerForActive) {
	btnClose.on("click", function () {
		containerForActive.removeClass('active');
		$('body').removeClass('stop-scrolling');
	});
}

// MatchMedia ------------------------------------
function checkingMatchMedia(minScreenWidths = 991, trueFuncName) {
	const mediaQuery = window.matchMedia(`(min-width: ${minScreenWidths}px)`);
	function handleTabletChange(e) {
		// Проверить, что media query будет true
		if (e.matches) {
			trueFuncName();
		}
	}
	mediaQuery.addListener(handleTabletChange); // Слушать события
	handleTabletChange(mediaQuery); // Начальная проверка
}


$(function () {
	// Бургер -----------------------------------
	const btnBurger = $('#btn-burger');
	const burgerContainer = $('.burger-wrapper');
	const btnClose = $('.icon-close');

	addClassActie(btnBurger, burgerContainer);
	removeClassActie(btnClose, burgerContainer);

	burgerContainer.mouseup(function (e) {
		var div = $(".burger");
		if (!div.is(e.target)
			&& div.has(e.target).length === 0) {
			btnClose.trigger('click');
		}
	});

	burgerContainer.removeClass('active');
	$('body').removeClass('stop-scrolling');


	const triggerClickClose = () => btnClose.trigger('click');

	checkingMatchMedia(991, triggerClickClose);


	// Mеню навигации -----------------------------
	const btnClientNav = $('.client__nav_btn');
	const clientNavContainer = $('.client__nav');
	const btnClientClose = $('.client__nav_esc');

	addClassActie(btnClientNav, clientNavContainer);
	removeClassActie(btnClientClose, clientNavContainer);

	const triggerClickCloseClientNav = () => btnClientClose.trigger('click');
	checkingMatchMedia(991, triggerClickCloseClientNav);


	// выезд sidebar снизу
	if ($('.sidebar').length) {
		$(document).on('click', '.btn__filter', function () {
			$('.catalog__sidebar.sidebar').animate({ scrollTop: $("header").offset().top }, 0);
			$('.catalog__sidebar.sidebar').addClass('active');
			// $('.sidebar').css({ 'top': '0px', 'zIndex': '300' });
			$('.apply_filter').show();
			setTimeout(function () {
				$('.apply_filter').css('bottom', '0px');
			}, 300);

		});
		$(document).on('click', '.btn-close__filter', function () {
			$('.catalog__sidebar.sidebar').removeClass('active');
			$('.apply_filter').hide();

			// setTimeout(function () {
			// 	$('.apply_filter').removeClass('active');
			// }, 300);
		});
	}

	if ($('.akkardion__wrapper').length) {
		$(".akkardion__title, .akkardion__text").on("click", function () {
			$(".akkardion__title").not(this).removeClass("active").next(".akkardion__text").slideUp(200);
			$(".akkardion__wrapper").not(this).removeClass("active");
			$(this).toggleClass("active").next(".akkardion__text").slideToggle(200);
			$(this).parent().toggleClass("active");
		});
		$(".akkardion__wrapper:first-child .akkardion__title").addClass("active").next(".akkardion__text").slideToggle(200);
		$(".akkardion__wrapper:first-child").addClass("active");
	}


	// oткрытие попапа с фото
	//при клике на image-slider__image к .modal-img и  id="overlay"  добовляется modal-open

	// const btnPopupOpen = $('.image-slider__image');
	const btnPopupOpen = $('.swiper-zoom-container');


	const btnClosePopup = $('.close-button');

	btnPopupOpen.on("click", function () {
		$('.modal-img').addClass('modal-open');
		$('body').addClass('stop-scrolling');
		console.log('клик');
	});

	btnClosePopup.on("click", function () {
		$('body').removeClass('stop-scrolling');
		$('.modal-img').removeClass('modal-open');
	});


	// добовляет пробелы к ценам --------------------------
	$('.price-gap').text((i, text) => {
		const [price] = text.split(' ');
		return price ? `${(+price).toLocaleString()} ` : '';
	});

	//карточка товара добавление-удаления фона у стрелок
	$(window).on('load resize', function () {
		const a = $('.image-mini-slider__slide').length;
		if (a > 5) {
			$('.image-mini-slider').addClass('bottomBg');
		}
		$('.button-mini-next').on("click", function () {
			if ($('.product-slider__wrapper-vertical').find('.button-mini-prev').hasClass('swiper-button-disabled')) {
				console.log('next есть класс disabled');
			} else {
				console.log('next нет класса disabled');
				$('.image-mini-slider').addClass('topBg');
			}
		});
		$('.button-mini-prev').on("click", function () {
			if ($('.product-slider__wrapper-vertical').find('.button-mini-prev').hasClass('swiper-button-disabled')) {
				console.log('prev есть класс disabled');
				$('.image-mini-slider').removeClass('topBg');
			} else {
				console.log('prev нет класса disabled');
			}
		});
	});

	// ?Действия при изменении экрана ----------------
	$(window).on('load resize', function () {
		// ! больше 991
		if (document.documentElement.clientWidth >= 991) {
			$('.catalog__sidbar ').text('Войти в аккаунт');
			// $('.apply_filter.sidebar-mob').removeAttr('style');
			// } else {
			// $('.total-private__account').text('Войдите в личный кабинет');
		}
		// ! 991
		if (document.documentElement.clientWidth < 991) {
			$('.total-private__account').text('Войти в аккаунт');
		} else {
			$('.total-private__account').text('Войдите в личный кабинет');
		}
		// ! 850
		// ?меняем блоки местами | страница page-product.html ------------------
		if (document.documentElement.clientWidth < 850) {
			$('.product-descr .product-descr__count').insertBefore('.product');
		} else {
			$('.product-descr__count').insertBefore('.product-descr__specifications');
		}
		// ! 750
		if (document.documentElement.clientWidth < 750) {
			if ($('.shopping-cart__total_container').children().hasClass('total-warn')) {
				$('.total-price__sum').hide();
			} else {
				$('.total-price__sum').show();
			}
		} else {
			$('.total-price__sum').show();
		}
		// ! 575
		if (document.documentElement.clientWidth < 575) {
			$('.account-like__content_btn').text('');
		} else {
			$('.account-like__content_btn').text('в корзину');
		}
		// ! 500
		if (document.documentElement.clientWidth < 500) {
			$('.shopping-cart__total .btn').text('к оформлению');
		} else {
			$('.shopping-cart__total .btn').text('перейти к оформлению');
		}
		// ! 386
		if (document.documentElement.clientWidth < 386) {
			$('.basket__btn .basket__btn_log').attr('value', 'войти');
		} else {
			$('.basket__btn .basket__btn_log').attr('value', 'войти на сайт');
		}
	});

	$(window).on('load resize', function () {

		$('.sidebar h4 a').text('');

		// Личный кабинет | Убирает header & footer, меняет фон body
		const a = $('section').hasClass('personal-account'),
			b = $('.personal-account').hasClass('control-panel');

		function closePopapBottom() {
			$('.popap-account').css("top", "120vh");
			$('#overlay').removeClass("modal-open");
			$('body').removeClass('stop-scrolling');
		}
		function openPopapBottom() {
			$('.popap-account').css("top", "0px");
			$('#overlay').addClass("modal-open");
			$('body').addClass('stop-scrolling');
		}



		if (a && !b) {
			$('.header__wrapper, .burger, .header-catalog, .header-page__catalog').addClass('header-account');
			$('.footer').addClass('footer-account');
			if (document.documentElement.clientWidth < 991) {
				if ($('.personal-account').hasClass('personal-account-item')) {
					$('body').css("backgroundColor", "#fff");
				} else {
					$('body').removeAttr('style');
				}
			} else {
				$('body').css("backgroundColor", "#F0ECE6");
			};
			if (document.documentElement.clientWidth > 575) {
				closePopapBottom()
			}

			$('.account-order__btn').on("click", function () {
				openPopapBottom()
			});
			$('.popap-account').mouseup(function (e) { // событие клика по веб-документу
				var div = $(".mob-popap"); // тут указываем ID элемента
				if (!div.is(e.target)
					&& div.has(e.target).length === 0) { // и не по его дочерним элементам
					closePopapBottom(); // скрываем его
				}
			});
			$('.popap-account').find('.account-order__btn').on("click", function () {
				closePopapBottom();
			});
		}

		//о компании | перестановка блока при изменение ширины экрана
		if (document.documentElement.clientWidth < 750) {
			if ($('.about').find('.about__item')) {
				$('.about__item_img').insertBefore('.about-descr__title');
				$('.about__item:nth-child(2) .title-h3').insertBefore('.about__item:nth-child(2) .about-descr__text .text:nth-child(1)');
			}
		}
		else {
			if ($('.about').find('.about__item')) {
				$('.about__item_img').insertBefore('.about__item:nth-child(2) .title-h3');
				$('.about__item:nth-child(2) .title-h3').insertBefore('.about__item:nth-child(2) .about-descr__text');
			}
		}

	});

	// ? добовляем active ------------------------------------------
	const funcToggleClickActive = function (clickActive) {
		clickActive.on("click", function (e) {
			$(this).parent().toggleClass('active');
		});
	}
	const clickActive = $('.menu-arrow');
	funcToggleClickActive(clickActive);

	// ? добовляем hover ------------------------------------------
	$('.question').hover();

	//карточка товара добавление-удаления фона у стрелок
	if ($('.image-mini-slider__slide').length) {
		$(window).on('load resize', function () {
			const slide = $('.image-mini-slider__slide').length
			if (slide > 5) {
				$('.image-mini-slider').addClass('bottomBg')
			}
			$('.button-mini-next').on("click", function () {
				if ($('.product-slider__wrapper-vertical').find('.button-mini-prev').hasClass('swiper-button-disabled')) {
				} else {
					$('.image-mini-slider').addClass('topBg')
				}
			});
			$('.button-mini-prev').on("click", function () {
				if ($('.product-slider__wrapper-vertical').find('.button-mini-prev').hasClass('swiper-button-disabled')) {
					// console.log('prev есть класс disabled');
					$('.image-mini-slider').removeClass('topBg')
				}
			});
		});
	}
});


// ---------------------------------------------------------

// ? Инициализируем Swiper ------------------------------------------
if (document.querySelectorAll(".swiper-slide").length) {
	// !Слайдер "Первый экран"
	const swiperMain = new Swiper('.first-swiper', {
		grabCursor: true,
		slidesPerView: 1,
		// Отключение функционала если слайдов меньше чем нужно
		watchOverflow: true,
		// Количество пролистываемых слайдов
		slidesPerGroup: 1,
		spaceBetween: 30,
		// effect: 'fade',
		navigation: {
			nextEl: '.button-next',
			prevEl: '.button-prev'
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		},
		breakpoints: {
			320: {
				slidesPerView: 1,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
			},
			992: {
				slidesPerView: 1,
			},
			1250: {
				slidesPerView: 2,
				effect: 'slide',
			},
		}
	});

	const buttonPrev = document.querySelector('.button-prev'),
		buttonNext = document.querySelector('.button-next'),
		quantitySwiperMain = document.querySelectorAll(".first-slide").length

	swiperMain.on('transitionEnd', function () {
		if (swiperMain.realIndex === 0) {
			buttonPrev.style.opacity = '0.3';
		} else {
			buttonPrev.style.opacity = '0.8';
		}
		if (quantitySwiperMain === swiperMain.realIndex + 2) {
			buttonNext.style.opacity = '0.3';
		} else {
			buttonNext.style.opacity = '0.8';
		}

		if (document.documentElement.clientWidth < 1250) {
			if (quantitySwiperMain === swiperMain.realIndex + 1) {
				buttonNext.style.opacity = '0.3';
			} else {
				buttonNext.style.opacity = '0.8';
			}
		}
	});

	// !Слайдер "Вы смотрели ранее"
	function swiperLooked() {
		new Swiper('.looked__slider', {
			grabCursor: true,
			simulateTouch: true,
			navigation: {
				nextEl: '.looked-button-next',
				prevEl: '.looked-button-prev'
			},
			pagination: {
				el: '.slider-pagination',
				type: 'bullets',
				clickable: true,
			},
			slidesPerView: 3,

			// Отключение функционала если слайдов меньше чем нужно
			watchOverflow: true,

			// Количество пролистываемых слайдов
			slidesPerGroup: 1,
			// Отступ между слайдами
			spaceBetween: 34,
			// Обновить свайпер при изменении элементов слайдера
			observer: true,
			// Обновить свайпер при изменении родительских элементов слайдера
			observeParents: true,
			// Обновить свайпер при изменении дочерних элементов слайда
			observeSlideChildren: true,

			breakpoints: {
				300: {
					slidesPerView: 1,
					spaceBetween: 0
				},
				575: {
					slidesPerView: 2,
					spaceBetween: 34,
				},
				850: {
					slidesPerView: 3,
					spaceBetween: 34,
				},
				1245: {
					slidesPerView: 3,
					spaceBetween: 60
				},
			}
		});
	}
	$(function () {
		$(window).on('load resize', function () {
			if ($('.looked__slider').hasClass('worker')) {
				swiperLooked()
				const countItemCard = $('.card').length;
				const btnsCard = $('.looked-button-prev, .looked-button-next');

				if (document.documentElement.clientWidth >= 850 && countItemCard <= 3) {
					btnsCard.addClass('disabled');
				} else if (document.documentElement.clientWidth >= 575 && countItemCard <= 2) {
					btnsCard.addClass('disabled');
				} else if (document.documentElement.clientWidth >= 300 && countItemCard <= 1) {
					btnsCard.addClass('disabled');
				} else {
					btnsCard.removeClass('disabled');
				}
			}
		});
	});


	// !Слайдер "ХИТЫ / НОВИНКИ / АКЦИИ"
	// !Фильтр

	$(function () {
		const lists = $('.looked__filter');
		const listFirstEl = $('.looked__filter li:eq(0)');
		// console.log(listFirstEl);

		$(window).on('load', function () {
			listFirstEl.trigger('click');
		});

		lists.find('li').click(function () {
			$(this).addClass('active');
			lists.find('li').not(this).removeClass('active');
			let dataType = $(this).data('id');
			// console.log(`по клику получила дата атрибут: ${dataType}`);
			let arrLookedWrapper = $('.card.swiper-slide.' + dataType + '');
			$('.card.swiper-slide').css('display', 'none');
			arrLookedWrapper.css('display', 'grid');
			swiperLooked();
		});
	});

	// !Слайдер в слайдере
	function swiperCard() {
		new Swiper('.card-container', {
			// Курсор перетаскивания
			grabCursor: true,
			// Навигация
			// пагинация, текущее положение, прогрессбар
			pagination: {
				el: '.swiper-pagination',
				// Буллеты
				clickable: true,
			},
			// Корректная работа свайпа для дочернего слайдера
			nested: true,
			// Обновить свайпер при изменении элементов слайдера
			observer: true,
			// Обновить свайпер при изменении родительских элементов слайдера
			observeParents: true,
			// Обновить свайпер при изменении дочерних элементов слайда
			observeSlideChildren: true,
			// Cмена прозрачности
			effect: 'fade',
			// Отключить предзагрузка картинок
			preloadImages: false,
			// Lazy Loading
			// (подгрузка картинок)
			lazy: {
				// Подгружать на старте
				// переключения слайда
				loadOnTransitionStart: true,
				// Подгрузить предыдущую
				// и следующую картинки
				loadPrevNext: true,
			},
			// Слежка за видимыми слайдами
			watchSlidesProgress: true,
			// Добавление класса видимым слайдам
			watchSlidesVisibility: true,
		});
	}
	swiperCard();

	// !Слайдер товаров ======================================
	const swiperImg = new Swiper('.image-slider', {
		navigation: {
			nextEl: '.button-next',
			prevEl: '.button-prev',
		},
		// Навигация
		// Буллеты, текущее положение, прогрессбар
		pagination: {
			el: '.number-pagination',
			type: 'fraction',
		},

		// grabCursor: true,
		// Управление клавиатурой
		keyboard: {
			enabled: true,
			onlyInViewport: true,
			pageUpDown: true,
		},
		slidesPerView: 1,
		// Отключение функционала если слайдов меньше чем нужно
		watchOverflow: true,
		// Количество пролистываемых слайдов
		slidesPerGroup: 1,

		// Эффекты переключения слайдов. Листание
		effect: 'fade',





		// Обновить свайпер при изменении элементов слайдера
		observer: true,
		// Обновить свайпер при изменении родительских элементов слайдера
		observeParents: true,
		// Обновить свайпер при изменении дочерних элементов слайда
		observeSlideChildren: true,

		// Отключить предзагрузка картинок
		preloadImages: false,
		// Lazy Loading
		// (подгрузка картинок)
		lazy: {
			// Подгружать на старте
			// переключения слайда
			loadOnTransitionStart: true,
			// Подгрузить предыдущую
			// и следующую картинки
			loadPrevNext: true,
		},
		// Слежка за видимыми слайдами
		watchSlidesProgress: true,
		// Добавление класса видимым слайдам
		watchSlidesVisibility: true,





		// Миниатюры (превью)
		thumbs: {
			// Свайпер с мениатюрами и его настройки
			swiper: {
				el: '.image-mini-slider',
				slidesPerView: 5,
				// Отступ между слайдами
				spaceBetween: 26,
				// Вертикальный слайдер
				direction: 'vertical',
				navigation: {
					nextEl: '.button-mini-next',
					prevEl: '.button-mini-prev',
				},
				// Отключить предзагрузка картинок
				preloadImages: false,
				// Lazy Loading
				// (подгрузка картинок)
				lazy: {
					// Подгружать на старте
					// переключения слайда
					loadOnTransitionStart: true,
					// Подгрузить предыдущую
					// и следующую картинки
					loadPrevNext: true,
				},
				// Слежка за видимыми слайдами
				watchSlidesProgress: true,
				// Добавление класса видимым слайдам
				watchSlidesVisibility: true,
			}
		},
	});
	swiperImg.on('transitionEnd', function () {
		if ($('.image-mini-slider__slide').last().hasClass('swiper-slide-thumb-active')) {
			$('.image-mini-slider').removeClass('bottomBg')
		}
	});
	// !Слайдер popup ======================================
	const swiperPopup = new Swiper('.popup-img', {
		navigation: {
			nextEl: '.popup-btn-next',
			prevEl: '.popup-btn-prev',
		},
		// Навигация
		// Буллеты, текущее положение, прогрессбар
		pagination: {
			el: '.popup-pagination',
			type: 'fraction',
		},

		grabCursor: true,
		// Управление клавиатурой
		keyboard: {
			enabled: true,
			onlyInViewport: true,
			pageUpDown: true,
		},

		slidesPerView: 1,
		// Отключение функционала если слайдов меньше чем нужно
		watchOverflow: true,
		// Количество пролистываемых слайдов
		slidesPerGroup: 1,

		// Эффекты переключения слайдов. Листание
		effect: 'fade',
		// Обновить свайпер при изменении элементов слайдера
		observer: true,
		// Обновить свайпер при изменении родительских элементов слайдера
		observeParents: true,
		// Обновить свайпер при изменении дочерних элементов слайда
		observeSlideChildren: true,

		// Отключить предзагрузка картинок
		preloadImages: false,
		// Lazy Loading
		// (подгрузка картинок)
		lazy: {
			// Подгружать на старте
			// переключения слайда
			loadOnTransitionStart: true,
			// Подгрузить предыдущую и следующую картинки
			loadPrevNext: true,
		},
		// Слежка за видимыми слайдами
		watchSlidesProgress: true,
		// Добавление класса видимым слайдам
		watchSlidesVisibility: true,
	});

	// !Слайдер "C этим товаром покупают"
	function swiperKit() {
		const swiperKit = new Swiper('.kit-slider', {
			navigation: {
				nextEl: '.kit-button-next',
				prevEl: '.kit-button-prev'
			},

			grabCursor: true,
			slidesPerView: 2,
			// Отключение функционала если слайдов меньше чем нужно
			// watchOverflow: true,
			// Количество пролистываемых слайдов
			slidesPerGroup: 1,
			// Отступ между слайдами
			spaceBetween: -20,
			breakpoints: {
				850: {
					slidesPerView: 3,
					spaceBetween: 0,
				},
			},
		});
	}
	swiperKit();
	// !Слайдер About ======================================
	const swiperAbout = new Swiper('.about-slider', {
		navigation: {
			nextEl: '.about-next',
			prevEl: '.about-prev',
		},
		// Навигация
		// Буллеты, текущее положение, прогрессбар
		pagination: {
			el: '.about-pagination',
			type: 'fraction',
		},
		grabCursor: true,
		slidesPerView: 1,
		// Отключение функционала если слайдов меньше чем нужно
		watchOverflow: true,
		// Количество пролистываемых слайдов
		slidesPerGroup: 1,
		// Эффекты переключения слайдов. Листание
		effect: 'fade',
	});
	// !Слайдер About сертификаты ======================================
	const swiperAboutСertified = new Swiper('.certified__catalog', {
		pagination: {
			el: '.certified-pagination',
			clickable: true,
		},
		grabCursor: true,
		slidesPerView: 3,
		// Отключение функционала если слайдов меньше чем нужно
		watchOverflow: true,
		// Количество пролистываемых слайдов
		slidesPerGroup: 1,
		breakpoints: {
			310: {
				slidesPerView: 1,
			},
			575: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
			992: {
				spaceBetween: 60,
			}
		},
	});
}



// --------------- Аккардион ----------------------------------------

const akkardionFunc = function (elWrapperAkkardion, windowWidth = 5000, cildren = false) {
	$(window).on('load resize', function () {
		if (document.documentElement.clientWidth <= windowWidth) {
			let accordions = document.querySelectorAll(elWrapperAkkardion);
			accordions.forEach(acco => {
				accordions.forEach(subAcco => {
					subAcco.classList.remove('active')
				});

				let accordionCildren = acco.childNodes[1];
				const akkardionFuncClick = () => {
					console.log('click')
					accordions.forEach(subAcco => {
						subAcco.classList.remove('active')
					});
					acco.classList.add('active');
				}
				if (cildren == true) {
					accordionCildren.onclick = (event) => {
						event.preventDefault()
						akkardionFuncClick()
					}
				} else {
					acco.onclick = (event) => {
						event.preventDefault()
						akkardionFuncClick()
					}
				}
			})
		}
		else {
			let accordions = document.querySelectorAll(elWrapperAkkardion);
			accordions.forEach(acco => {
				acco.classList.remove('active')
			})
		}
	});
}


const elWrapperNav = '.footer__wrapper_link';
const windowWidth = 992;
const accordionCildren = 1;
akkardionFunc(elWrapperNav, windowWidth, accordionCildren);

