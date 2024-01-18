<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );
	?>
	<div class="quantity">
		<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
		<!-- <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label> -->
		<input
			type="hidden"
			id="<?php echo esc_attr( $input_id ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
			step="<?php echo esc_attr( $step ); ?>"
			min="1" max="999" step="1" data-max-count="999" inputmode="decimal"
			name="<?php echo esc_attr( $input_name ); ?>"
			class="select-css quantity-input"
			inputmode="<?php echo esc_attr( $inputmode ); ?>"
			autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
		/>
		<div class="select-css quantity-js"><?php echo esc_attr( $input_value ); ?></div>
		<div class="select-input">
		<?php
			$quantity_value = esc_attr( $input_value );
			$selected_inputs = array(1 => '1', 2 => '2', 3 => '3', 4 => '4'); 
			foreach($selected_inputs as $key => $selected_input) {
				echo "<span value=".$key; 
				if($quantity_value == $selected_input){ echo ' class="selected"'; } 
				echo '>'; 
				echo $selected_input; 
				echo "</span>"; 
			}
			if ($quantity_value > 4) {
				echo '<div class="add-quantity-js selected">5+</div>';
			}
			else {
				echo '<div class="add-quantity-js">5+</div>';
			}
		?>
		</div>
		<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
	</div>
	<?php
}
