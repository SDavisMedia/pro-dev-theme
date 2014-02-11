<?php
/**
 * display info about the latest major update
 */
?>

<?php 
if ( is_front_page() ) : 
	
	// display default feature box? -- theme customizer
	if ( 1 == get_theme_mod( 'sdm_feature_box_toggle' ) ) : ?>

		<div class="info-box clear-sdm">
			<div class="info-text">
				<?php if ( get_theme_mod( 'sdm_featured_product_headline' ) ) : ?>
					<h3 class="info-box-title">
						<?php echo get_theme_mod( 'sdm_featured_product_headline' ); ?>
					</h3>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'sdm_featured_product_description' ) ) : ?>
					<div class="info-box-description">
						<?php echo wpautop( get_theme_mod( 'sdm_featured_product_description' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="info-cta">
				<?php if ( get_theme_mod( 'sdm_featured_product_version' ) ) : ?>
					<span class="info-subtitle"><?php _e( 'Current version: ', 'sdm' ); ?>
						<span class="info-version">
							<?php echo get_theme_mod( 'sdm_featured_product_version' ); ?>
						</span>
					</span>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'sdm_featured_product_note' ) ) : ?>
					<span class="info-subtitle"><?php _e( 'Note: ', 'sdm' ); ?>
						<span class="info-note">
							<?php echo get_theme_mod( 'sdm_featured_product_note' ); ?>
						</span>
					</span>
				<?php endif; ?>
				<?php
					if ( 'green' == get_theme_mod( 'sdm_cta_button_color' ) ) :
						$cta_button = 'green';
					elseif ( 'blue' == get_theme_mod( 'sdm_cta_button_color' ) ) :
						$cta_button = 'blue';
					else :
						$cta_button = 'gray';
					endif; 
				?>
				<?php if ( get_theme_mod( 'sdm_featured_product_url' ) && get_theme_mod( 'sdm_featured_product_button_text' ) ) : ?>
					<a href="<?php echo get_theme_mod( 'sdm_featured_product_url' ); ?>" class="cta-button button <?php echo $cta_button; ?>"><?php echo get_theme_mod( 'sdm_featured_product_button_text' ); ?></a>
				<?php endif; ?>
			</div>
		</div>

	<?php
	endif;
	
endif; // end feature box setup 