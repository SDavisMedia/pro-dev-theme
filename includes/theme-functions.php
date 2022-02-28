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
define( 'PDT_NAME', 'Professional Developer Theme' );
define( 'PDT_AUTHOR', 'Sean Davis' );
define( 'PDT_VERSION', '2.0.0' );
define( 'PDT_HOME', 'https://github.com/SDavisMedia/pro-dev-theme' );
define( 'PDT_DIR', get_template_directory() );
define( 'PDT_DIR_URI', get_template_directory_uri() );
define( 'PDT_THEME_URI', get_stylesheet_directory_uri() );

define( 'PDT_LANGUAGES', PDT_DIR . '/languages' );
define( 'PDT_INC', PDT_THEME_URI . '/includes' );
define( 'PDT_FUNCTIONS', PDT_DIR . '/includes/functions' );
define( 'PDT_FONTS', PDT_DIR_URI . '/includes/assets/fonts' );
define( 'PDT_IMAGES', PDT_INC . '/assets/images' );

require( PDT_FUNCTIONS . '/content-functions.php' );
require( PDT_FUNCTIONS . '/customizer-functions.php' );
require( PDT_FUNCTIONS . '/updater.php' );


/** ===============
 * Set up defaults and add support
 */
if ( ! function_exists( 'pdt_setup' ) ) :
	function pdt_setup() {
		global $content_width;

		/**
		 * Set the max content width for media
		 */
		if ( !isset( $content_width ) ) {
			$content_width = 615;
		}

		/**
		 * Make theme available for translation
		 */
		load_theme_textdomain( 'pdt', PDT_LANGUAGES );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 */
		add_theme_support( 'post-thumbnails' );
		// add size for downloads
		add_image_size( 'product-img', 540, 360, true );

		/**
		 * Register navigation menus
		 */
		register_nav_menus( array(
			'main' => __( 'Main Menu', 'pdt' ),
		) );
	}
endif; // pdt_setup
add_action( 'after_setup_theme', 'pdt_setup' );


/** ===============
 * Enqueue scripts and styles
 */
function pdt_scripts() {
	wp_enqueue_style( 'pdt-style', get_stylesheet_uri() );

	// responsive menu
	wp_enqueue_script( 'pdt-navigation', PDT_DIR_URI . '/includes/assets/js/navigation.js', array(), PDT_VERSION, true );

	// font awesome fonts
	wp_enqueue_style( 'fontawesome', PDT_FONTS . '/font-awesome/css/font-awesome.min.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pdt_scripts' );