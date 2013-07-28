<?php
/**
 * the template for displaying attachments
 *
 * To edit the attachment template, do so in a child theme by COPYING
 * and pasting the templates/content-attachment.php file into your child
 * folder in the same structural location. Then, WordPress will use
 * your child theme's content-image.php file instead. 
 */
?>

<?php get_header(); ?>

	<div class="content attached">

		<?php 
			// start the loop
			while ( have_posts() ) : the_post();

				// get main template HTML from template file
				get_template_part( 'templates/content', 'attachment' );			

			endwhile; // end the loop
			
			sdm_attachment_nav();
		?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>