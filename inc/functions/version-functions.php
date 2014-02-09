<?php
/**
 * functions specific to the "Versions" custom post type
 */



/** ===============
 * Version custom post type
 */
function create_post_type() {
	$labels = array(
		'name' 				=> __( 'Versions', 'sdm' ),
		'singular_name' 	=> __( 'Version', 'sdm' ),
		'all_items'			=> __( 'All Versions', 'sdm' ),
		'add_new_item'		=> __( 'Add New Version', 'sdm' ),
		'edit_item'			=> __( 'Edit Version', 'sdm' ),
		'new_item'			=> __( 'New Version', 'sdm' ),
		'view_item'			=> __( 'View Version', 'sdm' ),
	);
	
	$rewrite = array( 'slug' => 'versions', 'with_front' => false );
	
	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'exclude_from_search'	=> true,
		'menu_position'			=> 25,
		'has_archive'			=> true,
		'rewrite'				=> $rewrite
	);
	
	register_post_type( 'version', $args );
}
add_action( 'init', 'create_post_type' );



/** ===============
 * Set up version taxonomy
 */
function sdm_version_taxonomy() {

	$product_labels = array(
		'name' 				=> _x( 'Categories', 'taxonomy general name', 'sdm' ),
		'singular_name' 	=> _x( 'Category', 'taxonomy singular name', 'sdm' ),
		'search_items' 		=> __( 'Search Categories', 'sdm'  ),
		'all_items' 		=> __( 'All Categories', 'sdm'  ),
		'parent_item' 		=> __( 'Parent Category', 'sdm'  ),
		'parent_item_colon' => __( 'Parent Category:', 'sdm'  ),
		'edit_item' 		=> __( 'Edit Category', 'sdm'  ),
		'update_item' 		=> __( 'Update Category', 'sdm'  ),
		'add_new_item' 		=> __( 'Add New Category', 'sdm'  ),
		'new_item_name' 	=> __( 'New Category Name', 'sdm'  ),
		'menu_name' 		=> __( 'Categories', 'sdm'  ),
	);
	
	$product_args = array(
		'hierarchical' 	=> true,
		'labels' 		=> $product_labels,
		'show_ui' 		=> true,
		'query_var' 	=> true,
		'rewrite' 		=> array(
			'slug' 			=> 'changelog', 
			'with_front' 	=> false, 
			'hierarchical'	=> true 
		)
	);
	
	register_taxonomy( 'version_category', 'version', $product_args );
	register_taxonomy_for_object_type( 'version_category', 'version' );
}
add_action( 'init', 'sdm_version_taxonomy', 0 );



/** ===============
 * Modify the "Enter title here" text on versions
 */
function sdm_change_default_title( $title ){
     $screen = get_current_screen();
 
     if  ( 'version' == $screen->post_type ) {
          $title = __( 'Enter version number and title', 'sdm' );
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'sdm_change_default_title' );



/** ===============
 * Versions custom post type icons
 */
function sdm_versions_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-version .wp-menu-image {
            background: url(<?php echo SDM_IMAGES; ?>/version-icon.png) no-repeat 6px -17px !important;
        }
        #menu-posts-version:hover .wp-menu-image, 
        #menu-posts-POSTTYPE.wp-has-current-submenu .wp-menu-image {
            background-position: 6px 7px !important;
        }
    </style>
<?php }
add_action( 'admin_head', 'sdm_versions_icons' );