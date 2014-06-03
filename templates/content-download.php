<?php
/**
 * the template part for single download pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<?php		
		// display featured image?
		if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<?php the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) ); ?>
			</div>
			<?php
		endif; 
	?>
	<div class="entry-content">
		<?php 
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pdt' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article>