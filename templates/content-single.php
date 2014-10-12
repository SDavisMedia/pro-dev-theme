<?php
/**
 * the template part for single posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php pdt_posted_on(); ?>
		</div>
	</header>
	<section class="entry-content">
		<?php 
			// display featured image?
			if ( 1 == get_theme_mod( 'pdt_single_featured_image' ) && has_post_thumbnail() ) { ?>
				<div class="featured-image">
					<?php the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) ); ?>
				</div>
				<?php
			}
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pdt' ),
				'after'  => '</div>',
			) );
		?>
	</section>
	<footer class="entry-footer">
		<div class="entry-meta">
			<?php
				$category_list = get_the_category_list( __( ', ', 'pdt' ) );
				$tag_list = get_the_tag_list( '', __( ', ', 'pdt' ) );
	
				if ( ! pdt_categorized_blog() ) {
				
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'Tagged as %2$s.', 'pdt' );
					} else {
						$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pdt' );
					}
	
				} else {
				
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'Posted in %1$s and tagged %2$s.', 'pdt' );
					} else {
						$meta_text = __( 'Posted in %1$s.', 'pdt' );
					}
	
				} // end check for categories on this blog
	
				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
				
				edit_post_link( __( 'Edit', 'pdt' ), '<span class="edit-link"> ', '</span>' ); 
			?>
		</div>
	</footer>
</article>

<?php
if ( 1 == get_theme_mod( 'pdt_post_footer' ) ) { // show post footer? theme customizer options ?>
	<div class="single-post-footer">
		<div class="post-footer-header clear-pdt">
			<div class="post-footer-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 75, '', get_the_author_meta( 'display_name' ) ); ?>
			</div>
			<div class="post-footer-author">
				<h3><?php _e( 'Written by ' . get_the_author_meta( 'display_name' ), 'pdt' ); ?></h3>
				<p><?php pdt_social_profiles(); ?></p>
			</div>
		</div>
		<?php if ( get_the_author_meta( 'description' ) ) { ?>
			<div class="post-footer-body">
				<p><?php echo get_the_author_meta( 'description' ); ?></p>
			</div>
		<?php } ?>
	</div>
	<?php
}