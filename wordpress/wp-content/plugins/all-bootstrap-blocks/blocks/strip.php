<?php
function areoi_render_block_strip( $attributes, $content ) 
{
	global $lightspeed_attributes;
	$lightspeed_attributes = $attributes;
	
	$allow_pattern = true;
	
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'areoi-strip',
			'areoi-element',
			( !empty( $attributes['align'] ) ? 'align' . $attributes['align'] : '' ),
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			areoi_get_utilities_classes( $attributes ),
			lightspeed_get_block_classes( 'strip' )
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'block' ) 
	);
	$background 	= include( AREOI__PLUGIN_DIR . '/blocks/_partials/background.php' );

	$output = '
		<div ' . areoi_return_id( $attributes ) . ' class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '">
			' . $background . '
			' . $content . ' 
		</div>
	';

	return $output;
}