<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );

	// Get all product categories
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	) );

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $category ) {
			// Output category name
			echo '<h2>' . esc_html( $category->name ) . '</h2>';
			echo '<p>' . esc_html( $category->description ) . '</p>';

			// Get the category featured image
			$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
			$image_url = wp_get_attachment_image_url($thumbnail_id, 'full');
	
			if ($image_url) {
				echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
			}

			

			// Get the products in the current category
			$products = new WP_Query( array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'tax_query'      => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $category->term_id,
					),
				),
			) );

			if ( $products->have_posts() ) {
				while ( $products->have_posts() ) {
					$products->the_post();

					// Get the price
					$price = $product->get_price();
					$permalink = $product->get_permalink();

					// Output product details
					if ($product->is_type('booking')) {
						
						// Get the booking duration in minutes
						$duration = $product->get_duration();
					
						// Display the duration
						echo "<a href='$permalink'>";
						echo $duration . ' minutes ';
						echo `$`.$price. ' ';
						echo "</a>";
					}
					else
						echo `$`.$price. ' ';



					// wc_get_template_part( 'content', 'product' ); 

					


				}
			} else {
				echo 'No products found.';
			}

			// Restore global post data
			wp_reset_postdata();
		}
	} else {
		echo 'No categories found.';
	}
	?>
</header>

<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );

