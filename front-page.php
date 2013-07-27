<?php
/**
 * the most generic template file
 */
?>
 
<?php get_header(); ?>

<?php get_template_part( 'templates/content', 'front-page' ); ?>

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>