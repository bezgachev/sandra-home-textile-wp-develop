$(function () {
	
	$(window).on('load resize', function () {
		// if (document.documentElement.clientWidth < 992) {
  //           myMap.setCenter([55.75396, 37.620393]);
  //       }
        if (document.documentElement.clientWidth < 575) {
            $('.ymaps-2-1-79-controls__control').css("inset", "40px 20px auto auto");
        } else {
        	$('.ymaps-2-1-79-controls__control').css("inset", "190px 40px auto auto");
        }
    });

	// ---------------------- НАЧАЛО ЯНДЕКС КАРТЫ ----------------------
	setTimeout(function () {
		$('.options-js').find('span')[0].click();
	}, 800);


	$(document).on('click', '.option-js-active', function () {
		$(this).parent().find('.options-js').toggleClass('show');
		$(this).addClass('show');
	});
	$(document).on('click', '.option-js', function () {
		var th = $(this);
		// Замена адреса по клику селекта
		addr = th.attr('addr');
		addrhref = th.attr('2gis');
		mode = th.attr('mode');
		tel = th.attr('tel');
		telhref = th.attr('telhref');
		wrapperDescr = $('.contacts__info_descr');
		optionActive = th.text();
		option = th.parents('.select-js').find('.option-js-active').text();
		$('.option-js-active').removeClass('show');
		th.addClass('selected');
		$('.option-js').not(this).removeClass('selected');
		if (optionActive !== option) {
			th.parents('.select-js').find('.option-js-active').text(optionActive);
			wrapperDescr.find('#addr').html(addr);
			wrapperDescr.find('#addr').attr('href', addrhref);
			wrapperDescr.find('#mode').html(mode);
			wrapperDescr.find('#tel').html(tel);
			wrapperDescr.find('#tel').attr('href', 'tel:+' + telhref + '');
		}
	});

	type_geo = [];
	aadr = [];
	addrmap = [];
	geo = [];
	twogis = [];

	$(".contacts__info").find(".option-js").each(function (index) {
		count_map = index;
		type_geo.push($(this).text());
		aadr.push($(this).attr('addr'));
		addrmap.push($(this).attr('addrmap'));
		geo.push($(this).attr('geo'));
		twogis.push($(this).attr('2gis'));

	});
	geo_first = geo[0].split(',');
	ymaps.ready(init);
	function init() {
		var myMap = new ymaps.Map('map', {
			center: geo_first,
			searchControlProvider: 'yandex#search',
			zoom: 12,
			controls: []
		}, {
			// zoomControlSize: 'medium',
			zoomControlPosition: {
				right: 40,
				top: 190
			},
			suppressMapOpenBlock: true,
		});

		pointer = '';
		for (var i = 0; i <= count_map; i++) {
			pointer += geo[i].split(',');
		}

		$("span.option-js").click(function () {
			myMap.panTo([$(this).attr('geo').split(',')], {
				flying: true
			});
		});

		var dataUrlDirectoryBlock = document.querySelector("#main-js");
		var dataUrlDirectory = dataUrlDirectoryBlock.getAttribute("data-dir");
		// Создадим пользовательский макет ползунка масштаба.
		ZoomLayout = ymaps.templateLayoutFactory.createClass("<div class='map-nav__wrapper'><div class='map-nav__block'>" + "<div id='zoom-in' title='Приблизить'><i class='map-nav__icon-plus'></i></div>" + "<div id='zoom-out' title='Отдалить'><i class='map-nav__icon-minus'></i></div>" + "</div></div>", {
			// Переопределяем методы макета, чтобы выполнять дополнительные действия
			// при построении и очистке макета.
			build: function () {
				// Вызываем родительский метод build.
				ZoomLayout.superclass.build.call(this);
				// Привязываем функции-обработчики к контексту и сохраняем ссылки
				// на них, чтобы потом отписаться от событий.
				this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
				this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);
				// Начинаем слушать клики на кнопках макета.
				$('#zoom-in').bind('click', this.zoomInCallback);
				$('#zoom-out').bind('click', this.zoomOutCallback);
			},
			clear: function () {
				// Снимаем обработчики кликов.
				$('#zoom-in').unbind('click', this.zoomInCallback);
				$('#zoom-out').unbind('click', this.zoomOutCallback);
				// Вызываем родительский метод clear.
				ZoomLayout.superclass.clear.call(this);
			},
			zoomIn: function () {
				var map = this.getData().control.getMap();
				map.setZoom(map.getZoom() + 1, {
					checkZoomRange: true
				});
			},
			zoomOut: function () {
				var map = this.getData().control.getMap();
				map.setZoom(map.getZoom() - 1, {
					checkZoomRange: true
				});
			}
		}),
			zoomControl = new ymaps.control.ZoomControl({
				options: {
					layout: ZoomLayout
				}
			});

		// Создаём макет содержимого.
		MyIconContentLayout = ymaps.templateLayoutFactory.createClass('<div class="map__title">$[properties.iconContent]</div>');
		for (i = 0; i <= count_map; ++i) {
			balluns = new ymaps.Placemark(geo[i].split(','), {
				iconContent: '',
				balloonContent: '<div class="map__modal"><span class="map__modal_title">' + type_geo[i] + '</span><span class="map__modal_subtitle">' + addrmap[i] + '</span><a href="' + twogis[i] + '" target="_blank">Как добраться?</a></div></div>',
			}, {
				// Опции.
				// Необходимо указать данный тип макета.
				iconLayout: 'default#imageWithContent',
				// Своё изображение иконки метки.
				iconImageHref: '' + dataUrlDirectory + '/assets/icons/contacts-map.svg',
				// Размеры метки.
				iconImageSize: [30, 30],
				// Смещение левого верхнего угла иконки относительно
				// её "ножки" (точки привязки).
				iconImageOffset: [-14, -14],
				// Смещение слоя с содержимым относительно слоя с картинкой.
				iconContentOffset: [60, 5],
				// Макет содержимого.
				iconContentLayout: MyIconContentLayout,

			});
			myMap.controls.add(zoomControl);
			myMap.behaviors.disable('scrollZoom');
			myMap.behaviors.disable('multiTouch');
			myMap.geoObjects.add(balluns);
			myMap.geoObjects.events.add('click', function (e) {
				myMap.setZoom(17, {
					duration: 1000
				});
				var targetObject = e.get('target');
				myMap.setCenter(targetObject.geometry.getCoordinates());
			});
		}
		myMap.events.add('click', function () {
			myMap.balloon.close();
		});
	}
	// ---------------------- КОНЕЦ ЯНДЕКС КАРТЫ ----------------------

});