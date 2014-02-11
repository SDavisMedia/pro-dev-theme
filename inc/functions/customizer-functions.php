<?php
/**
 * Theme Customizer
 */

function sdm_customize_register( $wp_customize ) {
	
	
	
	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class sdm_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
	<?php
		}
	}
	


	/** ===============
	 * Site Title (Logo) & Tagline
	 */
	// section adjustments
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'sdm' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	// logo uploader
	$wp_customize->add_setting( 'sdm_logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sdm_logo', array(
		'label'    => __( 'Custom Site Logo', 'sdm' ),
		'section'  => 'title_tagline',
		'settings' => 'sdm_logo',
	) ) );	
	


	/** ===============
	 * Color Settings
	 */ 
	// sections adjustments
	$wp_customize->get_section( 'colors' )->title = __( 'Color Settings', 'sdm' );
	$wp_customize->get_section( 'colors' )->priority = 20;
	// color settings
	$colors = array();
	$colors[] = array(
		'slug'		=>'sdm_primary_color', 
		'default'	=> '#015F8E',
		'label'		=> __( 'Primary Design Color', 'sdm' )
	);
	// Build settings from $colors array
	foreach( $colors as $color ) {	
		// color settings
		$wp_customize->add_setting( $color['slug'], array(
				'default'		=> $color['default'],
				'type'			=> 'option', 
				'capability'	=> 'edit_theme_options'
			)
		);		
		// color controls
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array(
			'label'		=> $color['label'], 
			'section'	=> 'colors',
			'settings'	=> $color['slug'])
		) );
	}
	// button color
	$wp_customize->add_setting( 'sdm_cta_button_color', array( 'default' => 'green' ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sdm_cta_button_color', array(
		'label'		=> __( 'Call-to-Action Button Color', 'sdm' ),
		'section'	=> 'colors',
		'settings'	=> 'sdm_cta_button_color',
		'priority'	=> 20,
		'type'      => 'radio',
		'choices'   => array(
			'green'		=> 'Green',
			'blue'		=> 'Blue',
			'gray'		=> 'Gray'
		),
	) ) );
	


	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'sdm_content_section', array(
    	'title'       	=> __( 'Content Options', 'sdm' ),
		'description' 	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'sdm' ),
		'priority'   	=> 30,
	) );
	// post content
	$wp_customize->add_setting( 'sdm_post_content', array( 'default' => 'option1' ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sdm_post_content', array(
		'label'		=> __( 'Post Feed Content', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'settings'	=> 'sdm_post_content',
		'priority'	=> 10,
		'type'      => 'radio',
		'choices'   => array(
			'option1'	=> 'Excerpts',
			'option2'	=> 'Full Content'
		),
	) ) );
	// read more link
	$wp_customize->get_setting( 'sdm_read_more' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_read_more', array( 'default' => 'Read More &rarr;' ) );		
	$wp_customize->add_control( 'sdm_read_more', array(
	    'label' 	=> __( 'Excerpt & More Link Text', 'sdm' ),
	    'section' 	=> 'sdm_content_section',
		'settings' 	=> 'sdm_read_more',
		'priority'	=> 20,
	) );
	// show featured images on posts?
	$wp_customize->add_setting( 'sdm_single_featured_image', array( 'default' => 1 ) );
	$wp_customize->add_control( 'sdm_single_featured_image', array(
		'label'		=> __( 'Show Featured Images on Single Posts?', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'priority'	=> 30,
		'type'      => 'checkbox',
	) );
	// show single post footer?
	$wp_customize->add_setting( 'sdm_post_footer', array( 'default' => 1 ) );
	$wp_customize->add_control( 'sdm_post_footer', array(
		'label'		=> __( 'Show Post Footer on Single Posts?', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'priority'	=> 40,
		'type'      => 'checkbox',
	) );
	// comments on pages?
	$wp_customize->add_setting( 'sdm_page_comments', array( 'default' => 0 ) );
	$wp_customize->add_control( 'sdm_page_comments', array(
		'label'		=> __( 'Display Comments on Standard Pages?', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'priority'	=> 50,
		'type'      => 'checkbox',
	) );
	// credits & copyright
	$wp_customize->get_setting( 'sdm_credits_copyright' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_credits_copyright', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_credits_copyright', array(
		'label'		=> __( 'Footer Credits & Copyright', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'settings'	=> 'sdm_credits_copyright',
		'priority'	=> 60,
	) );
	
	

	/** ===============
	 * Feature Box Options
	 */
	$wp_customize->add_section( 'sdm_featured_product', array(
    	'title'       	=> __( 'Featured Product Options', 'sdm' ),
		'description' 	=> __( 'Set the main Featured Product details here which displays in the &rsquo;Front Page&rsquo; feature box and the sidebar of all other pages.', 'sdm' ),
		'priority'   	=> 40,
	) );
	// feature box toggle
	$wp_customize->add_setting( 'sdm_feature_box_toggle', array( 'default' => 1 ) );
	$wp_customize->add_control( 'sdm_feature_box_toggle', array(
		'label'		=> __( 'Display Default Feature Box?', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'priority'	=> 10,
		'type'      => 'checkbox',
	) );
	// feature sidebar box toggle
	$wp_customize->add_setting( 'sdm_feature_sidebar_toggle', array( 'default' => 1 ) );
	$wp_customize->add_control( 'sdm_feature_sidebar_toggle', array(
		'label'		=> __( 'Display Default Sidebar Feature?', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'priority'	=> 20,
		'type'      => 'checkbox',
	) );
	// featured product headline
	$wp_customize->get_setting( 'sdm_featured_product_headline' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_featured_product_headline', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_featured_product_headline', array(
		'label'		=> __( 'Main Product Headline', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'settings'	=> 'sdm_featured_product_headline',
		'priority'	=> 30,
	) );
	// featured product description
	$wp_customize->add_setting( 'sdm_featured_product_description', array( 'default' => null ) );
	$wp_customize->add_control( new sdm_customize_textarea_control( $wp_customize, 'sdm_featured_product_description', array(
		'label'		=> __( 'Main Product Description', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'settings'	=> 'sdm_featured_product_description',
		'priority'	=> 40,
	) ) );
	// featured product version
	$wp_customize->get_setting( 'sdm_featured_product_version' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_featured_product_version', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_featured_product_version', array(
		'label'		=> __( 'Main Product Version', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'settings'	=> 'sdm_featured_product_version',
		'priority'	=> 50,
	) );
	// featured product note
	$wp_customize->get_setting( 'sdm_featured_product_note' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_featured_product_note', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_featured_product_note', array(
		'label'		=> __( 'Main Product Note', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'settings'	=> 'sdm_featured_product_note',
		'priority'	=> 60,
	) );
	// featured product url
	$wp_customize->add_setting( 'sdm_featured_product_url', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_featured_product_url', array(
		'label'		=> __( 'URL to Product Page', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'settings'	=> 'sdm_featured_product_url',
		'priority'	=> 70,
	) );
	// featured product button text
	$wp_customize->get_setting( 'sdm_featured_product_button_text' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_featured_product_button_text', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_featured_product_button_text', array(
		'label'		=> __( 'Button Text', 'sdm' ),
		'section'	=> 'sdm_featured_product',
		'settings'	=> 'sdm_featured_product_button_text',
		'priority'	=> 80,
	) );
	
	

	/** ===============
	 * Easy Digital Downloads Options
	 */
	// only if EDD is activated
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$wp_customize->add_section( 'sdm_edd_options', array(
	    	'title'       	=> __( 'Easy Digital Downloads', 'sdm' ),
			'description' 	=> __( 'You must set the \'Store Front Headline\' if using the Store Front page template. All other EDD options are under Dashboard => Downloads.', 'sdm' ),
			'priority'   	=> 50,
		) );
		// show comments on downloads?
		$wp_customize->add_setting( 'sdm_download_comments', array( 'default' => 0 ) );
		$wp_customize->add_control( 'sdm_download_comments', array(
			'label'		=> __( 'Display Comments on Download Pages?', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'priority'	=> 10,
			'type'      => 'checkbox',
		) );
		// store front/downloads archive headline
		$wp_customize->get_setting( 'sdm_edd_store_archives_title' )->transport = 'postMessage';
		$wp_customize->add_setting( 'sdm_edd_store_archives_title', array( 'default' => null ) );
		$wp_customize->add_control( 'sdm_edd_store_archives_title', array(
			'label'		=> __( 'Store/Download Archives Main Title', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'settings'	=> 'sdm_edd_store_archives_title',
			'priority'	=> 20,
		) );
		// store front/downloads archive description
		$wp_customize->add_setting( 'sdm_edd_store_archives_description', array( 'default' => null ) );
		$wp_customize->add_control( new sdm_customize_textarea_control( $wp_customize, 'sdm_edd_store_archives_description', array(
			'label'		=> __( 'Store/Download Archives Description', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'settings'	=> 'sdm_edd_store_archives_description',
			'priority'	=> 30,
		) ) );
	}
	
	

	/** ===============
	 * Social Network Options
	 */
	$wp_customize->add_section( 'sdm_social_networks', array(
    	'title'       	=> __( 'Social Networking Profiles', 'sdm' ),
		'description' 	=> __( 'Paste full URLs to profiles. The URLs will be used in various places around the theme like the post footer author section on single posts.', 'sdm' ),
		'priority'   	=> 60,
	) );
	// twitter url
	$wp_customize->add_setting( 'sdm_twitter', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_twitter', array(
		'label'		=> __( 'Twitter Profile URL', 'sdm' ),
		'section'	=> 'sdm_social_networks',
		'settings'	=> 'sdm_twitter',
		'priority'	=> 10,
	) );
	// facebook url
	$wp_customize->add_setting( 'sdm_facebook', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_facebook', array(
		'label'		=> __( 'Facebook Profile URL', 'sdm' ),
		'section'	=> 'sdm_social_networks',
		'settings'	=> 'sdm_facebook',
		'priority'	=> 20,
	) );
	// google plus url
	$wp_customize->add_setting( 'sdm_gplus', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_gplus', array(
		'label'		=> __( 'Google Plus Profile URL', 'sdm' ),
		'section'	=> 'sdm_social_networks',
		'settings'	=> 'sdm_gplus',
		'priority'	=> 30,
	) );
	// github url
	$wp_customize->add_setting( 'sdm_github', array( 'default' => null ) );
	$wp_customize->add_control( 'sdm_github', array(
		'label'		=> __( 'Github Profile URL', 'sdm' ),
		'section'	=> 'sdm_social_networks',
		'settings'	=> 'sdm_github',
		'priority'	=> 40,
	) );
	
	

	/** ===============
	 * Navigation Menu
	 */
	// section adjustments
	$wp_customize->get_section( 'nav' )->title = __( 'Navigation Menu', 'sdm' );
	$wp_customize->get_section( 'nav' )->priority = 70;
	
	

	/** ===============
	 * Static Front Page
	 */
	// section adjustments
	$wp_customize->get_section( 'static_front_page' )->priority = 80;	
}
add_action( 'customize_register', 'sdm_customize_register' );



/** ===============
 * Add Customizer theme styles to <head>
 */
function sdm_customizer_head_styles() {
	$sdm_primary_color = get_option( 'sdm_primary_color' );
	
	/**
	 * Only add styles to the head of the document if the styles
	 * have been changed from default. 
	 */		
	if ( '#015F8E' != $sdm_primary_color ) : // Primary design color ?>

		<style type="text/css">
			a, .site-title a:hover, .main-menu ul li:hover > ul a:hover, .product-title:hover { 
				color: <?php echo $sdm_primary_color; ?>; 
			}
			.main-menu > ul > li > a:hover, 
			.main-menu > ul > .current-menu-item > a { 
				border-bottom: 3px solid <?php echo $sdm_primary_color; ?>; 
			}
			.bypostauthor .comment-meta { 
				border-right: 1px solid <?php echo $sdm_primary_color; ?>; 
			}
		</style>
	<?php 
	endif;
}
add_action( 'wp_head','sdm_customizer_head_styles' );



/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function sdm_customizer_styles() { ?>
	<style type="text/css">
		body { background: #fff; }
		.description { display: block; color: #999; margin: 2px 0 5px; font-style: italic; }
		textarea, input, select, .customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 10px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		#customize-control-sdm_read_more { margin-bottom: 20px; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'sdm_customizer_styles');



/** ===============
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sdm_customize_preview_js() {
	wp_enqueue_script( 'sdm_customizer', get_template_directory_uri() . '/inc/assets/js/customizer.js', array( 'customize-preview' ), '20130727', true );
}
add_action( 'customize_preview_init', 'sdm_customize_preview_js' );