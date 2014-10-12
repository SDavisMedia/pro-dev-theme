<?php
/**
 * the template for displaying the closing content area and footer
 */
?>

				</div>
			</div>
		</div>		
		<div class="footer-area full">
			<div class="main">
				<footer class="site-footer inner">
					<span class="site-info">
						<?php
							$credits = sprintf( __( 'Built with WordPress & %s', 'pdt' ), '<a href="' . PDT_HOME . '">' . PDT_NAME . '</a>' );
							
							// If copyright & credits are left empty or have not been set, display default info.
							if ( '' == get_theme_mod( 'pdt_credits_copyright' ) ) :
								echo $credits;
							else :
								echo get_theme_mod( 'pdt_credits_copyright', $credits );
							endif;
						?>
					</span>
				</footer>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>