<?php
/**
 * the primary sidebar widget area
 */
?>

<div class="sidebar">

<?php 
if ( ! is_front_page() ) : 
	
	// display default sidebar feature? -- theme customizer
	if ( 1 == get_theme_mod( 'pdt_feature_sidebar_toggle' ) ) :
	
		get_template_part( 'templates/content', 'sidebar-box' );

	endif;
	
endif; // end feature box setup ?>

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php if ( ! dynamic_sidebar( 'sidebar-primary' ) ) : ?>

		<aside id="archives" class="widget">
			<h4 class="widget-title">&raquo; <?php _e( 'Archives', 'pdt' ); ?></h4>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

		<aside id="meta" class="widget">
			<h4 class="widget-title">&raquo; <?php _e( 'Meta', 'pdt' ); ?></h4>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; ?>
	
</div>