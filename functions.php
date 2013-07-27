<?php
/**
 * functions and definitions
 */
 

/** ===============
 * Constants
 */
define( 'SDM_NAME', 'Professional Developer' );
define( 'SDM_AUTHOR', 'Sean Davis' );
define( 'SDM_VERSION', '1.0' );
define( 'SDM_HOME', 'http://sdavismedia.com' );
define( 'SDM_DIR', get_template_directory() );
define( 'SDM_URI', get_stylesheet_directory_uri() );
define( 'SDM_PATH_IMAGES', SDM_URI . '/inc/images' );
define( 'SDM_PATH_LANGUAGES', SDM_URI . '/inc/languages' );
define( 'SDM_PATH_UPDATER', SDM_DIR . '/inc/updater' );



/** ===============
 * we need this stuff to survive... and "function" :)
 */
// require SDM_PATH_INC . '/quota-options.php';
 
 
 
/** ===============
 * Set up defaults and registers support
 */
if ( ! function_exists( 'sdm_setup' ) ) :
	function sdm_setup() {
	
		/**
		 * Make theme available for translation
		 */
		load_theme_textdomain( 'sdm', get_template_directory() . '/languages' );
	
		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );
	
		/**
		 * Enable support for Post Thumbnails on posts and pages
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * set feed thumbnail size
		 */
		add_image_size( 'feed-thumb', 120, 120, true );
	
		/**
		 * Register navigation menus
		 */
		register_nav_menus( array(
			'main' => __( 'Main Menu', 'sdm' ),
		) );
	}
endif; // sdm_setup
add_action( 'after_setup_theme', 'sdm_setup' );



/** ===============
 * Enqueue scripts and styles
 */
function sdm_scripts() {
	wp_enqueue_style( 'sdm-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sdm_scripts' );



/** ===============
 * Version custom post type
 */
function create_post_type() {
	$labels = array(
		'name' 				=> __( 'Versions' ),
		'singular_name' 	=> __( 'Version' ),
		'all_items'			=> __( 'All Versions', 'sdm' ),
		'add_new_item'		=> __( 'Add New Version', 'sdm' ),
		'edit_item'			=> __( 'Edit Version', 'sdm' ),
		'new_item'			=> __( 'New Version', 'sdm' ),
		'view_item'			=> __( 'View Version', 'sdm' ),
	);
	
	$rewrite = array( 'slug' => 'version', 'with_front' => false );
	
	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'exclude_from_search'	=> true,
		'menu_position'			=> 25,
		'rewrite'				=> $rewrite,
	);
	
	register_post_type( 'version', $args );
}
add_action( 'init', 'create_post_type' );



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
            background: url(<?php echo SDM_PATH_IMAGES; ?>/version-icon.png) no-repeat 6px -17px !important;
        }
        #menu-posts-version:hover .wp-menu-image, 
        #menu-posts-POSTTYPE.wp-has-current-submenu .wp-menu-image {
            background-position: 6px 7px !important;
        }
    </style>
<?php }
add_action( 'admin_head', 'sdm_versions_icons' );



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
 * Register sidebar areas and version sidebars with default widgets
 */
function sdm_widgets_init() {
	
	/**
	 * Array with unique information about the various widgetized areas
	 */
	$register_sidebars = array(
		'front'			=> array(
			'name'			=> __( 'Front Page Sidebar', 'sdm' ),
			'id'			=> 'sidebar-front',
		),
		'primary'			=> array(
			'name'			=> __( 'Primary Sidebar', 'sdm' ),
			'id'			=> 'sidebar-primary',
		),
	);
	// Register all widgetized areas based on the $register_sidebars information
	foreach ( $register_sidebars as $sidebars ) {
		register_sidebar( array(
			'name'			=> $sidebars[ 'name' ],
			'id'			=> $sidebars[ 'id' ],
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title">&raquo; ',
			'after_title'	=> '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'sdm_widgets_init' );



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
	
			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'sdm' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'sdm' ) . '</span>' ); ?>
	
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
		
			// add .change-log body class to Change Log page templates
			$classes[] = 'change-log';
			
		endif;
		
	endif;
	
	if ( is_multi_author() ) 
		$classes[] = 'group-blog';
		
	return $classes;
}
add_filter( 'body_class', 'sdm_body_classes');



/** ===============
 * Add .top class to the first post in a loop
 */
function sdm_first_post_class($classes) {
	global $wp_query;
	if ( 0 == $wp_query->current_post )
		$classes[] = 'top';
		return $classes;
}
add_filter( 'post_class', 'sdm_first_post_class' );



/** ===============
 * Only show regular posts in search results
 */
function sdm_search_filter($query) {
	if ( $query->is_search )
		$query->set( 'post_type', 'post' );
	return $query;
}
add_filter('pre_get_posts','sdm_search_filter');



/** ===============
 * Adjust excerpt length
 */
function custom_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



/** ===============
 * Replace excerpt ellipses with new ellipses and link to full article
 */
function sdm_excerpt_more( $more ) {
	return ' [...]</p> <p class="more-link"><a href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More &rarr;', 'sdm' ) . '</a></p>';
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