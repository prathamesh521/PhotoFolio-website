<?php
require_once( AREOI__PLUGIN_LIGHTSPEED_DIR . 'helpers.php' );

class AREOI_Lightspeed
{
	private static $initiated = false;

	public static function init() {
		
		global $lightspeed_block_order;
		$lightspeed_block_order = 1;

		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	private static function init_hooks() 
	{
		self::$initiated = true;
		
		self::register_blocks();

		add_action( 'wp_enqueue_scripts', array( 'AREOI_Lightspeed', 'add_scripts' ), 100 );

		add_action( 'wp_enqueue_scripts', array( 'AREOI_Lightspeed', 'add_styles' ), 100 );

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( 'AREOI_Lightspeed', 'add_styles' ), 100 );
			add_action( 'admin_enqueue_scripts', array( 'AREOI_Lightspeed', 'add_admin_scripts' ) );
		}
	}

	public static function register_blocks()
	{
		add_filter( 'block_categories_all', [ 'AREOI_Lightspeed', 'add_block_categories' ], 100, 2 );

		require AREOI__PLUGIN_LIGHTSPEED_DIR . 'blocks/index.php';

		if ( is_admin() ) {
			$asset_file = include( AREOI__PLUGIN_LIGHTSPEED_DIR . 'assets/build/index.asset.php');
				
			wp_enqueue_script(
			   'areoi-lightspeed-blocks',
			   	AREOI__PLUGIN_LIGHTSPEED_URI . 'assets/build/index.js',
			    array_merge( $asset_file['dependencies'], array( 'areoi-blocks' ) ),
			    $asset_file['version']
			);

			wp_localize_script( 'areoi-lightspeed-blocks', 'areoi_lightspeed_vars', array(
				'blocks' 		=> self::get_blocks(),
				'templates'		=> self::get_templates(),
				'forms'			=> self::get_forms(),
				'is_lightspeed' => areoi_is_lightspeed(),
				'pattern'	 	=> get_option( 'areoi-lightspeed-styles-strip-pattern', false ),
				'divider' 		=> get_option( 'areoi-lightspeed-styles-strip-divider', false ),
				'mask' 			=> get_option( 'areoi-lightspeed-styles-image-mask', false ),
				'transition' 	=> get_option( 'areoi-lightspeed-transition-transition', false ),
				'parallax' 		=> get_option( 'areoi-lightspeed-parallax-parallax', false ),
			) );

			wp_set_script_translations( 'areoi-lightspeed-blocks', AREOI__TEXT_DOMAIN );
		}
	}

	public static function add_block_categories( $categories, $post ) 
	{
		$new_category = [
			'slug' => 'areoi-custom',
			'title' => __( 'Custom', AREOI__TEXT_DOMAIN ),
			'icon'	=> ''
		];
		$custom_category = array( $new_category );

		$new_category = [
			'slug' => 'areoi-lightspeed',
			'title' => __( 'Lightspeed', AREOI__TEXT_DOMAIN ),
			'icon'	=> ''
		];
		$lightspeed_category = array( $new_category );

		if ( areoi_is_lightspeed() ) {
			return array_merge( $custom_category, $lightspeed_category, $categories);
		}
		
		return array_merge( $custom_category, $categories, $lightspeed_category );
	}

	public static function add_scripts() 
	{
		$enqueue = 'assets/js/global.js';
		
		wp_enqueue_script(
		   'areoi-lightspeed',
		   	AREOI__PLUGIN_LIGHTSPEED_URI . $enqueue,
		    array( 'jquery' ),
		    filemtime( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue )
		);

		$scripts 	= '';

		ob_start(); include( AREOI__PLUGIN_LIGHTSPEED_DIR . 'assets/js/site.js' ); $scripts .= ob_get_clean();

		$transition = get_option( 'areoi-lightspeed-transition-transition', false );
		if ( $transition ) {
			$enqueue 		= 'assets/js/transition.js';
			if ( file_exists( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ) ) {
				ob_start(); include( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ); $scripts .= ob_get_clean();
			}
		}

		$page_transition = get_option( 'areoi-lightspeed-transition-page', false );
		if ( $page_transition ) {
			$enqueue 		= 'assets/js/transition-page.js';
			if ( file_exists( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ) ) {
				ob_start(); include( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ); $scripts .= ob_get_clean();
			}
		}

		$background_transition = get_option( 'areoi-lightspeed-transition-background', false );
		if ( $background_transition ) {
			$enqueue 		= 'assets/js/transition-background.js';
			if ( file_exists( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ) ) {
				ob_start(); include( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ); $scripts .= ob_get_clean();
			}
		}

		$parallax = get_option( 'areoi-lightspeed-parallax-parallax', false );
		if ( $parallax ) {
			$enqueue 		= 'assets/js/parallax.js';
			if ( file_exists( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ) ) {
				ob_start(); include( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ); $scripts .= ob_get_clean();
			}
		}

		$gallery = get_option( 'areoi-lightspeed-gallery-include', false );
		if ( $gallery ) {
			$enqueue 		= 'assets/js/gallery.js';
			if ( file_exists( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ) ) {
				ob_start(); include( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue ); $scripts .= ob_get_clean();
			}
		}

		if ( $scripts ) {
			$scripts = '
			jQuery(document).ready(function($){
				' . $scripts . '
			});
			';
			wp_add_inline_script( 'areoi-lightspeed', areoi_minify_js( $scripts ) );
		}
	}

	public static function add_admin_scripts() 
	{
		$enqueue = 'assets/js/admin.js';
		
		wp_enqueue_script(
		   'areoi-lightspeed-admin',
		   	AREOI__PLUGIN_LIGHTSPEED_URI . $enqueue,
		    array( 'jquery' ),
		    filemtime( AREOI__PLUGIN_LIGHTSPEED_DIR . $enqueue )
		);

		self::add_custom_fonts();
	}

	public static function get_blocks()
	{
		$plugin_directory = AREOI__PLUGIN_LIGHTSPEED_DIR . 'blocks/';
		$plugin_uri = AREOI__PLUGIN_LIGHTSPEED_URI . 'blocks/';
		$plugin_templates = lightspeed_list_files_with_uri( $plugin_directory, $plugin_uri );

		$custom_theme_directory = lightspeed_get_custom_directory();
		$custom_theme_uri = lightspeed_get_custom_directory_uri();
		$custom_theme_templates = lightspeed_list_files_with_uri( $custom_theme_directory, $custom_theme_uri );

		$child_custom_theme_templates = array();
		if ( is_child_theme() ) {
			$child_custom_theme_directory = lightspeed_get_custom_directory( true );
			$child_custom_theme_uri = lightspeed_get_custom_directory_uri( true );
			$child_custom_theme_templates = lightspeed_list_files_with_uri( $child_custom_theme_directory, $child_custom_theme_uri );
		}

		$block_folders = array_merge( $plugin_templates, $custom_theme_templates, $child_custom_theme_templates );
		
		return $block_folders;
	}

	public static function get_templates()
	{
		$block_folders = array( 
			'hero' 				=> 'hero/templates', 
			'header' 			=> 'header/templates',
			'footer' 			=> 'footer/templates',
			'content-with-media'=> 'content-with-media/templates',
			'content-with-items'=> 'content-with-items/templates',
			'media' 			=> 'media/templates',
			'posts' 			=> 'posts/templates',
			'call-to-action' 	=> 'call-to-action/templates',
			'next-and-previous' => 'next-and-previous/templates',
			'logos' 			=> 'logos/templates',
			'contact' 			=> 'contact/templates',
			'post-details' 		=> 'post-details/templates',
			'search' 			=> 'search/templates',
		);

		$theme_custom_directory = lightspeed_get_custom_directory();
		$theme_custom_templates = lightspeed_list_files( $theme_custom_directory );

		if ( !empty( $theme_custom_templates ) ) {
			foreach ( $theme_custom_templates as $template_key => $template ) {
				if ( !isset( $block_folders[$template] ) ) {
					$block_folders[$template] = 'custom/' . $template . '/templates';
				}
			}
		}

		if ( is_child_theme() ) {
			$theme_custom_directory = lightspeed_get_custom_directory( true );
			$theme_custom_templates = lightspeed_list_files( $theme_custom_directory );

			if ( !empty( $theme_custom_templates ) ) {
				foreach ( $theme_custom_templates as $template_key => $template ) {
					if ( !isset( $block_folders[$template] ) ) {
						$block_folders[$template] = 'custom/' . $template . '/templates';
					}
				}
			}
		}

		$templates = lightspeed_get_block_templates( $block_folders );
		
		$block_folders = array();
		$block_folders['dividers'] = 'dividers';
		$block_folders['patterns'] = 'patterns';
		$block_folders['content']  = 'content';
		$block_folders['masks']    = 'masks';

		$templates = array_merge( $templates, lightspeed_get_block_templates( $block_folders, false ) );
		
		return $templates;
	}

	public static function get_forms()
	{
		$forms = array(
			array( 'value' => '', 'label' => 'None' )
		);

		if ( class_exists( 'Ninja_Forms' ) ) {
			$ninja_forms = Ninja_Forms()->form()->get_forms();

			foreach ( $ninja_forms as $form_key => $form ) {
				
				$forms[] = array(
					'value' => $form->get_id(),
					'label' => $form->get_setting( 'title' )
				);
			}
		}

		return $forms;
	}

	public static function add_custom_fonts()
	{
		$fonts 			= array();
		$heading_font 	= get_option( 'areoi-lightspeed-company-heading-font-url', '' );
		$body_font 		= get_option( 'areoi-lightspeed-company-body-font-url', '' );
		if ( $heading_font ) $fonts['areoi-heading-font'] = $heading_font;
		if ( $body_font && $body_font != $heading_font ) $fonts['areoi-body-font'] = $body_font;
		
		if ( !empty( $fonts ) ) {
			foreach ( $fonts as $font_key => $font ) {
				wp_enqueue_style( $font_key, $font, array(), '' );
			}
		}
	}

	public static function add_styles()
	{
		self::add_custom_fonts();

		ob_start();
		include( AREOI__PLUGIN_LIGHTSPEED_DIR . 'assets/css/lightspeed.css' );
		
		$styles 			= ob_get_clean();
		
		$frame 				= get_option( 'areoi-lightspeed-styles-frame', false );
		if ( $frame ) {
			
			add_action( 'wp_body_open', function() {
				echo '
					<div class="areoi-frame areoi-frame-top">
						<svg class="areoi-frame-corner-left" xmlns="http://www.w3.org/2000/svg" width="23.001" height="23.001" viewBox="0 0 23.001 23.001">
						<path d="M0 23V0h23v.022A23.986 23.986 0 0 0 .02 23.002z"/></svg>
						<svg class="areoi-frame-corner-right" xmlns="http://www.w3.org/2000/svg" width="23.001" height="23.001" viewBox="0 0 23.001 23.001">
						<path d="M0 23V0h23v.022A23.986 23.986 0 0 0 .02 23.002z"/></svg>
					</div>
					<div class="areoi-frame areoi-frame-left"></div>
					<div class="areoi-frame areoi-frame-right"></div>
					<div class="areoi-frame areoi-frame-bottom">
						<svg class="areoi-frame-corner-left" xmlns="http://www.w3.org/2000/svg" width="23.001" height="23.001" viewBox="0 0 23.001 23.001">
						<path d="M0 23V0h23v.022A23.986 23.986 0 0 0 .02 23.002z"/></svg>
						<svg class="areoi-frame-corner-right" xmlns="http://www.w3.org/2000/svg" width="23.001" height="23.001" viewBox="0 0 23.001 23.001">
						<path d="M0 23V0h23v.022A23.986 23.986 0 0 0 .02 23.002z"/></svg>
					</div>
				';
			});

			$frame_color	= get_option( 'areoi-lightspeed-styles-frame-color', '#fff' );
			$styles .= '
				.areoi-frame {
					background-color: ' . $frame_color . ';
				}
				.areoi-frame path {
					fill: ' . $frame_color . ';
				}
			';
		}

		$gallery 				= get_option( 'areoi-lightspeed-gallery-include', false );
		if ( $gallery ) {
			
			add_action( 'wp_body_open', function() {
				echo '
					<div class="modal fade" id="areoi-gallery" tabindex="-1" aria-labelledby="areoi-gallery" aria-hidden="true">
						<div class="modal-dialog modal-fullscreen">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title text-dark" id="areoi-gallery-title">' . __( 'Gallery' ) . '</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div id="areoi-gallery-carousel" class="carousel carousel-dark slide h-100">
									  <div class="carousel-inner h-100"></div>

									  	<button class="carousel-control-prev" type="button" data-bs-target="#areoi-gallery-carousel" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next" type="button" data-bs-target="#areoi-gallery-carousel" data-bs-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Next</span>
										</button>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				';
			});
		}

		function body_classes( $classes ) 
		{
		    $transition 		= get_option( 'areoi-lightspeed-transition-transition', false );
		    $page_transition 	= get_option( 'areoi-lightspeed-transition-page', false );
		    $background_transition 	= get_option( 'areoi-lightspeed-transition-background', false );
		    $hover_transition 	= get_option( 'areoi-lightspeed-transition-hover', false );
		    $parallax 			= get_option( 'areoi-lightspeed-parallax-parallax', false );
		    $background_parallax = get_option( 'areoi-lightspeed-parallax-background', false );
		    $components_parallax = get_option( 'areoi-lightspeed-parallax-components', false );
		    $patterns_parallax 	= get_option( 'areoi-lightspeed-parallax-patterns', false );
		    $frame 				= get_option( 'areoi-lightspeed-styles-frame', false );
		    $gallery 			= get_option( 'areoi-lightspeed-gallery-include', false );

		    if ( $transition ) $classes[] = 'has-areoi-transition areoi-transition-' . $transition;
		    if ( $page_transition ) $classes[] = 'has-areoi-page-transition';
		    if ( $background_transition ) $classes[] = 'has-areoi-background-transition';
		    if ( $hover_transition ) $classes[] = 'has-areoi-hover-transition areoi-hover-transition-' . $hover_transition;
		    if ( $parallax ) $classes[] = 'has-areoi-parallax';
		    if ( $background_parallax ) $classes[] = 'has-areoi-parallax-background';
		    if ( $components_parallax ) $classes[] = 'has-areoi-parallax-components';
		    if ( $patterns_parallax ) $classes[] = 'has-areoi-parallax-patterns';
		    if ( $frame ) $classes[] = 'has-areoi-frame areoi-frame-' . $frame;
		    if ( $gallery ) $classes[] = 'has-areoi-gallery';

		    return $classes;
		}
		add_filter( 'body_class','body_classes' );

		$divider = get_option( 'areoi-lightspeed-styles-strip-divider', 'none.svg' );
		if ( !$divider ) $divider = 'none.svg';
		$divider_template = lightspeed_get_dividers_directory_uri( $divider );
		$styles .= '
			.areoi-divider {
				mask-image: url(' . $divider_template . '); 
				-webkit-mask-image: url(' . $divider_template . ');
			}
		';

		$mask = get_option( 'areoi-lightspeed-styles-image-mask', 'none.svg' );
		if ( !$mask ) $mask = 'none.svg';
		$mask_template = lightspeed_get_masks_directory_uri( $mask );
		$styles .= '
			.areoi-has-mask {
				mask-image: url(' . $mask_template . '); 
				-webkit-mask-image: url(' . $mask_template . ');
			}
		';

		if ( $styles ) {
			$styles = str_replace( 'url(../', 'url(' . AREOI__PLUGIN_LIGHTSPEED_URI . '/assets/', $styles );
			wp_add_inline_style( 'areoi-style-index', areoi_minify_css( $styles ) );
			wp_add_inline_style( 'areoi-index', areoi_minify_css( $styles ) );
		}
	}

}

if ( areoi_is_lightspeed() ) add_action( 'init', array( 'AREOI_Lightspeed', 'init' ) );