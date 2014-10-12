<?php
/**
 * the EDD sidebar widget area
 */
?>

<div class="sidebar">
	<?php 
	if ( ! is_front_page() ) { 
		if ( 1 == get_theme_mod( 'pdt_feature_sidebar_toggle' ) ) {
			?>
				
			<aside class="info-box widget clear-pdt">	
				<div class="product-info-wrapper">
					<div class="product-sidebar-price">
						<?php if ( edd_has_variable_prices( get_the_ID() ) ) : ?>
							<h3><?php echo __( 'Starting at', 'pdt' ) . ': '; edd_price( get_the_ID() ); ?></h3>						
						<?php elseif ( '0' != edd_get_download_price( get_the_ID() ) && !edd_has_variable_prices( get_the_ID() ) ) : ?>			
							<h3><?php echo __( 'Price at', 'pdt' ) . ': '; edd_price( get_the_ID() ); ?></h3> 
						<?php else : ?>
							<h3><?php _e( 'Free', 'pdt' ); ?></h3>
						<?php endif;  ?>
					</div>	
					<div class="product-download-buy-button">
						<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
					</div>
				</div>
			</aside>
			<?php
		}	
	}
	do_action( 'before_sidebar' );
	if ( is_active_sidebar( 'sidebar-edd' ) ) {
		dynamic_sidebar( 'sidebar-edd' );
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