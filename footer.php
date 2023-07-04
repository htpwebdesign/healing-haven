<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Healing_Haven_Massage
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php

		if(function_exists( 'get_field' )){

			?> <ul class="footer-list">
			<?php
					if( get_field( 'address' , 37 )){
						?><li class="footer-item"><?php
						the_field( 'address' , 37 );
						?></li><?php
						
					}
					if( get_field( 'clinic_email' , 37 )){
						?><li class="footer-item"><?php
						the_field( 'clinic_email' , 37 );
						?></li><?php
					}
					if( get_field( 'phone_number' , 37 )){
						?><li class="footer-item"><?php
						the_field( 'phone_number' , 37 );
						?></li><?php
					}
			}
			?><li class="footer-item">
			<a class="footer-policies" href="<?php echo esc_url( home_url( '/about#policies' ) ); ?>">
				<span>Policies</span>
			</a>
			</li>
			
		<li class="footer-item">
		<?php wp_nav_menu(array('theme_location' => 'footer-right'));?>
		</li>
		</ul>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
