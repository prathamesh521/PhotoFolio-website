<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/**
 * Register files here
 */
// require_once "inc/blocks-config.php";


/**
 * Enqueue custom style sheet
 *
 * @return void
 */
function load_stylesheet()
{
    wp_register_style('google.fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap', false);
    wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css', false, '', 'all');
    
    wp_register_style('bootstrap', get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css', false, '', 'all');
    wp_register_style('bootstrap-icons', get_stylesheet_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css', false, '', 'all');
    wp_register_style('swiper', get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', false, '', 'all');
    wp_register_style('glightox', get_stylesheet_directory_uri() . '/assets/vendor/glightbox/css/glightbox.min.css', false, '', 'all');
    wp_register_style('aos', get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.css', false, '', 'all');

    wp_register_style('styles', get_stylesheet_directory_uri() . '/assets/css/style.css', array('google.fonts', 'font-awesome', 'bootstrap', 'bootstrap-icons', 'swiper', 'glightox', 'aos'), '1.0.0', 'all');
    wp_enqueue_style('styles');
}
add_action('wp_enqueue_scripts', 'load_stylesheet',  50);

/**
 * Enqueue Custom Script
 *
 * @return void
 */
function load_scripts()
{
    wp_register_script('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js',  false, '', true);
    
    wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',  false, '', true);
    wp_register_script('swiper', get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.jss',  false, '', true);
    wp_register_script('glightbox', get_stylesheet_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js',  false, '', true);
    wp_register_script('aos', get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.js',  false, '', true);
    wp_register_script('validate', get_stylesheet_directory_uri() . '/assets/vendor/php-email-form/validate.js',  false, '', true);
    
    wp_register_script('init', get_stylesheet_directory_uri() . '/assets/js/init.js', array(
        'jquery', 
        'font-awesome', 
        'bootstrap', 
        'swiper',
        'glightbox',
        'aos',
        'validate'
    ), '1.0.0', true);
    wp_enqueue_script('init');
}
add_action('wp_enqueue_scripts', 'load_scripts');

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

register_nav_menus(array(
    'primary' => __('Primary Menu'),
));

add_filter('nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3);

/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute($atts, $item, $args)
{
	if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
		if (array_key_exists('data-toggle', $atts)) {
			unset($atts['data-toggle']);
			$atts['data-bs-toggle'] = 'dropdown';
		}
	}
	return $atts;
}