<?php
/**
 * the most generic template file
 */
?>
 
<?php get_header(); ?>

	<div class="content">
	
		<?php 
			if ( have_posts() ) :
	
				// Start the Loop
				while ( have_posts() ) : the_post();
		
					// get main template HTML from template file
					get_template_part( 'templates/content', get_post_format() );
				
				endwhile;
	
				sdm_content_nav( 'nav-below' );
	
			else :
	
				// get main template HTML from template file
				get_template_part( 'templates/no-results', 'index' );
	
			endif; // end the loop
		?>
		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>