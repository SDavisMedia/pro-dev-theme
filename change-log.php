<?php
/**
 * Template Name: Change Log (Versions)
 *
 * This is a Page Template used to collect all of the "versions"
 * and list them in chronological order to form a change log.
 */
?>
 
<?php get_header(); ?>

	<div class="content">
	
		<?php 
			$version_loop = new WP_Query( array( 
				'post_type' => 'version', 
				'posts_per_page' => 99999 
			) ); 
			
			if ( $version_loop->have_posts() ) :
	
				// Start the Loop
				while ( $version_loop->have_posts() ) : $version_loop->the_post();

					get_template_part( 'templates/content', 'change-log' );
				
				endwhile; // end the loop
	
			else :
	
				get_template_part( 'templates/no-results', 'index' );
	
			endif; 
		?>
		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>