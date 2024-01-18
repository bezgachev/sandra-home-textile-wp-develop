<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// свой класс построения главного меню в шапке:
class header_main_menu extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {

		if ($item->url && $item->url != '') {
			$output .= '<li>';
		}

		if ($item->url && $item->url != '') {
			$output .= '<a href="' . $item->url . '">'. $item->title .'</a>';
		}
		else {
			$output .= '<li><span class="menu-arrow">'. $item->title .'</span>';
		}
	}

	function start_lvl(&$output, $depth=0, $args=null) {
		$output .= '<ul>';	
	}
	function end_lvl(&$output, $depth=0, $args=null) {
		$output .= '</ul>';
	}
	function end_el(&$output, $item, $depth=0, $args=null) { 
		$output .= '</li>';
	}
}



// свой класс построения бокового меню:
class sibebar_menu extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {

		if ($item->url && $item->url != '') {
			$output .= '<li class="text">';
		}

		if ($item->url && $item->url != '') {
			$output .= '<a href="' . $item->url . '">'. $item->title .'</a>';
		}
		else {
			$output .= '<li class="burger__item text"><span class="menu-arrow">'. $item->title .'</span>';
		}
	}

	function start_lvl(&$output, $depth=0, $args=null) {
		$output .= '<ul class="burger__list">';	
	}
	function end_lvl(&$output, $depth=0, $args=null) {
		$output .= '</ul>';
	}
	function end_el(&$output, $item, $depth=0, $args=null) { 
		$output .= '</li>';
	}
}



// свой класс построения каталога у header без icon:
class catalog_menu extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		if ($item->url && $item->url != '') {
			$output .= '<li><a href="' . $item->url . '">'. $item->title .'</a>';
		}
	}
	function start_lvl(&$output, $depth=0, $args=null) {
		$output .= '<ul>';	
	}
	function end_lvl(&$output, $depth=0, $args=null) {
		$output .= '</ul>';
	}
	function end_el(&$output, $item, $depth=0, $args=null) { 
		$output .= '</li>';
	}
}




// свой класс построения каталога у header с icon:
class catalog_menu_icon extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$thumbnail_icon_id = get_term_meta($item->object_id, 'second_thumbnail_id', true);
        $thumbnail_icon_url = wp_get_attachment_image_url( $thumbnail_icon_id, '', true);
		if ($item->url && $item->url != '') {
			$output .= '
			<a href="' . $item->url . '" class="header-page__item">
				<div class="header-page__item_img">
					<img src="' . $thumbnail_icon_url . '" alt="icon_category">
				</div>
				<div class="header-page__item_link">'. $item->title .'</div>
			</a>';
		}
	}
	function start_lvl(&$output, $depth=0, $args=null) {
		$output .= '';	
	}
	function end_lvl(&$output, $depth=0, $args=null) {
		$output .= '';
	}
	function end_el(&$output, $item, $depth=0, $args=null) { 
		$output .= '';
	}
}


// свой класс построения основного каталога на страницах:
class catalog_main extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {


		$thumbnail_id = get_term_meta($item->object_id, 'thumbnail_id', true);
		//$thumbnail_id = get_woocommerce_term_meta( $item->object_id, 'thumbnail_id', true );
		
        $thumbnail_url = wp_get_attachment_image_url( $thumbnail_id, 'woo-mini-catalog', true);

		if ($item->url && $item->url != '') {
			$output .= '<a class="first-catalog__item" href="' . $item->url . '" style="background: url(' .$thumbnail_url. ') no-repeat center center;"><div class="first-catalog__item_link">ПЕРЕЙТИ К КАТАЛОГУ</div><div class="first-catalog__item_title">'. $item->title .'</div>';
		}

	}

	function end_el(&$output, $item, $depth=0, $args=null) { 
		$output .= '</a>';
	}
}


// свой класс построения каталога у footer:
class catalog_footer extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {

		if ($item->url && $item->url != '') {
			$output .= '<li><a href="' . $item->url . '" class="text footer__link">'. $item->title .'</a>';
		}
	}

	function start_lvl(&$output, $depth=0, $args=null) {
		$output .= '<ul>';	
	}
	function end_lvl(&$output, $depth=0, $args=null) {
		$output .= '</ul>';
	}
	function end_el(&$output, $item, $depth=0, $args=null) { 
		$output .= '</li>';
	}
}