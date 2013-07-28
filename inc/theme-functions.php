<?php
/**
 * theme functions and definitions
 *
 * Child themes can have direct access to this file by "requiring it once"
 * before the parent theme gets a chance to. For a full description of how
 * this system works, see the functions.php file comment block header.
 */

 

/** ===============
 * Constants and important files
 */
define( 'SDM_NAME', 'Professional Developer Theme' );
define( 'SDM_AUTHOR', 'Sean Davis' );
define( 'SDM_VERSION', '1.0' );
define( 'SDM_HOME', 'http://sdavismedia.com' );
define( 'SDM_DIR', get_template_directory() );
define( 'SDM_DIR_URI', get_template_directory_uri() );
define( 'SDM_THEME_URI', get_stylesheet_directory_uri() );

define( 'SDM_LANGUAGES', SDM_DIR . '/languages' );
define( 'SDM_INC', SDM_THEME_URI . '/inc' );
define( 'SDM_FUNCTIONS', SDM_DIR . '/inc/functions' );
define( 'SDM_FONTS', SDM_INC . '/assets/fonts' );
define( 'SDM_IMAGES', SDM_INC . '/assets/images' );

require( SDM_FUNCTIONS . '/content-functions.php' );
require( SDM_FUNCTIONS . '/version-functions.php' );
require( SDM_FUNCTIONS . '/customizer-functions.php' );
require( SDM_FUNCTIONS . '/edd-functions.php' );
require( SDM_FUNCTIONS . '/updater.php' );	

 
 
/** ===============
 * Set up defaults and add support
 */
if ( ! function_exists( 'sdm_setup' ) ) :
	function sdm_setup() {

		/**
		 * WordPress says it's required. *Shoulder shrug*
		 */
		if ( !isset( $content_width ) ) $content_width = 960;
	
		/**
		 * Make theme available for translation
		 */
		load_theme_textdomain( 'sdm', SDM_LANGUAGES );
	
		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );
	
		/**
		 * Enable support for Post Thumbnails on posts and pages
		 */
		add_theme_support( 'post-thumbnails' );
	
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