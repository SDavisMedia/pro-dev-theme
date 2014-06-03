<?php
/**
 * This template is the most generic of all content displaying templates.
 * If the content type is not specified, like a single post or page, this
 * template is used to structure the content.
 */ 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-feed' ); ?>>
	<header class="entry-header">
		<a class="entry-title" href="<?php the_permalink(); ?>">
			<?php the_title( '<span class="title-icon"><i class="fa fa-link"></i></span><h1 class="entry-headline">', '</h1>' ); ?>
		</a>
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php pdt_posted_on(); ?>
			</div>
		<?php endif; ?>
	</header>
	
	<?php 
		// change <section> class based on post feed content options
		$post_content_type = ( 'option2' == get_theme_mod( 'pdt_post_content' ) ? 'entry-content' : 'entry-summary' ); 
	?>
	
	<section class="<?php echo $post_content_type; ?>">
		<?php
			// display either full posts or excerpts based on theme customizer options
			if ( 'option2' == get_theme_mod( 'pdt_post_content' ) ) :
			
				// display featured image full
				if ( 1 == get_theme_mod( 'pdt_feed_featured_image' ) && has_post_thumbnail() ) : ?>
					<div class="featured-image">
						<?php the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) ); ?>
					</div>
					<?php
				endif;
				
				the_content( get_theme_mod( 'pdt_read_more', __( 'Read More', 'pdt' ) . ' &rarr;' ) );
	
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'pdt' ),
					'after'  => '</div>',
				) );
				
			else :
			    the_excerpt();
			endif;
		?>
	</section>
</article>