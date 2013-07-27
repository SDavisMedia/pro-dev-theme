<?php
/**
 * the template part for image attachments 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-attachment' ); ?>>
	<header class="entry-header">
		<span class="entry-title">
			<h1><?php the_title(); ?></h1>
		</span>
		<div class="entry-meta">
		
			<?php
				// image byline information
				$metadata = wp_get_attachment_metadata();
				printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a> ', 'sdm' ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					wp_get_attachment_url(),
					$metadata['width'],
					$metadata['height'],
					get_permalink( $post->post_parent ),
					esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
					get_the_title( $post->post_parent )
				);

				edit_post_link( __( 'Edit', 'sdm' ), '<span class="edit-link">', '</span>' );
			?>
			
		</div>
	</header>

	<section class="entry-content">
		<div class="entry-attachment">
			<div class="attachment">
				<?php sdm_the_attached_image(); ?>
			</div>
			<?php if ( has_excerpt() ) : ?>
				<div class="entry-caption">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sdm' ),
				'after'  => '</div>',
			) );
		?>
		
	</section>

	<nav role="navigation" class="navigation-image">
		<div class="nav-previous">
			<?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'sdm' ) ); ?>
		</div>
		<div class="nav-next">
			<?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'sdm' ) ); ?>
		</div>
	</nav>
</article>