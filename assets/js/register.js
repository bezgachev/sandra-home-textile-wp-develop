$(function () {
	$('form#auth-user').on('submit', function (event) {
		$('.auth__account .loader').removeClass('d-hide');
		var username = $('#username').val();
		password = $('#password').val();
		email = $('#email').val();
		security = $('#security').val();
		privacy_policy = $('#privacy_policy_cart').val();
		rememberme = $(this).parent().find('#rememberme');
		if (rememberme.is(':checked')) {
			rememberme.attr('value', 'forever');
		} else {
			rememberme.attr('value', '');
		}
		remembermeval = $('#rememberme').val();
		if ($('form#auth-user').hasClass('login_user')) {
			//console.log('авторизация');
			var data = {
				action: 'ajaxlogin',
				password: password,
				email: email,
				security: security,
				rememberme: remembermeval
			};
		}
		else {
			//console.log('регистрация');
			var data = {
				action: 'ajaxregister',
				username: username,
				password: password,
				email: email,
				security: security,
				privacy_policy_cart: privacy_policy,
			};
		}
		$('.status').show().text(ajax_auth_object.loadingmessage);
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajax_auth_object.ajaxurl,
			data: data,
			success: function (data) {

				if (data.loggedin == true) {
					$('.status-success').text(data.success_message);
					$('.status-error').addClass('d-hide');
					$('.status-success').removeClass('d-hide');

					if ($('.shopping-cart').length > 0) {
						setTimeout(function () {
							$('.esc-popap').trigger("click");
							$('.actions button[name="update_cart"]').removeAttr("disabled").trigger("click");
						}, 1800);
					}
					else {
						setTimeout(function () {
							location.reload();
						}, 1800);
					}
				}
				else {
					$('.status-error').text(data.message);
					$('.status-error').removeClass('d-hide');
				}
				$('.auth__account.open').find('.loader').addClass('d-hide');
			}
		});
		event.preventDefault();
	});
});