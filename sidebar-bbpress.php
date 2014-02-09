<?php
/**
 * the bbpress (forum) sidebar widget area
 */
?>

<div class="sidebar">

<?php 
if ( ! is_front_page() ) : 
	
	// display default sidebar feature? -- theme customizer
	if ( 'option1' == get_theme_mod( 'sdm_feature_sidebar_toggle' ) ) : ?>

		<aside class="info-box widget clear-sdm">
			<div class="info-text">
				<h3 class="info-box-title">
					<?php echo get_theme_mod( 'sdm_featured_product_headline', __( 'Main Product Headline', 'sdm' ) ); ?>
				</h3>
				<div class="info-box-description">
					<?php echo get_theme_mod( 'sdm_featured_product_description', __( 'The product description belongs here. Because this is the first thing people will see when they land on your site, explain exactly what your product offers. Keep it short!', 'sdm' ) ); ?>
				</div>
			</div>
			<div class="info-cta">
				<span class="info-subtitle"><?php _e( 'Version: ', 'sdm' ); ?>
					<span class="info-version">
						<?php echo get_theme_mod( 'sdm_featured_product_version', __( 'Ex. 1.0 beta', 'sdm' ) ); ?>
					</span>
				</span>
				<span class="info-subtitle"><?php _e( 'Note: ', 'sdm' ); ?>
					<span class="info-note">
						<?php echo get_theme_mod( 'sdm_featured_product_note', __( 'Final details about this version of your product like system requirements or download details', 'sdm' ) ); ?>
					</span>
				</span>
				<a href="#" class="button green"><?php _e( 'Download Now', 'sdm' ); ?></a>
			</div>
		</aside>

	<?php
	endif;
	
endif; // end feature box setup ?>

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php 
	if ( is_active_sidebar( 'sidebar-bbpress' ) ) :
		dynamic_sidebar( 'sidebar-bbpress' );
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