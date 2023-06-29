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
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<?php healing_haven_post_thumbnail(); ?>

			<?php
			if ( function_exists( 'get_field' ) ) :
			?>

				<div class="entry-content">

				<?php
				$about_clinic = get_field( 'about_clinic' );

				if ( $about_clinic ) {

					foreach ( $about_clinic as $item ) {

						$title_about = $item['title_about'];
						$about_parag = $item['about_paragraph'];

						if( $title_about &&  $about_parag ) {
						?>
							<div class="about <?php echo esc_attr(strtolower( $title_about ));?>">
								<h2><?php echo esc_html( $title_about ); ?></h2>
								<p><?php echo esc_html( $about_parag ); ?></p>
							</div>
						
						<?php
						}

					}

				}

				$policies = get_field( 'policies' );

				if ( $policies ) :
					?>
					<div class="about policies">
						<h2>Policies</h2>
						<div class="accordion">

					<?php

					$index = 0;

					foreach ( $policies as $policy ) {
						$policy_title = $policy['policy_title'];
						$policy_parag = $policy['policy_paragraph'];

						if( $policy_title && $policy_parag ) :
							?>

							<div class="accordion-item">
								<h3 class="accordion-title" data-index="<?php echo $index; ?>"><?php echo $policy_title; ?>
									<svg class="accordion-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z"/>
                  </svg>
								</h3>

								<div class="accordion-content" data-index="<?php echo $index; ?>"><?php echo $policy_parag; ?></div>
							</div> <!-- Close accordion-item -->

							<?php

							$index++;

						endif;
					}
					?>

						</div> <!-- Close accordion -->
					</div>

					<?php
				endif;
			endif;
			
		endwhile; // End of the loop.
		?>
				</div><!-- .entry-content -->

				
				<div class="link-button">
					<a href="<?php echo esc_url( home_url( '/therapists' ) ); ?>">Meet Our Team</a>
				</div>

		</article><!-- #post-<?php the_ID(); ?> -->
	</main><!-- #main -->

<?php
get_footer();
