<?php
/**
 * the template for displaying image attachments
 *
 * To edit the image attachment template, do so in a child theme by COPYING
 * and pasting the templates/content-image.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-image.php file instead of Quota's. 
 */

get_header(); ?>

	<div class="content attached">

		<?php 
			// start the loop
			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', 'attachment' );			

			endwhile; // end the loop
		?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>