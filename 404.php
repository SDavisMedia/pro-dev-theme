<?php
/**
 * the template for displaying 404 pages (Not Found)
 *
 * To edit the 404 error template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-404.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-404.php file instead of Quota's. 
 */
?>

<?php get_header(); ?>

	<div class="content">
	
		<?php get_template_part( 'templates/content', '404' ); ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>