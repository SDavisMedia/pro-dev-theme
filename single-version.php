<?php
/**
 * the template for displaying all versions
 *
 * To edit the versions template, do so in a child theme by COPYING
 * and pasting the templates/content-version.php file into your child
 * folder in the same structural location. Then, WordPress will use 
 * your child theme's content-version.php file instead. 
 */
?>

<?php get_header(); ?>

	<div class="content clear">

		<?php 
			// start the loop
			while ( have_posts() ) : the_post();
			
				// get main template HTML from template file
				get_template_part( 'templates/content', 'version' );
				
				sdm_content_nav( 'nav-below' );

			endwhile; // end the loop
		?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>