<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

	<div class="content"">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
