<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'basic_information_company' );
function basic_information_company( $wp_customize ) {
	//Почта
	$wp_customize->add_section(
		// ID
		'mail_custom',
		// Arguments array
		array(
			'title' => 'Настройки Почты',
			'capability' => 'edit_theme_options',
			'priority'  => 100,
			'description' => "Здесь Вы можете настроить SMTP сервер-обработчик почты.<br><br>Внимание! Если нужно изменить Административный E-mail для WordPress (Настройки - Общие - Административный E-mail), то временно отключите SMTP-сервер.<br><br>При смене Административной почты, необходимо продублировать её также в настройках: WooCommerce - Настройки - Email'ы - Адрес отправителя.<br><br>Если вдруг почта не отправляется, сверьте свои настройки для исходящей почты: <a href='https://yandex.ru/support/mail/mail-clients/others.html' target='_blank'>Яндекс </a>, <a href='https://developers.google.com/gmail/imap/imap-smtp' target='_blank'>Google</a>, <a href='https://help.mail.ru/mail/mailer/popsmtp' target='_blank'>Mail.ru</a> или перезапустите SMTP-сервер, если настройки верны.",
		)
	);

	$wp_customize->add_setting('enabled_mail_smtp', array(
		'default'    => 'true',
		'capability' => 'edit_theme_options',
		'type' => 'option',
	));
	$wp_customize->add_control(
		'enabled_mail_smtp_control', array(
			'type'      => 'checkbox',
			'section' => 'mail_custom',
			'label'     => __('Запустить SMTP-сервер'),
			'settings'  => 'enabled_mail_smtp',		
		)
	);

	//email почты
	$wp_customize->add_setting(
		'mail_custom_SMTP_USER', array(
			'default' => '', 
			'type' => 'option',
		)
	);
	$wp_customize->add_control(
		'mail_custom_SMTP_USER_control', array(
			'type' => 'hidden',
			'section' => 'mail_custom',
			'label' => 'Сервер-обработчик: ' . get_option('admin_email'),
			'description' => "Для обработки писем используется Ваш Административный E-mail<br><br>",
			'settings' => 'mail_custom_SMTP_USER'
		)
	);

	$wp_customize->add_setting(
		'mail_custom_SMTP_PASS', array(
			'default' => '',
			'type' => 'option',
		)
	);
	$wp_customize->add_control(
		'mail_custom_SMTP_PASS_control', array(
			'type' => 'text',
			'section' => 'mail_custom',
			'label' => 'Пароль приложения',
			'description' => "Пароль приложения сервера почты. Пароль генерируется в аккаунте Вашей почты в настройках безопасности. Обычный пароль для входа не подойдёт, не рекомендуется в целях безопасности",
			'settings' => 'mail_custom_SMTP_PASS'
		)
	);
	
	$wp_customize->add_setting(
		'mail_custom_SMTP_HOST', array(
			'default' => '',
			'type' => 'option',
		)
	);
	$wp_customize->add_control(
		'mail_custom_SMTP_HOST_control', array(
			'type' => 'text',
			'section' => 'mail_custom',
			'label' => 'Хост почтового сервера',
			'description' => "Яндекс — smtp.yandex.ru, Google — smtp.gmail.com, Mail.ru — ssl://smtp.mail.ru. Скопируйте и вставьте значения, в соответствии с тем, какой сервис почты Вы используете.<br><br>Если письма не отправляются, добавьте приставку ssl://<br>Пример: ssl://smtp.yandex.ru",
			'settings' => 'mail_custom_SMTP_HOST'
		)
	);

	$wp_customize->add_setting(
		'mail_custom_SMTP_PORT', array(
			'default' => '',
			'type' => 'option',
		)
	);
	$wp_customize->add_control(
		'mail_custom_SMTP_PORT_control', array(
			'type' => 'text',
			'section' => 'mail_custom',
			'label' => 'Порт почтового сервера',
			'description' => "Яндекс — 465, Google — 465, либо 587, Mail.ru — 465",
			'settings' => 'mail_custom_SMTP_PORT'
		)
	);

	$wp_customize->add_setting(
		'mail_custom_SMTP_SECURE', array(
			'default' => '',
			'type' => 'option',
		)
	);
	$wp_customize->add_control(
		'mail_custom_SMTP_SECURE_control', array(
			'type' => 'select',
			'section' => 'mail_custom',
			'label' => 'Метод защиты соединения, передачи данных',
			'description' => "Яндекс — SSL, Google — TLS, Mail.ru — SSL или TLS",
			'settings' => 'mail_custom_SMTP_SECURE',
			'choices' => array(
				'SSL' => 'SSL',
				'TLS' => 'TLS',
			),
		)
	);

	//Режим обслуживания
	$wp_customize->add_section(
		// ID
		'maintenance_mode',
		// Arguments array
		array(
			'title' => 'Техническое обслуживание',
			'capability' => 'edit_theme_options',
			'priority'  => 200,
			'description' => "Здесь Вы можете перевести свой сайт в режим технического обслуживания.<br><br>Эта возможность даёт программистам проводить технические работы, когда необходимо временно закрыть доступ к сайту для пользователей Вашего сайта и вывести пользователям об этом уведомление.<br><br>Для авторизованного администратора доступ к сайту доступен.",
		)
	);

	$wp_customize->add_setting('enabled_maintenance_mode', array(
		'default'    => 'true',
		'capability' => 'edit_theme_options',
		'type' => 'option',
	));
	$wp_customize->add_control(
		'enabled_maintenance_mode_control', array(
			'type'      => 'checkbox',
			'section' => 'maintenance_mode',
			'label'     => __('Включить режим обслуживания'),
			'settings'  => 'enabled_maintenance_mode',		
		)
	);

}