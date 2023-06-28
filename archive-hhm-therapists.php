<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$args = array(
				'post_type'      => 'hhm-therapists',
				'posts_per_page' => -1,
			);

			$query = new WP_Query( $args );

			if( $query -> have_posts() ) {
				?>
				<section class="therapists-section">

				<?php
				while( $query -> have_posts () ) {
					$query -> the_post();
				?>
				<article class="therapist-item">
						<?php the_post_thumbnail('small');?>
						<h3><?php the_title(); ?></h3>
						<p>Specialties:
							<?php
								echo get_the_term_list(get_the_ID(), 'hhm-specialties', '',' / ','');
							?>
						</p>

						<?php
						if ( function_exists( 'get_field' ) ) {
							$days_available = get_field( 'days_available', get_the_ID() );
							if ( $days_available ) {
								echo 'Days Available: ';
								$days = array();
								foreach ( $days_available as $day ) {
									$days[] = $day['days_available'];
								}
								echo implode(', ', $days);
							}
						}
						?>
						<div class="more-info">
							<button>
								<a href="<?php the_permalink(); ?>">
								More Info</a>
							</button>
						</div>
				</article>
				<?php
				}
				wp_reset_postdata();
				?>
				</section>
			<?php
			}
		endif;
		?>
	</main><!-- #main -->

<?php
get_footer();
