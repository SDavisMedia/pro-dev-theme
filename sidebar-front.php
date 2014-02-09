<?php
/**
 * the front page sidebar widget area
 */
?>

<div class="sidebar">

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php 
	if ( is_active_sidebar( 'sidebar-front' ) ) :
		dynamic_sidebar( 'sidebar-front' );
	else :
		
		if ( ! dynamic_sidebar( 'sidebar-primary' ) ) : ?>

			<aside id="archives" class="widget">
				<h1 class="widget-title">&raquo; <?php _e( 'Archives', '_s' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title">&raquo; <?php _e( 'Meta', '_s' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>
			
		<?php
		endif;
			
	endif;
	?>
	
</div>