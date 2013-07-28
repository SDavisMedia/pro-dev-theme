<?php
/**
 * the template part for versions
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	<header class="entry-header">
		<span class="entry-title">
			<h1><?php the_title(); ?></h1>
		</span>

		<div class="entry-meta">
			<?php sdm_posted_on(); ?>
		</div>
	</header>
	<section class="entry-content">
	
		<?php 
			// display post content with pages if necessary
			the_content(); 
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sdm' ),
				'after'  => '</div>',
			) );
		?>
		
	</section>
</article>