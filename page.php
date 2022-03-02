<?php
/**
 * The template for displaying all pages
 */
get_header();
?>

<div class="content">
	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'templates/content', 'page' );
			if ( 1 == get_theme_mod( 'pdt_page_comments' ) ) {
				if ( comments_open() || '0' != get_comments_number() ) {
					comments_template();
				}
			}
		endwhile;
	?>
</div>

<?php
get_sidebar();
get_footer();
