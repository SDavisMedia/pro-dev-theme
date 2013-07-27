<?php
/**
 * the main sidebar widget area
 */
?>

<div class="aux-col">
	
</div>

<div class="sidebar">

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php if ( ! dynamic_sidebar( 'sidebar-primary' ) ) : ?>

			<aside class="widget widget_archive">
				<h4 class="widget-title"><?php _e( '&raquo; Archives', 'quota' ); ?></h4>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside class="widget widget_search">
				<h4 class="widget-title"><?php _e( '&raquo; Search', 'quota' ); ?></h4>
				<?php get_search_form(); ?>
			</aside>

	<?php endif; ?>
	
</div>