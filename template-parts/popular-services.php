<?php
/**
 * Template part for displaying popular services
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

?>

<?php 
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'popular_services', 32 ) ) { 
			$popular_services = get_field('popular_services', 32); ?>

			<ul>
			<?php foreach( $popular_services as $popular_service) {
				$service = wc_get_product($popular_service);
				$title = $service->get_title();
				$thumbnail = $service->get_image('thumbnail');
				$permalink = $service->get_permalink();
				?>
				<li>
					<?php echo $thumbnail ?>
					<?php echo $title ?>
					<a href="<?php echo esc_url($permalink) ?>">
						<p>More Info</p>
					</a>
				</li>
			<?php } ?>
			</ul>
		<?php
		}
	}
?>
