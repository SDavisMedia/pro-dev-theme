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
			<h1 class="entry-headline"><?php the_title(); ?></h1><span class="title-icon"><i class="fa fa-link"></i></span>
		</a>
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
			
				<?php sdm_posted_on(); ?>
				
			</div>
		<?php endif; ?>
	</header>
	
	<?php 
		// change <section> class based on post feed content options
		$post_content_type = ( 'option2' == get_theme_mod( 'sdm_post_content' ) ? 'entry-content' : 'entry-summary' ); 
	?>
	
	<section class="<?php echo $post_content_type; ?>">
		
		<?php
			// display either full posts or excerpts based on theme customizer options
			if ( 'option2' == get_theme_mod( 'sdm_post_content' ) ) :
			
				// display featured image full
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
				endif;
				
				the_content( get_theme_mod( 'sdm_read_more', __( 'Read More &rarr;', 'sdm' ) ) );
	
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'sdm' ),
					'after'  => '</div>',
				) );
				
			else :
			    the_excerpt();
			endif;
		?>
		
	</section>
</article>