<?php
/**
 * the template for displaying 404 pages (Not Found)
 *
 * To edit the 404 error template, do so in a child theme by COPYING
 * and pasting the templates/content-404.php file into your child
 * folder in the same structural location. Then, WordPress will use 
 * your child theme's content-404.php file instead. 
 */
?>

<?php get_header(); ?>

	<div class="content">
	
		<?php 
			// get main template HTML from template file
			get_template_part( 'templates/content', '404' );
		?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>