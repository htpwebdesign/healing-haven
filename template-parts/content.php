<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php healing_haven_post_thumbnail(); ?>

	<div class="text-contents">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				if ( is_singular () ):
					healing_haven_posted_on();
					healing_haven_posted_by();
				else :
					healing_haven_posted_on();
				endif;
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<div class="entry-content">
			<?php
			if( is_single() ){
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'healing-haven' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
			} else {
				the_excerpt();
			}

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'healing-haven' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
