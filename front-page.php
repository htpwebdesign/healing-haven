<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main">
		<header>
			<?php 
			if ( function_exists( 'get_field' ) ) {
				if ( get_field( 'hero_image' ) ) {
					$hero_image = get_field( 'hero_image' );
					$hero_image_size = 'full';
					echo wp_get_attachment_image( $hero_image, $hero_image_size );
				};
				if ( get_field('welcome_message') ) { ?>
					<p> <?php the_field( 'welcome_message' ); ?></p>
				
				<?php 
				}
				if ( get_field('welcome_message_2') ) { ?>
					<h1><?php the_field( 'welcome_message_2' ); ?></h1>
				<?php
				}
			};
			?>
		</header>

		<?php
		if ( have_posts() ) :
			
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>

				<section class="home-intro">
					<?php 
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'slogan' ) ) { ?>
							<h2><?php the_field( 'slogan' ); ?></h2>
						<?php
						}
						if ( get_field( 'about_clinic_home' ) ) { ?>
							<p><?php the_field( 'about_clinic_home' ); ?></p>
						<?php
						}
					}
					?>
				</section>

				<section class="home-popular-services">
					<h2>Popular Services</h2>
					<?php get_template_part( 'template-parts/popular', 'services' ); ?>
				</section>

				<section class="home-testimonials">
					<h2>Testimonials</h2>
					<?php 
					$args = array (
						'post_type' => 'hhm-testimonial',
						'posts_per_page' => 3,
						'orderby' => 'rand',
					);

					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						while( $query->have_posts() ) {
							$query->the_post();
							the_content();
						};
						wp_reset_postdata();
					}
					?>
				</section>

				<section class="home-blog">
					<h2>Recent Blog Posts</h2>
					<?php 
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3
					);
					$blog_query = new WP_Query( $args );
					if ( $blog_query -> have_posts() ) {
						while ( $blog_query -> have_posts() ) {
							$blog_query -> the_post();
							?>
							<article>
								<?php the_post_thumbnail( 'thumbnail' ); ?>
								<h3><?php the_title(); ?></h3>
								<p><?php echo get_the_date(); ?></p>
								<p><?php the_excerpt(); ?></p>
								<a href="<?php the_permalink() ?>"><p>Read More</p></a>
							</article>
							<?php
						}
						wp_reset_postdata();
					}
					?>
					<a href="<?php the_permalink(57) ?>"><p>Check out other posts</p></a>
				</section>

				<section class="instagram">
					<h2>Check out our instagram</h2>
					<?php 
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'instagram' ) ) {
							the_field('instagram');
						};
					};
					?>
				</section>

			<?php
			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
