<?php
/**
 * the bbpress (forum) sidebar widget area
 */
?>

<div class="sidebar">

<?php 
if ( ! is_front_page() ) : 
	
	// display default sidebar feature? -- theme customizer
	if ( 1 == get_theme_mod( 'pdt_feature_sidebar_toggle' ) ) : ?>
			
		<aside class="info-box widget clear-pdt">	
			<div class="product-info-wrapper">
				<div class="product-sidebar-price">
					<?php	
						// custom price template filters 
						$item_info = apply_filters( 'item_info', array(
							'price'				=> 'Price:',
							'starting_price'	=> 'Starting at:',
							'free'				=> 'Free'
						));
					?>
						
					<?php if ( edd_has_variable_prices( get_the_ID() ) ) : ?>
						<h3><?php _e( $item_info[ 'starting_price' ] . ' ', 'pdt'); edd_price( get_the_ID() ); ?></h3>						
					<?php elseif ( '0' != edd_get_download_price( get_the_ID() ) && !edd_has_variable_prices( get_the_ID() ) ) : ?>			
						<h3><?php _e( $item_info[ 'price' ] . ' ', 'pdt' ); edd_price( get_the_ID() ); ?></h3> 
					<?php else : ?>
						<h3><?php _e( $item_info[ 'free' ] . ' ','pdt' ); ?></h3>
					<?php endif;  ?>
				</div>	
				<div class="product-download-buy-button">
					<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
				</div>
			</div>
		</aside>

	<?php
	endif;
	
endif; // end feature box setup ?>

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php 
	if ( is_active_sidebar( 'sidebar-edd' ) ) :
		dynamic_sidebar( 'sidebar-edd' );
	else :
		
		if ( ! dynamic_sidebar( 'sidebar-primary' ) ) : ?>

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
		endif;
			
	endif;
	?>
	
</div>