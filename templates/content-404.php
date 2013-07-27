<?php
/**
 * the template part for the 404 error page
 */
?>

<article id="post-0" class="post not-found">
	<header class="entry-header">
		<span class="entry-title">
			<h1><?php _e( 'Oops! It looks like there\'s an error. Let us help.', 'sdm' ); ?></h1>
		</span>
	</header>

	<div class="entry-content">
		<p><?php _e( 'Try using search to find what you were looking for.', 'sdm' ); ?></p>
		<?php get_search_form(); ?>
	</div>  		    
</article>
