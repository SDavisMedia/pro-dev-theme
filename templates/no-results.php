<?php
/**
 * the template part for displaying a message that posts cannot be found
 */
?>

<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'pdt' ); ?></h1>
	</header>
	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pdt' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php } elseif ( is_search() ) { ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'pdt' ); ?></p>
			<?php get_search_form(); ?>
		<?php } else { ?>
			<p><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'pdt' ); ?></p>
			<?php get_search_form(); ?>
		<?php } ?>
	</div>
</article>
