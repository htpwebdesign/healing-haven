<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		?>
			<section class="individual-slider">
			<?php
				$args = array(
					'post_type'      => 'hhm-testimonial',
					'posts_per_page' => -1
				);

				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {
					$post_type_object = get_post_type_object('hhm-testimonial');
					$post_type_label = $post_type_object->labels->singular_name;
					echo '<h2>' . $post_type_label . 's</h2>';
				?>
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="swiper-slide">
									<?php the_content(); ?>
								</div>
							<?php endwhile; ?>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
				<?php
					wp_reset_postdata();
				}
				?>
			</section>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
