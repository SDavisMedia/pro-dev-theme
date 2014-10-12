<?php
/**
 * The template for displaying all pages
 */
get_header();

// adjust content column class if it's bbPress and full width forums are selected
if ( class_exists( 'bbPress' ) && is_bbpress() ) {
	$page_content = 1 == get_theme_mod( 'pdt_bbpress_full_width' ) ? 'bbpress-content' : 'content';
} else {
	$page_content = 'content';
}
?>
	<div class="<?php echo $page_content; ?>">
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

// if it's a bbPress page and a sidebar is displayed, get the bbPress sidebar
if ( class_exists( 'bbPress' ) && is_bbpress() ) {
	if ( 1 != get_theme_mod( 'pdt_bbpress_full_width' ) ) {
		get_sidebar( 'bbpress' );
	}
} else {
	get_sidebar();
}
get_footer();
