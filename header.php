<?php
/**
 * the template for the document <head>
 */
$title = get_bloginfo('name');
$tagline = get_bloginfo('description');
$char = get_bloginfo('charset');
$ping = get_bloginfo('pingback_url');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo $char; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
		
		<?php 
			echo
			wp_title( '|', true, 'right' ),
			$title,

			// Add the blog description for the home/front page.
			(!empty($tagline) && (is_home() || is_front_page()) ? " | $tagline" : ''),

			// Add a page number if necessary:
			($paged >= 2 || $page >= 2 ? ' | ' . sprintf(__('Page %s', 'sdm'), max($paged, $page)) : ''); 
		?>
		
		</title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php echo $ping; ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		
		<div class="header-area full">
			<div class="main">
				<header class="site-header inner">
					<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $title ); ?>"><?php bloginfo( 'name' ); ?></a>
					<span class="site-description"><?php echo $tagline; ?></span>
				</header>
			</div>
		</div>
	
		<div class="menu-area full">
			<div class="main">
				<div class="menu inner clear-sdm">
					<?php
						// main menu configuration 
						$menu_args = array( 
							'theme_location' => 'main', 
							'container_class' => 'main-menu',
							'fallback_cb' => '' 
						);
						wp_nav_menu( $menu_args );
					?>
					<div class="search-container">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="feature-area full">
			<div class="main">
				<div class="feature inner clear-sdm">
						
					<?php
						// call the templates/content-feature-box.php
						get_template_part( 'templates/content', 'feature-box' );
					?>
						
				</div>
			</div>
		</div>
		
		<div class="content-area full">
			<div class="main">
				<div class="site-content clear-sdm">