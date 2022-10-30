<?php 
$styles = '
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-footer-container {
	padding-top: ' . $first_padding . 'px;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .dropdown-menu {
	background: ' . lightspeed_get_theme_color( 'bg-light' ) . ';
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .dropdown-menu a {
	color: ' . lightspeed_get_theme_color( 'bg-dark' ) . ';
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .dropdown button {
	transition: all 0.25s ease-in-out;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .dropdown button.show {
	transform: rotate(180deg);
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-top-bar,
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-bottom-bar {
	padding: ' . $padding . 'px 0;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-menu-bar {
	padding: ' . ( $padding * 2 ) . 'px 0;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer ul:not(.sub-menu, .dropdown-menu) {
	display: flex;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer button {
	background: none;
	border: none;
}

.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-top-bar img,
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-top-bar svg {
	max-height: ' . lightspeed_get_attribute( 'logo_height', '50' ) . 'px;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer,
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer a:not(.dropdown-menu a),
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer button {
	color: ' . lightspeed_get_theme_color( lightspeed_get_attribute( 'main_text', lightspeed_get_default_color( 'bg', lightspeed_get_attribute( 'main_background', 'bg-body' ) ) ) ) . ';
}

.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-menu-bar ul li:not(.sub-menu li) {
	margin-bottom: 20px;
	padding: 0;
}
.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-menu-bar ul a:not(.sub-menu a) {
	font-size: 1.4em;
}

.' . lightspeed_get_block_id() . '.areoi-lightspeed-footer .areoi-bottom-bar ul li:not(.dropdown-menu li) {
	padding: 0 10px;
}
';
?>
<?php if ( $styles ) : ?>
	<style><?php echo areoi_minify_css( $styles ) ?></style>
<?php endif; ?>

<div class="areoi-footer-container <?php lightspeed_attribute( 'main_background' ) ?>">
	<?php if ( !lightspeed_get_attribute( 'exclude_top_bar', false ) ) : ?>
		<div class="areoi-top-bar">
			<div class="<?php lightspeed_attribute( 'container', 'container' ) ?>">
				<div class="row row-cols-1 row-cols-md-2 text-center text-md-start align-items-center justify-content-center justify-content-md-between">
					<div class="col">
						<a class="h-100" href="<?php echo home_url() ?>" title="<?php echo get_bloginfo( 'name' ) ?>">
							<?php lightspeed_logo( lightspeed_get_default_color( 'logo', lightspeed_get_attribute( 'top_bar_background' ) ) ) ?>

							<?php if ( !lightspeed_get_attribute( 'exclude_social', false ) ) : ?>
								<div class="h1 d-block d-md-none"></div>
							<?php endif; ?>
						</a>
					</div>

					<?php if ( !lightspeed_get_attribute( 'exclude_social', false ) ) : ?>
						<div class="col d-flex justify-content-center justify-content-md-end">
							<?php lightspeed_social() ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="areoi-menu-bar">
		<div class="<?php lightspeed_attribute( 'container', 'container' ) ?>">
			<div class="row row-cols-1 row-cols-md-2">
				<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<div class="col flex-grow-1">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'row row-cols-1 text-center row-cols-md-2 text-md-start row-cols-lg-3 row-cols-xl-4' ) ); ?>					
					</div>
				<?php endif; ?>

				<?php if ( !lightspeed_get_attribute( 'exclude_company', false ) && lightspeed_has_contact() ) : ?>
					<div class="col col-lg-5 col-xl-4 text-center text-md-end">
						<div class="h1 d-block d-md-none"></div>
						<p class="h3 mb-2"><?php _e( 'Contact Details' ) ?></p>
						<?php lightspeed_contact( '', 'mb-0' ) ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="areoi-bottom-bar">
		<div class="<?php lightspeed_attribute( 'container', 'container' ) ?>">
			<div class="row row-cols-1 row-cols-md-2 align-items-center justify-content-center justify-content-md-between small">
				<div class="col text-center text-md-start">
					<p class="mb-2 mb-md-0"><?php _e( 'Copyright ' ) ?>&copy; <?php echo date( 'Y' ) ?> <?php echo get_bloginfo( 'name' ) ?>.</p>
				</div>
				<div class="col text-center text-md-end">
					<?php if ( has_nav_menu( 'bottom-menu' ) ) : ?>
						<?php wp_nav_menu( array( 'theme_location' => 'bottom-menu', 'walker' => new AREOI_HAF_Walker_Nav_Menu_Primary, 'menu_class' => 'justify-content-center justify-content-md-end' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>