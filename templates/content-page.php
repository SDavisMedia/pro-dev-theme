<?php
/**
 * the template part for standard pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>	</header>
	<section class="entry-content">
		<?php 
			the_content(); 
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pdt' ),
				'after'  => '</div>',
			) );
		?>
	</section>
</article>
