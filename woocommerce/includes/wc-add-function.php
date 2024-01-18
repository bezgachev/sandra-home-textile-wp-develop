<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//Добавление загрузки изображения (svg) для категории продуктов
class Product_Second_Thumbnail {
    private static $instance = false;
    private function __construct() {
        add_action( 'product_cat_add_form_fields', [ $this, 'add_category_fields' ] );
        add_action( 'product_cat_edit_form_fields', [ $this, 'edit_category_fields' ], 10 );
        add_action( 'created_term', [ $this, 'save_category_fields' ], 10, 3 );
        add_action( 'edit_term', [ $this, 'save_category_fields' ], 10, 3 );
    }

    public static function get_instance() {
        return ! self::$instance ? self::$instance = new self() : self::$instance;
    }

    private function __clone() {}

    private function __wakeup() {}

    public function add_category_fields( $term ) {
        ?>

        <div class="form-field term-thumbnail-wrap">
            <label><?php esc_html_e( 'Иконка SVG для категории', 'weblitex' ); ?></label>
            <div id="product_cat_second_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
            <div style="line-height: 60px;">
                <input type="hidden" id="product_cat_second_thumbnail_id" name="product_cat_second_thumbnail_id" />
                <button type="button" class="second_upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'woocommerce' ); ?></button>
                <button type="button" class="second_remove_image_button button"><?php esc_html_e( 'Remove image', 'woocommerce' ); ?></button>
            </div>
            <script type="text/javascript">

                if ( ! jQuery( '#product_cat_second_thumbnail_id' ).val() ) {
                    jQuery( '.second_remove_image_button' ).hide();
                }

                let second_file_frame;

                jQuery( document ).on( 'click', '.second_upload_image_button', function( event ) {

                    event.preventDefault();

                    if ( second_file_frame ) {
                        second_file_frame.open();
                        return;
                    }

                    second_file_frame = wp.media.frames.downloadable_file = wp.media({
                        title: '<?php esc_html_e( 'Choose an image', 'woocommerce' ); ?>',
                        button: {
                            text: '<?php esc_html_e( 'Use image', 'woocommerce' ); ?>'
                        },
                        multiple: false
                    });

                    second_file_frame.on( 'select', function() {
                        let attachment = second_file_frame.state().get( 'selection' ).first().toJSON(),
                            attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                        jQuery( '#product_cat_second_thumbnail_id' ).val( attachment.id );
                        jQuery( '#product_cat_second_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
                        jQuery( '.second_remove_image_button' ).show();
                    });

                    second_file_frame.open();
                });

                jQuery( document ).on( 'click', '.second_remove_image_button', function() {
                    jQuery( '#product_cat_second_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
                    jQuery( '#product_cat_second_thumbnail_id' ).val( '' );
                    jQuery( '.second_remove_image_button' ).hide();
                    return false;
                });

                jQuery( document ).ajaxComplete( function( event, request, options ) {
                    if ( request && 4 === request.readyState && 200 === request.status
                        && options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

                        let res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
                        if ( ! res || res.errors ) {
                            return;
                        }
                        jQuery( '#product_cat_second_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
                        jQuery( '#product_cat_second_thumbnail_id' ).val( '' );
                        jQuery( '.second_remove_image_button' ).hide();

                        return;
                    }
                } );

            </script>
            <div class="clear"></div>
        </div>
        <?php
    }

    public function edit_category_fields( $term ) {

        $thumbnail_id = absint( get_term_meta( $term->term_id, 'second_thumbnail_id', true ) );
        $image = $thumbnail_id ? wp_get_attachment_thumb_url( $thumbnail_id ) : wc_placeholder_img_src();

        ?>

        <tr class="form-field term-thumbnail-wrap">
            <th scope="row" valign="top"><label><?php esc_html_e( 'Иконка SVG для категории', 'weblitex' ); ?></label></th>
            <td>
                <div id="product_cat_second_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
                <div style="line-height: 60px;">
                    <input type="hidden" id="product_cat_second_thumbnail_id" name="product_cat_second_thumbnail_id" value="<?php echo esc_attr( $thumbnail_id ); ?>" />
                    <button type="button" class="upload_second_image_button button"><?php esc_html_e( 'Upload/Add image', 'woocommerce' ); ?></button>
                    <button type="button" class="remove_second_image_button button"><?php esc_html_e( 'Remove image', 'woocommerce' ); ?></button>
                </div>
                <script type="text/javascript">

                    if ( '0' === jQuery( '#product_cat_second_thumbnail_id' ).val() ) {
                        jQuery( '.remove_second_image_button' ).hide();
                    }

                    let second_file_frame;

                    jQuery( document ).on( 'click', '.upload_second_image_button', function( event ) {

                        event.preventDefault();

                        if ( second_file_frame ) {
                            second_file_frame.open();
                            return;
                        }

                        second_file_frame = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php esc_html_e( 'Choose an image', 'woocommerce' ); ?>',
                            button: {
                                text: '<?php esc_html_e( 'Use image', 'woocommerce' ); ?>'
                            },
                            multiple: false
                        });

                        second_file_frame.on( 'select', function() {
                            let attachment           = second_file_frame.state().get( 'selection' ).first().toJSON(),
                                attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            jQuery( '#product_cat_second_thumbnail_id' ).val( attachment.id );
                            jQuery( '#product_cat_second_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
                            jQuery( '.remove_second_image_button' ).show();
                        });

                        second_file_frame.open();
                    });

                    jQuery( document ).on( 'click', '.remove_second_image_button', function() {
                        jQuery( '#product_cat_second_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
                        jQuery( '#product_cat_second_thumbnail_id' ).val( '' );
                        jQuery( '.remove_second_image_button' ).hide();
                        return false;
                    });

                </script>
                <div class="clear"></div>
            </td>
        </tr>
        <?php
    }

    public function save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
        if ( ( ! isset( $_REQUEST['_wpnonce'] ) && ! isset( $_REQUEST['_wpnonce_add-tag'] ) ) ||
            ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'update-tag_' . $term_id ) && ! wp_verify_nonce( $_REQUEST['_wpnonce_add-tag'], 'add-tag' ) ) ||
            ! current_user_can( 'edit_term', $term_id )
        ) {
            return;
        }

        if ( isset( $_POST['product_cat_second_thumbnail_id'] ) && 'product_cat' === $taxonomy ) {
            update_term_meta( $term_id, 'second_thumbnail_id', absint( $_POST['product_cat_second_thumbnail_id'] ) );
        }
    }

}
$wc_secondary_thumbnail = Product_Second_Thumbnail::get_instance();


add_action( 'woocommerce_product_options_general_product_data', 'art_woo_add_custom_fields' );
function art_woo_add_custom_fields() {
	global $product, $post;
	echo '<div class="options_group">';
		woocommerce_wp_text_input( array(
			'id'                => '_text_field_videoid',
			'label'             => __( 'ID видео', 'woocommerce' ),
			//'placeholder'       => '',
			'description'       => __( 'Айдишник (id) видео берётся из ссылки YouTube', 'woocommerce' ),
			'type'              => 'text',
			'desc_tip'          => 'true',
			//'custom_attributes' => array( 'required' => 'required' ),
		));
	echo '</div>';
}


add_action( 'woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10 );
function art_woo_custom_fields_save( $post_id ) {
	// Вызываем объект класса
	$product = wc_get_product( $post_id );
	//Сохранение текстового поля
	$text_field = isset( $_POST['_text_field_videoid'] ) ? sanitize_text_field( $_POST['_text_field_videoid'] ) : '';
	$product->update_meta_data( '_text_field_videoid', $text_field );
	//Сохраняем все значения
	$product->save();
}


