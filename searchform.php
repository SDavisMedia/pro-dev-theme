<?php
/**
 * the template for displaying search forms
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'pdt' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'pdt' ); ?>">
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'pdt' ); ?>">
</form>
