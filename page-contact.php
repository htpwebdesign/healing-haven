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
			?>
		<?php
		$contact_field = get_field('contact_form_intro');
		$phone_number = get_field('phone_number');
		$clinic_email = get_field('clinic_email');
		$clinic_address = get_field('address');
		$google_map = get_field('address_map');
		$map_api = 'AIzaSyDAdANZWDHKVSOgqX4ltgy5N6pEWAbxs08';
		
			
		if ($phone_number) {
			?>
			<div class="contact-form-phone">
				<?php echo $phone_number; ?>
			</div>
			<?php
		}
		?>

		<?php
		if ($clinic_email) {
			?>
			<div class="contact-form-email">
				<?php echo $clinic_email; ?>
			</div>
			<?php
		}
		?>

		<?php
		if ($clinic_address) {
			?>
			<div class="contact-form-address">
				<?php echo $clinic_address; ?>
			</div>
			<?php
		}
		?>

		<?php
		if ($google_map) {
			$address = $google_map['address'];
			$zoom = $google_map['zoom'];

			?>
			<div class="contact-form-map">
				 <div class="acf-map" data-zoom="<?php echo esc_attr($zoom); ?>">
					<div class="marker" data-lat="<?php echo esc_attr($google_map['lat']); ?>" data-lng="<?php echo esc_attr($google_map['lng']); ?>">
					</div>
				</div>
			</div>
		<?php
		}
		?>

		<?php
		if ($contact_field) {
			?>
			<div class="contact-form-intro">
				<?php echo $contact_field; ?>
			</div>
			<?php
		}
		?>
		<?php
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
