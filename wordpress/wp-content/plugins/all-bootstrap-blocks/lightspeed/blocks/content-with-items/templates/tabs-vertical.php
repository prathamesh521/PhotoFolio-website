<?php

$styles = '
.' . lightspeed_get_block_id() . '.areoi-lightspeed-block .nav-link.active {
	border-bottom: none;
}
';
?>
<?php if ( $styles ) : ?>
	<style><?php echo areoi_minify_css( $styles ) ?></style>
<?php endif; ?>

<div class="container h-100 position-relative">
	<div class="row h-100 align-items-center justify-content-<?php lightspeed_attribute( 'alignment', 'center' ) ?>">
		
		<div class="col-lg-6 col-xxl-5 <?php echo lightspeed_get_attribute( 'alignment', 'center' ) == 'center' ? 'text-center' : '' ?>">
			
			<?php lightspeed_content( 2, 'start' ) ?>

			<div class="h1"></div>
		</div>

		<?php if ( lightspeed_get_attribute( 'items', array() ) ) : ?>
			<div class="col-12">

				<?php lightspeed_tabs_vertical( lightspeed_get_attribute( 'items', array() ) ) ?>

			</div>
		<?php endif; ?>
	
	</div>
</div>