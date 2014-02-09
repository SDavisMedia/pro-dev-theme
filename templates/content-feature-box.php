<?php
/**
 * display info about the latest major update
 */
?>

<?php 
if ( is_front_page() ) : 
	
	// display default feature box? -- theme customizer
	if ( 'option1' == get_theme_mod( 'sdm_feature_box_toggle' ) ) : ?>

		<div class="info-box clear-sdm">
			<div class="info-text">
				<h3 class="info-box-title">
					<?php echo get_theme_mod( 'sdm_featured_product_headline' ); ?>
				</h3>
				<div class="info-box-description">
					<?php echo wpautop( get_theme_mod( 'sdm_featured_product_description' ) ); ?>
				</div>
			</div>
			<div class="info-cta">
				<span class="info-subtitle"><?php _e( 'Version: ', 'sdm' ); ?>
					<span class="info-version">
						<?php echo get_theme_mod( 'sdm_featured_product_version' ); ?>
					</span>
				</span>
				<span class="info-subtitle"><?php _e( 'Note: ', 'sdm' ); ?>
					<span class="info-note">
						<?php echo get_theme_mod( 'sdm_featured_product_note' ); ?>
					</span>
				</span>
				<a href="#" class="button green"><?php _e( 'Download Now', 'sdm' ); ?></a>
			</div>
		</div>

	<?php
	endif;
	
endif; // end feature box setup 