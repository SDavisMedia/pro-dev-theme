<?php
/**
 * display info about the latest major update
 */
?>

<aside class="info-box widget clear-sdm">
	<div class="info-text">
		<?php if ( get_theme_mod( 'sdm_featured_info_headline' ) ) : ?>
			<h3 class="info-box-title">
				<?php echo get_theme_mod( 'sdm_featured_info_headline' ); ?>
			</h3>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'sdm_featured_info_description' ) ) : ?>
			<div class="info-box-description">
				<?php echo wpautop( get_theme_mod( 'sdm_featured_info_description' ) ); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="info-cta">
		<?php if ( get_theme_mod( 'sdm_featured_info_note' ) ) : ?>
			<span class="info-subtitle">
				<?php _e( 'Additional Notes: ', 'sdm' ); ?>
			</span>
			<span class="info-note">
				<?php echo wpautop( get_theme_mod( 'sdm_featured_info_note' ) ); ?>
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
		<?php if ( get_theme_mod( 'sdm_featured_info_url' ) && get_theme_mod( 'sdm_featured_info_button_text' ) ) : ?>
			<a href="<?php echo get_theme_mod( 'sdm_featured_info_url' ); ?>" class="cta-button button <?php echo $cta_button; ?>"><?php echo get_theme_mod( 'sdm_featured_info_button_text' ); ?></a>
		<?php endif; ?>
	</div>
</aside>