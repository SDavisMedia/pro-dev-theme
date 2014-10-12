<?php
/**
 * the template for displaying all single downloads
 *
 * To edit the download template, do so in a child theme by COPYING
 * and pasting the templates/content-download.php file into your child
 * folder in the same structural location. Then, WordPress will use 
 * your child theme's content-download.php file instead. 
 */
get_header();
	?>
	<div class="content">
		<?php 
			while ( have_posts() ) : the_post();
				get_template_part( 'templates/content', 'download' );
				if ( 1 == get_theme_mod( 'pdt_download_comments' ) ) {
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template();
					}
				}
			endwhile;
		?>
	</div>
	<?php
get_sidebar( 'download' );
get_footer();