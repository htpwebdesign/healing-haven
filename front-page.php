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
		<?php 
			while ( have_posts() ) :
				the_post();

				// Get Hero image and store it in a variable 
				if ( function_exists( 'get_field' ) ) {
					if ( get_field( 'hero_image' ) ) {
						$hero_image = get_field( 'hero_image' );
					}; 
				}
				?>
				<header class="home-hero" style="background-image: url('<?php echo $hero_image ?>');">
					<?php 
					// Output hero section text
					if ( function_exists( 'get_field' ) ) { ?>
						<div class="hero-text">
							<?php
							if ( get_field('welcome_message') ) { ?>
								<p> <?php the_field( 'welcome_message' ); ?></p>
							
							<?php 
							}
							if ( get_field('welcome_message_2') ) { ?>
								<h1><?php the_field( 'welcome_message_2' ); ?></h1>
							<?php
							} ?>
						</div>
					<?php
					};
					?>
				</header>

			<!-- Output intro text -->
			<section class="home-intro" id="home-intro">
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

			<div class="home-content-wrapper">
			<!-- Output popular services -->
			<section class="home-popular-services">
				<h2>Popular Services</h2>
				<?php get_template_part( 'template-parts/popular-services' ); ?>
			</section>

			<!-- Output 3 random testimonials -->
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
						$query->the_post(); ?>
						<article>
						<h3><?php the_title(); ?></h3>
						<?php the_content(); ?>
						</article>
					<?php
					};
					wp_reset_postdata();
				}
				?>
			</section>

			<!-- Out 3 random blog posts -->
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
							<p><a href="<?php the_permalink() ?>">Read More</a></p>
						</article>
						<?php
					}
					wp_reset_postdata();
				}
				?>
				<p><a href="<?php the_permalink(57) ?>">Check out other posts</a></p>
			</section>

			<!-- Output instagram feed -->
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
			</div>
		<?php endwhile; ?>
	</main><!-- #main -->

<?php
get_footer();
