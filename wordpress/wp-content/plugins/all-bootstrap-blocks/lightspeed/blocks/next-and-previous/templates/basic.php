<?php  
$prev_post = get_previous_post();
$next_post = get_next_post();
$items = array(
	'prev' => array(
		'heading' => $prev_post ? $prev_post->post_title : '',
		'media' => $prev_post ? wp_get_attachment_image_url( get_post_thumbnail_id( $prev_post->ID ), 'single-post-thumbnail' ) : '',
		'permalink' => $prev_post ? get_the_permalink( $prev_post->ID ) : ''
	),
	'next' => array(
		'heading' => $next_post ? $next_post->post_title : '',
		'media' => $next_post ? wp_get_attachment_image_url( get_post_thumbnail_id( $next_post->ID ), 'single-post-thumbnail' ) : '',
		'permalink' => $next_post ? get_the_permalink( $next_post->ID ) : ''
	),
);

$styles = '';
if ( !$next_post && !$prev_post ) {
	$styles .= '
		.' . lightspeed_get_block_id() . '.areoi-lightspeed-block {
			display: none;
		}
	';
}
?>
<?php if ( $styles ) : ?>
	<style><?php echo areoi_minify_css( $styles ) ?></style>
<?php endif; ?>

<div class="container h-100 position-relative">
	<div class="row h-100 align-items-center">

		<?php foreach ( $items as $item_key => $item ) : ?>
			<?php if ( !empty( $item['heading'] ) ) : ?>
				<div class="col-md-6 position-relative areoi-has-url">
					<div class="row align-items-center">
						<div class="col-6 <?php echo $item_key == 'next' ? 'order-1' : '' ?>">
							<?php lightspeed_heading( 2, $item, 'h3' ) ?>
						</div>
						<div class="col-6">
							<div class="areoi-media-col h-100">
								<div class="areoi-media-col-content h-100">
									<?php lightspeed_square_spacer() ?>
									<?php if ( $item['media'] ) : ?>
										<img src="<?php echo $item['media'] ?>" alt="<?php echo $item['heading'] ?>" />
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>			
					<a href="<?php echo $item['permalink'] ?>" class="stretched-link" aria-label="View <?php echo $item['heading'] ?>"></a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>

	</div>
</div>