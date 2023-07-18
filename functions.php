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
	if (is_shop() || is_account_page()) {
		wp_enqueue_script(
			'services-nav-scripts',
			get_template_directory_uri() . '/js/services-nav.js',
			array(),
			'_S_VERSION',
			true
		);
	}

	if (is_account_page()) {
		wp_enqueue_script(
			'account-scripts',
			get_template_directory_uri() . '/js/my-account.js',
			array(),
			'_S_VERSION',
			true
		);
	}

	// Enqueue map on contact page
	if (is_page('contact') || is_page('edit-contact')) {
	wp_enqueue_script(
		'google-maps', 
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyDAdANZWDHKVSOgqX4ltgy5N6pEWAbxs08&callback=Function.prototype', array(), 
		null, 
		true);
		
    wp_enqueue_script(
		'custom-map-script', 
		get_template_directory_uri() . '/js/map.js', 
		array('jquery'), 
		'5.8.6', 
		true);
	}

	// slider - swiper files
	wp_enqueue_style(
		'swiper-styles',
		get_template_directory_uri() . '/css/swiper-bundle.css',
		array(),
		'9.3.1'
	);

	wp_enqueue_script(
		'swiper-scripts',
		get_template_directory_uri().'/js/swiper-bundle.min.js',
		array(),
		'9.3.1',
		true 
	);

	wp_enqueue_script(
		'swiper-settings',
		get_template_directory_uri().'/js/swiper-settings.js',
		array( 'swiper-scripts' ), 
		_S_VERSION,
		true
	);
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

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyDAdANZWDHKVSOgqX4ltgy5N6pEWAbxs08';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Change excerpt length to 20 words
function hhm_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'hhm_excerpt_length', 999, 1 );

// Changed excerpt more to a link
function hhm_excerpt_more( $more ) {
	$more = '...';
	return $more;
}
add_filter( 'excerpt_more', 'hhm_excerpt_more' );

//customizing account menu items
function hhm_remove_default_account_navigation( $items ) {
    $items = array();
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'hhm_remove_default_account_navigation', 10 );

// function remove_smart_coupons_from_my_account() {
//     update_option( 'woocommerce_smart_coupon_show_my_account', 'no' );
// }
// add_action( 'init', 'remove_smart_coupons_from_my_account' );


function hhm_customize_account_navigation() {
	if ( is_account_page() ) {
	?>
	
	<nav class="category-nav">
		<button class="subnav-title" aria-controls="my-account-menu" aria-expanded="false">
			<h3 id="account-navigation-title">Account Navigation</h3>
			<svg aria-hidden="true" class="accordion-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path d="M7 10l5 5 5-5z"/>
			</svg>
		</button>	
		<ul class="dropdown">
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Dashboard'); ?></a>
			</li>
			<!-- <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Orders'); ?></a>
			</li> -->
			<!-- <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--downloads">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'downloads' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Downloads'); ?></a>
			</li> -->
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--bookings">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'bookings' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Bookings'); ?></a>
			</li>
			<!-- <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--coupons">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'coupons' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Coupons'); ?></a>
			</li> -->
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--addresses">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Addresses'); ?></a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--payment-methods">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'payment-methods' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Payment Methods'); ?></a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--account-details">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Account Details'); ?></a>
			</li>
			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>" class="services-menu-link"><?php esc_html_e( 'Log Out'); ?></a>
			</li>
		</ul>
	</nav>
	<?php
	}
}

add_action( 'woocommerce_account_navigation', 'hhm_customize_account_navigation', 1 );


function handleServices(){

	remove_action(
		'woocommerce_before_single_product_summary',
		'woocommerce_show_product_images',
		20
	);

	remove_action(
		'woocommerce_before_single_product_summary',
		'woocommerce_show_product_sale_flash',
		10
	);

	remove_action(
		'woocommerce_single_product_summary',
		'woocommerce_template_single_excerpt',
		20
	);

	remove_action(
		'woocommerce_single_product_summary',
		'woocommerce_template_single_meta',
		40
	);
}
add_action( 'woocommerce_before_single_product', 'handleServices', 1 );

// rename the 'Apply coupon" button on cart page
function hhm_rename_coupon_field_on_cart( $translated_text, $text, $text_domain ) {
	// bail if not modifying frontend woocommerce text
	if ( is_admin() || 'woocommerce' !== $text_domain ) {
		return $translated_text;
	}

	if ( 'Apply coupon' === $text ) {

		$translated_text = 'Apply';
	}

	return $translated_text;
};
add_filter('gettext', 'hhm_rename_coupon_field_on_cart', 10, 3);

// Automatically approve reviews maybe?
// function auto_approve_reviews($commentdata) {
//     $commentdata['comment_approved'] = 1;
//     return $commentdata;
// }
// add_filter('preprocess_comment', 'auto_approve_reviews');

// Change placeholder text in Additional Notes on Checkout Page
function hhm_custom_additional_info( $fields ) {
	$fields['order']['order_comments']['label'] = 'Any special requests or additional info?';
	$fields['order']['order_comments']['placeholder'] = 'Let us know here.';
	return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'hhm_custom_additional_info' );

// Create a block template for contact page
function hhm_block_editor_templates() {
	if ( isset($_GET['post']) && '37' == $_GET['post'] ) {
		$post_type_object = get_post_type_object( 'page' );

		$post_type_object->template = array(
										array('gravityforms/form'),
									);

		$post_type_object->template_lock = 'all';
	}

	if ( isset($_GET['post']) && ('17' == $_GET['post'] || '18' == $_GET['post'] || '19' == $_GET['post']) ) {
		$post_type_object = get_post_type_object( 'page' );

		$post_type_object->template = array(
										array('core/shortcode'),
									);

		$post_type_object->template_lock = 'all';
	}
}
add_action('init', 'hhm_block_editor_templates');

// Lock block editor for the following pages in the array
function hhm_post_filter( $use_block_editor, $post ) {
    $page_ids = array( 32, 34);
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'hhm_post_filter', 10, 2 );

// Move Yoast metabox to bottom
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );