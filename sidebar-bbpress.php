<?php
/**
 * the bbpress (forum) sidebar widget area
 */
?>

<div class="sidebar">

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php 
	if ( is_active_sidebar( 'sidebar-bbpress' ) ) :
		dynamic_sidebar( 'sidebar-bbpress' );
	else :
		dynamic_sidebar( 'sidebar-primary' );		
	endif;
	?>
		
</div>