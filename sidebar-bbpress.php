<?php
/**
 * the bbpress (forum) sidebar widget area
 */
?>

<div class="sidebar">
	<?php 
	if ( ! is_front_page() ) { 
		if ( 1 == get_theme_mod( 'pdt_feature_sidebar_toggle' ) ) {
			get_template_part( 'templates/content', 'sidebar-box' );
		}	
	}
	do_action( 'before_sidebar' );	
	if ( is_active_sidebar( 'sidebar-bbpress' ) ) {
		dynamic_sidebar( 'sidebar-bbpress' );
	} else {		
		if ( ! dynamic_sidebar( 'sidebar-primary' ) ) {
			?>
			<aside id="archives" class="widget">
				<h1 class="widget-title">&raquo; <?php _e( 'Archives', 'pdt' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>
			<aside id="meta" class="widget">
				<h1 class="widget-title">&raquo; <?php _e( 'Meta', 'pdt' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>
			<?php
		}			
	}
	?>	
</div>