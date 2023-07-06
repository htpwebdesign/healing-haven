<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
					?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php 
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'image_gallery' ) ) {
							$imageGallery = get_field('image_gallery'); ?>

							<!-- <div id="lightgallery"> -->
							<?php
							foreach( $imageGallery as $image ) { ?>
								<!-- <a data-src="<?php echo wp_get_attachment_image_url($image, 'large') ?>"> -->
									<?php echo wp_get_attachment_image($image, 'medium'); ?>
								<!-- </a> -->
								<?php
							} ?>
							<!-- </div> -->
							<?php
						};
					};
					?>

				</div><!-- .entry-content -->

			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();