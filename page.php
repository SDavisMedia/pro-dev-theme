<?php
/**
 * The template for displaying all pages
 */
?>

<?php get_header(); 

		if ( class_exists( 'bbPress' ) && is_bbpress() && 1 == get_theme_mod( 'sdm_bbpress_full_width' ) ) :
			$bbpress_fw = 'bbpress-content ';
		else :
			$bbpress_fw = 'content';
		endif; 
	?>

	<div class="<?php echo $bbpress_fw; ?>">

		<?php 
			// start the loop
			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', 'page' );
			
				// only allow comments if chosen in theme customizer
				if ( 1 == get_theme_mod( 'sdm_page_comments' ) ) :
				
					// if comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				endif;

			endwhile; // end of the loop.
		?>

	</div>

<?php 
	if ( class_exists( 'bbPress' ) && is_bbpress() ) :
		if ( 1 != get_theme_mod( 'sdm_bbpress_full_width' ) ) :
			get_sidebar( 'bbpress' );
		endif;
	else :
		get_sidebar();
	endif;
?>
<?php get_footer(); ?>
