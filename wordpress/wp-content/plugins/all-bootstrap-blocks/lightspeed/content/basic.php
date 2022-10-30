<div class="row <?php echo 'text-' . lightspeed_get_attribute( 'content_alignment', $default_align ) ?>">
	
	<div class="col">
		
		<?php lightspeed_heading( $heading_level ) ?>

		<?php lightspeed_introduction() ?>

		<?php lightspeed_cta() ?>

		<?php if ( lightspeed_get_attribute( 'columns', array() ) && lightspeed_get_cta() ) : ?>
			<div class="h1"></div>
		<?php endif; ?>

		<div class="row rows-col-1 row-cols-md-2">
			<?php foreach ( lightspeed_get_attribute( 'columns', array() ) as $column_key => $column ) : ?>
				<div class="col mb-4 position-relative">
					<?php lightspeed_item( $column ) ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>

</div>