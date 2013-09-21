<?php
/**
 * display info about the latest major update
 */
?>

<?php 
if ( is_front_page() ) : 
	
	// display default feature box? -- theme customizer
	if ( 'option1' == get_theme_mod( 'sdm_feature_toggle' ) ) : ?>

		<div class="info-box clear-sdm">
			<div class="info-text">
				<h3 class="info-box-title"><?php echo get_theme_mod( 'sdm_feature_product_headline', __( 'Main Product Headline', 'sdm' ) ); ?></h3>
				<div class="info-box-description">
					<?php
						if ( '' != get_theme_mod( 'sdm_feature_product_description' ) ) :
						
							echo get_theme_mod( 'sdm_feature_product_description' );
							
						else : ?>
								<p><?php _e( 'This is where you would add text about your main purpose for people being on your site. What do you really want them to do? Download something?', 'sdm' ); ?></p>
								<p><?php _e( 'Buy something? Subscribe for updates? Let them know why they should make a move here. Then call them to action over there. &rarr;', 'sdm' ); ?></p>
						
						<?php							
						endif;
					?>
				</div>
			</div>
			<div class="info-cta">
				<span class="info-subtitle">Version: <span>2013.07.13b2</span></span>
				<span class="info-subtitle">Overview: <span>Sometimes you have to provide final info unworthy of the excerpt. Keep it short and sweet</span></span>
				<a href="#" class="button green">Purchase Link</a>
			</div>
		</div>

	<?php
	endif;
	
else :
	
	/** 
	* You are free to place whatever you'd like in the feature box below this comment.
	* It will show on every page except the homepage, unless you write a conditional.
	*
	* The feature box design is made to where leaving it empty gives you a space 
	* above .content-area and below .header-area to create a nice separation. However, 
	* if you needed to highlight content, putting it in the feature box still looks great.
	*/
	
endif; // end feature box setup