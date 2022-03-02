<?php
/**
 * functions specific to content handling
 */


/** ===============
 * social networking profiles
 */
function pdt_social_profiles() {
	/**
	 * Built into the Customizer are a fields for social profiles.
	 * Using the following array, check to see if the field
	 * has a URL. If so, create a link for the profile. If not, do nothing.
	 */
	$profiles_menu = array(
		'github'	=> array(
			'name' 		=> 'Github',
			'option'	=> esc_url( get_theme_mod( 'pdt_github' ) ),
			'icon'		=> '<i class="fa fa-github-alt"></i>'
		),
		'twitter'	=> array(
			'name' 		=> 'Twitter',
			'option'	=> esc_url( get_theme_mod( 'pdt_twitter' ) ),
			'icon'		=> '<i class="fa fa-twitter"></i>'
		),
		'facebook'	=> array(
			'name' 		=> 'Facebook',
			'option'	=> esc_url( get_theme_mod( 'pdt_facebook' ) ),
			'icon'		=> '<i class="fa fa-facebook-square"></i>'
		)
	);
	// Build the social networking profile links based on the $social_profiles
	foreach ( $profiles_menu as $profile ) {
		if ( '' != $profile[ 'option' ] ) {
			echo '<a class="social-nav-item" href="', $profile[ 'option' ], '" title="', $profile[ 'name' ], '">', $profile[ 'icon' ], '</a>';
		}
	}
}


/** ===============
 * fallback function for empty menus
 */
function pdt_menu_fallback() { ?>
	<div class="main-menu">
		<ul id="menu-main-menu" class="menu nav-menu">
			<li class="menu-item">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>"><?php _e( 'Home', 'pdt' ); ?></a>
			</li>
		</ul>
	</div>
<?php }


/** ===============
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'pdt_posted_on' ) ) :

	function pdt_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s" rel="author">%6$s</a></span></span>', 'pdt' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string,
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'pdt' ), get_the_author() ) ),
			get_the_author()
		);
	}
endif; // pdt_posted_on


/** ===============
 * Display navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'pdt_content_nav' ) ) :

	function pdt_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
			<?php
			if ( is_single() ) { // navigation links for single posts

				previous_post_link( '<div class="nav-previous"><span class="post-nav-title">' . __( 'Previous post:', 'pdt' ) . '</span>%link</div>', '%title' );
				next_post_link( '<div class="nav-next"><span class="post-nav-title">' . __( 'Next post:', 'pdt' ) . '</span>%link</div>', '%title' );

			} elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) {

				if ( get_next_posts_link() ) { ?>
					<div class="nav-previous">
						<?php next_posts_link( '<span class="meta-nav">&larr;</span> ' . __( 'Older posts', 'pdt' ) ); ?>
					</div>
					<?php
				}

				if ( get_previous_posts_link() ) {
					?>
					<div class="nav-next">
						<?php previous_posts_link( __( 'Newer posts', 'pdt' ) . ' <span class="meta-nav">&rarr;</span>' ); ?>
					</div>
					<?php
				}
			}
			?>
		</nav>
		<?php
	}
endif; // pdt_content_nav


/** ===============
 * Display navigation to next/previous attachment when applicable
 */
if ( ! function_exists( 'pdt_attachment_nav' ) ) :

	function pdt_attachment_nav() { ?>

		<nav role="navigation" class="navigation-image">
			<div class="nav-previous">
				<?php previous_image_link( false, '<span class="meta-nav">&larr;</span> ' . __( 'Previous', 'pdt' ) ); ?>
			</div>
			<div class="nav-next">
				<?php next_image_link( false, __( 'Next', 'pdt' ) . ' <span class="meta-nav">&rarr;</span>' ); ?>
			</div>
		</nav>

	<?php }
endif; // pdt_attachment_nav


/** ===============
 * Prints the attached image with a link to the next attached image.
 */
if ( ! function_exists( 'pdt_the_attached_image' ) ) :

	function pdt_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'pdt_attachment_size', array( 1200, 1200 ) );
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
				if ( $attachment->ID == $post->ID ) {
					break;
				}
			}
			$k++;

			if ( isset( $attachments[ $k ] ) ) { // get the URL of the next image attachment...
				$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
			} else { // or get the URL of the first image attachment.
				$next_attachment_url = get_attachment_link( $attachments[0]->ID );
			}
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( array( 'echo' => false ) ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; // pdt_the_attached_image


/** ===============
 * Register sidebar areas with default widgets
 */
function pdt_widgets_init() {

	/**
	 * Register sidebars by default or only if their associate plugins are activated
	 */
	register_sidebar( array(
		'name'			=> __( 'Primary Sidebar', 'pdt' ),
		'id'			=> 'sidebar-primary',
		'description'	=> __( 'ALL sidebars default to this sidebar when they are empty.', 'pdt' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h4 class="widget-title">&raquo; ',
		'after_title'	=> '</h4>',
	) );
}
add_action( 'widgets_init', 'pdt_widgets_init' );


/** ===============
 * Adds custom classes to the array of body classes
 */
function pdt_body_classes( $classes ) {

	if ( is_front_page() ) {
		$classes[] = 'homepage';
	}

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'pdt_body_classes');


/** ===============
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function pdt_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'pdt_wp_title', 10, 2 );


/** ===============
 * Only show regular posts in search results
 */
function pdt_search_filter( $query ) {
	if ( $query->is_search && ! is_admin() ) {
		$query->set( 'post_type', 'post' );
	}

	return $query;
}
add_filter( 'pre_get_posts','pdt_search_filter' );


/** ===============
 * Adjust excerpt length
 */
function pdt_custom_excerpt_length( $length ) {
	return 37;
}
add_filter( 'excerpt_length', 'pdt_custom_excerpt_length', 999 );


/** ===============
 * Protected posts custom password form
 */
function pdt_password_form() {
    global $post;

    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

    $protect_post_form = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
    $protect_post_form .= '<p class="password-protected">' . __( 'To view this protected post, enter the password below:', 'pdt' ) . '</p>';
    $protect_post_form .= '<input name="post_password" class="post-password" id="' . $label . '" type="password" size="20" placeholder="' . __( 'Enter Password', 'pdt' ) . '" />';
    $protect_post_form .= '<input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'pdt' ) . '" />';
    $protect_post_form .= '</form>';

    return $protect_post_form;
}
add_filter( 'the_password_form', 'pdt_password_form' );


/** ===============
 * Returns true if a blog has more than 1 category
 */
function pdt_categorized_blog() {
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
		return true; // This blog has more than 1 category so pdt_categorized_blog should return true
	} else {
		return false; // This blog has only 1 category so pdt_categorized_blog should return false
	}
}


/** ===============
 * Flush out the transients used in pdt_categorized_blog
 */
function pdt_category_transient_flusher() {
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'pdt_category_transient_flusher' );
add_action( 'save_post',     'pdt_category_transient_flusher' );