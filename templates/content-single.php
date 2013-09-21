<?php
/**
 * the template part for single posts
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
			// display featured image?
			if ( 'option1' == get_theme_mod( 'sdm_single_featured_image' ) && has_post_thumbnail() ) :
				the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
			endif;
			
			// display post content with pages if necessary
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sdm' ),
				'after'  => '</div>',
			) );
		?>
		
	</section>

	<footer class="entry-footer">
		<div class="entry-meta">
	
			<?php
				// translators: used between list items, there is a space after the comma
				$category_list = get_the_category_list( __( ', ', 'sdm' ) );
	
				// translators: used between list items, there is a space after the comma
				$tag_list = get_the_tag_list( '', __( ', ', 'sdm' ) );
	
				if ( ! sdm_categorized_blog() ) {
				
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'Tagged as %2$s.', 'sdm' );
					} else {
						$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sdm' );
					}
	
				} else {
				
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'Posted in %1$s and tagged %2$s.', 'sdm' );
					} else {
						$meta_text = __( 'Posted in %1$s.', 'sdm' );
					}
	
				} // end check for categories on this blog
	
				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
				
				edit_post_link( __( 'Edit', 'sdm' ), '<span class="edit-link"> ', '</span>' ); 
			?>
		</div>
	</footer>
</article>

<?php // show post footer? theme customizer options ?>
<?php if ( 'option1' == get_theme_mod( 'sdm_post_footer' ) ) : ?>
	<div class="single-post-footer">
		<div class="post-footer-header clear-sdm">
			<div class="post-footer-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 75, '', get_the_author_meta( 'display_name' ) ); ?>
			</div>
			<div class="post-footer-author">
				<h3><?php _e( 'Written by ' . get_the_author_meta( 'display_name' ), 'sdm' ); ?></h3>
				<p>
				
					<?php 
						/**
						 * Built into the Customizer are a fields for social networking
						 * profiles. Using the following array, check to see if the field
						 * has a URL. If so, create a link for that profile in the post
						 * footer. If not, do nothing.
						 */
						$social_profiles = array( 
							'twitter'	=> array(
								'name' 		=> 'Twitter',
								'option'	=> get_theme_mod( 'sdm_twitter' )
							),
							'facebook'	=> array(
								'name' 		=> 'Facebook',
								'option'	=> get_theme_mod( 'sdm_facebook' )
							),
							'gplus'	=> array(
								'name' 		=> 'Google+',
								'option'	=> get_theme_mod( 'sdm_gplus' )
							),
							'github'	=> array(
								'name' 		=> 'Github',
								'option'	=> get_theme_mod( 'sdm_github' )
							),
						);
						// Build the social networking profile links based on the $social_profiles
						foreach ( $social_profiles as $profile ) {
							if ( '' != $profile[ 'option' ] ) :
								echo '<a href="', $profile[ 'option' ], '">', $profile[ 'name' ], '</a>'; 
							endif;
						}
					?>
										
				</p>
			</div>
		</div>
		<div class="post-footer-body">
			<p><?php echo get_the_author_meta( 'description' ); ?></p>
		</div>
	</div>
<?php endif; ?>