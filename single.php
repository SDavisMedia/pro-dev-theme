<?php
/**
 * the template for displaying all single posts
 *
 * To edit the single post template, do so in a child theme by COPYING
 * and pasting the templates/content-single.php file into your child
 * folder in the same structural location. Then, WordPress will use 
 * your child theme's content-single.php file instead. 
 */
get_header();
	?>
	<div class="content clear">
		<?php 
			while ( have_posts() ) : the_post();
				get_template_part( 'templates/content', 'single' );
				if ( comments_open() || '0' != get_comments_number() ) {
					comments_template();
				}
				pdt_content_nav( 'nav-below' );
			endwhile;
		?>
	</div>
	<?php
get_sidebar();
get_footer();