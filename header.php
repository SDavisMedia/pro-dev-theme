<?php
/**
 * the template for the document <head>
 */
$title = get_bloginfo( 'name' );
$tagline = get_bloginfo( 'description' );
$char = get_bloginfo( 'charset' );
$ping = get_bloginfo( 'pingback_url' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo $char; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php echo $ping; ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php // site wide header area ?>
		<div class="header-area full">
			<div class="main">
				<header class="site-header inner">
					<span class="site-title">
						<?php if ( get_theme_mod( 'pdt_logo' ) ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo get_theme_mod( 'pdt_logo' ); ?>" alt="<?php echo esc_attr( $title ); ?>">
							</a>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $title ); ?>">
								<?php echo $title; ?>
							</a>
						<?php endif; ?>
					</span>
					<?php if ( 1 != get_theme_mod( 'pdt_hide_tagline' ) ) : ?>
						<h1 class="site-description"><?php echo $tagline; ?></h1>
					<?php endif; ?>
					<div class="social-nav">
						<?php pdt_social_profiles(); ?>
					</div>
				</header>
			</div>
		</div>

		<div class="menu-area full">
			<div class="main">
				<nav id="site-navigation" class="main-navigation menu inner clear-pdt" role="navigation">
					<span class="menu-toggle"><i class="fa fa-bars"></i> <?php _e( 'Menu', 'pdt' ); ?></span>
					<?php
						// main menu configuration
						$menu_args = array(
							'theme_location' => 'main',
							'container_class' => 'main-menu',
							'fallback_cb' => 'pdt_menu_fallback'
						);
						wp_nav_menu( $menu_args );
					?>
					<div class="search-container">
						<i class="fa fa-search main-search-icon"></i><?php get_search_form(); ?>
					</div>
				</nav>
			</div>
		</div>

		<?php // site wide content area... closes in footer.php ?>
		<div class="content-area full">
			<div class="main">
				<div class="site-content clear-pdt">