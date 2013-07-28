<?php
/**
 * functions specific to Easy Digital Downloads
 */
 
 

/** ===============
 * Allow comments on downloads
 */
function sdm_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter( 'edd_download_supports', 'sdm_edd_add_comments_support' );