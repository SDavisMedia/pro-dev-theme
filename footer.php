<?php
/**
 * the template for displaying the closing content area and footer
 */
?>

				</div><?php // .site-content ?>
			</div><?php // .main ?>
		</div><?php // .content-area ?>
		
		<div class="footer-area full">
			<div class="main">
				<footer class="site-footer inner">
			
					<?php
						$credits = __( 'Built with WordPress & <a href="' . SDM_HOME . '">' . SDM_NAME . '</a>', 'sdm' );
						
						// If copyright & credits are left empty or have not been set, display default info.
						if ( '' == get_theme_mod( 'sdm_credits_copyright' ) ) :
							echo $credits;
						else :
							echo get_theme_mod( 'sdm_credits_copyright' );
						endif;
					?>
					
				</footer>
			</div>
		</div>
		
		<?php 
			// do not remove WordPress' footer hook
			wp_footer(); 
		?>
	
	</body>
</html>