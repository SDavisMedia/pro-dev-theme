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
			<h1><?php the_title(); ?></h1>
		</a>
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
			
				<?php sdm_posted_on(); ?>
				
			</div>
		<?php endif; ?>
	</header>
	<section class="entry-summary">
		
		<?php
			// display featured image
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'feed-thumb', array( 'class' => 'alignleft' ) );
			endif;
		
			the_excerpt(); 
		?>
		
	</section>
</article>