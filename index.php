<?php
/**
 * the most generic template file
 */
get_header();
	?>
	<div class="content">	
		<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'templates/content', get_post_format() );
				endwhile;
				pdt_content_nav( 'nav-below' );
			else :
				get_template_part( 'templates/no-results', 'index' );
			endif;
		?>		
	</div>
	<?php
get_sidebar();
get_footer();