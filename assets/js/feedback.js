$(function () {
    $(document).on('click', '.header__callback_text, #btn-modal-call', function () {
        $('#overlay, .modal-popup').css('display', "block");
        setTimeout(function () {
            $('.modal-popup').css('opacity', "1");
        }, 100);
    });

    $(document).on('click', '.modal-popup .close-button', function () {
        $('.modal-popup').css('opacity', "0");
        setTimeout(function () {
            $('#overlay, .modal-popup').removeAttr('style');
        }, 300);

    });
    var error_cancel_order = $('.modal-account-cancel-order').find('.error-mess');
    var form_feedback = $('form.feedback__form, form.popup, form.account-help__form, form.cancel-order');

    form_feedback.on('click', 'input[type="submit"]', function () {
        th_form = $(this).parents('form');
        th_form_class = th_form.attr('class');
        console.log(th_form_class);
        //feedback_type = th_form.find('input[name="feedback"]').val();
    });


    //var form_feedback_btn = form_feedback.find('input[type="submit"]');
    // Сброс значений полей
    // $('#add_feedback input, #add_feedback textarea').on('blur', function () {
    //     $('#add_feedback input, #add_feedback textarea').removeClass('error');
    //     $('.error-name,.error-email,.error-comments,.message-success').remove();
    //     $('#submit-feedback').val('Отправить сообщение');
    // });
    function successDisplay() {
        if (th_form_class == 'popup') {
            $('.modal-access').find('h3').removeClass('popup-error');
            $('.modal-access').find('h3').html('Заявка успешно отправлена!');
            $('.modal-access').find('p').html('В самое ближайшее время<br>с Вами свяжется наш менеджер.');
            $('.modal-popup').css('opacity', "0");
            $('.modal-access').css('display', "block");
            setTimeout(function () {
                $('.modal-access').css('opacity', "1");
                $('.modal-popup').removeAttr('style');
            }, 300);

            setTimeout(function () {
                $('.modal-access').css('opacity', "0");
            }, 3000);

            setTimeout(function () {
                $('#overlay, .modal-access').removeAttr('style');
                th_form[0].reset();
                $('input[name="form-checkbox"]').removeAttr('value');
            }, 3300);
            yaCounter86800166.reachGoal('call');
        }
        else if (th_form_class == 'feedback__form' || th_form_class == 'account-help__form') {
            $('.feedback__btn_alert').find('.report__ok').removeClass('d-hide');
            setTimeout(function () {
                $('.feedback__btn_alert').find('.report__ok').css('opacity', '1');
            }, 300);
            setTimeout(function () {
                $('.feedback__btn_alert').find('.report__ok').css('opacity', '0');
            }, 3500);
            setTimeout(function () {
                $('.feedback__btn_alert span').removeAttr('style');
                $('.feedback__btn_alert span').addClass('d-hide');
                th_form[0].reset();

                $('input[name="form-checkbox"]').removeAttr('value');
            }, 4000);
            if (th_form_class == 'feedback__form') {
                yaCounter86800166.reachGoal('callback');
            }
            if (th_form_class == 'account-help__form') {
                yaCounter86800166.reachGoal('callback-account');
            }
        }
        else if (th_form_class == 'cancel-order') {
            $('.modal-account-cancel-order, #overlay').css('display', 'none');
            window.location = $('#cancel-order-tech').attr('href');
            console.log('Заказ успешно отменен');
        }






        // $('#overlay, .modal-access .form__btn-close').removeAttr('style');
        // $('.modal.modal-open').css('opacity', '0');
        // $('.modal-access').addClass('modal-open');
        // if ($('.modal-access').hasClass('popup-err')) {
        //     $('.modal-access').removeClass('popup-err');
        // }
        // setTimeout(function () {
        //     $('.modal-access.modal-open').css('opacity', '1');
        //     $('.modal.modal-open').removeClass('modal-open');
        //     $('.modal-access').addClass('modal-open');
        //     $('.modal-access').find('.form__title').text('Сообщение отправлено');
        //     $('.modal-access').find('.form__subtitle').text('Совсем скоро мы ответим Вам!');
        //     $('#feedback')[0].reset();
        //     $('#feedback input[type="submit"]').val('Отправить сообщение');
        // }, 300);


    }

    function errorDisplay() {
        if (th_form_class == 'popup') {
            $('.modal-access').find('h3').addClass('popup-error');
            $('.modal-access').find('h3').html('Ой, что-то пошло не так...');
            $('.modal-access').find('p').html('Ваша заявка не отправилась.<br>Пожалуйста, повторите ещё раз.');
            $('.modal-popup').css('opacity', "0");
            $('.modal-access').css('display', "block");
            setTimeout(function () {
                $('.modal-access').css('opacity', "1");
                $('.modal-popup').removeAttr('style');
            }, 300);

            setTimeout(function () {
                $('.modal-access').css('opacity', "0");
                $('.modal-popup').css('display', "block");
            }, 3000);

            setTimeout(function () {
                $('.modal-popup').css('opacity', "1");
                $('.modal-access').removeAttr('style');
            }, 3300);
        }

        else if (th_form_class == 'feedback__form' || th_form_class == 'account-help__form') {
            $('.feedback__btn_alert').find('.report__error').removeClass('d-hide');
            setTimeout(function () {
                $('.feedback__btn_alert').find('.report__error').css('opacity', '1');
            }, 300);
        }

        else if (th_form_class == 'cancel-order') {
            set_message('Не удалось отменить товар. <br>Попробуйте еще раз');
        }

    }
    // Отправка значений полей

    $(document).on('click', 'input[name="form-checkbox"]', function () {
        if ($(this).is(':checked')) {
            $(this).attr('value', '1');
            //$('#feedback .form__btn').removeClass('disabled');
            //$('#feedback .form__btn').prop('disabled', false);
        } else {
            $(this).attr('value', '');
            //$('#feedback .form__btn').addClass('disabled');
            //$('#feedback .form__btn').prop('disabled', true);
        }
    });

    // $(document).on('input', '#feedback input, #feedback textarea', function (e) {
    //     $(this).parent().removeClass('woocommerce-invalid woocommerce-invalid-required-field');
    // });

    var options = {
        url: feedback_object.url,
        data: {
            action: 'feedback_action',
            nonce: feedback_object.nonce
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            th_form.find('.popup__field, .feedback__field, .feedback__textarea, .form__checkbox .custom-checkbox, .feedback__checkbox .custom-checkbox, .form-row').removeClass('woocommerce-invalid woocommerce-invalid-required-field');
            error_cancel_order.addClass('d-hide');
            $('.feedback__btn_alert span').removeAttr('style');
            $('.feedback__btn_alert span').addClass('d-hide');
            // При отправке формы меняем надпись на кнопке
            th_form.find('input[type="submit"]').val('Отправляем...');
        },
        success: function (request, xhr, status, error) {
            if (request.success === true) { } else {
                console.log('ПОЛЯ НЕ ЗАПОЛНЕНЫ');
                $.each(request.data, function (key) {
                    console.log('key ' + key);
                    if (th_form_class == 'cancel-order') {
                        if (key == 'motive') {
                            error_cancel_order.removeClass('d-hide');
                        }
                        else {
                            error_cancel_order.addClass('d-hide');
                        }
                    }
                    else {
                        th_form.find('input[name="form-' + key + '"], textarea[name="form-' + key + '"]').parent().addClass('woocommerce-invalid woocommerce-invalid-required-field');
                    }

                });


                var btn_text = th_form.find('input[type="submit"]').data('text');
                th_form.find('input[type="submit"]').val(btn_text);
            }
            if (request.message == 'OK') {
                console.log('хорошо от сервера');
                successDisplay();
            }
            else if (request.message == 'ERROR') {
                errorDisplay();
                console.log('ошибка от сервера');
            }
        },
        error: function (request, status, error) {
            errorDisplay();
            console.log('ошибка загрузки');
        }
    };
    // Отправка формы
    form_feedback.ajaxForm(options);



});