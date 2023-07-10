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

	<main id="primary" class="site-main single-blog-post">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous', 'healing-haven' ) . '</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'healing-haven' ) . '</span>',
				)
			);
			?>

			<!-- Display Popular services -->
			<section class="single-popular-services">
				<h2>Popular Services</h2>
				<div class='popular-services-carousel'>
					<?php get_template_part( 'template-parts/popular', 'services' ); ?>
				</div>
			</section>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
