<?php
/**
 * functions specific to content handling
 */



/** ===============
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'sdm_posted_on' ) ) :

	function sdm_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
	
		printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s" rel="author">%6$s</a></span></span>', 'sdm' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string,
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'sdm' ), get_the_author() ) ),
			get_the_author()
		);
	}
endif; // sdm_posted_on



/** ===============
 * Display navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'sdm_content_nav' ) ) :

	function sdm_content_nav( $nav_id ) {
		global $wp_query, $post;
	
		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );
	
			if ( ! $next && ! $previous )
				return;
		}
	
		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;
	
		$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
	
		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
	
		<?php if ( is_single() ) : // navigation links for single posts ?>
	
			<?php previous_post_link( '<div class="nav-previous"><span class="post-nav-title">Previous post:</span>%link</div>', '%title' ); ?>
			<?php next_post_link( '<div class="nav-next"><span class="post-nav-title">Next post:</span>%link</div>', '%title' ); ?>
	
		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
	
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sdm' ) ); ?></div>
			<?php endif; ?>
	
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sdm' ) ); ?></div>
			<?php endif; ?>
	
		<?php endif; ?>
	
		</nav>
		<?php
	}
endif; // sdm_content_nav



/** ===============
 * Display navigation to next/previous attachment when applicable
 */
if ( ! function_exists( 'sdm_attachment_nav' ) ) :

	function sdm_attachment_nav() { ?>

		<nav role="navigation" class="navigation-image">
			<div class="nav-previous">
				<?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'sdm' ) ); ?>
			</div>
			<div class="nav-next">
				<?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'sdm' ) ); ?>
			</div>
		</nav>
		
	<?php }
endif; // sdm_attachment_nav



/** ===============
 * Prints the attached image with a link to the next attached image.
 */
if ( ! function_exists( 'sdm_the_attached_image' ) ) :

	function sdm_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'sdm_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();
	
		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachments = array_values( get_children( array(
			'post_parent'    => $post->post_parent,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		)));
	
		// If there is more than 1 attachment in a gallery...
		if ( count( $attachments ) > 1 ) {
			foreach ( $attachments as $k => $attachment ) {
				if ( $attachment->ID == $post->ID )
					break;
			}
			$k++;
	
			// get the URL of the next image attachment...
			if ( isset( $attachments[ $k ] ) )
				$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	
			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( $attachments[0]->ID );
		}
	
		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( array( 'echo' => false ) ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; // sdm_the_attached_image



/** ===============
 * Register sidebar areas and version sidebars with default widgets
 */
function sdm_widgets_init() {
	
	/**
	 * Register sidebars by default or only if their associate plugins are activated
	 */
	register_sidebar( array(
		'name'			=> __( 'Primary Sidebar', 'sdm' ),
		'id'			=> 'sidebar-primary',
		'description'	=> __( 'ALL sidebars default to this sidebar when they are empty.', 'sdm' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h4 class="widget-title">&raquo; ',
		'after_title'	=> '</h4>',
	) );
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		register_sidebar( array(
			'name'			=> __( 'Easy Digital Downloads Sidebar', 'sdm' ),
			'id'			=> 'sidebar-edd',
			'description'	=> __( 'This sidebar only displays on EDD downloads and templates. If it is empty, it defaults to the Primary Sidebar.', 'sdm' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title">&raquo; ',
			'after_title'	=> '</h4>',
		) );
	}
	if ( class_exists( 'bbPress' ) ) {
		register_sidebar( array(
			'name'			=> __( 'bbPress Sidebar', 'sdm' ),
			'id'			=> 'sidebar-bbpress',
			'description'	=> __( 'This sidebar only displays on the bbPress pages. If it is empty, it defaults to the Primary Sidebar.', 'sdm' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title">&raquo; ',
			'after_title'	=> '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'sdm_widgets_init' );



/** ===============
 * Adds custom classes to the array of body classes
 */
function sdm_body_classes( $classes ) {

	if ( is_front_page() ) :
	
		// add .homepage body class to the home page
		$classes[] = 'homepage';
		
	elseif ( is_single() || is_page() || ( 'version' == get_post_type() ) ) :
		
		// add .singular body class to posts, pages, and versions
		$classes[] = 'singular';
		
		if ( is_page_template( 'change-log.php' ) ) :		
			$classes[] = 'change-log';		
		elseif ( is_page_template( 'edd_templates/edd-store-front.php' ) ) :		
			$classes[] = 'store-front-template no-sidebar';
		elseif ( is_page_template( 'edd_templates/edd-checkout.php' ) ) :		
			$classes[] = 'checkout-template no-sidebar';	
		elseif ( is_page_template( 'edd_templates/edd-confirmation.php' ) ) :		
			$classes[] = 'confirmation-template no-sidebar';
		elseif ( is_page_template( 'edd_templates/edd-history.php' ) ) :		
			$classes[] = 'history-template no-sidebar';
		elseif ( is_page_template( 'edd_templates/edd-members.php' ) ) :		
			$classes[] = 'members-template no-sidebar';
		elseif ( is_page_template( 'edd_templates/edd-failed.php' ) ) :		
			$classes[] = 'failed-template no-sidebar';				
		endif;
		
	endif;
	
	if ( class_exists( 'bbPress' ) && is_bbpress() && 1 == get_theme_mod( 'sdm_bbpress_full_width' ) ) :		
		$classes[] = 'no-sidebar';
	endif;
	
	if ( is_multi_author() ) 
		$classes[] = 'group-blog';
		
	return $classes;
}
add_filter( 'body_class', 'sdm_body_classes');



/** ===============
 * Add .top class to the first post in a loop
 */
function sdm_first_post_class( $classes ) {
	global $wp_query;
	if ( 0 == $wp_query->current_post )
		$classes[] = 'top';
		return $classes;
}
add_filter( 'post_class', 'sdm_first_post_class' );



/** ===============
 * Only show regular posts in search results
 */
function sdm_search_filter( $query ) {
	if ( $query->is_search && !is_admin &&  !is_bbpress() )
		$query->set( 'post_type', 'post' );
	return $query;
}
add_filter( 'pre_get_posts','sdm_search_filter' );



/** ===============
 * Adjust excerpt length
 */
function sdm_custom_excerpt_length( $length ) {
	return 37;
}
add_filter( 'excerpt_length', 'sdm_custom_excerpt_length', 999 );



/** ===============
 * Replace excerpt ellipses with new ellipses and link to full article
 */
function sdm_excerpt_more( $more ) {
	if ( is_page_template( 'edd_templates/edd-store-front.php' ) ) {
		return '...';
	} else {
		return '...</p> <div class="continue-reading"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . get_theme_mod( 'sdm_read_more', __( 'Read More &rarr;', 'sdm' ) ) . '</a></div>';
	}
}
add_filter( 'excerpt_more', 'sdm_excerpt_more' );



/** ===============
 * Protected posts custom password form
 */
function sdm_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><p class="password-protected">
    ' . __( 'To view this protected post, enter the password below:', 'sdm' ) . '</p>
    <input name="post_password" class="post-password" id="' . $label . '" type="password" size="20" placeholder="Enter Password" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit' ) . '" />
    </form>';
    
    return $o;
}
add_filter( 'the_password_form', 'sdm_password_form' );



/** ===============
 * Returns true if a blog has more than 1 category
 */
function sdm_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so sdm_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so sdm_categorized_blog should return false
		return false;
	}
}



/** ===============
 * Flush out the transients used in sdm_categorized_blog
 */
function sdm_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'sdm_category_transient_flusher' );
add_action( 'save_post',     'sdm_category_transient_flusher' );