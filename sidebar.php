<?php
/**
 * the primary sidebar widget area
 */
?>

<div class="sidebar">

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php if ( ! dynamic_sidebar( 'sidebar-primary' ) ) : ?>

		<aside class="widget widget_archive">
			<h4 class="widget-title"><?php _e( '&raquo; Archives', 'quota' ); ?></h4>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

	<?php endif; ?>
	
</div>