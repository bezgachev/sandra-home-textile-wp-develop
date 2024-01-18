<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$id_socials = 27;
$socials = get_field('enable_display_social', $id_socials);
if ($socials) {
    $whatsapp = get_field('whatsapp', $id_socials);
    $viber = get_field('viber', $id_socials);
    $telegram = get_field('telegram', $id_socials);
    $instagram = get_field('instagram', $id_socials);
    if($socials && in_array('viber', $socials) && !empty($viber)) {
        $viber_cut = mb_substr($viber, 1, 10, 'UTF8');
        echo '<a href="viber://chat?number=+7'.$viber_cut.'" class="social viber" target="_blank"></a>';
    }
    if($socials && in_array('whatsapp', $socials) && !empty($whatsapp)) {
        $whatsapp_cut = mb_substr($whatsapp, 1, 10, 'UTF8');
        echo '<a href="whatsapp://send?phone=+7'.$whatsapp_cut.'" class="social whatsapp" target="_blank"></a>';
    }
    if($socials && in_array('telegram', $socials) && !empty($telegram)) {
        echo '<a href="https://t.me/'.$telegram.'" class="social telegram" target="_blank"></a>';
    }
    if($socials && in_array('instagram', $socials) && !empty($instagram)) {
        echo '<a href="https://www.instagram.com/'.$instagram.'" class="social instagram" target="_blank"></a>';
    }
}