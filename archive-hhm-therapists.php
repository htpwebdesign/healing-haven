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
					<?php the_post_thumbnail( 'portrait-therapist' );?>
					<h3><?php the_title(); ?></h3>
					<p>
					<?php
						$specialties = get_the_terms(get_the_ID(), 'hhm-specialties');
						if ($specialties) {
							$specialty_names = array();
							foreach ($specialties as $specialty) {
								$specialty_names[] = $specialty->name;
							}
							echo implode(' / ', $specialty_names);
						}
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
								<a href="<?php the_permalink(); ?>">
									More Info
									<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
										<path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/>
									</svg>
								</a>
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
