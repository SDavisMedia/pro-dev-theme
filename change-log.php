<?php
/**
 * Template Name: Change Log (Updates)
 */

$version_loop = new WP_Query( array( 'post_type' => 'version', 'posts_per_page' => 10 ) ); ?>
 
<?php get_header(); ?>

	<div class="content">
	
		<?php 
			if ( $version_loop->have_posts() ) :
	
				// Start the Loop
				while ( $version_loop->have_posts() ) : $version_loop->the_post();

					get_template_part( 'templates/content', 'change-log' );
				
				endwhile;
	
				sdm_content_nav( 'nav-below' );
	
			else :
	
				get_template_part( 'templates/no-results', 'index' );
	
			endif; 
		?>
		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>