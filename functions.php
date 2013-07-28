<?php
/**
 * All functions have been moved to a remote file called
 *
 * theme-functions.php
 *
 * This is done to make developing with a child theme much easier. 
 * Below, the theme-functions.php file is "required once" and when no
 * child theme is installed, everything will behave just as if all of
 * theme functions were in this file.
 *
 * The Problem:
 *
 * In the event a child theme is installed, WordPress will look for the child
 * theme's functions.php file before this one. Because of this firing order,
 * functions placed in a child theme's functions.php will run *before*
 * the parent theme's functions which may lead to undesirable results 
 * and extra code.
 *
 * The Solution:
 *
 * To make things easier, child themes that wish to run functions.php files
 * should also "require_once" the theme-functions.php 1st (remember, child 
 * theme functions.php files run first). With that in place, the child theme 
 * will have direct and immediate access to all parent theme functions.
 *
 * Because the child theme *must use* "require_once" as well, once WordPress
 * finishes running its functions.php file and moves on to run the parent theme's 
 * functions.php file (this file), it will read the line below and NOT "require"
 * the theme-functions.php file because it has already been required *once* in
 * the child theme.
 *
 * Therefore, child themes with a functions.php file should run the
 * following line above *all* other custom functions:
 *
 * require_once( get_template_directory() . '/inc/theme-functions.php' );
 *
 * Placing all custom functions below that line will keep parent theme core 
 * functions running before the child theme's functions. Sweat deal. :)
 */
 
require_once('inc/theme-functions.php'); // core functions