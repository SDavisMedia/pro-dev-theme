<?php
/**
 * the template part for change log output
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	<header class="entry-header">
		<span class="entry-title">
			<h1><?php the_title(); ?></h1>
		</span>
		<div class="entry-meta">
		
			<?php	
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			
				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);
			
				printf( __( 'Released on %s ', 'sdm' ), $time_string );
				
				edit_post_link( __( 'Edit', 'sdm' ), '<span class="edit-link">', '</span>' ); 
			?>

		</div>
	</header>	
	<section class="entry-content">
		<?php the_content(); ?>
	</section>
</article>