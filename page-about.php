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

			
			if ( function_exists( 'get_field' ) ) {

				$about_clinic = get_field( 'about_clinic' );

				if ( $about_clinic ) {

					foreach ( $about_clinic as $item ) {

						$title_about = $item['title_about'];
						$about_parag = $item['about_paragraph'];

						if( $title_about ) {
							echo '<h2>' . esc_html( $title_about ) . '</h2>';
						}

						if( $about_parag ) {
							echo '<p>' . esc_html( $about_parag ) . '</p>';
						}

					}

				}

				$accordion = get_field( 'accordion' );

				if( $accordion ) {
					echo do_shortcode( $accordion );
				}
			}
	

			// get_template_part( 'template-parts/content', 'page' );

			// // If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
