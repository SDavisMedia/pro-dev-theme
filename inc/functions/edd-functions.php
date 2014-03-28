<?php
/**
 * functions specific to Easy Digital Downloads
 */
 
 

/** ===============
 * Allow comments on downloads
 */
function pdt_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter( 'edd_download_supports', 'pdt_edd_add_comments_support' );

	
	
/** ===============
 * No purchase button below download content
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );