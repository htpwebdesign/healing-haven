<?php
/**
 * Healing Haven Massage functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Healing_Haven_Massage
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function healing_haven_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Healing Haven Massage, use a find and replace
		* to change 'healing-haven' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'healing-haven', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Portrait Therapists Size 
	add_image_size( 'portrait-therapist', 400, 300, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'healing-haven' ),
			'header-right' => esc_html__( 'Header - Right Side', 'healing-haven' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'healing_haven_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'healing_haven_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function healing_haven_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'healing_haven_content_width', 640 );
}
add_action( 'after_setup_theme', 'healing_haven_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function healing_haven_scripts() {
	wp_enqueue_style( 'healing-haven-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'healing-haven-style', 'rtl', 'replace' );

	wp_enqueue_script( 'healing-haven-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue accordion on the About page
	wp_enqueue_script(
		'accordion-scripts',
		get_template_directory_uri() .'/js/accordion.js',
		array(),
		_S_VERSION,
		true
	);

	// Enqueue services-nav on the Services page
	wp_enqueue_script(
		'services-nav-scripts',
		get_template_directory_uri() .'/js/services-nav.js',
		array(),
		_S_VERSION,
		true
	);

	// Enqueue map on contact page
	wp_enqueue_script(
		'google-maps', 
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyDAdANZWDHKVSOgqX4ltgy5N6pEWAbxs08&map_ids=d751ae2754605c87&callback=Function.prototype', array(), 
		null, 
		true);

    wp_enqueue_script(
		'custom-map-script', 
		get_template_directory_uri() . '/js/map.js', 
		array('jquery'), 
		'5.8.6', 
		true);
	}
add_action( 'wp_enqueue_scripts', 'healing_haven_scripts' );


/**
* Custom Post Types & Taxonomies
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Remove the category count for WooCommerce categories
add_filter( 'woocommerce_subcategory_count_html', '__return_null' );

// Remove "Archives:" from the title
function hhm_archive_title_prefix( $prefix ){
	if ( get_post_type() === 'hhm-therapists' ) {
			return false;
	} else {
			return $prefix;
	}
}
add_filter( 'get_the_archive_title_prefix', 'hhm_archive_title_prefix' );

// To remove the prefix for all archives on the site...
// add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

// function my_acf_google_map_api( $api ){
//     $api['key'] = 'AIzaSyDAdANZWDHKVSOgqX4ltgy5N6pEWAbxs08';
//     return $api;
// }
// add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Change excerpt length to 20 words
function hhm_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'hhm_excerpt_length', 999, 1 );

// Changed excerpt more to a link
function hhm_excerpt_more( $more ) {
	$more = '... <a class="read-more" href="'. esc_url( get_permalink() ) .'">'. __( 'Continue Reading', 'hhm' ) .'</a>';
	return $more;
}
add_filter( 'excerpt_more', 'hhm_excerpt_more' );