<?php
/**
 * The template for displaying all pages
 */
?>

<?php get_header(); ?>

	<div class="content">

		<?php 
			// start the loop
			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', 'page' );
			
				// only allow comments if chosen in theme customizer
				if ( 'option1' == get_theme_mod( 'sdm_page_comments' ) ) :
				
					// if comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				endif;

			endwhile; // end of the loop.
		?>

	</div>

<?php class_exists( 'bbPress' ) && is_bbpress() ? get_sidebar( 'bbpress' ) : get_sidebar(); ?>
<?php get_footer(); ?>
