<?php
/**
 * the front page template file
 */
?>

<?php get_header(); ?>
	
	<div class="content-front">

		<?php
			// get main template HTML from template file 
			get_template_part( 'templates/content', 'front-page' ); 
		?>
		
	</div>

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>