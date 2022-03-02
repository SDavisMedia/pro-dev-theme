<?php
get_header();
?>
	<div class="content">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'templates/content', get_post_format() );
			endwhile;
		endif;
		?>
	</div>
<?php
get_footer();